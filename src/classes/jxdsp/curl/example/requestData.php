<?php

// Available in Composer package
$composerVendorDir = dirname(dirname(dirname(__DIR__)));
$baseDir = dirname($composerVendorDir);
require_once $baseDir . '/vendor/autoload.php';

$RequestURL = 'https://example.org';
$SendData = [
    'test' => '$test',
];
