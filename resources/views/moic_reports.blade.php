<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>
<body class="internal-page">
<header class="internal-header navbar-fixed-top">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h4>PHC {{$report->phc_name}} : Performance Review
					<span>{{$months[$report->month]}} 2018</span>
				</h4>
			</div>
		</div>

		<div class="box-area mt-1">
			<div class="row">
				<div class="col-md-4 text-center phc-ranking-title">
					<img src="{{asset('images/trophy-icon.png')}}" alt="" border="0"> 
					PHC Ranking:
				</div>
				<div class="col-md-4 text-center phc-ranking-content">
					{{Helpers::ordinal($report->phc_rank_in_block)}} <span>in block (of 8)</span>
				</div>
				<div class="col-md-4 text-center phc-ranking-content">
					{{Helpers::ordinal($report->phc_rank_in_district)}} <span>in district (of 80)</span>
				</div>
			</div>
		</div>
	</div>
</header>	

<section class="reports-area navbar-fixed-top">
	<div class="container">
		<div class="box-area">
			<div class="row">
				<div class="col-md-4 text-center">
					<h5>May 2018 Report Card</h5>
					<ul>
						<li>Program</li>
						<li>Metric</li>
					</ul>
				</div>
				<div class="col-md-4 text-center">
					<h5>MOIC Name:</h5>
					<ul>
						<li>Target</li>
						<li>May'18 Performance</li>
					</ul>
				</div>
				<div class="col-md-4 text-center">
					<h5>Best Performing PHC</h5>
					<ul>
						<li>In the block</li>
						<li>In Alwar</li>
						<li>In Rajasthan</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="internal-table-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<table width="100%" class="table">
					<tr>
						<th rowspan="2" valign="middle">Utilization</th>
						<td>OPDs/day (>40)</td>
						<td>{{ $report->opd_target }}</td>
						<td>{{ $report->opd_performance }}</td>
						<td>{{ $report->opd_block }}</td>
						<td>{{ $report->opd_district }}</td>
						<td>{{ $report->opd_state }}</td>
					</tr>
					<tr>
						<td>Proportion of <br/> Institutional Delivery</td>
						<td>{{ $report->pid_target }}</td>
						<td>{{ $report->pid_performance }}</td>
						<td>{{ $report->pid_block }}</td>
						<td>{{ $report->pid_district }}</td>
						<td>{{ $report->pid_state }}</td>
					</tr>
				</table>

				<table width="100%" class="table">
					<tr>
						<th rowspan="8" valign="middle">RMNCH + A</th>
						<td>Full Immunization Coverage</td>
						<td>{{ $report->fic_target }}</td>
						<td>{{ $report->fic_performance }}</td>
						<td>{{ $report->fic_block }}</td>
						<td>{{ $report->fic_district }}</td>
						<td>{{ $report->fic_state }}</td>
					</tr>
					<tr>
						<td>ANC 3 Coverage</td>
						<td>{{ $report->anc3_target }}</td>
						<td>{{ $report->anc3_performance }}</td>
						<td>{{ $report->anc3_block }}</td>
						<td>{{ $report->anc3_district }}</td>
						<td>{{ $report->anc3_state }}</td>
					</tr>
					<tr>
						<td>ANC 4 Coverage</td>
						<td>{{ $report->anc4_target }}</td>
						<td>{{ $report->anc4_performance }}</td>
						<td>{{ $report->anc4_block }}</td>
						<td>{{ $report->anc4_district }}</td>
						<td>{{ $report->anc4_state }}</td>
					</tr>
					<tr>
						<td>ANC Registration (within 12 weeks)</td>
						<td>{{ $report->anc12_target }}</td>
						<td>{{ $report->anc12_performance }}</td>
						<td>{{ $report->anc12_block }}</td>
						<td>{{ $report->anc12_district }}</td>
						<td>{{ $report->anc12_state }}</td>
					</tr>
					<tr>
						<td>Proportion of LBW among new born</td>
						<td>{{ $report->plb_target }}</td>
						<td>{{ $report->plb_performance }}</td>
						<td>{{ $report->plb_block }}</td>
						<td>{{ $report->plb_district }}</td>
						<td>{{ $report->plb_state }}</td>
					</tr>
					<tr>
						<td>FP - IUCD Insertion %</td>
						<td>{{ $report->fpiucd_target }}</td>
						<td>{{ $report->fpiucd_target }}</td>
						<td>{{ $report->fpiucd_block }}</td>
						<td>{{ $report->fpiucd_district }}</td>
						<td>{{ $report->fpiucd_state }}</td>
					</tr>
					<tr>
						<td>FP - PPIUCD Insertion %</td>
						<td>{{ $report->ppiucd_target }}</td>
						<td>{{ $report->ppiucd_performance }}</td>
						<td>{{ $report->ppiucd_block }}</td>
						<td>{{ $report->ppiucd_district }}</td>
						<td>{{ $report->ppiucd_state }}</td>
					</tr>
					<tr>
						<td>FP - Sterilization %</td>
						<td>{{ $report->fp_sterilization_target }}</td>
						<td>{{ $report->fp_sterilization_performance }}</td>
						<td>{{ $report->fp_sterilization_block }}</td>
						<td>{{ $report->fp_sterilization_district }}</td>
						<td>{{ $report->fp_sterilization_state }}</td>
					</tr>
				</table>

				<table width="100%" class="table">
					<tr>
						<th rowspan="3" valign="middle">CDs</th>
						<td>Pneumonia prevalence</td>
						<td>{{ $report->pneumonia_target }}</td>
						<td>{{ $report->pneumonia_performance }}</td>
						<td>{{ $report->pneumonia_block }}</td>
						<td>{{ $report->pneumonia_district }}</td>
						<td>{{ $report->pneumonia_state }}</td>
					</tr>
					<tr>
						<td>Malaria slides collected</td>
						<td>{{ $report->malaria_target }}</td>
						<td>{{ $report->malaria_performance }}</td>
						<td>{{ $report->malaria_block }}</td>
						<td>{{ $report->malaria_district }}</td>
						<td>{{ $report->malaria_state }}</td>
					</tr>
					<tr>
						<td>Diarrhea prevalence</td>
						<td>{{ $report->diarrhea_target }}</td>
						<td>{{ $report->diarrhea_performance }}</td>
						<td>{{ $report->diarrhea_block}}</td>
						<td>{{ $report->diarrhea_district }}</td>
						<td>{{ $report->diarrhea_state }}</td>
					</tr>
				</table>


				<table width="100%" class="table">
					<tr>
						<th rowspan="3" valign="middle">NCDs</th>
						<td>prevalence (old and new cases) %Hypertension </td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
					</tr>
					<tr>
						<td>Diabetes prevalence (old and new cases) %</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
					</tr>
					<tr>
						<td>CVD diagnosis (old and new cases) %</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
					</tr>
				</table>

				<table width="100%" class="table">
					<tr>
						<th rowspan="6" valign="middle">Governance</th>
						<td># Days patient vouchers were updated this month </td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
					</tr>
					<tr>
						<td>% Patient Vouchers recorded vs OPD for the month</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
					</tr>
					<tr>
						<td>Med Availability >80% &verified by Patient Feedback</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
					</tr>
					<tr>
						<td>Test Availability >80% & verified by Patient Feedback </td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
					</tr>
					<tr>
						<td>Doctor Attendance >80% & verified by Patient Feedback</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
					</tr>
					<tr>
						<td>Rajdhara: % Fill Rate</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
					</tr>
				</table>

				<table width="100%" class="table">
					<tr>
						<th rowspan="4" valign="middle">Reporting</th>
						<td>Pregnant Women registered on PCTS - line list vs. expected PW </td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
					</tr>
					<tr>
						<td>Live births registered on PCTS vs. expected </td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
					</tr>
					<tr>
						<td>Institutional Deliveries (Summary(Form6,7) - LL)</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
					</tr>
					<tr>
						<td>Full Immunization (Summary – Line List) </td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
					</tr>
				</table>
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
});
</script>
</body>
</html>