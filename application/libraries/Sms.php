<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sms{
	private $username,
			$password,
			$senderid,
			$messagetype,
			$DReports,
			$url;

	public function __construct(){
        $this->username = "caremobapp"; //your username
        $this->password = "care@1234"; //your password
        $this->messagetype = "N"; //Type Of Your Message
        $this->url = "http://www.smscountry.com/SMSCwebservice_Bulk.aspx";
		$this->senderid = "smscntry"; //Your senderid
		$this->DReports = "Y"; //Delivery Reports
	}

	public function send($mobile,$message){
		$message = urlencode($message);
		$data_url = "User={$this->username}&passwd={$this->password}&mobilenumber={$mobile}&message={$message}&sid={$this->senderid}&mtype={$this->messagetype}&DR={$this->DReports}";
		$ch = curl_init();
		if (!$ch){die("Couldn't initialize a cURL handle");}
		$ret = curl_setopt($ch, CURLOPT_URL,$this->url);
		curl_setopt ($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt ($ch, CURLOPT_POSTFIELDS,$data_url);
		$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$curlresponse = curl_exec($ch);
		if(curl_errno($ch)){
			curl_close($ch);
			return false;
		}
		if (empty($ret)) {
			curl_close($ch);
			return false;
		} else {
			$info = curl_getinfo($ch);
			curl_close($ch);
			return true;
		}
	}
}
