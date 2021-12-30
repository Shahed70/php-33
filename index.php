<?php

header('Access-Control-Allow-Origin: *');
// header('Content-Type: Application/json');

// $method = $_SERVER['REQUEST_METHOD'];

// switch($method){
//     case 'GET':
//         echo 'Get method';
//         break;
//     case 'POST':
//         echo 'Post method';
//         break;
//     default:
//         return;
// }

var_dump('test');

$headers = [
    'header' => "Content-type: application/x-www-form-urlencoded",
    'method' => 'POST'
];
$code ='39dd672336d82720b0201d8fdd0f5b5b';

$postData = [
    'grant_type' => "authorization_code",
    'client_id' => '809720505134',
    'client_secret' => '085dee158238b3b3b5edfadbbede4e6316112c356c4c575410',
    'redirect_uri' => 'http://127.0.0.1:3000',
    'code' => $code
];

$post = array('formParams'=> $postData);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://login.mailchimp.com/oauth2/token');
curl_setopt($curl, CURLOPT_POST,1);
curl_setopt($curl, CURLOPT_POSTFIELDS,  http_build_query($post));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($curl);

$curlresponse = json_decode($result);

var_dump($curlresponse);
