<?php

use jxdsp\Captcha\NumberCaptcha;

$length = 4;
$captcha = new NumberCaptcha($length);
$captcha
    ->setBackgroundColor(255, 255, 255)
    ->setIgnoreAllEffects(true)
    ->build(110, 36)
    ->output(20);
