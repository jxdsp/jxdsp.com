<?php

use jxdsp\Mysql\Mysql;

require_once dirname(__DIR__, 5) . "/config/init_functions.php";

global $Phrase;

$code        = mb_strtolower($Phrase);
$status      = '1';
$ip          = getIp();
$error_times = 0;

$DateTime_5 = new DateTime('+5 min');
$expire     = $DateTime_5->format('Y-m-d H:i:s.u');

$newSafeData = [
    "code"        => (string)$code,
    "status"      => (string)$status,
    "ip"          => (string)$ip,
    "error_times" => (int)$error_times,
    "expire"      => (string)$expire,
];

$tableName = 'jxdsp.captcha';

$xxx = new Mysql();

$aaa = $xxx->insert($tableName, $newSafeData);

if ($xxx->getLastErrno()) {
    $result = [
        'code' => -1,
        'msg'  => '新用户的信息添加失败',
    ];
    exit(json_encode($result, JSON_UNESCAPED_UNICODE));
}
