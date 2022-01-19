<?php

use jxdsp\Mysql\Mysql;

require_once dirname(__DIR__, 5) . '/config/init_functions.php';

$ip = getIp();

$upData = [
    'status' => '0'
];

$xxx = new Mysql();

$xxx->Where('ip', $ip);

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
