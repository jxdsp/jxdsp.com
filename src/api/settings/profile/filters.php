<?php

use Inhere\Validate\FieldValidation;
use Inhere\Validate\Locale\LocaleZhCN;

require_once dirname(__DIR__, 4) . '/vendor/autoload.php';

LocaleZhCN::register();

$regexp        = [
    '' => "//",
];
$MultipleRules = [
    ['hash', 'required'],
];
$translates    = [
    '' => '',
];

$safePost = FieldValidation::check($_POST, $MultipleRules, $translates);

if ($safePost->isFail()) {
    exit(json_encode($safePost->getErrors(), JSON_UNESCAPED_UNICODE));
}

$safePostData = $safePost->getSafeData();
