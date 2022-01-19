<?php
require_once dirname(__DIR__, 3) . '/config/security/AccessControlAllow.php';

$result = [
    'code' => -9999,
    'msg'  => 'v1停用',
];

exit(json_encode($result, JSON_UNESCAPED_UNICODE));
