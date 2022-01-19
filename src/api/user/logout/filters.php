<?php

use Inhere\Validate\FV;
use Inhere\Validate\Locale\LocaleZhCN;


LocaleZhCN::register();

$filter     = ['trim', 'lowercase'];
$rules      = [
    ['token', 'required|string', 'msg' => '{attr} 格式错误'],
];
$translates = [
    'token'   => '令牌',
];

$safePost = FV::check($_POST, $rules, $translates);

if ($safePost->isFail()) {
    exit(json_encode($safePost->getErrors(), JSON_UNESCAPED_UNICODE));
}

$safePostData = $safePost->getSafeData();
