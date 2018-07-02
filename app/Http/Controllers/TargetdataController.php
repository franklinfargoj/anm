<?php

namespace App\Http\Controllers;

use App\AnmTargetDataModel;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\Storage;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Excel;
use File;
use DB;
use DataTables;



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
        return view('import');
    }

    public function fetchTargetData()
    {
        $target_data = AnmTargetDataModel::select('id', 'og_filename as filenames', 'uploaded_on', 'status')
            ->groupBy('filename')
            ->get();

        $db = Datatables::of($target_data);

        $db->addColumn('actions', function ($target_data) {
            return '<a class="btn btn-xs btn-primary" href="">View</a>';
        })
        ->rawColumns(['actions']);
        return $db->make(true);
    }

    public function importFile(Request $request)
    {
        $this->validate($request, array('sample_file' => 'required'));
        if ($request->hasFile('sample_file')) {
            $extension = File::extension($request->sample_file->getClientOriginalName(''));

            if ($extension == "xlsx" || $extension == "xls") {
                $path = $request->file('sample_file')->getRealPath();
                $data = \Excel::selectSheets('target_data')->load($path)->get()->toArray();
                //$data = \Excel::selectSheets('anm_translations')->load($path)->get()->toArray();
                //$data = \Excel::selectSheets('beneficiary_details')->load($path)->get()->toArray();
                //$data = \Excel::selectSheets('phc_translations')->load($path)->get()->toArray();
                $file_name = time() .$request->sample_file->getClientOriginalName();
                $day_time = Carbon::now()->toDateTimeString('Y-m-d');
                $day = Carbon::now()->toDateString('Y-m-d');

                if (count($data)>0) {
                    foreach ($data as $key => $value) {
                        $arr[] = [
                            'district' => $value["district"],
                            'block' => $value["block"],
                            'phc_name' =>$value["phc_name"],
                            'moic_name' =>$value["moic_name"],
                            'moic_mobile_number' =>$value["moic_phone_number"],
                            'anm_name' =>$value["anm_name"],
                            'anm_mobile_number' =>$value["anm_phone_number"],
                            'performer_category' =>$value["performer_category"],
                            'scenerio' =>$value["scenario"],
                            'created_at'=> $day_time,
                            'uploaded_on'=>$day,
                            'filename'=>$file_name
                        ];
                    }

                    if (!empty($arr)) {
                        $inserted = DB::table('anm_target_data')->insert($arr);
                        if($inserted){
                            Storage::putFileAs('FileUpload',$request->file('sample_file'), $file_name);
                        }
                    }
                }
            } else {
                Session::flash('error', 'File is a ' . $extension . ' file.!! Please upload a valid xls/xlsx file..!!');
                return back();
            }
        }  return back();
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



}
