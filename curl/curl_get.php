<?php

global $RequestURL, $SendData;

use jxdsp\Curl\Method\Get\CurlGet;

$CurlResult = new CurlGet($RequestURL, $SendData);

if ($CurlResult->getErrorResult() === false) {
    $CurlResult = $CurlResult->getCurlResponse();
} else {
    $CurlResult = $CurlResult->getErrorResult();
}
