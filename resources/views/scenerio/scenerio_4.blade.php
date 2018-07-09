@extends('scenerio.template')

@section('body')
	<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; padding: 10px 25px 40px;">
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
			<td align="center" valign="middle"><img src="http://design.neosofttech.in/50/rajesh/BCG/html/images/newsletter-img/pic5-center.jpg" alt="" alt=""></td>
		</tr>
		<tr>
			<td align="center" style="font-weight: bold; padding: 20px 60px;">
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

@endsection