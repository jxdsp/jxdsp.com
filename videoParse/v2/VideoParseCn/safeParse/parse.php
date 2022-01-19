<?php

function sign($appId, $appSecret, $url, $timestamp)
{
    $param = [
        'appid'     => $appId,
        'url'       => $url,
        'timestamp' => $timestamp,
    ];
    ksort($param);
    return substr(md5(substr(md5(urldecode(http_build_query($param))), 6, 18) . $appSecret), 10, 16);
}

global $link, $APiUrl, $AppId, $AppSecret, $result;

$timestamp = time();
$sign      = sign($AppId, $AppSecret, $link, $timestamp);

$param = [
    'appid'     => $AppId,
    'url'       => $link,
    'timestamp' => $timestamp,
    'sign'      => $sign,
];

$SendData   = $param;
$RequestURL = $APiUrl;
