<?php
require_once dirname(__DIR__, 4) . "/vendor/autoload.php";

use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;

$PhraseBuilderLength = mt_rand(4, 5);
$PhraseBuilderCharset = 'abcdefghijklmnpqrstuvwxyz123456789';
$phraseBuilder = new PhraseBuilder($PhraseBuilderLength, $PhraseBuilderCharset);
$captcha = new CaptchaBuilder(null, $phraseBuilder);

$captcha
    ->setBackgroundImages([])
    ->setBackgroundColor(233, 236, 239)
    ->setIgnoreAllEffects(true)
    ->build(110, 36);
