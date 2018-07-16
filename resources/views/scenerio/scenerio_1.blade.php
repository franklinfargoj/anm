@extends('scenerio.template')

@section('body')
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; padding: 10px 25px;">
        <tr>
            <td style="border-top: solid 1px #08683a; border-bottom: solid 1px #08683a; padding: 10px 0px;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td align="left"><img src="{{ asset('images/newsletter-img/announcment-icon-left.jpg') }} " alt="" style="margin-left: -20px;"></td>
                        <td style="font-size: 36px; line-height: 36px; color: #08683a; font-weight: bold; text-align: center; font-family: 'kruti_dev_010regular';">शाबाश {{ strtoupper($type) }}
                            <?php
                               if($type == 'anm'){
                            ?>
                            दीदी </td>
                        <?php }?>
                        <td align="right"><img src="{{ asset('images/newsletter-img/announcment-icon-right.jpg') }} " alt="" style="margin-right: -20px;"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff;">
        <tr>
            <td align="left" valign="middle"><img src="{{ asset('images/newsletter-img/pic1-left.jpg') }}" alt="" alt=""></td>
            <td align="center" style="font-weight: bold;">

                {{--@if($type != 'beneficiary')--}}
                    @if(isset($lstData['TOP']['anm_name']) && count($lstData['TOP']['anm_name']) > 0)
                        <span style="color: #ec1d25; font-size: 30px;" class=""> {{ implode(',', $lstData['TOP']['anm_name']) }}</span>
                                और
                        <span style="color: #ec1d25; font-size: 30px;" class=""> {{ $lstData['TOP']['end'] }}</span>
                    @else
                        <span style="color: #ec1d25; font-size: 30px;" class=""> {{ $lstData['TOP']['end'] }}</span>
                    @endif
                {{--@endif--}}

				<p style="color: #000; font-size: 18px; line-height: 30px; margin:0;">आपने मार्च में अव्वल दर्जे का काम कर दिखाया! आप में से कुछ <span style="color: #ec1d25; font-size: 24px;">{{ strtoupper($type) }}s</span> ने 80% बच्चो का टीकाकरण पूरा कर दिखाया तथा कुछ ने 30% गर्भवती महिलाओ का चौथा ANC चैकप भी पूरा किया!</p>
            </td>
        </tr>
    </table>
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; padding-top: 30px;">
        <tr>
            <td align="center" style="font-weight: bold;">
                <span style="color: #ec1d25; font-size: 30px;">
                    <span style="font-size:20px; color: #000; display: block;">हमारी</span>
                    {{--@if($type != 'beneficiary')--}}
                        @if(isset($lstData['MIDDLE']['anm_name']) && count($lstData['MIDDLE']['anm_name']) > 0)
                            <span class="">{{ implode(',', $lstData['MIDDLE']['anm_name']) }}</span>
                            एवं
                           <span class="">{{ $lstData['MIDDLE']['end'] }}</span>
                        @else
                            <span class="">{{ $lstData['MIDDLE']['end'] }}</span>
                        @endif
                    {{--@endif--}}
                <span>
                <p style="color: #000; font-size: 18px; line-height: 30px; margin:0;"><?php
                    if($type == 'anm'){
                    ?>
                    दीदी
            <?php }?> ने भी अच्छा करने प्रयास किया 30% - 80% बच्चो का टीकाकरण कर दिखाया साथ ही साथ 10% - 30% गर्भवती महिलाओ का चौथा ANC चैकप भी पूरा किया!</p>
            </td>
            <td align="right" valign="middle"><img src="{{ asset('images/newsletter-img/pic2-right.jpg') }}" alt="" alt=""></td>
        </tr>
    </table>
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; padding-top: 30px;">
        <tr>
            <td align="left" valign="middle"><img src="{{ asset('images/newsletter-img/pic3-left.jpg') }}" alt="" alt=""></td>
            <td align="center" style="font-weight: bold;">
				<span style="color: #ec1d25; font-size: 30px;">
                    {{--@if($type != 'beneficiary')--}}
                        @if(isset($lstData['BOTTOM']['anm_name']) && count($lstData['BOTTOM']['anm_name']) > 1)
                            <span class="">{{ implode(',', $lstData['BOTTOM']['anm_name']) }}</span>

                            एवं

                            <span class="">{{ $lstData['BOTTOM']['end'] }}</span>
                        @else
                            <span class="">{{ $lstData['BOTTOM']['end'] }}</span>
                        @endif
                    {{--@endif--}}


                 <span>
				<p style="color: #000; font-size: 18px; line-height: 30px; margin:0;">आपको भी 80% बच्चो का टीकाकरण एवं 30% से भी अधिक गर्भवती महिलाओ का चौथा ANC करके दिखाना है| थोड़ी और तैयारी करो| </p>
            </td>
        </tr>
    </table>

@endsection