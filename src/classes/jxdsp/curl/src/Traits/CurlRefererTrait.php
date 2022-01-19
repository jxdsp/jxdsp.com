<?php


namespace jxdsp\Curl\Traits;


use Curl\Curl;

trait CurlRefererTrait
{
    /**
     * @param Curl $curlVariable
     * @param string $referer
     * @link https://www.php.net/manual/en/function.curl-setopt.php
     */
    public function setCurlReferer(Curl $curlVariable, string $referer)
    {
        $curlVariable->setReferrer($referer);
    }
}
