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
					<td style="font-size: 24px; font-weight: bold; line-height: 32px; text-align: center;">जानना चाहते है की <span style="color: #ec1d25;">{{ $current_month }} <span style="text-decoration: underline;">{{date('Y')}}</span></span> में <span style="color: #ec1d25;">{{ $lstData['phc_name'] }} पी.एच.सी</span> <br/> के किस <span style="color: #ec1d25; font-size: 30px;">{{ strtoupper($type) }}</span> ने सबसे अच्छा काम किया?</td>
				</tr>
			</table>

			<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; padding: 10px 25px;">
				<tr>
					<td style="border-top: solid 1px #08683a; border-bottom: solid 1px #08683a; padding: 10px 0px;">
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td align="left"><img src="http://design.neosofttech.in/50/rajesh/BCG/html/images/newsletter-img/announcment-icon-left.jpg" alt="" style="margin-left: -20px;"></td>
								 <td style="font-size: 36px; line-height: 36px; color: #08683a; font-weight: bold; text-align: center;">शाबाश {{ strtoupper($type) }}
                                    @if($type == 'anm')
                                    {{ 'दीदी' }}
                                    @endif
                                </td>
								<td align="right"><img src="http://design.neosofttech.in/50/rajesh/BCG/html/images/newsletter-img/announcment-icon-right.jpg" alt="" style="margin-right: -20px;"></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>

			<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff;">
				<tr>
					<td align="left" valign="middle"><img src="http://design.neosofttech.in/50/rajesh/BCG/html/images/newsletter-img/pic1-left.jpg" alt="" alt=""></td>
					<td align="center" style="font-weight: bold;">
						<span style="color: #ec1d25; font-size: 30px;">
							@if(isset($lstData['TOP']['anm_name']) && count($lstData['TOP']['anm_name']) > 0)
                                <span class="fontsforweb_fontid_8705"> {{ implode('&#93;', $lstData['TOP']['anm_name']) }}</span>
                                        और
                                <span class="fontsforweb_fontid_8705"> {{ $lstData['TOP']['end'] }}</span>
                            @else
                                <span class="fontsforweb_fontid_8705"> {{ $lstData['TOP']['end'] }}</span>
                            @endif
						<span>
						<p style="color: #000; font-size: 18px; line-height: 30px; margin:0;">आपने {{$current_month}} में अव्वल दर्जे का काम कर दिखाया! आप में से कुछ <span style="color: #ec1d25; font-size: 24px;">{{ strtoupper($type) }}s</span> ने 80% बच्चो का टीकाकरण पूरा कर दिखाया तथा कुछ ने 30% गर्भवती महिलाओ का चौथा ANC चैकप भी पूरा किया!</p>
					</td>
				</tr>
			</table>

			<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; padding-top: 30px;">
				<tr>
					<td align="center" style="font-weight: bold;">
						<span style="color: #ec1d25; font-size: 30px;"><span style="font-size:20px; color: #000; display: block;">हमारी</span>
							@if(isset($lstData['MIDDLE']['anm_name']) && count($lstData['MIDDLE']['anm_name']) > 0)
                                <span style="color: #ec1d25; font-size: 30px;" class="fontsforweb_fontid_8705"> {{ implode('&#93;', $lstData['MIDDLE']['anm_name']) }}</span>
                                        और
                                <span style="color: #ec1d25; font-size: 30px;" class="fontsforweb_fontid_8705"> {{ $lstData['MIDDLE']['end'] }}</span>
                            @else
                                <span style="color: #ec1d25; font-size: 30px;" class="fontsforweb_fontid_8705"> {{ $lstData['MIDDLE']['end'] }}</span>
                            @endif
						<span>
						<p style="color: #000; font-size: 18px; line-height: 30px; margin:0;">दीदी ने भी अच्छा करने प्रयास किया 30% - 80% बच्चो का टीकाकरण कर दिखाया साथ ही साथ 10% - 30% गर्भवती महिलाओ का चौथा ANC चैकप भी पूरा किया!</p>
					</td>
					<td align="right" valign="middle"><img src="http://design.neosofttech.in/50/rajesh/BCG/html/images/newsletter-img/pic2-right.jpg" alt="" alt=""></td>
				</tr>
			</table>

			<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; padding: 60px 25px 5px;">
				<tr>
					<td align="center" colspan="2" style="font-size: 18px; line-height: 30px; font-weight: bold; border-top: solid 1px #000;">
						बने रहिये: देखते है {{ $next_month }} {{ date("Y") }} में कौनसी <span style="color: #ec1d25; font-size: 26px;">{{strtoupper($type)}}</span> अव्वल नंबर का काम करके दिखाएगी| 
					</td>
				</tr>

				<tr>
					<td align="center" colspan="2" style="padding: 20px 0;">
						 <button style="font-size:16px; background-color: #ec1d25; color: #ffffff; outline: none; border:none; padding: 8px 15px;">Download</button>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>