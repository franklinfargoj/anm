<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
	<style type="text/css">
		body {
			margin: 10px;
			padding: 0;
		}
	</style>
</head>
<body>
<table width="540" cellpadding="0" cellspacing="0" border="0" align="center" style="font-family: Arial; background-color: #f0c94a; padding: 10px;">
	<tr>
		<td>
			<table width="100%" cellpadding="0" cellspacing="0" border="0" style="padding-bottom: 15px;">
				<tr>
					<td style="font-size: 24px; font-weight: bold; line-height: 32px; text-align: center;">जानना चाहते है की <span style="color: #ec1d25;">{{$current_month}} <span style="text-decoration: underline;">{{date('Y')}}</span></span> में <span style="color: #ec1d25;">{{ $lstData['phc_name'] }} पी.एच.सी</span> <br/> के किस <span style="color: #ec1d25; font-size: 30px;">{{strtoupper($type)}}</span> ने सबसे अच्छा काम किया?</td>
				</tr>
			</table>

			@yield('body')

			<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; padding: 60px 25px 5px;">
				<tr>
					<td align="center" colspan="2" style="font-size: 18px; line-height: 30px; font-weight: bold; border-top: solid 1px #000;">
						बने रहिये: देखते है {{$next_month}} {{date('Y')}} में कौनसी <span style="color: #ec1d25; font-size: 26px;">{{strtoupper($type)}}</span> अव्वल नंबर का काम करके दिखाएगी| 
					</td>
				</tr>

				<tr>
					<td align="center" colspan="2" style="padding: 20px 0;">
                        <a style="font-size:16px; background-color: #ec1d25; color: #ffffff; text-decoration: none; outline: none; border:none; padding: 8px 15px;" target="_blank" href="{{ route('download-link') }}">Download</a>
                    </td>
				</tr>
			</table>
		</td>
	</tr>
</table>	
</body>
</html>