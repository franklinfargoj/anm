<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\NudgeModel;
use Carbon\Carbon;
use App\Classes\Helpers;


class NudgeSmsDispatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nudge:dispatch_sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispaptch nudge sms';

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
        $newsms = NudgeModel::where('sms_sent', 0)->where('schedule_at', '<', Carbon::now())->get()->toArray();
        $cnt = count($newsms);

        if($cnt > 0){
            $ids= [];
            echo $cnt." new nudge sms requests found".PHP_EOL;
            foreach ($newsms as $sms){
                $message = $sms['message'];
                $phone_no = $sms['phone_no'];
                $status = Helpers::sendSmsUnicode($message,$phone_no);
                if($status['status'] == 200 && (str_contains($status['response'], '402') == true)){
                    $ids[] = $sms['id'];
                    $temp['sms_sent'] = 1;
                }else{
                    $temp['sms_sent'] = 0;
                }
                NudgeModel::whereIn('id', $ids)->update(['sms_sent' => 1]);
            }
            echo count($ids)." "."nudge message dispatched".PHP_EOL;
        }else{
            echo "All nudge sms are dispatched till date.".PHP_EOL;
        }
    }
}
