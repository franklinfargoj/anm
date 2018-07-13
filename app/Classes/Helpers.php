<?php
namespace App\Classes;

class Helpers{

	public static function renderHindi($phc, $type)
	{
		$topphctext = '';
		$cnt = count($phc);
	    $last = $phc[$cnt-1];
	    for($i = 0; $i < $cnt; $i++){
	        if($last == $phc[$i]){
	            $topphctext .= ' तथा  '.$type.' '.$phc[$i];
	        }else{
	            $topphctext .= $type.' '.$phc[$i].'&#93; ';
	        }
	    }
	    return $topphctext;
	}


	public static function sendSms($sms, $mobile)
	{
		return ["status" => true, "message" => "sms sent successfully"];
	}
}
?>