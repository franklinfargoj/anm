<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\MoicRanking;
use Excel;
use DB;


class ExportRankingReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'moic:ranking_report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export another sheet from ranking excel';

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
        $not_exported = MoicRanking::where('status', 'N')->select('uploaded_file')->distinct()->get();
        $drs = MoicRanking::select('id', 'phc_en', 'month', 'year', 'uploaded_file')->get()->toArray();
        $cnt = count($not_exported);
        if($cnt > 0){
            echo $cnt.' file(s) found for rankings report..!!'.PHP_EOL;
            foreach($not_exported as $file){
                $path = public_path().'/moic/imports/'.$file->uploaded_file;
                if(file_exists($path)){
                    $sheetName = Excel::load($path)->getSheetNames();
                    if(in_array('PHC_wise_Performance', $sheetName)){
                        $rankings = Excel::selectSheets($sheetName[1])->load($path)->get()->toArray();
                        $insert = [];
                        foreach ($rankings as $ranking){
                            $month = $ranking['month_year']->format('m'); $year = $ranking['month_year']->format('Y');
                            $particular = array_filter($drs, function($index) use($ranking, $file, $month, $year){
                                return (strtolower($index['phc_en']) == strtolower($ranking['phc_name']) && $index['month'] == $month && $index['year'] == $year && $index['uploaded_file'] == $file->uploaded_file);
                            });
                            $particular = reset($particular);
                            $weblink = '';
                            if(!empty($particular)){
                                $weblink = md5($particular['id']);
                            }
                            $insert[] = [
                                'filename' => $file->uploaded_file,
                                'district' => $ranking['district_name'],
                                'dr_weblink' => $weblink,
                                'block' => $ranking['block_name'],
                                'phc_name' => $ranking['phc_name'],
                                'month' => $month,
                                'year' => $year,
                                'moic' => $ranking['moic_name'],
                                'is_aadarsh_phc' => $ranking['adarsh_phc'],
                                'phc_rank_in_block' => ($ranking['phc_rank_in_the_block'])?$ranking['phc_rank_in_the_block']:0,
                                'phc_rank_in_district' => ($ranking['phc_rank_in_the_district'])?$ranking['phc_rank_in_the_district']:0,
                                'opd_target' => ($ranking['opd_target'])?$ranking['opd_target']:0,
                                'opd_performance' => ($ranking['opd_performance'])?$ranking['opd_performance']:0,
                                'opd_block' => ($ranking['in_opd_block'])?$ranking['in_opd_block']:0,
                                'opd_district' => ($ranking['in_opd_district'])?$ranking['in_opd_district']:0,
                                'opd_state' => ($ranking['in_opd_state'])?$ranking['in_opd_state']:0,
                                'pid_target' => ($ranking['pid_target'])?$ranking['pid_target']:0,
                                'pid_performance' => ($ranking['pid_performance'])?$ranking['pid_performance']:0,
                                'pid_block' => ($ranking['in_pid_block'])?$ranking['in_pid_block']:0,
                                'pid_district' => ($ranking['in_pid_district'])?$ranking['in_pid_district']:0,
                                'pid_state' => ($ranking['in_pid_state'])?$ranking['in_pid_state']:0,
                                'fic_target' => ($ranking['fic_target'])?$ranking['fic_target']:0,
                                'fic_performance' => ($ranking['fic_performance'])?$ranking['fic_performance']:0,
                                'fic_block' => ($ranking['in_fic_block'])?$ranking['in_fic_block']:0,
                                'fic_district' => ($ranking['in_fic_district'])?$ranking['in_fic_district']:0,
                                'fic_state' => ($ranking['in_fic_state'])?$ranking['in_fic_state']:0,
                                'anc3_target' => ($ranking['anc3_target'])?$ranking['anc3_target']:0,
                                'anc3_performance' => ($ranking['anc3_performance'])?$ranking['anc3_performance']:0,
                                'anc3_block' => ($ranking['in_anc3_block'])?$ranking['in_anc3_block']:0,
                                'anc3_district' => ($ranking['in_anc3_district'])?$ranking['in_anc3_district']:0,
                                'anc3_state' => ($ranking['in_anc3_state'])?$ranking['in_anc3_state']:0,
                                'anc4_target' => ($ranking['anc4_target'])?$ranking['anc4_target']:0,
                                'anc4_performance' => ($ranking['anc4_performance'])?$ranking['anc4_performance']:0,
                                'anc4_block' => ($ranking['in_anc4_block'])?$ranking['in_anc4_block']:0,
                                'anc4_district' => ($ranking['in_anc4_district'])?$ranking['in_anc4_district']:0,
                                'anc4_state' => ($ranking['in_anc4_state'])?$ranking['in_anc4_state']:0,
                                'anc12_target' => ($ranking['anc12_target'])?$ranking['anc12_target']:0,
                                'anc12_performance' => ($ranking['anc12_performance'])?$ranking['anc12_performance']:0,
                                'anc12_block' => ($ranking['in_anc12_block'])?$ranking['in_anc12_block']:0,
                                'anc12_district' => ($ranking['in_anc12_district'])?$ranking['in_anc12_district']:0,
                                'anc12_state' => ($ranking['in_anc12_state'])?$ranking['in_anc12_state']:0,
                                'plb_target' => ($ranking['plb_target'])?$ranking['plb_target']:0,
                                'plb_performance' => ($ranking['plb_performance'])?$ranking['plb_performance']:0,
                                'plb_block' => ($ranking['in_plb_block'])?$ranking['in_plb_block']:0,
                                'plb_district' => ($ranking['in_plb_district'])?$ranking['in_plb_district']:0,
                                'plb_state' => ($ranking['in_plb_state'])?$ranking['in_plb_state']:0,
                                'fpiucd_target' => ($ranking['fpiucd_target'])?$ranking['fpiucd_target']:0,
                                'fpiucd_performance' => ($ranking['fpiucd_performance'])?$ranking['fpiucd_performance']:0,
                                'fpiucd_block' => ($ranking['in_fpiucd_block'])?$ranking['in_fpiucd_block']:0,
                                'fpiucd_district' => ($ranking['in_fpiucd_district'])?$ranking['in_fpiucd_district']:0,
                                'fpiucd_state' => ($ranking['in_fpiucd_state'])?$ranking['in_fpiucd_state']:0,
                                'ppiucd_target' => ($ranking['ppiucd_target'])?$ranking['ppiucd_target']:0,
                                'ppiucd_performance' => ($ranking['ppiucd_performance'])?$ranking['ppiucd_performance']:0,
                                'ppiucd_block' => ($ranking['in_ppiucd_block'])?$ranking['in_ppiucd_block']:0,
                                'ppiucd_district' => ($ranking['in_ppiucd_district'])?$ranking['in_ppiucd_district']:0,
                                'ppiucd_state' => ($ranking['in_ppiucd_state'])?$ranking['in_ppiucd_state']:0,
                                'fp_sterilization_target' => ($ranking['fp_sterilization_target'])?$ranking['fp_sterilization_target']:0,
                                'fp_sterilization_performance' => ($ranking['fp_sterilization_performance'])?$ranking['fp_sterilization_performance']:0,
                                'fp_sterilization_block' => ($ranking['in_fp_sterilization_block'])?$ranking['in_fp_sterilization_block']:0,
                                'fp_sterilization_district' => ($ranking['in_fp_sterilization_district'])?$ranking['in_fp_sterilization_district']:0,
                                'fp_sterilization_state' => ($ranking['in_fp_sterilization_state'])?$ranking['in_fp_sterilization_state']:0,
                                'pneumonia_target' => ($ranking['pneumonia_target'])?$ranking['pneumonia_target']:0,
                                'pneumonia_performance' => ($ranking['pneumonia_performance'])?$ranking['pneumonia_performance']:0,
                                'pneumonia_block' => ($ranking['in_pneumonia_block'])?$ranking['in_pneumonia_block']:0,
                                'pneumonia_district' => ($ranking['in_pneumonia_district'])?$ranking['in_pneumonia_district']:0,
                                'pneumonia_state' => ($ranking['in_pneumonia_state'])?$ranking['in_pneumonia_state']:0,
                                'malaria_target' => ($ranking['malaria_target'])?$ranking['malaria_target']:0,
                                'malaria_performance' => ($ranking['malaria_performance'])?$ranking['malaria_performance']:0,
                                'malaria_block' => ($ranking['in_malaria_block'])?$ranking['in_malaria_block']:0,
                                'malaria_district' => ($ranking['in_malaria_district'])?$ranking['in_malaria_district']:0,
                                'malaria_state' => ($ranking['in_malaria_state'])?$ranking['in_malaria_state']:0,
                                'diarrhea_target' => ($ranking['diarrhea_target'])?$ranking['diarrhea_target']:0,
                                'diarrhea_performance' => ($ranking['diarrhea_performance'])?$ranking['diarrhea_performance']:0,
                                'diarrhea_block' => ($ranking['in_diarrhea_block'])?$ranking['in_diarrhea_block']:0,
                                'diarrhea_district' => ($ranking['in_diarrhea_district'])?$ranking['in_diarrhea_district']:0,
                                'diarrhea_state' => ($ranking['in_diarrhea_state'])?$ranking['in_diarrhea_state']:0,
                                'hp_target' => ($ranking['hp_target'])?$ranking['hp_target']:0,
                                'hp_performance' => ($ranking['hp_performance'])?$ranking['hp_performance']:0,
                                'hp_block' => ($ranking['in_hp_block'])?$ranking['in_hp_block']:0,
                                'hp_district' => ($ranking['in_hp_district'])?$ranking['in_hp_district']:0,
                                'hp_state' => ($ranking['in_hp_state'])?$ranking['in_hp_state']:0,
                                'diabetes_target' => ($ranking['diabetes_target'])?$ranking['diabetes_target']:0,
                                'diabetes_performance' => ($ranking['diabetes_performance'])?$ranking['diabetes_performance']:0,
                                'diabetes_block' => ($ranking['in_diabetes_block'])?$ranking['in_diabetes_block']:0,
                                'diabetes_district' => ($ranking['in_diabetes_district'])?$ranking['in_diabetes_district']:0,
                                'diabetes_state' => ($ranking['in_diabetes_state'])?$ranking['in_diabetes_state']:0,
                                'cvd_target' => ($ranking['cvd_target'])?$ranking['cvd_target']:0,
                                'cvd_performance' => ($ranking['cvd_performance'])?$ranking['cvd_performance']:0,
                                'cvd_block' => ($ranking['in_cvd_block'])?$ranking['in_cvd_block']:0,
                                'cvd_district' => ($ranking['in_cvd_district'])?$ranking['in_cvd_district']:0,
                                'cvd_state' => ($ranking['in_cvd_state'])?$ranking['in_cvd_state']:0,
                                'days_patient_voucher_target' => ($ranking['days_patient_voucher_target'])?$ranking['days_patient_voucher_target']:0,
                                'days_patient_voucher_performance' => ($ranking['days_patient_voucher_performance'])?$ranking['days_patient_voucher_performance']:0,
                                'days_patient_voucher_block' => ($ranking['in_days_patient_voucher_block'])?$ranking['in_days_patient_voucher_block']:0,
                                'days_patient_voucher_district' => ($ranking['in_days_patient_voucher_district'])?$ranking['in_days_patient_voucher_district']:0,
                                'days_patient_voucher_state' => ($ranking['in_days_patient_voucher_state'])?$ranking['in_days_patient_voucher_state']:0,
                                'patient_vouchers_target' => ($ranking['patient_vouchers_target'])?$ranking['patient_vouchers_target']:0,
                                'patient_vouchers_performance' => ($ranking['patient_vouchers_performance'])?$ranking['patient_vouchers_performance']:0,
                                'patient_vouchers_block' => ($ranking['in_patient_vouchers_block'])?$ranking['in_patient_vouchers_block']:0,
                                'patient_vouchers_district' => ($ranking['in_patient_vouchers_district'])?$ranking['in_patient_vouchers_district']:0,
                                'patient_vouchers_state' => ($ranking['in_patient_vouchers_state'])?$ranking['in_patient_vouchers_state']:0,
                                'med_avail_feedback_target' => ($ranking['med_avail_feedback_target'])?$ranking['med_avail_feedback_target']:0,
                                'med_avail_feedback_performance' => ($ranking['med_avail_feedback_performance'])?$ranking['med_avail_feedback_performance']:0,
                                'med_avail_feedback_block' => ($ranking['in_med_avail_feedback_block'])?$ranking['in_med_avail_feedback_block']:0,
                                'med_avail_feedback_district' => ($ranking['in_med_avail_feedback_district'])?$ranking['in_med_avail_feedback_district']:0,
                                'med_avail_feedback_state' => ($ranking['in_med_avail_feedback_state'])?$ranking['in_med_avail_feedback_state']:0,
                                'test_avail_target' => ($ranking['test_avail_feedback_target'])?$ranking['test_avail_feedback_target']:0,
                                'test_avail_performance' => ($ranking['test_avail_feedback_performance'])?$ranking['test_avail_feedback_performance']:0,
                                'test_avail_block' => ($ranking['in_test_avail_feedback_block'])?$ranking['in_test_avail_feedback_block']:0,
                                'test_avail_district' => ($ranking['in_test_avail_feedback_district'])?$ranking['in_test_avail_feedback_district']:0,
                                'test_avail_state' => ($ranking['in_test_avail_feedback_state'])?$ranking['in_test_avail_feedback_state']:0,
                                'doc_avail_target' => ($ranking['doc_avail_feedback_target'])?$ranking['doc_avail_feedback_target']:0,
                                'doc_avail_performance' => ($ranking['doc_avail_feedback_performance'])?$ranking['doc_avail_feedback_performance']:0,
                                'doc_avail_block' => ($ranking['in_doc_avail_feedback_block'])?$ranking['in_doc_avail_feedback_block']:0,
                                'doc_avail_district' => ($ranking['in_doc_avail_feedback_district'])?$ranking['in_doc_avail_feedback_district']:0,
                                'doc_avail_state' => ($ranking['in_doc_avail_feedback_state'])?$ranking['in_doc_avail_feedback_state']:0,
                                'rajdhara_target' => ($ranking['rajdharaa_target'])?$ranking['rajdharaa_target']:0,
                                'rajdhara_performance' => ($ranking['rajdharaa_performance'])?$ranking['rajdharaa_performance']:0,
                                'rajdhara_block' => ($ranking['in_rajdharaa_block'])?$ranking['in_rajdharaa_block']:0,
                                'rajdhara_district' => ($ranking['in_rajdharaa_district'])?$ranking['in_rajdharaa_district']:0,
                                'rajdhara_state' => ($ranking['in_rajdharaa_state'])?$ranking['in_rajdharaa_state']:0,
                                'linelist_vs_expected_target' => ($ranking['linelist_vs_expected_target'])?$ranking['linelist_vs_expected_target']:0,
                                'linelist_vs_expected_performance' => ($ranking['linelist_vs_expected_performance'])?$ranking['linelist_vs_expected_performance']:0,
                                'linelist_vs_expected_block' => ($ranking['in_linelist_vs_expected_block'])?$ranking['in_linelist_vs_expected_block']:0,
                                'linelist_vs_expected_district' => ($ranking['in_linelist_vs_expected_district'])?$ranking['in_linelist_vs_expected_district']:0,
                                'linelist_vs_expected_state' => ($ranking['in_linelist_vs_expected_state'])?$ranking['in_linelist_vs_expected_state']:0,
                                'pcts_vs_expected_target' => ($ranking['pcts_vs_expected_target'])?$ranking['pcts_vs_expected_target']:0,
                                'pcts_vs_expected_performance' => ($ranking['pcts_vs_expected_performance'])?$ranking['pcts_vs_expected_performance']:0,
                                'pcts_vs_expected_block' => ($ranking['in_pcts_vs_expected_block'])?$ranking['in_pcts_vs_expected_block']:0,
                                'pcts_vs_expected_district' => ($ranking['in_pcts_vs_expected_district'])?$ranking['in_pcts_vs_expected_district']:0,
                                'pcts_vs_expected_state' => ($ranking['in_pcts_vs_expected_state'])?$ranking['in_pcts_vs_expected_state']:0,
                                'id_target' => ($ranking['id_target'])?$ranking['id_target']:0,
                                'id_performance' => ($ranking['id_performance'])?$ranking['id_performance']:0,
                                'id_block' => ($ranking['in_id_block'])?$ranking['in_id_block']:0,
                                'id_district' => ($ranking['in_id_district'])?$ranking['in_id_district']:0,
                                'id_state' => ($ranking['in_id_state'])?$ranking['in_id_state']:0,
                                'fi_target' => ($ranking['fi_target'])?$ranking['fi_target']:0,
                                'fi_performance' => ($ranking['fi_performance'])?$ranking['fi_performance']:0,
                                'fi_block' => ($ranking['in_fi_block'])?$ranking['in_fi_block']:0,
                                'fi_district' => ($ranking['in_fi_district'])?$ranking['in_fi_district']:0,
                                'fi_state' => ($ranking['in_fi_state'])?$ranking['in_fi_state']:0,
                                'pss_target' => ($ranking['pss_target'])?$ranking['pss_target']:0,
                                'pss_performance' => ($ranking['pss_performance'])?$ranking['pss_performance']:0,
                                'pss_block' => ($ranking['in_pss_block'])?$ranking['in_pss_block']:0,
                                'pss_district' => ($ranking['in_pss_district'])?$ranking['in_pss_district']:0,
                                'pss_state' => ($ranking['in_pss_state'])?$ranking['in_pss_state']:0,
                                'created_at' => \Carbon\Carbon::now(),
                                'updated_at' => \Carbon\Carbon::now()
                            ];
                        }
                        DB::table('moic_ranking_reports')->insert($insert);
                        echo "Done..!!";
                    }else{
                        echo "Sheet name is invalid..!!";
                    }
                    MoicRanking::where('status', 'N')->update(['status' => 'Y']);
                }else{
                    echo $file->uploaded_file.' not exists in folder..!!';
                }
                echo PHP_EOL;
            }
        }else{
            echo 'All rankings are generated'.PHP_EOL;
        }
    }
}