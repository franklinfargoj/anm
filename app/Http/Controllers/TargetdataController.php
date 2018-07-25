<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;
use App\AnmTargetDataModel;
use Illuminate\Support\Facades\Storage;
use Session;
use Carbon\Carbon;
use Excel;
use File;
use DB;
use DataTables;
use App\Classes\ConvertToUnicode;

use Illuminate\Support\Facades\Auth;
use App\District;
use App\Block;
use App\Http\Requests\ImportAnmRequest;


class TargetdataController extends Controller
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $district = District::pluck('district_name', 'id');
        $first_district = $district->first();
        $block = Block::whereHas('district', function ($query) use ($first_district) {
            $query->where('district_name', $first_district);
        })->pluck('block_name', 'id');
        return view('import', compact('district', 'block'));

    }

    public function fetchTargetData()
    {
        $target_data = AnmTargetDataModel::select('id', 'og_filename as filenames','filename', 'uploaded_on','schedule_at', 'status', 'created_at',\DB::raw('group_concat(anm_sms_initiated) as anm_sent'))
            ->selectRaw("(CASE WHEN status='N' THEN 'Pending' WHEN status='Y' THEN 'Successful' END) as status")
            ->groupBy('filename')
            ->orderBy('created_at', 'DESC')
            ->get();

        $db = Datatables::of($target_data);
        $db->addColumn('sr_no', function ($target_data) {
            static $i = 0;
            $i++;
            return $i;
        })->rawColumns(['id']);
        $db->addColumn('actions', function ($target_data) {
            return '<a href="' . route('processedfile', $target_data['id']) . '">View details</a>';
        })->addColumn('reschedule', function($target_data){
            return '
<input type="hidden" id="'.$target_data['filename'].'" value="'.$target_data['filename'].'">
<input type="text" class="re_schedule" name="re_schedule" class="form-control">';
        })->rawColumns(['actions','reschedule']);


        return $db->make(true);
    }

    public function importFile(ImportAnmRequest $request)
    {
        $obj = new ConvertToUnicode();
        //$this->validate($request, array('sample_file' => 'required'));;
        if ($request->hasFile('sample_file')) {
            $extension = File::extension($request->sample_file->getClientOriginalName(''));

            $months = DB::table('master_months')->pluck('month_translated', 'id');
            if ($extension == "xlsx" || $extension == "xls") {
                $path = $request->file('sample_file')->getRealPath();
                $data = \Excel::selectSheets('target_data')->load($path)->get()->toArray();
                $file_name = time() . $request->sample_file->getClientOriginalName();
                $og_file_name = $request->sample_file->getClientOriginalName();
                $day_time = Carbon::now()->toDateTimeString('Y-m-d');
                $day = Carbon::now()->toDateString('Y-m-d');
                $web = array();
                $beneficiary = array();
                $moic = array();

                if (count($data) > 0) {
                    $phcNameInHindi = "";
                    $moicNameInHindi = "";
                    $anmNameInHindi = "";
                    foreach ($data as $key => $value) {
                        if (!in_array($value["phc_name"], $web)) {
                            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                            $str = substr(str_shuffle($chars), 0, 10);
                            $web[] = $value["phc_name"];
                            $web[$value["phc_name"]] = $str;

                            $str1 = substr(str_shuffle($chars), 0, 10);
                            $beneficiary[] = $value["phc_name"];
                            $beneficiary[$value["phc_name"]] = $str1;

                            $str2 = substr(str_shuffle($chars), 0, 10);
                            $moic[] = $value["phc_name"];
                            $moic[$value["phc_name"]] = $str2;
                        }
                        //$separated = explode(',', $obj->convert_to_unicode2($value['anm_name_hindi']));
                        $msg = '';
                        $separated = $value['anm_name_hindi'];
                        $anmNameInHindi = $obj->convert_to_unicode2($value['anm_name_hindi']);
                        if(str_contains($value['anm_name_hindi'], ',')){
                            $separated = [];
                            $exploded = explode(',', $value['anm_name_hindi']);
                            foreach ($exploded as $single) {
                                $separated[] = $obj->convert_to_unicode2($single);
                            }
                            $anmNameInHindi = implode(',', $separated);
                            foreach ($separated as $single) {
                                $msg .= $single . ' जानना चाहते हैं की ' . $months[$request->get('month')] . ' ' . $request->get('year') . ' में ' . $obj->convert_to_unicode2($value['phc_name_hindi']) . ' पीएचसी के किस  एनम् ने सबसे अच्छा काम किया?
                                    जानने के लिए नीचे लिंक पर क्लिक करके देखिये:,';
                            }
                        }else{
                            $msg = $obj->convert_to_unicode2($value['anm_name_hindi']).' जानना चाहते हैं की ' . $months[$request->get('month')] . ' ' . $request->get('year') . ' में ' . $obj->convert_to_unicode2($value['phc_name_hindi']) . ' पीएचसी के किस  एनम् ने सबसे अच्छा काम किया?
                                    जानने के लिए नीचे लिंक पर क्लिक करके देखिये:,';
                        }
                        $phcNameInHindi = $obj->convert_to_unicode2($value["phc_name_hindi"]);
                        $moicNameInHindi = $obj->convert_to_unicode2($value["moic_name_hindi"]);

                        $arr[] = [
                            'district' => $request->get("district"),
                            'block' => $value["block"],
                            'subcenter' => $value["phcsc"],
                            'phc_name' => strtolower($value["phc_name"]),
                            'phc_hin' => $phcNameInHindi,
                            'moic_name' => $value["moic_name"],
                            'moic_hin' => $moicNameInHindi,
                            'moic_mobile_number' => $value["moic_phone_number"],
                            'anm_name' => $value["anm_name"],
                            'anm_hin' => $anmNameInHindi,
                            'anm_mobile_number' => $value["anm_phone_number"],
                            'performer_category' => $value["performer_category"],
                            'scenerio' => $value["scenario"],
                            'created_at' => $day_time,
                            'uploaded_on' => $day,
                            'weblink' => $web[$value["phc_name"]],
                            'schedule_at'=>  $request->get("schedule_at"),
                            'filename' => $file_name,
                            'og_filename' => $og_file_name,
                            /*'beneficiary_code'=> $beneficiary[$value["phc_name"]],
                            'moic_code'=>$moic[$value["phc_name"]],*/
                            'month' => $request->get('month'),
                            'year' => $request->get('year'),
                            'anm_custom_msg' => rtrim($msg, ','),
                            'moic_custom_msg' => $obj->convert_to_unicode2($value['moic_name_hindi']) . ' जानना चाहते हैं की ' . $months[$request->get('month')] . ' ' . $request->get('year') . ' में  ' . $obj->convert_to_unicode2($value['phc_name_hindi']) . ' पीएचसी के किस  एनम् ने सबसे अच्छा काम किया?
    जानने के लिए नीचे लिंक पर क्लिक करके देखिये:',
                            'beneficiary_custom_msg' => 'जानना चाहते हैं की ' . $months[$request->get('month')] . ' ' . $request->get('year') . ' में  ' . $obj->convert_to_unicode2($value['phc_name_hindi']) . ' पीएचसी के किस  एनम् ने सबसे अच्छा काम किया?
    जानने के लिए नीचे लिंक पर क्लिक करके देखिये:'
                        ];
                    }
                    if (!empty($arr)) {
                        $inserted = DB::table('anm_target_data')->insert($arr);
                        if ($inserted) {
                            Session::flash('success', 'File Uploaded successfully!');
                            Storage::putFileAs('FileUpload', $request->file('sample_file'), $file_name);
                            return back();
                        }
                    }

                } else {
                    Session::flash('error', 'Please select valid data file.');
                    return back();
                }
            } else {
                Session::flash('error', 'Please upload a valid xls/xlsx file only');
                return back();
            }
        }
    }


/*    public function homePage()
    {
        return view('home');
    }*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function getBlocks(District $district)
    {
        try{
            return ['status' => 200, 'data' => $district->blocks];
        }catch(Exception $ex){
            return ['status' => 404 ,'message' => 'not found', 'data' => ''];
        }
    }


    public function update_sms_schedule(Request $request)
    {
        $data = $request->toArray();
        $file_name =$data['file_name'];
        $date_time=$data['date_time'];
        $result = AnmTargetDataModel::where('filename',$file_name)->update(array('schedule_at'=>$date_time));
        return;
    }
}
