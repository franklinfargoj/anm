<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AnmTargetDataModel;
use App\MoicRanking;
use App\FeedbackModel;
use App\NudgeModel;
use DB;
//use DataTables;
use Yajra\Datatables\Datatables;

class DashboardController extends Controller
{

    public function index()
    {
        $category = '';$list_data = '';
        return view('dashboard',compact('list_data','category'));
    }

    public function listing(Request $request)
    {

       $category = $request['category_module'];

        if($category == 'Anm'){

            $list_data = AnmTargetDataModel::leftjoin('anm_weblink_logs','anm_target_data.id', '=', 'anm_weblink_logs.weblink_id')
                                            ->selectRaw('og_filename,uploaded_on,anm_target_data.id,
                                             SUM(IF(anm_sms_initiated=1, 1, 0)) AS countSentSms,
                                             COUNT(anm_weblink_logs.weblink_id) as weblink_opened,
                                             COUNT(filename) AS total_rows');
                                            if($request->from_date)
                                            {
                                                $list_data->where('uploaded_on', '>=', $request->from_date);
                                            }
                                            if($request->to_date)
                                            {
                                                $list_data->where('uploaded_on', '<=', $request->to_date);
                                            }
            $list_data = $list_data->groupBy('filename')->orderBy('uploaded_on', 'DESC')->get()->toArray();

        }elseif ($category == 'Moic'){  

            $list_data = MoicRanking::selectRaw('og_moic_filename as og_filename,moic_ranking.created_at as uploaded_on,moic_ranking.id,
                                                SUM(IF(sms_sent_initiated=1, 1, 0)) AS countSentSms,
                                                COUNT(moic_logs.weblink_id) as weblink_opened,
                                                COUNT(moic_ranking.og_moic_filename) AS total_rows')
                                    ->leftjoin('moic_ranking_reports', 'moic_ranking.id', '=', 'moic_ranking_reports.rank_id')
                                    ->leftjoin('moic_logs', 'moic_ranking_reports.id', '=', 'moic_logs.weblink_id');
                                     if($request->from_date){
                                         $list_data->where('moic_ranking.created_at','>=',$request->from_date);
                                     }
                                     if($request->to_date){
                                         $list_data ->where('moic_ranking.created_at','<=',$request->to_date);
                                     }
            $list_data = $list_data->groupBy('uploaded_file')->orderBy('uploaded_on', 'DESC')->get()->toArray();

        }elseif ($category == 'Feedback'){

            dd('Feedback');
            $list_data = FeedbackModel::selectRaw('og_filename,created_at as uploaded_on,id,COUNT(filename) AS total_rows');
                                        if($request->from_date){
                                            $list_data->where('created_at','>=',$request->from_date);
                                        }
                                        if($request->to_date){
                                            $list_data ->where('created_at','<=',$request->to_date);
                                        }
            $list_data =  $list_data->groupBy('filename')->get()->toArray();
        }elseif ($category == 'Nudges'){

            $list_data = NudgeModel::selectRaw('id,og_filename,schedule_at,created_at as uploaded_on,COUNT(id)AS total_rows,SUM(IF(sms_sent=1, 1, 0)) AS countSentSms');
                                        if($request->from_date){
                                            $list_data->where('created_at','>=',$request->from_date);
                                        }
                                        if($request->to_date){
                                            $list_data ->where('created_at','<=',$request->to_date);
                                        }
            $list_data = $list_data->groupBy('filename')
                                      ->get()->toArray();
        }

        return view('dashboard',compact('list_data','category'));
    }

    public function anm_details($id){

        $file = AnmTargetDataModel::select('filename')
                ->where('id',$id)->get()->toArray();
        $filename = $file[0]['filename'];

        $file_data = AnmTargetDataModel::select('weblink','anm_sms_initiated AS sms_sent','anm_weblink_logs.ip_address','anm_weblink_logs.clicked_at','anm_weblink_logs.mobile_no')
                ->leftJoin('anm_weblink_logs', 'anm_target_data.weblink', '=', 'anm_weblink_logs.link')
                ->where('filename',$filename)->paginate(10);

        return view('dashboarddetails',compact('file_data','id'));
    }

    public function moic_details($id){

        $file = MoicRanking::select('uploaded_file')
                             ->where('id',$id)->get()->toArray();
        $filename = $file[0]['uploaded_file'];

        $file_data = DB::table('moic_ranking_reports')->select('dr_weblink as weblink','moic_logs.ip_address','moic_logs.clicked_at','moic_ranking.sms_sent_initiated AS sms_sent','moic_logs.mobile_no')
                                ->leftJoin('moic_ranking', 'moic_ranking_reports.rank_id', '=', 'moic_ranking.id')
                                ->leftJoin('moic_logs', 'moic_ranking_reports.dr_weblink', '=', 'moic_logs.link')
                                ->where('filename',$filename)->paginate(10);

        return view('dashboarddetails',compact('file_data','id'));
    }

    public function feedback_details($id){

        $file = FeedbackModel::select('filename')
                                    ->where('id',$id)
                                    ->get()->toArray();

        $filename = $file[0]['filename'];

        $file = FeedbackModel::select('filename')
            ->where('filename',$filename)
            ->get()->toArray();

        return view('dashboarddetails');
    }

    //displays nudge file details
    public function nudge_details($id){
        $location = 'dashboard';
        return view('nudge_detail',compact('id','location'));
    }


    public function weblinks_export($id)
    {
        $file = AnmTargetDataModel::select('filename')
            ->where('id',$id)
            ->first();

        $data = AnmTargetDataModel::select('weblink','anm_sms_initiated','anm_weblink_logs.ip_address','anm_weblink_logs.clicked_at','anm_weblink_logs.mobile_no')
                                ->leftJoin('anm_weblink_logs', 'anm_target_data.id', '=', 'anm_weblink_logs.weblink_id')
                                ->where('filename',$file['filename'])
                                ->get()
                                ->toArray();

        \Excel::create('anm_weblink'.time(), function($excel) use($data) {
            $excel->sheet('target_data', function($sheet) use($data) {
                $excelData = [];
                $excelData[] = [
                    'Weblink',
                    'Mobile number',
                    'SMS sent(y/n)',
                    'IP address',
                    'Clicked at'
                ];

                foreach ($data as $value) {
                    $excelData[] = array(
                        $value['weblink'],
                        $value['mobile_no'],
                        $value['anm_sms_initiated'],
                        $value['ip_address'],
                        $value['clicked_at']
                    );
                }
                $sheet->fromArray($excelData, null, 'A1', true, false);
            });
        })->download('xlsx');
    }


}




