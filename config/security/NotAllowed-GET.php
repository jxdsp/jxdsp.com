<?php
if ($_GET) {
    $result = [
        'code' => '-2',
        'msg'  => '动态访问保护',
    ];
    exit(json_encode($result, JSON_UNESCAPED_UNICODE));
}
