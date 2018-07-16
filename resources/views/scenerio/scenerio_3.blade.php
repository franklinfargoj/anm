@extends('scenerio.template')

@section('body')

    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; padding: 10px 25px 80px;">
        <tr>
            <td style="border-top: solid 1px #08683a; border-bottom: solid 1px #08683a; padding: 10px 0px;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td align="left"><img src="{{ asset('images/newsletter-img/announcment-icon-left.jpg') }}" alt="" style="margin-left: -20px;"></td>
                        <td style="font-size: 36px; line-height: 36px; color: #08683a; font-weight: bold; text-align: center;">शाबाश
                            {{ strtoupper($type) }}
                            <?php
                            if($type == 'anm'){
                            ?>
                            दीदी </td>
                        <?php }?>
                        <td align="right"><img src="{{ asset('images/newsletter-img/announcment-icon-right.jpg') }}" alt="" style="margin-right: -20px;"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff;">
        <tr>
            <td align="left" valign="middle"><img src="{{ asset('images/newsletter-img/pic1-left.jpg') }}" alt="" alt=""></td>
            <td align="center" style="font-weight: bold;">
                @if(isset($lstData['TOP']['anm_name']) && count($lstData['TOP']['anm_name']) > 0)
                    <span style="color: #ec1d25; font-size: 30px;" class=""> {{ implode(',', $lstData['TOP']['anm_name']) }}<span>
                                और
                        <span style="color: #ec1d25; font-size: 30px;" class=""> {{ $lstData['TOP']['end'] }}<span>
                    @else
                                    <span style="color: #ec1d25; font-size: 30px;"> {{ $lstData['TOP']['end'] }}<span>
                    @endif
				<p style="color: #000; font-size: 18px; line-height: 30px; margin:0;" class="">आपने {{$current_month}} में अव्वल दर्जे का काम कर दिखाया! आप में से कुछ <span style="color: #ec1d25; font-size: 24px;">{{ strtoupper($type) }}s</span> ने 80% बच्चो का टीकाकरण पूरा कर दिखाया तथा कुछ ने 30% गर्भवती महिलाओ का चौथा ANC चैकप भी पूरा किया!</p>
            </td>
        </tr>
    </table>

    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; padding-top: 80px;">
        <tr>
            <td align="center" style="font-weight: bold;">
				<span style="color: #ec1d25; font-size: 30px;">
                    @if(isset($lstData['BOTTOM']['anm_name']) && count($lstData['BOTTOM']['anm_name']) > 1)
                        <span class="">{{ implode(',', $lstData['BOTTOM']['anm_name']) }}</span>

                        एवं

                        <span class="">{{ $lstData['BOTTOM']['end'] }}</span>
                    @else
                        <span class="">{{ $lstData['BOTTOM']['end'] }}</span>
                    @endif
                <span>
				<p style="color: #000; font-size: 18px; line-height: 30px; margin:0;">आपको भी 80% बच्चो का टीकाकरण एवं 30% से भी अधिक गर्भवती महिलाओ का चौथा ANC करके दिखाना है| थोड़ी और तैयारी करो| </p>
            </td>
            <td align="right" valign="middle"><img src="{{ asset('images/newsletter-img/pic4-right.jpg') }}" alt="" alt=""></td>
        </tr>
    </table>
@endsection