<?php

use Inhere\Validate\FV;
use Inhere\Validate\Locale\LocaleZhCN;


LocaleZhCN::register();

$regexp     = [
    'username' => "/^[a-zA-Z]\w{3,15}$/",
    'password' => "/^\S*(?=\S{8,})(?=\S*\d)(?=\S*[a-zA-Z])(?=\S*[`.~!@#$%^&*? ])\S*$/",
];
$filter     = ['trim', 'lowercase'];
$rules      = [
    ['username', 'required|string:3,15'],
    ['username', 'regexp', "{$regexp['username']}", 'msg' => '{attr}格式不符合规则'],

    ['password', 'required|string:8,20'],
    ['password', 'regexp', "{$regexp['password']}", 'msg' => '{attr}格式不符合规则'],

    ['rememberMe', 'required|boolean', 'msg' => '{attr}格式不符合规则'],
];
$translates = [
    'username'   => '用户名',
    'password'   => '密码',
    'rememberMe' => '记住我',
];

$safePost = FV::check($_POST, $rules, $translates);

if ($safePost->isFail()) {
    exit(json_encode($safePost->getErrors(), JSON_UNESCAPED_UNICODE));
}

$safePostData = $safePost->getSafeData();
