<?php

use Curl\Curl;

require_once dirname(__FILE__) . '/requestData.php';
global $RequestURL;

$curl = new Curl();

$curl->get($RequestURL);

echo $curl->getErrorMessage();
echo $curl->getErrorCode();
echo $curl->getResponse();
//echo json_encode($curlGet->getResponse());
