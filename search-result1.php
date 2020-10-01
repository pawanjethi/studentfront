<?php
$searchterm = $_POST['searchvalue'];
//$searchterm = 'smallest bone';
//$searchterm1 = [
//'file' => '$searchterm',
//];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://15.207.176.8/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => array('file' => $searchterm),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

?>