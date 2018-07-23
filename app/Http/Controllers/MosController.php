<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AnmTargetDataModel;
use App\PhcTranslationModel;
use App\District;
use App\Http\Requests\ImportMosRankingRequest;
use App\MoicRanking;
use Excel;
use File;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Storage;
use App\Classes\ConvertToUnicode;
use Chumper\Zipper\Zipper;
use App\RankingZip;
use Session;



class MosController extends Controller
{

    public function index()
    {
        return view('mois');
    }

    public function fetchRankingData(){

        $moic = MoicRanking::select('id','og_moic_filename AS filenames', 'zip_path', 'uploaded_file')
                                ->selectRaw("DATE(created_at) as uploaded_on" )
                                ->groupBy('uploaded_file')
                                ->orderBy('created_at', 'DESC')
                                ->get()
                                ->toArray();

        $db = Datatables::of($moic);
        $db->addColumn('sr_no', function ($moic){ static $i = 0; $i++; return $i; }) ->rawColumns(['id']);
        $db->addColumn('actions', function ($moic) {
            return '<a href="'.route('rankingdetails',$moic['id']).'">View details</a>';
        })->addColumn('download_zip', function($moic){
            if($moic['zip_path'] != ''){
                $folder = explode('.', $moic['uploaded_file']);
                return '<a href="'.url('/download/moic_zip/'.$folder[0]).'" target="_blank">Download Zip</a>';
            }
            return "Processing";
        })->rawColumns(['actions', 'download_zip']);

        return $db->make(true);
    }


    public function ajaxMoic($id)
    {
       return view('moic_detail',compact('id'));
    }


    public function rank_details($id)
    {
        $links = \DB::table('moic_ranking_reports')->pluck('dr_weblink')->toArray();
        $file = MoicRanking::select('uploaded_file')->where('id',$id)->get()->toArray();
        $file_name = $file[0]['uploaded_file'];

        $moic = MoicRanking::select('id', 'block', 'ranking_pdf', 'sms', 'phc_en', 'dr_name_en')
                            ->orderBy('created_at', 'DESC')
                            ->where('uploaded_file',$file_name)
                            ->get()->toArray();

        $db = Datatables::of($moic);

        $db->addColumn('sr_no', function ($moic){
            static $i = 0; $i++; return $i;
        })->addColumn('sms_span', function($moic){
            $modifyed = str_replace('(', '<span class="">', $moic['sms']);
            $modifyed = str_replace(')', '</span>', $modifyed);
            return '<span class="">'.$modifyed.'</span>';
        })->addColumn('link', function($moic) use($links){
            if(in_array(md5($moic['id']), $links)){
                return '<a href="'.url('/moic/report/'.md5($moic['id'])).'" target="_blank">View</a>';
            }
            return "Processing";
        })->rawColumns(['id', 'sms_span', 'link']);
        return $db->make(true);
    }



