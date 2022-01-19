<?php

use jxdsp\Captcha\LettersCaptcha;

$length = 4;
$captcha = new LettersCaptcha($length);
$captcha
    ->setBackgroundColor(255, 255, 255)
    ->setIgnoreAllEffects(true)
    ->build(110, 36)
    ->output(20);
