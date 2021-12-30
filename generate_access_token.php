<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: Application/json');

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


$code = file_get_contents('php://input');

$url = 'https://login.mailchimp.com/oauth2/token';
$context = stream_context_create([
'http' => [
    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
    'method' => 'POST',
    'content' => http_build_query([
        'grant_type' => "authorization_code",
        'client_id' => '809720505134',
        'client_secret' => '085dee158238b3b3b5edfadbbede4e6316112c356c4c575410',
        'redirect_uri' => 'http://127.0.0.1:3000',
        'code' => $code,
    ]),
],
]);

if (($result = @file_get_contents($url, false, $context)) === false) {
    $error = error_get_last();
    echo json_encode(false);
} else {
    $decoded = json_decode($result);
    $access_token = $decoded->access_token;
    echo json_encode($access_token);
}