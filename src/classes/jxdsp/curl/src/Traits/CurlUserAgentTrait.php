<?php


namespace jxdsp\Curl\Traits;


use Curl\Curl;

trait CurlUserAgentTrait
{
    /**
     * @param Curl $curlVariable
     * @param string $userAgent
     * @link https://www.php.net/manual/en/function.curl-setopt.php
     */
    public function setCurlUserAgent(Curl $curlVariable, string $userAgent)
    {
        $curlVariable->setUserAgent($userAgent);
    }
}
