<!DOCTYPE html>
<html>
   <head>
      <title></title>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--       <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
      <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
      <!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css') }}"> -->
   </head>
   <body class="internal-page">
      <header class="internal-header navbar-fixed-top">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h4>PHC {{$report->phc_name}} : Performance Review</h4>
                  <div class="date-area">{{$months[$report->month]}} {{$report->year}}</div>
               </div>
            </div>
            <div class="box-area mt-1">
               <div class="row">
                  <div class="col-md-12 performance-review-area">
                     <div class="phc-ranking-title">
                        <img src="{{asset('images/trophy-icon.png')}}" alt="" border="0"> 
                        PHC Ranking:
                     </div>
                     <div class="phc-ranking-content"> 
                        {{Helpers::ordinal($report->phc_rank_in_block)}} <span>in block (of {{$report->phcs_in_the_block}})</span>
                     </div>
                     <div class="phc-ranking-content">
                        {{Helpers::ordinal($report->phc_rank_in_district)}} <span>in district (of {{$report->phcs_in_the_district}})</span>
                     </div>
                     <div class="site-logo pull-right">
                        <img src="{{asset('images/mishaal-logo.png')}}" class="img-responsive" style="height: 84px;width: 105px;">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- <section class="reports-area navbar-fixed-top">
         <div class="container">
         	<div class="row">
         		<div class="col-md-12">
         			<div class="outer-area">
         				<div class="inner-area">
         					<table width="100%" class="table report-card-table fancy-table">
         						<tr>
         							<td colspan="2" class="blue-bg">{{$months[$report->month]}} 2018 Report Card</td>
         							<td colspan="4">MOIC Name: {{$report->moic_name}}</td>
         							<td colspan="3" class="grey-bg">Best Performing PHC</td>
         						</tr>
         						<tr>
         							<td width="10%" class="dark-blue">Program</td>
         							<td width="20%" class="text-left dark-blue" align="left">Metric</td>
         							<td width="12%" class="velvet-color">Max scene that can be achieved</td>
         							<td width="9%" class="velvet-color">Scene achieved</td>
         							<td width="10%" class="velvet-color">Target</td>
         							<td width="9%" class="blue">May'18 Performance</td>
         							<td width="10%" class="dark-green">In the block</td>
         							<td width="10%" class="dark-green">In Alwar</td>
         							<td width="10%" class="dark-green">In Rajasthan</td>
         						</tr>
         					</table>
         				</div>
         			</div>
         		</div>
         	</div>
         </div>
         </section> -->
      <section class="internal-table-area">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                    <div class="outer-area">
                       <div class="inner-area">
                       	<div class="reports-area navbar-fixed-top">
                          	<div class="container">
                          		<table width="100%" class="table report-card-table fancy-table">
	                             <tr>
	                                <td colspan="2" class="blue-bg">{{$months[$report->month]}} {{$report->year}} Report Card</td>
	                                <td colspan="4">MOIC Name: {{$report->moic_name}}</td>
	                                <td colspan="3" class="grey-bg">Best Performing PHC</td>
	                             </tr>
	                             <tr>
	                                <td width="10%" class="dark-blue">Program</td>
	                                <td width="20%" class="text-left dark-blue" align="left">Metric</td>
	                                <td width="12%" class="velvet-color">Max score that can be achieved</td>
	                                <td width="9%" class="velvet-color">Score achieved</td>
	                                <td width="10%" class="velvet-color">Target</td>
	                                <td width="9%" class="blue">{{$months[$report->month]}} {{$report->year}} Performance</td>
	                                <td width="10%" class="dark-green">Best in block</td>
	                                <td width="10%" class="dark-green">Best in Alwar</td>
	                                <td width="10%" class="dark-green">Best in Rajasthan</td>
	                             </tr>
	                          </table>
                          	</div>
                          </div>
                          <table width="100%" class="table fancy-table">
                             <tr data-title-attribute="{{$months[$report->month]}} {{$report->year}} Report Card">
                                <th width="10%" rowspan="2" valign="middle" data-title-attribute="Program">Utilization</th>
                                <td width="20%" data-title-attribute="Metric">OPDs/day (>40)</td>
                                <td width="12%" data-title-attribute="Max score that can be achieved" class="velvet-color">{{ $report->opd_max_score_achieved }}</td>
                                <td width="9%" data-title-attribute="Score achieved" class="velvet-color">{{ $report->opd_score_achieved }}</td>
                                <td width="10%" data-title-attribute="Target" class="velvet-color">{{ $report->opd_target }}</td>
                                <td width="9%" data-title-attribute="May'18 Performance" class="blue">{{ $report->opd_performance }}</td>
                                <td width="10%" data-title-attribute="In the block" class="dark-green">{{ $report->opd_block }}</td>
                                <td width="10%" data-title-attribute="In Alwar" class="dark-green">{{ $report->opd_district }}</td>
                                <td width="10%" data-title-attribute="In Rajasthan" class="dark-green">{{ $report->opd_state }}</td>
                             </tr>
                             <tr>
                                <td data-title-attribute="Metric">Proportion of <br/> Institutional Delivery</td>
                                <td data-title-attribute="Max score that can be achieved" class="velvet-color">{{ Helpers::convertToPercent($report->pid_max_score_achieved) }}</td>
                                <td data-title-attribute="Score achieved" class="velvet-color">{{ Helpers::convertToPercent($report->pid_score_achieved) }}</td>
                                <td data-title-attribute="Target" class="velvet-color">{{ Helpers::convertToPercent($report->pid_target) }}</td>
                                <td data-title-attribute="May'18 Performance" class="blue">{{ Helpers::convertToPercent($report->pid_performance) }}</td>
                                <td data-title-attribute="In the block" class="dark-green">{{ Helpers::convertToPercent($report->pid_block) }}</td>
                                <td data-title-attribute="In Alwar" class="dark-green">{{ Helpers::convertToPercent($report->pid_district) }}</td>
                                <td data-title-attribute="In Rajasthan" class="dark-green">{{ Helpers::convertToPercent($report->pid_state) }}</td>
                             </tr>
                          </table>
                          <table width="100%" class="table fancy-table">
                             <tr data-title-attribute="{{$months[$report->month]}} {{$report->year}} Report Card">
                                <th width="10%" rowspan="8" valign="middle">RMNCH + A</th>
                                <td width="20%">Full Immunization Coverage  </td>
                                <td width="12%" class="velvet-color">{{ Helpers::convertToPercent($report->fic_max_score_achieved) }}</td>
                                <td width="9%" class="velvet-color">{{ Helpers::convertToPercent($report->fic_score_achieved) }}</td>
                                <td width="10%" class="velvet-color">{{ Helpers::convertToPercent($report->fic_target) }}</td>
                                <td width="9%" class="blue">{{ Helpers::convertToPercent($report->fic_performance) }}</td>
                                <td width="10%" class="dark-green">{{ Helpers::convertToPercent($report->fic_block) }}</td>
                                <td width="10%" class="dark-green">{{ Helpers::convertToPercent($report->fic_district) }}</td>
                                <td width="10%" class="dark-green">{{ Helpers::convertToPercent($report->fic_state) }}</td>
                             </tr>
                             <tr>
                                <td>ANC 3 Coverage  </td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->anc3_max_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->anc3_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->anc3_target) }}</td>
                                <td class="blue">{{ Helpers::convertToPercent($report->anc3_performance) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->anc3_block) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->anc3_district) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->anc3_state) }}</td>
                             </tr>
                             <tr>
                                <td>ANC 4 Coverage  </td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->anc4_max_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->anc4_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->anc4_target) }}</td>
                                <td class="blue">{{ Helpers::convertToPercent($report->anc4_performance) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->anc4_block) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->anc4_district) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->anc4_state) }}</td>
                             </tr>
                             <tr>
                                <td>ANC Registration (within 12 weeks)  </td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->anc12_max_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->anc12_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->anc12_target) }}</td>
                                <td class="blue">{{ Helpers::convertToPercent($report->anc12_performance) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->anc12_block) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->anc12_district) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->anc12_state) }}</td>
                             </tr>
                             <tr>
                                <td>Proportion of LBW among new born</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->plb_max_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->plb_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->plb_target) }}</td>
                                <td class="blue">{{ Helpers::convertToPercent($report->plb_performance) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->plb_block) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->plb_district) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->plb_state) }}</td>
                             </tr>
                             <tr>
                                <td>FP - IUCD Insertion %</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->fpiucd_max_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->fpiucdscore_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->fpiucd_target) }}</td>
                                <td class="blue">{{ Helpers::convertToPercent($report->fpiucd_performance) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->fpiucd_block) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->fpiucd_district) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->fpiucd_state) }}</td>
                             </tr>
                             <tr>
                                <td>FP - PPIUCD Insertion %</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->ppiucd_max_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->ppiucd_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->ppiucd_target) }}</td>
                                <td class="blue">{{ Helpers::convertToPercent($report->ppiucd_performance) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->ppiucd_block) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->ppiucd_district) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->ppiucd_state) }}</td>
                             </tr>
                             <tr>
                                <td>FP - Sterilization %</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->fp_max_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->fp_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->fp_sterilization_target) }}</td>
                                <td class="blue">{{ Helpers::convertToPercent($report->fp_sterilization_performance) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->fp_sterilization_block) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->fp_sterilization_district) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->fp_sterilization_state) }}</td>
                             </tr>
                          </table>
                          <table width="100%" class="table fancy-table">
                             <tr data-title-attribute="{{$months[$report->month]}} {{$report->year}} Report Card">
                                <th width="10%" rowspan="4" valign="middle">CDs</th>
                                <td width="20%">Pneumonia prevalence</td>
                                <td width="12%" class="velvet-color">{{ $report->pneumonia_max_score_achieved }}</td>
                                <td width="9%" class="velvet-color">{{ $report->pneumonia_score_achieved }}</td>
                                <td width="10%" class="velvet-color">{{ $report->pneumonia_target }}</td>
                                <td width="9%" class="blue">{{ $report->pneumonia_performance }}</td>
                                <td width="10%" class="dark-green">{{ $report->pneumonia_block }}</td>
                                <td width="10%" class="dark-green">{{ $report->pneumonia_district }}</td>
                                <td width="10%" class="dark-green">{{ $report->pneumonia_state }}</td>
                             </tr>
                             <tr>
                                <td>Malaria slides collected</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->malaria_max_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->malaria_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->malaria_target) }}</td>
                                <td class="blue">{{ Helpers::convertToPercent($report->malaria_performance) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->malaria_block) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->malaria_district) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->malaria_state) }}</td>
                             </tr>

                             <tr>
                                <td>Diarrhea prevalence</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->diarrhea_max_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->diarrhea_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->diarrhea_target) }}</td>
                                <td class="blue">{{ Helpers::convertToPercent($report->diarrhea_performance) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->diarrhea_block)}}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->diarrhea_district) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->diarrhea_state) }}</td>
                             </tr>
                          </table>
{{--                             <tr>
                                <td>Dengue</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->dengue_max_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->dengue_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->dengue_target) }}</td>
                                <td class="blue">{{ Helpers::convertToPercent($report->dengue_performance) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->dengue_block)}}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->dengue_district) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->dengue_state) }}</td>
                             </tr>--}}

