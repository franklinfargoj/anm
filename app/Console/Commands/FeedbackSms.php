<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\FeedbackModel;
use DB;

class FeedbackSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feedback:complete_sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Making a complete sms';

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
        $table = FeedbackModel::getModel()->getTable();
        $caseString = 'CASE id';
        $ids = '';
        $content = FeedbackModel::select('id','sms','feedback_for_doctor_availability',
                                         'feedback_for_patient_satisfaction','feedback_for_medicine_availability','feedback_for_test_availability')
                                        ->Where('complete_sms','')
                                        ->get()->toArray();
        if($content){
            foreach($content as $key){
                $sms = $key['sms'];
                $doctor_availability = $key['feedback_for_doctor_availability'];
                $patient_satisfaction = $key['feedback_for_patient_satisfaction'];
                $medicine_availability = $key['feedback_for_medicine_availability'];
                $test_availability = $key['feedback_for_test_availability'];
                $sms_complete = $sms.$doctor_availability.$patient_satisfaction.$medicine_availability.$test_availability;

                $id = $key['id'];
                $ids .= " $id,";
                $caseString .= " WHEN" ." ".$key['id']." ". "THEN"." '". $sms_complete."'";
            }
            $ids = trim($ids, ',');

            DB::statement("UPDATE $table SET complete_sms = $caseString END WHERE id IN ($ids)");
            echo "SMS created successfully".PHP_EOL;
        }else{
            echo "All sms are already generated".PHP_EOL;
        }
    }

}
