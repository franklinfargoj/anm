<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AnmTargetDataModel;
use App\PhcTranslationModel;
use App\District;
use App\Http\Requests\ImportMosRankingRequest;
use App\MoicRanking;
use Excel;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Faker\Provider\File;

class MosController extends Controller
{

    public function index()
    {
        return view('mois');
    }

    public function importRankings(ImportMosRankingRequest $request)
    {
    	$path = $request->file('sample_file')->getRealPath();
        $data = \Excel::selectSheets('MOIC_Ranking_SMS')->load($path)->get()->toArray();
        $file_name = time() .$request->sample_file->getClientOriginalName();
        $og_file_name =$request->sample_file->getClientOriginalName();
        $pdfname = time().$request->rankings->getClientOriginalName();
        $day_time = Carbon::now()->toDateTimeString('Y-m-d');
        $day = Carbon::now()->toDateString('Y-m-d');
        $web = array();
        $beneficiary = array();
        $moic = array();
        if (count($data)>0) {
            foreach ($data as $key => $value) {
                $arr[] = [
                    'block' => $value["block"],
                    'block_hin' => $value["block_name_in_hindi"],
                    'phc_en' =>$value["phc"],
                    'phc_hin' =>$value["phc_name_in_hindi"],
                    'dr_name_en' =>$value["name_of_incharge"],
                    'dr_name_hin' =>$value["doctor_name_in_hindi"],
                    'mobile' =>$value["mobile_no"],
                    'email' =>$value["email_id"],
                    'scenerio' =>$value["performance"],
                    'uploaded_file' => $file_name,
                    'ranking_pdf' => $pdfname,
                    'month' => $request->get('month'),
                    'year' => $request->get('year'),
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now(),
                ];
            }
            if (!empty($arr)) {
            	$dir = 'moic/imports'; $pdfdir = 'moic/rankings';
                $inserted = MoicRanking::insert($arr);
                if($inserted){
                    /*$request->file('sample_file')->move($dir, $file_name);
                    $request->file('rankings')->move($pdfdir, $pdfname);*/
                    Storage::putFileAs($dir, $request->file('sample_file'), $file_name);
                    Storage::putFileAs($pdfdir, $request->file('rankings'), $pdfname);
                    return redirect('mos')->with(['success' => 'Files uploaded successfully']);
                }
            }
        }else {
            Session::flash('error', 'Please select valid data file.');
            return back();
        }
    }


    public function ajaxMoic()
    {
    	$moic = MoicRanking::select('id', 'block', 'ranking_pdf', 'sms', 'phc_en')
            ->orderBy('created_at', 'DESC')
            ->get();
        $db = Datatables::of($moic);
        $db->addColumn('pdf_url', function($moic){
        	return '<a href="'.url('/moic/rankings/'.$moic->ranking_pdf).'" target="_blank">View</a>';
        })->addColumn('sms_span', function($moic){
        	return '<span class="fontsforweb_fontid_8705">'.$moic->sms.'</span>';
        })->rawColumns(['pdf_url', 'sms_span', 'block_span']);
    	return $db->make(true);
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
                    'Pdf Url',
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


}
























































