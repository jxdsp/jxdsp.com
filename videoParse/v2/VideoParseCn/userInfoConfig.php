<?php
require_once dirname(__DIR__, 3) . '/config/env.php';

$APiUrl = $_ENV['VideoParseCn_User_getInfo'];
$AppId  = $_ENV['VideoParseCn_AppId'];

require_once dirname(__FILE__) . '/user/getInfo.php';
