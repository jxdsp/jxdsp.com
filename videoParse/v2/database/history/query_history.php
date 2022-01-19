<?php

use jxdsp\Mysql\Mysql;

require_once dirname(__DIR__, 4) . "/config/init_functions.php";

global $result;
global $link;
global $videoType;

$ip   = getIp();
$type = $videoType;
$uid  = '0';
$hash = hash('md5', $ip . '-' . $link);

$columns = ["id", "uid", "ip", 'historyResult', 'update_time'];

$tableName = 'jxdsp.history_' . $videoType;

$xxx = new Mysql();

$xxx->where("type", $type);
$xxx->where("historyHash", $hash);

$query_result = $xxx->get($tableName, null, $columns);

require_once dirname(__FILE__) . '/query_historyResult.php';
