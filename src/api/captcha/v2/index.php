<?php
require_once dirname(__DIR__, 4) . '/vendor/autoload.php';

//require_once dirname(__FILE__) . '/getNumberCaptcha.php';
require_once dirname(__FILE__) . '/getLettersCaptcha.php';
global $captcha;

$Phrase = $captcha->getPhrase();
require_once dirname(__DIR__) . '/adapter/mysql/savePhrase.php';
