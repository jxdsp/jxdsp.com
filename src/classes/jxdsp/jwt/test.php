<?php

require_once dirname(__DIR__, 4) . '/vendor/autoload.php';

$jwt = new \Jose\Easy\JWT();

$header = $jwt->header;
$claims = $jwt->claims;


$header->set('aaaa', 'a111111');

$claims->set('ccccc', 'cccccc222');


//echo json_encode($jwt);

$token=\Jose\Easy\Load::jws('');
