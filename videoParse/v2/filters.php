<?php

use Inhere\Validate\Locale\LocaleZhCN;

LocaleZhCN::register();

$filter        = ['trim', 'lowercase'];
$regexp        = [
    'link'  => "//",
    'video' => "//",
];
$MultipleRules = [
    ['link', 'required|url', 'filter' => $filter],

    ['video', 'required|enum:s,m,l'],
    ['video', 'fixedSize:1'],

    ['token', 'string', 'filter' => ['trim']],
];
$translates    = [
    'link'  => '链接',
    'video' => '视频类型',
];

$safePost = Inhere\Validate\FV::check($_POST, $MultipleRules, $translates);

if ($safePost->isFail()) {
    exit(json_encode($safePost->getErrors(), JSON_UNESCAPED_UNICODE));
}

$link      = $safePost->getSafeData()['link'];
$videoType = $safePost->getSafeData()['video'];
$token     = $safePost->getSafeData()['token'] ?? '';
