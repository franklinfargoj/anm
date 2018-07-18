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
					{{\Helpers::ordinal($report->phc_rank_in_block)}} <span>in block (of 8)</span>
				</div>
				<div class="col-md-4 text-center phc-ranking-content">
					{{\Helpers::ordinal($report->phc_rank_in_district)}} <span>in district (of 80)</span>
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
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
					</tr>
					<tr>
						<td>Proportion of <br/> Institutional Delivery</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
					</tr>
				</table>

				<table width="100%" class="table">
					<tr>
						<th rowspan="8" valign="middle">RMNCH + A</th>
						<td>Full Immunization Coverage</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
					</tr>
					<tr>
						<td>ANC 3 Coverage</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
					</tr>
					<tr>
						<td>ANC 4 Coverage</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
					</tr>
					<tr>
						<td>ANC Registration (within 12 weeks)</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
					</tr>
					<tr>
						<td>Proportion of LBW among new born</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
					</tr>
					<tr>
						<td>FP - IUCD Insertion %</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
					</tr>
					<tr>
						<td>FP - PPIUCD Insertion %</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
					</tr>
					<tr>
						<td>FP - Sterilization %</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
					</tr>
				</table>

				<table width="100%" class="table">
					<tr>
						<th rowspan="3" valign="middle">CDs</th>
						<td>Pneumonia prevalence</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
					</tr>
					<tr>
						<td>Malaria slides collected</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
					</tr>
					<tr>
						<td>Diarrhea prevalence</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
						<td>00</td>
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