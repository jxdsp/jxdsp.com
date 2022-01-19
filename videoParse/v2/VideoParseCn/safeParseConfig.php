<?php
require_once dirname(__DIR__, 3) . '/config/env.php';

$APiUrl    = $_ENV['VideoParseCn_Safe_parse'];
$AppId     = $_ENV['VideoParseCn_AppId'];
$AppSecret = $_ENV['VideoParseCn_AppSecret'];

//require_once dirname(__FILE__) . '/customParse/parse.php';
require_once dirname(__FILE__) . '/safeParse/parse.php';
