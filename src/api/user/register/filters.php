<?php

use Inhere\Validate\FV;
use Inhere\Validate\Locale\LocaleZhCN;

LocaleZhCN::register();

$regexp     = [
    'username'   => "/^[a-zA-Z]\w{3,15}$/",
    'password'   => "/^\S*(?=\S{8,})(?=\S*\d)(?=\S*[a-zA-Z])(?=\S*[`.~!@#$%^&*? ])\S*$/",
    'rePassword' => "/^\S*(?=\S{8,})(?=\S*\d)(?=\S*[a-zA-Z])(?=\S*[`.~!@#$%^&*? ])\S*$/",
    'phone'      => "/^(?:(?:\+|00)86)?1[3-9]\d{9}$/",
];
$filter     = ['trim', 'lowercase'];
$rules      = [
    ['userTermsOfService', 'required|accepted', 'filter' => $filter],
    ['privacyStatement', 'required|accepted', 'filter' => $filter],

    ['username', 'required|string:3,15', 'filter' => $filter],
    ['username', 'regexp', "{$regexp['username']}", 'msg' => '{attr}格式不符合规则'],

    ['phone', 'requiredWithoutAll', ['email']],
    ['phone', "fixedSize:11", 'filter' => $filter],
    ['phone', 'regexp', "{$regexp['phone']}", 'msg' => '{attr}格式不符合规则'],

    ['email', 'requiredWithoutAll', ['phone']],
    ['email', "string:6,50", 'filter' => $filter],
    ['email', 'email', 'msg' => '{attr}格式不符合规则'],

    ['password', 'required|string:8,20', 'filter' => $filter],
    ['password', 'regexp', "{$regexp['password']}", 'msg' => '{attr}格式不符合规则'],

    ['rePassword', 'required|string:8,20', 'filter' => $filter],
    ['rePassword', 'regexp', "{$regexp['rePassword']}", 'msg' => '{attr}格式不符合规则'],

    ['rePassword', 'eqField:password', 'msg' => '两次密码不一致'],
];
$translates = [
    'username'           => '用户名',
    'email'              => '电子邮箱',
    'phone'              => '手机号',
    'password'           => '密码',
    'rePassword'         => '确认密码',
    'userTermsOfService' => '用户服务条款',
    'privacyStatement'   => '用户隐私声明',
];

$safePost = FV::check($_POST, $rules, $translates);

if ($safePost->isFail()) {
    exit(json_encode($safePost->getErrors(), JSON_UNESCAPED_UNICODE));
}

$safePostData = $safePost->getSafeData();
