<?php
if (empty($_POST)) {
    $result = [
        'code' => '-2',
        'msg'  => '访问保护',
    ];
    exit(json_encode($result, JSON_UNESCAPED_UNICODE));
}
