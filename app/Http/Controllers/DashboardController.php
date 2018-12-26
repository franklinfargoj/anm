<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AnmTargetDataModel;
use App\MoicRanking;
use App\FeedbackModel;
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
            

            //print_r($queries);exit;
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
            
            //dd($list_data);
        }
        //dd($list_data);

        return view('dashboard',compact('list_data','category'));
    }

    public function anm_details($id){

        $file = AnmTargetDataModel::select('filename')
                ->where('id',$id)->get()->toArray();
        $filename = $file[0]['filename'];

        $file_data = AnmTargetDataModel::select('weblink','anm_sms_initiated AS sms_sent','anm_weblink_logs.ip_address','anm_weblink_logs.clicked_at','anm_weblink_logs.mobile_no')
                ->leftJoin('anm_weblink_logs', 'anm_target_data.weblink', '=', 'anm_weblink_logs.link')
                ->where('filename',$filename)->paginate(10);

        return view('dashboarddetails',compact('file_data'));
    }

    public function moic_details($id){

        $file = MoicRanking::select('uploaded_file')
                             ->where('id',$id)->get()->toArray();
        $filename = $file[0]['uploaded_file'];

        $file_data = DB::table('moic_ranking_reports')->select('dr_weblink as weblink','moic_logs.ip_address','moic_logs.clicked_at','moic_ranking.sms_sent_initiated AS sms_sent','moic_logs.mobile_no')
                                ->leftJoin('moic_ranking', 'moic_ranking_reports.rank_id', '=', 'moic_ranking.id')
                                ->leftJoin('moic_logs', 'moic_ranking_reports.dr_weblink', '=', 'moic_logs.link')
                                ->where('filename',$filename)->paginate(10);

        return view('dashboarddetails',compact('file_data'));
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


}



/*
// return Datatables::of($list_data)->make(true);
if(!$dataTables->getRequest()->ajax()){
    //dd($list_data);
    return $dataTables->of($list_data)->make(true);
}*/
// return view('dashboard',compact('modules','list_data'));