{{--                          <table width="100%" class="table fancy-table">
                             <tr data-title-attribute="{{$months[$report->month]}} {{$report->year}} Report Card">
                                <th width="10%" rowspan="3" valign="middle">NCDs</th>
                                <td width="20%">prevalence (old and new cases) %Hypertension </td>
                                <td width="12%" class="velvet-color">{{ Helpers::convertToPercent($report->hp_max_score_achieved) }}</td>
                                <td width="10%" class="velvet-color">{{ Helpers::convertToPercent($report->hp_score_achieved) }}</td>
                                <td width="10%" class="velvet-color">{{ Helpers::convertToPercent($report->hp_target) }}</td>
                                <td width="10%" class="blue">{{ Helpers::convertToPercent($report->hp_performance) }}</td>
                                <td width="10%" class="dark-green">{{ Helpers::convertToPercent($report->hp_block)}}</td>
                                <td width="10%" class="dark-green">{{ Helpers::convertToPercent($report->hp_district) }}</td>
                                <td width="10%" class="dark-green">{{ Helpers::convertToPercent($report->hp_state) }}</td>
                             </tr>
                             <tr>
                                <td>Diabetes prevalence (old and new cases) %</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->diabetes_max_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->diabetes_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->diabetes_target) }}</td>
                                <td class="blue">{{ Helpers::convertToPercent($report->diabetes_performance) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->diabetes_block) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->diabetes_district) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->diabetes_state) }}</td>
                             </tr>
                             <tr>
                                <td>CVD diagnosis (old and new cases) %</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->cvd_max_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->cvd_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->cvd_target) }}</td>
                                <td class="blue">{{ Helpers::convertToPercent($report->cvd_performance) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->cvd_block) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->cvd_district) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->cvd_state) }}</td>
                             </tr>
                          </table>--}}
                          <table width="100%" class="table fancy-table">
                             <tr data-title-attribute="{{$months[$report->month]}} {{$report->year}} Report Card">
                                <th width="10%" rowspan="6" valign="middle">Governance</th>
                                <td width="20%"># Days patient vouchers were updated this month </td>
                                <td width="12%" class="velvet-color">{{ $report->days_patient_voucher_max_score_achieved }}</td>
                                <td width="9%" class="velvet-color">{{ $report->days_patient_voucher_score_achieved }}</td>
                                <td width="10%" class="velvet-color">{{ $report->days_patient_voucher_target }}</td>
                                <td width="9%" class="blue">{{ $report->days_patient_voucher_performance }}</td>
                                <td width="10%" class="dark-green">{{ $report->days_patient_voucher_block }}</td>
                                <td width="10%" class="dark-green">{{ $report->days_patient_voucher_district }}</td>
                                <td width="10%" class="dark-green">{{ $report->days_patient_voucher_state }}</td>
                             </tr>
                             <tr>
                                <td>% Patient Vouchers recorded vs OPD for the month</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->patient_vouchers_max_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->patient_vouchers_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->patient_vouchers_target) }}</td>
                                <td class="blue">{{ Helpers::convertToPercent($report->patient_vouchers_performance) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->patient_vouchers_block) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->patient_vouchers_district) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->patient_vouchers_state) }}</td>
                             </tr>
                             <tr>
                                <td>Med Availability >80% &verified by Patient Feedback</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->med_avail_feedback_max_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->med_avail_feedback_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->med_avail_feedback_target) }}</td>
                                <td class="blue">{{ Helpers::convertToPercent($report->med_avail_feedback_performance) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->med_avail_feedback_block) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->med_avail_feedback_district) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->med_avail_feedback_state) }}</td>
                             </tr>
                             <tr>
                                <td>Test Availability >80% & verified by Patient Feedback </td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->test_avail_feedback_max_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->test_avail_feedback_score_achieved)}}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->test_avail_target) }}</td>
                                <td class="blue">{{ Helpers::convertToPercent($report->test_avail_performance) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->test_avail_block) }}</td>
                                <td>{{ Helpers::convertToPercent($report->test_avail_district) }}</td>
                                <td>{{ Helpers::convertToPercent($report->test_avail_state)}}</td>
                             </tr>
                             <tr>
                                <td>Doctor Attendance >80% & verified by Patient Feedback</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->doc_avail_feedback_max_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->doc_avail_feedback_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->doc_avail_target) }}</td>
                                <td class="blue">{{ Helpers::convertToPercent($report->doc_avail_performance) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->doc_avail_block) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->doc_avail_district) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->doc_avail_state) }}</td>
                             </tr>
{{--                             <tr>
                                <td>Rajdhara: % Fill Rate</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->rajdharaa_max_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->rajdharaa_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->rajdhara_target) }}</td>
                                <td class="blue">{{ Helpers::convertToPercent($report->rajdhara_performance) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->rajdhara_block) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->rajdhara_district) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->rajdhara_state) }}</td>
                             </tr>--}}
                          </table>
                          <table width="100%" class="table fancy-table">
                             <tr data-title-attribute="{{$months[$report->month]}} {{$report->year}} Report Card">
                                <th width="10%" rowspan="4" valign="middle">Reporting</th>
                                <td width="20%">Pregnant Women registered on PCTS - line list vs. expected PW </td>
                                <td width="12%" class="velvet-color">{{ Helpers::convertToPercent($report->linelist_vs_expected_max_score_achieved) }}</td>
                                <td width="9%" class="velvet-color">{{ Helpers::convertToPercent($report->linelist_vs_expected_score_achieved) }}</td>
                                <td width="10%" class="velvet-color">{{ Helpers::convertToPercent($report->linelist_vs_expected_target) }}</td>
                                <td width="9%" class="blue">{{ Helpers::convertToPercent($report->linelist_vs_expected_performance) }}</td>
                                <td width="10%" class="dark-green">{{ Helpers::convertToPercent($report->linelist_vs_expected_block) }}</td>
                                <td width="10%" class="dark-green">{{ Helpers::convertToPercent($report->linelist_vs_expected_district) }}</td>
                                <td width="10%" class="dark-green">{{ Helpers::convertToPercent($report->linelist_vs_expected_state) }}</td>
                             </tr>
                             <tr>
                                <td>Live births registered on PCTS vs. expected  </td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->pcts_vs_expected_max_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->pcts_vs_expected_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->pcts_vs_expected_target) }}</td>
                                <td class="blue">{{ Helpers::convertToPercent($report->pcts_vs_expected_performance) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->pcts_vs_expected_block) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->pcts_vs_expected_district) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->pcts_vs_expected_state) }}</td>
                             </tr>
                             <tr>
                                <td>Institutional Deliveries (Summary(Form6,7) - LL)  </td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->id_max_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->id_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->id_target) }}</td>
                                <td class="blue">{{ Helpers::convertToPercent($report->id_performance) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->id_block) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->id_district) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->id_state) }}</td>
                             </tr>
                             <tr>
                                <td>Full Immunization (Summary – Line List) </td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->fi_max_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->fi_score_achieved) }}</td>
                                <td class="velvet-color">{{ Helpers::convertToPercent($report->fi_target) }}</td>
                                <td class="blue">{{ Helpers::convertToPercent($report->fi_performance) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->fi_block) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->fi_district) }}</td>
                                <td class="dark-green">{{ Helpers::convertToPercent($report->fi_state) }}</td>
                             </tr>
                          </table>


                          <table width="100%" class="table fancy-table footer-table">
                             <tr data-title-attribute="{{$months[$report->month]}} {{$report->year}} Report Card">
                                <th width="30%" valign="middle">Patient Satisfaction Score</th>
                                <td width="12%" class="velvet-color">{{ Helpers::convertToPercent($report->patient_satisfaction_max_score_achieved) }}</td>
                                <td width="9%" class="velvet-color">{{ Helpers::convertToPercent($report->patient_satisfaction_score_achieved) }}</td>
                                <td width="10%" class="velvet-color">{{ Helpers::convertToPercent($report->patient_satisfaction_cut_off) }}</td>
                                <td width="9%" class="blue">{{ Helpers::convertToPercent($report->patient_satisfaction_performance) }}</td>
                                <td width="10%" class="dark-green">{{ Helpers::convertToPercent($report->patient_satisfaction_block) }}</td>
                                <td width="10%" class="dark-green">{{ Helpers::convertToPercent($report->patient_satisfaction_district) }}</td>
                                <td width="10%" class="dark-green">{{ Helpers::convertToPercent($report->patient_satisfaction_state) }}</td>
                             </tr>
                          </table>

                    </div>
                 </div>
               </div>
            </div>
         </div>
      </section>
      <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
      <script type="text/javascript">
         $(window).scroll(function() {
            var scroll = $(window).scrollTop();
         
            if (scroll >= 100) {
                $(".reports-area.navbar-fixed-top").addClass("darkHeader");
            } else {
                $(".reports-area.navbar-fixed-top").removeClass("darkHeader");
            }
         
            if( $( window ).width() <= 767 ){
            	if (scroll >= 200) {
                 $(".reports-area.navbar-fixed-top").addClass("darkHeader");
             } else {
                 $(".reports-area.navbar-fixed-top").removeClass("darkHeader");
             }
            }
         
         });
      </script>
   </body>
</html>