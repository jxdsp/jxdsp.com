<?php

global $link, $APiUrl, $AppId, $AppSecret;

$param = [
    'appid'     => $AppId,
    'appsecret' => $AppSecret,
    'url'       => $link,
];

$SendData = $param;
$RequestURL = $APiUrl;
