<?php

require_once dirname(__DIR__, 4) . '/vendor/autoload.php';

// 验证码
require_once dirname(__DIR__, 2) . '/captcha/adapter/index.php';

// 用户表单
require_once dirname(__FILE__) . '/filters.php';
global $safePostData;


$xxx = new jxdsp\Member\Member();


$uid      = $xxx->createUid();
$username = $safePostData['username'];
$password = $xxx->hashPassword($safePostData['password']);


// 用户核心
$newUser = [$uid, $username, $password];
$xxx->setUserCore(...$newUser);

// 用户信息
$email        = $safePostData['email'] ?? null;
$phone_prefix = $safePostData['phone_prefix'] ?? null;
$phone        = $safePostData['phone'] ?? null;
$nickname     = $safePostData['nickname'] ?? '新昵称' . random_int(99, 99999);

$newUserInfo = [$uid, $phone_prefix, $phone, $email, $nickname];
$xxx->setUserInfo(...$newUserInfo);


// 用户权限
$newUserCasbin = [$uid, 'init', 0, 0];
$xxx->setUserCasbin(...$newUserCasbin);

// 用户核心权限
$newCasbinEn = new jxdsp\Casbin\CasbinEnforcer();
$newCasbinEn->addGroupingPolicy($uid, 'init');

// 返回结果
$result = [
    'code' => 0,
    'msg'  => '注册成功',
];
exit(json_encode($result, JSON_UNESCAPED_UNICODE));
