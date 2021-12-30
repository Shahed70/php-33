<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: Application/json');
$listId = '438ddc7eae';
// $dataCenter = 'us7';




$params = file_get_contents('php://input');
$decoded = json_decode($params);
$code = $decoded->code;
$name = $decoded->name;
$email = $decoded->email;

$arr = [
    'email_address' => $email,
    'status' => 'subscribed',
    "merge_fields" => [
        "FNAME" => $name,
    ]
];

$url = "https://us7.api.mailchimp.com/3.0/lists/$listId/members/";
$context = stream_context_create([
    'http' => [
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($arr),
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


echo gettype($params);

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