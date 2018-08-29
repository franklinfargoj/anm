<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\FeedbackModel;
use App\Classes\Helpers;

class FeedbackSmsDispatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feedback:sms_dispatch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to send Patient feedback sms to Doctor';

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
        $newsms = FeedbackModel::select('complete_sms','mobile_no')
                                ->where('sms_sent',0)
                                ->where('mobile_no','!=','')
                                ->where('complete_sms','!=','')
                                ->get()
                                ->toArray();

        if(!empty($newsms)){
            foreach($newsms as $sms){
                $status = Helpers::sendSmsUnicode($sms['complete_sms'],$sms['mobile_no']);

                dd($status);
                }
            }
    }

}
