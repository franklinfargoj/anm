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
                    $request->file('sample_file')->move($dir, $file_name);
                    $request->file('rankings')->move($pdfdir, $pdfname);
                    return redirect('mos')->with(['success' => 'Files uploaded successfully']);
                }
            }
        }else {
            Session::flash('error', 'Please select valid data file.');
            return back();
        }
    }
}
