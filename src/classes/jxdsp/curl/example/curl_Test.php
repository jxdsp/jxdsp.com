<?php

use jxdsp\Curl\Curl as CurlAlias;

require_once dirname(__FILE__) . '/requestData.php';
global $RequestURL, $SendData;

class Curl extends CurlAlias
{
    public function __construct(string $RequestURL = '', array $SendData = array(), string $RequestMethod = null)
    {
        parent::__construct($RequestURL, $SendData, $RequestMethod);
    }
}

$curlGet = new Curl($RequestURL, $SendData, 'get');
//$curlGet = new Curl($RequestURL, $SendData, 'post');

echo $curlGet->getErrorResult();
echo $curlGet->getCurlResponse();
//echo json_encode($curlGet->getCurlResponse());
