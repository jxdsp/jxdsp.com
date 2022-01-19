<?php

global $RequestURL, $SendData;

use jxdsp\Curl\Method\Post\CurlPost;

$CurlResult = new CurlPost($RequestURL, $SendData);

if ($CurlResult->getErrorResult() === false) {
    $CurlResult = $CurlResult->getCurlResponse();
} else {
    $CurlResult = $CurlResult->getErrorResult();
}
