<?php

use jxdsp\Curl\Method\Get\CurlGet;

require_once dirname(__FILE__) . '/requestData.php';
global $RequestURL;

$curlGet = new CurlGet($RequestURL);

echo $curlGet->getErrorResult();
echo $curlGet->getCurlResponse();
//echo json_encode($curlGet->getCurlResponse());
