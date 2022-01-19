<?php
require_once dirname(__DIR__, 3) . '/config/env.php';

$APiUrl    = $_ENV['ParseVideoCom_Normal_Parse'];
$AppId     = $_ENV['ParseVideoCom_AppId'];
$AppSecret = $_ENV['ParseVideoCom_AppSecret'];

require_once dirname(__FILE__) . '/normalParse/parse.php';
//require_once dirname(__FILE__) . '/signParse/parse.php';
