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

        $username="franklin";                      //username of the department
        $password="franklinf123";                  //password of the department
        $encryp_password=sha1(trim($password));
        $senderid="1";                             //senderid of the deparment
        $message="Your Normal message here ";      //message content
        $mobileno="9561459348";                    //if single sms need to be send use mobileno keyword
        $deptSecureKey= "11";                      //departsecure key for encryption of message...

        sendSingleSMS($username,$encryp_password,$senderid,$message,$mobileno,$deptSecureKey);

        //Function to send single sms
        function sendSingleSMS($username,$encryp_password,$senderid,$message,$mobileno,$deptSecureKey){
            $key=hash('sha512',trim($username).trim($senderid).trim($message).trim($deptSecureKey));
            $data = array(
                "username" => trim($username),
                "password" => trim($encryp_password),
                "senderid" => trim($senderid),
                "content" => trim($message),
                "smsservicetype" =>"singlemsg",
                "mobileno" =>trim($mobileno),
                "key" => trim($key)
            );
            post_to_url("https://msdgweb.mgov.gov.in/esms/sendsmsrequest",$data); //calling post_to_url to send sms
        }

        //function to send bulk sms
        function sendBulkSMS($username,$encryp_password,$senderid,$message,$mobileNos,$deptSecureKey){
            $key=hash('sha512', trim($username).trim($senderid).trim($message).trim($deptSecureKey));

            $data = array(
                "username" => trim($username),
                "password" => trim($encryp_password),
                "senderid" => trim($senderid),
                "content" => trim($message),
                "smsservicetype" =>"bulkmsg",
                "bulkmobno" =>trim($mobileNos),
                "key" => trim($key)
            );
            post_to_url("https://msdgweb.mgov.gov.in/esms/sendsmsrequest",$data); //calling post_to_url to send bulk sms
        }

        function post_to_url($url, $data) {
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
            curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($post); //result from mobile seva server
            echo $result; //output from server displayed
            curl_close($post);
        }
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

	
	public static function convertToPercent($number){

	    if($number > 0){
	        $percentNumber = $number*100;
	        return $percentNumber;
        }else{
	        return 0;
        }
    }
}
?>