<?php
namespace App\Classes;
use setasign\Fpdi;

class Helpers{

	/**
	 *Render hindi text for storing purpose
	 *@param string $phc, string $type
	 *@return string
	 */
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


	/**
	 *Send a sms
	 *@param string $sms, string $mobile //maybe comma separated
	 *@return JSON
	 */
	public static function sendSms($sms, $mobile)
	{
		return ["status" => true, "message" => "sms sent successfully"];
		$username = env('SMS_USERNAME');
		$senderid = env('SMS_SENDERID');
		$deptSecureKey = env('SMS_SECURE_KEY');
		$key = hash('sha512',trim($username).trim($senderid).trim($sms).trim($deptSecureKey));
		$url = env('SMS_URL');
		$data = array(
		    "username" => trim($username),
		    "password" => trim($encryp_password),
		    "senderid" => trim($senderid),
		    "content" => trim($sms),
		    "smsservicetype" =>"singlemsg",
		    "mobileno" =>trim($mobile),
		    "key" => trim($key)
		);
		return self::postCurl($url, $data);
	}

	/**
	 *Genarate number with suffix for e.g 1 => 1st, 2 => 2nd
	 *@param int $number
	 *@return string
	 */
	public static function ordinal($number) {
	    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
	    if ((($number % 100) >= 11) && (($number%100) <= 13)){
	        return $number. 'th';
	    }
	    else{
	        return $number. $ends[$number % 10];
	    }
	}

	/**
	 *Genarate number with suffix for e.g 1 => 1st, 2 => 2nd
	 *@param int $number
	 *@return int
	 */
	public static function convertToPercent($number){

	    if($number > 0){
	        $percentNumber = $number*100;
	        return $percentNumber;
        }else{
	        return 0;
        }
    }


    /**
	 *POST data to url using cURL
	 *@param int $number
	 *@return string
	 */
    public function postCurl($url, $data)
    {
		$fields = '';
		foreach($data as $key => $value) {
		    $fields .= $key . '=' . urlencode($value) . '&';
		}
		rtrim($fields, '&');

		$post = curl_init();
		//curl_setopt($post, CURLOPT_SSLVERSION, 5); // uncomment for systems supporting TLSv1.1 only
		curl_setopt($post, CURLOPT_SSLVERSION, 6); // use for systems supporting TLSv1.2 or comment the line
		curl_setopt($post,CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($post, CURLOPT_URL, $url);
		curl_setopt($post, CURLOPT_POST, count($data));
		curl_setopt($post, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($post, CURLOPT_HTTPHEADER, array("Content-Type:application/x-www-form-urlencoded"));
		curl_setopt($post, CURLOPT_HTTPHEADER, array("Content-length:"
		    . strlen($fields) ));
		curl_setopt($post, CURLOPT_HTTPHEADER, array("User-Agent:Mozilla/4.0 (compatible; MSIE 5.0; Windows 98; DigExt)"));
		curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($post); //result from mobile seva server
		curl_close($post);
		return $result;
    }

    public static function testPDF($fname)
    {
    	$months = \DB::table('master_months')->pluck('month_english', 'id')->toArray();
	    $array = \DB::table('moic_ranking_reports')->first();
	    $i = 5;
	    $i++;
	    libxml_use_internal_errors(true);
	    $pdf = \PDF::setPaper('A4');
	    $pdf = \PDF::loadView('pdfv2',['report' => $array, 'months' => $months])->save('/home/webwerk/Desktop/anm/'.$fname.'.pdf');
	    echo $fname;
    }

}
?>