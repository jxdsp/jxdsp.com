<?php
global $ip, $query_result;
global $token;

$todayDateTime  = new DateTime('today');
$todayTimestamp = $todayDateTime->format('Y-m-d H:i:s.u');

$freeTimes = 0;

foreach ($query_result as $index => $value) {
    $update_time = $value['update_time'];
    if (strtotime($update_time) >= strtotime($todayTimestamp)) {
        if ($ip === $value['ip']) ++$freeTimes;
    }
}

$maxParseTimes = 1;
if ($token) {
    $maxParseTimes = 3;
}

if ($freeTimes >= $maxParseTimes) {
    $result = [
        'msg' => '今日免费的次数' . $maxParseTimes . '次，已经用完。',
    ];
    exit(json_encode($result, JSON_UNESCAPED_UNICODE));
}
