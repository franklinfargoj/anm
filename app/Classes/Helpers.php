<?php
namespace App\Classes;

class Helpers{

	public static function renderHindi($phc, $type)
	{
		$topphctext = '';
		$cnt = count($phc);
	    $last = $phc[$cnt-1];
	    if($cnt == 1){
	    	$topphctext .= $type.' '.$phc[0];
	    }
	    else{
		    for($i = 0; $i < $cnt; $i++){
		        if($last == $phc[$i]){
		            $topphctext .= rtrim($topphctext, ',').' तथा  '.$type.'  '.$phc[$i].'';
		        }else{
		            $topphctext .= $type.'  '.$phc[$i].', ';
		        }
		    }
	    }
	    return $topphctext;
	}


	public static function sendSms($sms, $mobile)
	{
		return ["status" => true, "message" => "sms sent successfully"];
	}

	public static function ordinal($number) {
	    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
	    if ((($number % 100) >= 11) && (($number%100) <= 13)){
	        return $number. 'th';
	    }
	    else{
	        return $number. $ends[$number % 10];
	    }
	}
}
?>