    public function importRankings(ImportMosRankingRequest $request)
    {
        $obj = new ConvertToUnicode();
        if($request->hasFile('sample_file')){
        $extension = File::extension($request->sample_file->getClientOriginalName(''));

            if ($extension == "xlsx" || $extension == "xls") {
            $path = $request->file('sample_file')->getRealPath();
            $data = \Excel::selectSheets('MOIC_Ranking_SMS')->load($path)->get()->toArray();
            $file_name = time() .$request->sample_file->getClientOriginalName();

            $moic_filename = $request->sample_file->getClientOriginalName();
            $day_time = Carbon::now()->toDateTimeString('Y-m-d');
            $day = Carbon::now()->toDateString('Y-m-d');
            $web = array();
            $beneficiary = array();
            $moic = array();

                if (count($data)>0) {
                    foreach ($data as $key => $value) {
                        $phcNameInHindi = $obj->convert_to_unicode2($value["phc_name_in_hindi"]);
                        $doctorNameInHindi = $obj->convert_to_unicode2($value["doctor_name_in_hindi"]);
                        $blockNameInHindi = $obj->convert_to_unicode2($value["block_name_in_hindi"]);
                        $arr[] = [
                            'block' => $value["block"],
                            'block_hin' => $blockNameInHindi,
                            'phc_en' =>$value["phc"],
                            'phc_hin' => $phcNameInHindi,
                            'dr_name_en' =>$value["name_of_incharge"],
                            'dr_name_hin' =>$doctorNameInHindi,
                            'mobile' =>$value["mobile_no"],
                            'email' =>$value["email_id"],
                            'scenerio' =>$value["performance"],
                            'og_moic_filename'=> $moic_filename,
                            'uploaded_file' => $file_name,
                            'ranking_pdf' => '',
                            'zip_path' => '',
                            'schedule_at'=>  $request->get("schedule_at"),
                            'month' => $request->get('month'),
                            'year' => $request->get('year'),
                            'created_at'=> Carbon::now(),
                            'updated_at'=> Carbon::now()
                        ];
                    }
                    if (!empty($arr)) {
                        $dir = 'moic/imports'; $pdfdir = 'moic/rankings';
                        $inserted = MoicRanking::insert($arr);
                        if($inserted){
                            Storage::putFileAs($dir, $request->file('sample_file'), $file_name);
                            return redirect('get-mos')->with(['success' => 'Files uploaded successfully']);
                        }
                    }
                }else {
                    Session::flash('error', 'Please select valid data file.');
                    return back();
                }
            }
            else
            {
                Session::flash('error','Please upload a valid xls/xlsx file only.');
                return back();
            }
        }
    }


    public function export_mos(){

        $moic_data = MoicRanking::select('block','phc_en','dr_name_en','mobile','email','ranking_pdf','sms')
                              ->get()
                              ->toArray();
        \Excel::create('moic_ranking'.time(), function($excel) use($moic_data) {

            $excel->sheet('moic', function ($sheet) use ($moic_data) {
                $excelData = [];
                $excelData[] = [
                    'Block',
                    'Phc Name',
                    'Doctor name',
                    'Phone Number',
                    'Email',
                    'Weblink',
                    'Sms'
                ];

                foreach ($moic_data as $value) {
                    $excelData[] = array(
                        $value['block'],
                        $value['phc_en'],
                        $value['dr_name_en'],
                        $value['mobile'],
                        $value['email'],
                        url('/moic/rankings/'.$value['ranking_pdf']),
                        $value['sms']
                    );
                }
                $sheet->fromArray($excelData, null, 'A1', true, false);
            });

        })->download('xlsx');

    }


    public function testZip($value='')
    {
        $zipper = new Zipper;
        $file = public_path().'/moic/rankings/ranking_pdf.zip';
        $zipper->make($file)->folder('rankings')->add(public_path().'/moic/rankings/1531460592PHC_Scorecard.pdf');
        $zipper->zip($file)->folder('rankings')->add(public_path().'/moic/rankings/1531495739PHC_Scorecard.pdf');
        $zipper->zip($file)->folder('rankings')->add(public_path().'/moic/rankings/1531719521PHC_Scorecard.pdf');
        $zipper->close();
        return ['status' => 'Done'];
    }


    public function unzip()
    {
        $zipper = new Zipper;
        $path = public_path().'/moic/rankings/ranking_pdf.zip';
        $zipper->make($path)->folder('rankings')->extractTo(public_path().'/moic/zip');
        return ['status' => 'Done'];
    }



    public function showReport($link)
    {
        $months = \DB::table('master_months')->pluck('month_english', 'id')->toArray();
        $report = \DB::table('moic_ranking_reports')->where('dr_weblink', $link)->get()->toArray();
        if(!empty($report)){
            $report = $report[0];
            return view('moic_reports', compact('report', 'months'));
        }else{
            return redirect('/get-mos');
        }
    }

    public function downloadZip($path)
    {
        $path = public_path().'/moic/rankings/zips/'.$path.'/'.$path.'.zip';
        return response()->download($path);
    }
}
