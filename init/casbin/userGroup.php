<?php

$base = ['root', 'admin', 'donate', 'customize', 'vip', 'general', 'init', 'lock', 'delete'];

$vipSequenceLength = 5;
$sequence          = [];

// 资源
$obj = [
    'video' => ['s', 'm', 'l'],
];

// 动作
$act = [
    'video' => ['parse'],
];


$userPermission = [
    'root'      => [
        'video' => [true, true, true]
    ],
    'admin'     => [
        'video' => [true, true, true]
    ],
    'donate'    => [
        'video' => [true, true, true]
    ],
    'customize' => [
        'video' => [true, true, true]
    ],
    'vip'       => [
        'video' => [true, true, true]
    ],
    'general'   => [
        'video' => [true, true, true]
    ],
    'init'      => [
        'video' => [false, false, false]
    ],
    'lock'      => [
        'video' => [false, false, false]
    ],
    'delete'    => [
        'video' => [false, false, false]
    ],
];
