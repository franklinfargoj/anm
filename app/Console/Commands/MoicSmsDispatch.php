<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\MoicRanking;
use DB;
use App\Classes\Helpers;
use Carbon\Carbon;


class MoicSmsDispatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'moic:sms_dispatch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to send sms to respected moic rankings\'s ';

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
        //To check any new sms request
        $new_sms = MoicRanking::where('sms_sent_initiated', 0)->get();
        $count = count($new_sms);
        if($count > 0){
            $ids = $new_sms->pluck('id');
            $insert = [];
            echo $count.' new requests found'.PHP_EOL;
            foreach($new_sms as $sms){
                $combined_sms = $sms->sms.' '.url('/moic/report/'.md5($sms->id));
                $temp = [
                    'filename' => $sms->uploaded_file,
                    'dr_name' => $sms->dr_name_en,
                    'mobile' => $sms->mobile,
                    'sms' => $combined_sms,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
                $status = Helpers::sendSms($combined_sms, $sms->mobile);
                if($status['status']){
                    $temp['is_sent'] = 1;
                    $temp['sent_at'] = Carbon::now();
                }
                $insert[] = $temp;
            }
            if(!empty($insert)){
                DB::table('mois_anm_sms_logs')->insert($insert);
                MoicRanking::whereIn('id',$ids)->update(['sms_sent_initiated' => 1]);
            }
            echo "Done!!".PHP_EOL;
        }else{
            echo "All sms requests are done".PHP_EOL;
        }

        //Attempt to send failed sms again
        $fails = DB::table('mois_anm_sms_logs')->where('is_sent', 0)->whereNUll('sent_at')->get();
        $count = count($fails);
        if($count > 0){
            $ids = $fails->pluck('id');
            $insert = [];
            echo $count.' failed requests found'.PHP_EOL;
            foreach($fails as $sms){
                $status = Helpers::sendSms($sms->sms, $sms->mobile);
                if($status['status']){
                    $temp['is_sent'] = 1;
                    $temp['sent_at'] = Carbon::now();
                }
                DB::table('mois_anm_sms_logs')->where('id', $sms->id)->update($temp);
            }
            echo "Done!!".PHP_EOL;
        }else{
            echo "All failed sms requests are done".PHP_EOL;
        }
    }
}
