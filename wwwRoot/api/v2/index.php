<?php

require_once dirname(__DIR__, 3) . '/config/security/AccessControlAllow.php';

require_once dirname(__DIR__, 3) . '/videoParse/v2/index.php';
global $result;

exit(json_encode($result, JSON_UNESCAPED_UNICODE));
