<?php

require_once dirname(__DIR__, 4) . '/vendor/autoload.php';

// 过滤
require_once dirname(__FILE__) . '/filters.php';
global $safePostData;


$xxx = new jxdsp\Member\Member();

$token = $safePostData['token'];// todo:从这里去做获取用户名的逻辑，并且先判断token的有效性

$uid = $xxx->getUid('admin');


// 验证


// 记录
$login = new jxdsp\Member\History();
$login->logoutSuccess($uid);

$result[] = [
    'code' => 0,
    'msg'  => '退出成功',
];
exit(json_encode($result, JSON_UNESCAPED_UNICODE));
