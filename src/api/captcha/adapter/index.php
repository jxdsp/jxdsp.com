<?php

require_once dirname(__FILE__) . '/filters.php';
global $safeCaptchaCode;
$userCaptchaPhrase = mb_strtolower($safeCaptchaCode);


require_once dirname(__FILE__) . '/mysql/getPhrase.php';
global $lastCaptchaColumns;

if (!$lastCaptchaColumns) {
    // 记录验证码错误日志
    $history = new jxdsp\Member\History();
    $history->captchaNotExist();

    $result[] = [
        'code'   => 0,
        'msg'    => '请先获取验证码',
        'region' => 'captchaCode',
    ];
    exit(json_encode($result, JSON_UNESCAPED_UNICODE));
}

$id                 = $lastCaptchaColumns['id'];
$expireTime         = $lastCaptchaColumns['expire'];
$code               = $lastCaptchaColumns['code'];
$currentErrorTimes  = $lastCaptchaColumns['error_times'];
$maxAllowErrorTimes = 3;


if ($currentErrorTimes >= $maxAllowErrorTimes) {
    // 当验证次数超过限制时，将当前IP下所有验证码设置为失效
    require_once dirname(__FILE__) . '/mysql/phraseStatusAllByIp.php';
    $result[] = [
        'code'   => 0,
        'msg'    => '请重新获取验证码',
        'region' => 'captchaCode',
    ];
    exit(json_encode($result, JSON_UNESCAPED_UNICODE));
}

if (time() > (int)strtotime($expireTime)) {
    // 记录验证码超时日志
    $history = new jxdsp\Member\History();
    $history->captchaTimeout();

    // 当验证码超时，将当前验证码设置为失效
    require_once dirname(__FILE__) . '/mysql/phraseStatus.php';
    $result[] = [
        'code'   => 0,
        'msg'    => '验证码超时，请重新获取验证码',
        'region' => 'captchaCode',
    ];
    exit(json_encode($result, JSON_UNESCAPED_UNICODE));
}

if ($userCaptchaPhrase !== $code) {
    // 记录验证码错误日志
    $history = new jxdsp\Member\History();
    $history->captchaWrong();

    // 验证码错误时，当前错误次数增加
    require_once dirname(__FILE__) . '/mysql/phraseErrorTimes.php';
    $result[] = [
        'code'   => 0,
        'msg'    => '验证码错误',
        'region' => 'captchaCode',
    ];
    exit(json_encode($result, JSON_UNESCAPED_UNICODE));
}

// 验证码正确后设置单个验证码失效
require_once dirname(__FILE__) . '/mysql/phraseStatus.php';
