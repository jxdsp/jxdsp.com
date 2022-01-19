<?php

$http_origin = $_SERVER['HTTP_ORIGIN'] ?? '';

$allow_origin = [
    'https://www.jxdsp.com',
    'http://www.jxdsp-test.com',
];
if (in_array($http_origin, $allow_origin)) {
    header('Access-Control-Allow-Origin:' . $http_origin);
    header('Access-Control-Allow-Methods:POST,GET');
    header('Access-Control-Allow-Headers:x-requested-with,content-type');
//    header('X-Content-Type-Options: nosniff');
} else {
    $result = [
        'code' => '-3',
        'msg'  => 'Origin保护',
    ];
    exit(json_encode($result, JSON_UNESCAPED_UNICODE));
}
