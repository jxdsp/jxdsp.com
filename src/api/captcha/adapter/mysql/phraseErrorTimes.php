<?php

use jxdsp\Mysql\Mysql;

global $id;
global $currentErrorTimes;

$newErrorCount = $currentErrorTimes + 1;

$upData = [
    'error_times' => $newErrorCount
];

$xxx = new Mysql();

$xxx->Where('id', $id);

$tableName = 'jxdsp.captcha';

$executeStatus = $xxx->update($tableName, $upData);

//if ($xxx->getLastErrno()) {
if (!$executeStatus) {
    $result = [
        'code' => -1,
        'msg'  => '设置验证码错误次数失败',
    ];
    exit(json_encode($result, JSON_UNESCAPED_UNICODE));
}
