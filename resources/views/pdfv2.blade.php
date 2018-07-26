
<!DOCTYPE html>
<html style="margin:0; padding:0;">
<head>
<meta charset="UTF-8">
<title>ANM</title>
<style type="text/css" media="screen">
        /*@media all {
            .page-break{display:none;}
        }
        @media print {
            .page-break{display:block; page-break-before:always;}
        }*/
    </style>
</head>

<body style="padding: 0px; margin: 0px; font-family: Arial, Helvetica, sans-serif;"> 
    <!-- Main Header -->
    <div style="background-color: #17568F; padding:20px 10px;">
        <div style="width:95%; margin: 0 auto;">
            <h1 style="color: #ffffff; margin: 0px; font-size: 1.5em;">PHC {{$report->phc_name}} : Performance Review</h1>
            <h5 style="color: #ffffff; margin: 0px; font-size: 1.2em;">{{$months[$report->month]}} {{$report->year}}</h5>
            <div style="background-color: #ffffff; border-radius: 18px;">
                <ul style="list-style: none; padding-left: 0px; padding:20px;">
                    <li style="width:9%; display: inline-block; vertical-align:middle;">
                        <img src="images/trophy.png" width="40px" alt="" border="0" style="display: inline-block; margin-right:10px;">
                    </li>
                    <li style="width: 30%; display: inline-block; vertical-align:middle;">
                        <label style="font-size:0.9em; color: #11427d; margin: 0px; padding:0px;"><strong>PHC Ranking:</strong></label>
                    </li>
                    <li style="width: 30%; display: inline-block; vertical-align:middle;">
                        <p style="font-size:0.9em ; color: #11427d; margin: 0px; padding:0;"><strong>{{Helpers::ordinal($report->phc_rank_in_block)}}</strong> in block (of 8)</p>
                    </li>
                    <li style="width: 30%; display: inline-block; vertical-align:middle;">
                            <p style="font-size:0.9em ; color: #11427d; margin: 0px;  padding:0;"><strong>{{Helpers::ordinal($report->phc_rank_in_district)}} </strong>in district (of 80)</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Main Header -->

    <br>
    <br>
    <div style="background-color: #fff;">
        <div style="width:95%; margin: 0 auto;">
            <!-- Table Header -->
            <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
               <li style="background-color: #3d9bd8; font-size:0.8em; color: #fff; display: table-cell; padding: 10px 20px; text-align: center; width: 40%;">{{$months[$report->month]}} {{$report->year}} Report Card</li>
               <li style="background-color: #69b0e1; font-size:0.8em; color: #fff; display: table-cell; padding: 10px 20px; text-align: center; width: 24%;">MOIC Name: {{$report->moic_name}}</li>
               <li style="background-color: #c7c7c7; font-size:0.8em; color: #fff; display: table-cell; padding: 10px 20px; text-align: center; width: 36%;">Best Performing PHC</li>
            </ul>
            <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width:100%;">
                <li style="font-size:0.7em; font-weight:bold; color: #025fad; display: table-cell; padding:5px 20px; margin:0px; text-align: center; width: 15%">Program</li>
                <li style="font-size:0.7em; font-weight:bold; color: #025fad; display: table-cell; padding: 5px 20px; margin:0px;  text-align: center; width: 25%">Metric</li>
                <li style="font-size:0.7em; font-weight:bold; color: #670f31; display: table-cell; padding: 5px 20px; margin:0px;  text-align: center; width: 12%">Target</li>
                <li style="font-size:0.7em; font-weight:bold; color: #025fad; display: table-cell; padding: 5px 20px; margin:0px;  text-align: center; width: 12%">{{$months[$report->month]}}'s {{$report->year}} Performance</li>
                <li style="font-size:0.7em; font-weight:bold; color: #03522d; display: table-cell; padding: 5px 20px; margin:0px;  text-align: center; width: 12%">In the block   </li>
                <li style="font-size:0.7em; font-weight:bold; color: #03522d; display: table-cell; padding: 5px 20px;  margin:0px; text-align: center; width: 12%">In Alwar   </li>
                <li style="font-size:0.7em; font-weight:bold; color: #03522d; display: table-cell; padding: 5px 20px;  margin:0px; text-align: center; width: 12%">In Rajasthan </li>
            </ul>
            <!-- Table Header -->


            <!-- Table Row Utilization-->
            <div style="display: table; table-layout: fixed; padding: 0px; width: 100%;  border: 1px solid #d1d1d1; margin-bottom: 20px;">
                <div style="display: table-cell; font-size:0.7em; font-weight:bold; width: 15%; padding:5px 20px; text-align: center; vertical-align: middle; color: #fff; background-color: #2a9dd0">
                   <p>Utilization</p>
                </div>
                <div style="display: table-cell; width: 85%;">
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell; padding:5px 20px;  margin:0px; text-align: center; width: 25%">OPDs/day (>40)</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell; padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->opd_max_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell; padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->opd_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell; padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->opd_target }}</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell; padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->opd_performance }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell; padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->opd_block }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell; padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->opd_district }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell; padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->opd_state }}</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell; padding:5px 20px;  margin:0px; text-align: center; width: 25%">Proportion of
                                Institutional Delivery</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->pid_max_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->pid_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->pid_target) }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->pid_performance) }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->pid_block }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->pid_district }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->pid_state }}</li>
                    </ul>
                </div>
            </div>

            <!-- Table Row RMNCH + A div-->
            <div style="display: table; table-layout: fixed; padding: 0px; width: 100%;  border: 1px solid #d1d1d1; margin-bottom: 20px;">
                <div style="display: table-cell; width: 15%; font-size:0.7em; font-weight:bold;  padding:5px 20px;  margin:0px; text-align: center; vertical-align: middle; color: #fff; background:#2a9dd0">
                    <p>RMNCH + A</p>
                </div>
                <div style="display: table-cell; width: 85%;">
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">Full Immunization Coverage * </li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->fic_max_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->fic_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->fic_target) }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->fic_performance) }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->fic_block }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->fic_district }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->fic_state }}</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">ANC 3 Coverage * </li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->anc3_max_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->anc3_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->anc3_target) }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->anc3_performance) }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->anc3_block }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->anc3_district }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->anc3_state }}</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">ANC 4 Coverage * </li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->anc4_max_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->anc4_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->anc4_target) }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->anc4_performance) }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->anc4_block }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->anc4_district }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->anc4_state }}</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">ANC Registration (within 12 weeks) * </li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->anc12_max_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->anc12_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->anc12_target) }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->anc12_performance) }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->anc12_block }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->anc12_district }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->anc12_state }}</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">Proportion of LBW among new born</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->plb_max_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->plb_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->plb_target) }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->plb_performance) }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->plb_block }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->plb_district }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->plb_state }}</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">FP - IUCD Insertion %</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->fpiucd_max_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->fpiucdscore_achieved }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->fpiucd_target) }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->fpiucd_performance) }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->fpiucd_block }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->fpiucd_district }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->fpiucd_state }}</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">FP - PPIUCD Insertion %</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->ppiucd_max_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->ppiucd_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->ppiucd_target) }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->ppiucd_performance) }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->ppiucd_block }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->ppiucd_district }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->ppiucd_state }}</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">FP - Sterilization %</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->fp_max_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->fp_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->fp_sterilization_target) }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->fp_sterilization_performance) }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->fp_sterilization_block }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->fp_sterilization_district }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->fp_sterilization_state }}</li>
                    </ul>
                </div>
            </div>

            <!--CDs div-->
            <div style="display: table; table-layout: fixed; padding: 0px; width: 100%;  border: 1px solid #d1d1d1; margin-bottom: 20px;">
                <div style="display: table-cell; width: 15%; font-size:0.7em; font-weight:bold;  padding:5px 20px;  margin:0px; text-align: center; vertical-align: middle; color: #fff; background:#2a9dd0">
                    <p>CDs</p>
                </div>
                <div style="display: table-cell; width: 85%;">
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">Pneumonia prevalence</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->pneumonia_max_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->pneumonia_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->pneumonia_target }}</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->pneumonia_performance }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->pneumonia_block }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->pneumonia_district }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->pneumonia_state }}</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">Malaria slides collected</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->malaria_max_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->malaria_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->malaria_target) }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->malaria_performance) }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->malaria_block }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->malaria_district }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->malaria_state }}</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">Diarrhea prevalence</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->diarrhea_max_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->diarrhea_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->diarrhea_target }}</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->diarrhea_performance }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->diarrhea_block}}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->diarrhea_district }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->diarrhea_state }}</li>
                    </ul>
                </div>
            </div>

            <!-- NCD's div-->
            <div style="display: table; table-layout: fixed; padding: 0px; width: 100%;  border: 1px solid #d1d1d1; margin-bottom: 20px;">
                <div style="display: table-cell; width: 15%; font-size:0.7em; font-weight:bold;  padding:5px 20px;  margin:0px; text-align: center; vertical-align: middle; color: #fff; background:#2a9dd0">
                    <p>NCDs</p>
                </div>
                <div style="display: table-cell; width: 85%;">
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">prevalence (old and new cases) %Hypertension</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->hp_max_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->hp_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->hp_target) }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->hp_performance) }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->hp_block }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->hp_district }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->hp_state }}</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">Diabetes prevalence (old and new cases) %</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->diabetes_max_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->diabetes_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->diabetes_target) }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->diabetes_performance) }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->diabetes_block }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->diabetes_district }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->diabetes_state }}</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">CVD diagnosis (old and new cases) %</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->cvd_max_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->cvd_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->cvd_target) }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->cvd_performance) }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->cvd_block}}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->cvd_district }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->cvd_state }}</li>
                    </ul>
                </div>
            </div>
            <div style="display:block; page-break-before:always;"></div>

            <!--Gevernance div -->
            <div style="display: table; table-layout: fixed; padding: 0px; width: 100%;  border: 1px solid #d1d1d1; margin-bottom: 20px;">
                <div style="display: table-cell; width: 15%; font-size:0.7em; font-weight:bold;  padding:5px 20px;  margin:0px; text-align: center; vertical-align: middle; color: #fff; background:#2a9dd0">
                    <p>Governance</p>
                </div>
                <div style="display: table-cell; width: 85%;">
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%"># Days patient vouchers were updated this month </li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->days_patient_voucher_max_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->days_patient_voucher_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->days_patient_voucher_target }}</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->days_patient_voucher_performance }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->days_patient_voucher_block }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->days_patient_voucher_district }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->days_patient_voucher_state }}</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">% Patient Vouchers recorded vs OPD for the month</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->patient_vouchers_max_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->patient_vouchers_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->patient_vouchers_target) }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->patient_vouchers_performance) }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->patient_vouchers_block }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->patient_vouchers_district }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->patient_vouchers_state }}</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">CVD diagnosis (old and new cases) %</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->cvd_max_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->cvd_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->cvd_target) }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->cvd_performance) }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->cvd_block}}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->cvd_district }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->cvd_state }}</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">Med Availability >80% &verified by Patient Feedback</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->med_avail_feedback_max_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->med_avail_feedback_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->med_avail_feedback_target) }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->med_avail_feedback_performance) }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->med_avail_feedback_block }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->med_avail_feedback_district }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->med_avail_feedback_state }}</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">Test Availability >80% & verified by Patient Feedback </li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->test_avail_feedback_max_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->test_avail_feedback_score_achieved}}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->test_avail_target) }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->test_avail_performance) }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->test_avail_block }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->test_avail_district }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->test_avail_state}}</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">Doctor Attendance >80% & verified by Patient Feedback</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->doc_avail_feedback_max_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->doc_avail_feedback_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->doc_avail_target) }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->doc_avail_performance) }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->doc_avail_block }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->doc_avail_district }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->doc_avail_state }}</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">Rajdhara: % Fill Rate</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->rajdharaa_max_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->rajdharaa_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->rajdhara_target) }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->rajdhara_performance) }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->rajdhara_block }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->rajdhara_district }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->rajdhara_state }}</li>
                    </ul>
                </div>
            </div>

            <!--Reporting div-->
            <div style="display: table; table-layout: fixed; padding: 0px; width: 100%;  border: 1px solid #d1d1d1; margin-bottom: 20px;">
                <div style="display: table-cell; width: 15%; font-size:0.7em; font-weight:bold;  padding:5px 20px;  margin:0px; text-align: center; vertical-align: middle; color: #fff; background:#2a9dd0">
                    <p>Reporting</p>
                </div>
                <div style="display: table-cell; width: 85%;">
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">Pregnant Women registered on PCTS - line list vs. expected PW</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->linelist_vs_expected_max_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->linelist_vs_expected_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->linelist_vs_expected_target) }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->linelist_vs_expected_performance) }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->linelist_vs_expected_block }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->linelist_vs_expected_district }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->linelist_vs_expected_state }}</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">Live births registered on PCTS vs. expected * </li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->pcts_vs_expected_max_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->pcts_vs_expected_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->pcts_vs_expected_target) }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->pcts_vs_expected_performance) }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->pcts_vs_expected_block }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->pcts_vs_expected_district }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->pcts_vs_expected_state }}</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">Institutional Deliveries (Summary(Form6,7) - LL) * </li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->id_max_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->id_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->id_target) }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->id_performance) }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->id_block}}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->id_district }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->id_state }}</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">Full Immunization (Summary – Line List) </li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->fi_max_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->fi_score_achieved }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->fi_target) }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->fi_performance) }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->fi_block}}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->fi_district }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->fi_state }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</body>

</html>