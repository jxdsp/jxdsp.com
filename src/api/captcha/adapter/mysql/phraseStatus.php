<?php

use jxdsp\Mysql\Mysql;

global $code;

$upData = [
    'status' => '0'
];

$xxx = new Mysql();

$xxx->Where('code', $code);

$tableName = 'jxdsp.captcha';

$executeStatus = $xxx->update($tableName, $upData);

//if ($xxx->getLastErrno()) {
if (!$executeStatus) {
    $result = [
        'code' => -1,
        'msg'  => '设置验证码失效失败',
    ];
    exit(json_encode($result, JSON_UNESCAPED_UNICODE));
}
