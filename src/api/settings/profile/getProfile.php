<?php

use jxdsp\Mysql\Mysql;

$uid              = '';
$result_user      = ['username'];
$result_user_info = ['email', 'nickname', 'phone_prefix', 'phone'];

$xxx = new Mysql();
$xxx->where('uid', $uid);

$lastUser     = $xxx->getOne('jxdsp.user', $result_user);
$lastUserInfo = $xxx->getOne('jxdsp.user_info', $result_user_info);

$result = [
    'username'     => $lastUser['username'],
    'email'        => $lastUserInfo['email'],
    'nickname'     => $lastUserInfo['nickname'],
    'phone_prefix' => $lastUserInfo['phone_prefix'],
    'phone'        => $lastUserInfo['phone'],
];
