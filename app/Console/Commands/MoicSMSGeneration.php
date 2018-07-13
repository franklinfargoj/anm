<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\MoicRanking;
use DB;
use App\Classes\Helpers;

class MoicSMSGeneration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'moic:sms_create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to generate sms for moic asd per rankings and performace category format';

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
        $moic = MoicRanking::whereNull('sms')->get();
        if(count($moic) > 0){
            $grouped = $moic->groupBy('block')->toArray();
            $months = DB::table('master_months')->pluck('month_translated', 'id');
            foreach($grouped as $group => $moics){
                $tops = array_filter($moics, function($single){
                    return (trim($single['scenerio']) == 'Top');
                });
                $middle = array_filter($moics, function($single){
                    return (trim($single['scenerio']) == 'Middle');
                });
                $bottom = array_filter($moics, function($single){
                    return (trim($single['scenerio']) == 'Bottom');
                });

                $topphctext = Helpers::renderHindi(array_column($tops, 'phc_hin'), 'पीएचसी');
                $topdoctext = Helpers::renderHindi(array_column($tops, 'dr_name_hin'), ' डॉ.');
                $middlephc = Helpers::renderHindi(array_column($middle, 'phc_hin'), 'पीएचसी');
                $bottomphc = Helpers::renderHindi(array_column($bottom, 'phc_hin'), 'पीएचसी');

                foreach($moics as $single){
                    $sms = $single['dr_name_hin'].' &#93; क्या आप जानना चाहते हैं की  '.$single['block_hin'].' ब्लॉक की किस पीएचसी ने किया '.$months[$single['month']].' '.$single['year']. ' के महीने में बेहतरीन प्रदर्शन &#92; <br>';
                    $sms .= $single['block_hin'].' ब्लॉक में '.rtrim($topphctext, ', ').' अव्वल रहीं और इन् पीएचसीस के डॉक्टर - '.rtrim($topdoctext, ', ').'  ने सराहनीये कार्य किया। ';
                    $sms .= $middlephc.'  के भी डॉक्टरों ने भी अच्छा कार्य किया। '.$bottomphc.'  में बेहतर परिणामों के लिए सुद्धारण की आवश्यकता है। ';
                    $sms .= ' रॅंक को कैसे सुद्धारा जाये - जानने के लिए पीएचसी स्कोरकार्ड का प्रयोग करें। पीएचसी स्कोरकार्ड देखने के लिए यहाँ क्लिक करें &#037; ';
                    $indiv_moic = MoicRanking::find($single['id']);
                    $indiv_moic->sms = $sms;
                    $indiv_moic->save();
                    echo "Updated.".PHP_EOL;
                }
            }
        }else{
            echo "All sms's are updated.".PHP_EOL;
        }
    }
}
