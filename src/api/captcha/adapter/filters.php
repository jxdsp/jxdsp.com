<?php

use Inhere\Validate\FV;
use Inhere\Validate\Locale\LocaleZhCN;

LocaleZhCN::register();

$filter     = ['trim', 'lowercase'];
$regexp     = ['captchaCode' => '/^[a-z0-9]{4}$/'];
$rules      = [
    ['captchaCode', 'required|string', 'filter' => $filter],
    ['captchaCode', 'fixedSize:4'],
    ['captchaCode', 'regexp', "{$regexp['captchaCode']}", 'msg' => '{attr}格式不符合规则'],
];
$translates = [
    'captchaCode' => '验证码',
];

$safePost = FV::check($_POST, $rules, $translates);

if ($safePost->isFail()) {
    exit(json_encode($safePost->getErrors(), JSON_UNESCAPED_UNICODE));
}

$safeCaptchaCode = $safePost->getSafeData()['captchaCode'];
