<?php
global $query_result;

$cacheBaseTimestamp = new DateTime('-10 min');
$cacheBaseTimestamp_format = $cacheBaseTimestamp->format('Y-m-d H:i:s.u');

$databaseCache = '';
foreach ($query_result as $index => $value) {
    $update_time = $value['update_time'];
    if (strtotime($update_time) >= strtotime($cacheBaseTimestamp_format)) {
        $databaseCache = $value['historyResult'];
        $cacheBaseTimestamp_format = $update_time;
    }
}

if ($databaseCache != '') {
    exit($databaseCache);
}
