<?php
$url = "https://secure.ccavenue.com/transaction/getRSAKey";
$fields = array(
        'access_code'=>"AVCW64DD79AP28WCPA",
        'order_id'=>$_REQUEST["txn_number"]
);

$postvars='';
$sep='';
foreach($fields as $key=>$value){
$postvars.= $sep.urlencode($key).'='.urlencode($value);
$sep='&';
}

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,count($fields));
curl_setopt($ch, CURLOPT_CAINFO, 'cacert.pem');
curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
echo $result;
