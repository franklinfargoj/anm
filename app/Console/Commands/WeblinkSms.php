<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\AnmTargetDataModel;

class WeblinkSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weblinksms:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $data = AnmTargetDataModel::select('phc_name','moic_name','moic_mobile_number','anm_name','anm_mobile_number','scenerio','performer_category')
                                    ->where('status','Y')
                                    ->where('sms',Null)
                                    ->where('weblink',Null)
                                    ->get()
                                    ->toArray();
    }
}
