<?php

require_once dirname(__DIR__, 4) . '/vendor/autoload.php';

// 验证码
require_once dirname(__DIR__, 2) . '/captcha/adapter/index.php';

// 过滤
require_once dirname(__FILE__) . '/filters.php';
global $safePostData;


$xxx = new jxdsp\Member\Member();


$username = $safePostData['username'];

if (!$xxx->hasUsername($username)) {
    $history = new jxdsp\Member\History();
    $history->usernameWrong();

    $errorMsg[] = [
        'msg' => '用户名不存在'
    ];
    exit(json_encode($errorMsg, JSON_UNESCAPED_UNICODE));
}

$uid      = $xxx->getUid($username);
$password = $safePostData['password'];

// 验证密码
if (!$xxx->verifyPassword($password, $uid)) {
    $history = new jxdsp\Member\History();
    $history->passwordWrong($uid);

    $errorMsg[] = [
        'msg' => '密码不正确',
    ];
    exit(json_encode($errorMsg, JSON_UNESCAPED_UNICODE));
}


// 记录
$history = new jxdsp\Member\History();
$history->loginSuccess($uid);


// token
$jwt = new jxdsp\Jwt\JWK();

$token = jxdsp\Jwt\Easy\Build::set_jws($xxx->getUsername($uid));


$tokenData['token']    = $token;
$tokenData['login']    = true;
$tokenData['nickname'] = $xxx->getNickname($uid);


exit(json_encode($tokenData, JSON_UNESCAPED_UNICODE));
