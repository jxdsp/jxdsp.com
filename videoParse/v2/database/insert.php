<?php

use jxdsp\Mysql\Mysql;

require_once dirname(__DIR__, 3) . "/config/init_functions.php";

global $result;
global $link;
global $videoType;

$user_agent = get_user_agent();
$ip         = getIp();
$type       = $videoType;
$uid        = '0';
$hash       = hash('md5', $ip . '-' . $link);

$newSafeData = [
    "type"          => (string)$type,
    "historyHash"   => (string)$hash,
    "historyResult" => (string)json_encode($result),
    "uid"           => (int)$uid,
    "ip"            => (string)$ip,
    "user_agent"    => (string)$user_agent,
];

$tableName = 'jxdsp.history_' . $videoType;

$xxx = new Mysql();

$aaa = $xxx->insert($tableName, $newSafeData);

if ($xxx->getLastErrno()) {
    $result = [
        'code' => -1,
        'msg'  => '历史数据操作失败',
    ];
    exit(json_encode($result, JSON_UNESCAPED_UNICODE));
}
