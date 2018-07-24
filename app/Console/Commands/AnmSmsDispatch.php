<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\AnmTargetDataModel;
use DB;
use App\Classes\Helpers;
use Carbon\Carbon;



class AnmSmsDispatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'anm:sms_dispatch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send sms to moic from targetted data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $newsms = AnmTargetDataModel::where('anm_sms_initiated', 0)->where('schedule_at', '<', Carbon::now())->get();
        $cnt = count($newsms);
        if($cnt > 0){
            echo $cnt." new anm sms requests found".PHP_EOL;
            $ids = $newsms->pluck('id');
            $insert = [];
            foreach ($newsms as $sms){
                $separated_msg = explode(',', $sms->anm_custom_msg);
                $separated_num = explode(',', $sms->anm_mobile_number);
                $separated_anm = explode(',', $sms->anm_name);
                $cnt = count($separated_num);
                for($i=0; $i<$cnt; $i++){
                    $combined_sms = $separated_msg[$i].' '.url('weblink/'.$sms->weblink);
//                    $combined_sms = 'test from wrong side'.' '.url('weblink/'.$sms->weblink);
//                    $combined_sms = 'मोबाइलसेवामेंआपकास्वागतहै';
                    $temp = [
                        'filename' => $sms->filename,
                        'name' => $separated_anm[$i],
                        'mobile' => $separated_num[$i],
                        'type' => 'anm',
                        'sms' => $combined_sms,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];

                    $status = Helpers::sendSmsUnicode($combined_sms, $separated_num[$i]);
                    if($status['status'] == 200 && (str_contains($status['response'], '402') == true)){
                        $temp['is_sent'] = 1;
                        $temp['sent_at'] = Carbon::now();
                    }
                    $insert[] = $temp;
                }
            }
            if(!empty($insert)){
                DB::table('anm_mos_smslogs')->insert($insert);
                AnmTargetDataModel::whereIn('id', $ids)->update(['anm_sms_initiated' => 1]);
            }
            echo "Dispatched!!".PHP_EOL;
        }else{
            echo "All new anm sms requests are dispatched".PHP_EOL;
        }

        //Attempt to send failed sms again
        $fails = DB::table('anm_mos_smslogs')->where('is_sent', 0)->whereNUll('sent_at')->get();
        $count = count($fails);
        if($count > 0){
            $ids = $fails->pluck('id');
            $insert = [];
            echo $count.' failed requests found'.PHP_EOL;
            foreach($fails as $sms){
                $status = Helpers::sendSmsUnicode($sms->sms, $sms->mobile);
                if($status['status'] == 200 && (str_contains($status['response'], '402') == true)){
                    $temp['is_sent'] = 1;
                    $temp['sent_at'] = Carbon::now();
                    DB::table('anm_mos_smslogs')->where('id', $sms->id)->update($temp);
                }
            }
            echo "Dispatched!!".PHP_EOL;
        }else{
            echo "All failed sms requests are done".PHP_EOL;
        }
    }
}
