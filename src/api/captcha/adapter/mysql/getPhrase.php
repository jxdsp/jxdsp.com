<?php

use jxdsp\Mysql\Mysql;

require_once dirname(__DIR__, 5) . '/config/init_functions.php';

$ip      = getIp();
$status  = '1';
$columns = ['id', 'code', 'error_times', 'expire'];

$xxx = new Mysql();
$xxx->Where('ip', $ip);
$xxx->Where('status', $status);
$xxx->orderBy('id', 'DESC',);

$tableName = 'jxdsp.captcha';

$lastCaptchaColumns = $xxx->getOne($tableName, $columns);

if ($xxx->getLastErrno()) {
    $result = [
        'code' => -1,
        'msg'  => '获取字段失败',
    ];
    exit(json_encode($result, JSON_UNESCAPED_UNICODE));
}
