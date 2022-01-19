<?php

use jxdsp\Curl\Method\Post\CurlPost;

require_once dirname(__FILE__) . '/requestData.php';
global $RequestURL, $SendData;

$curlGet = new CurlPost($RequestURL, $SendData);

echo $curlGet->getErrorResult();
echo $curlGet->getCurlResponse();
//echo json_encode($curlGet->getCurlResponse());
