<?php

namespace jxdsp\Curl;

use Curl\Curl as CurlAlias;
use jxdsp\Curl\Interfaces\CurlInterface;
use jxdsp\Curl\Traits\CurlOptsTrait;
use jxdsp\Curl\Traits\CurlRefererTrait;
use jxdsp\Curl\Traits\CurlUserAgentTrait;
use jxdsp\Curl\Traits\RefererTrait;
use jxdsp\Curl\Traits\UserAgentTrait;

abstract class Curl implements CurlInterface
{
    use CurlUserAgentTrait, UserAgentTrait;
    use CurlRefererTrait, RefererTrait;
    use CurlOptsTrait;

    /**
     * @var CurlAlias
     */
    private CurlAlias $Curl;

    private $CurlResponse;

    private $ErrorResult;

    public function __construct(string $RequestURL = '', array $SendData = [], string $RequestMethod = null, bool $follow_303_with_post = false)
    {
        self::setCurl();
//        $this->Curl->setCookie('key', 'value');

        if (isset($RequestMethod) && ($RequestMethod === 'get' || $RequestMethod === 'post')) {
            // @link https://www.php.net/manual/en/function.curl-setopt.php
            $this->Curl->setUserAgent($_SERVER['HTTP_USER_AGENT']);
            $this->Curl->setReferrer($_SERVER['HTTP_REFERER'] ?? '-');
//            $this->Curl->setHeader('X-Requested-With', 'XMLHttpRequest');

            $this->Curl->setOpt(CURLOPT_SSL_VERIFYHOST, false);
            $this->Curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
//            $this->Curl->setOpt(CURLOPT_HEADER, false);

            $this->Curl->setOpt(CURLOPT_TIMEOUT_MS, 5000);//设置cURL允许执行的最长毫秒数;
            $this->Curl->setOpt(CURLOPT_DNS_CACHE_TIMEOUT, 1200);//设置在内存中保存DNS信息的时间，默认为120秒。

            $this->Curl->setOpt(CURLOPT_AUTOREFERER, true);//TRUE 时将根据 Location: 重定向时，自动设置 header 中的Referer:信息。

            $this->Curl->setOpt(CURLOPT_FOLLOWLOCATION, true);//TRUE 时将会根据服务器返回 HTTP 头中的 "Location: " 重定向。（注意：这是递归的，"Location: " 发送几次就重定向几次，除非设置了 CURLOPT_MAXREDIRS，限制最大重定向次数。）。
            $this->Curl->setOpt(CURLOPT_MAXREDIRS, 2);//指定最多的 HTTP 重定向次数，这个选项是和CURLOPT_FOLLOWLOCATION一起使用的。

            if ($RequestMethod === 'get') {
                self::get($RequestURL, $SendData);
            } elseif ($RequestMethod === 'post') {
                self::post($RequestURL, $SendData, $follow_303_with_post);
            }

            self::setErrorResult($this->Curl->error);
            self::setCurlResponse($this->Curl->response);
        }

    }

    /**
     * @param string $URL
     * @param array $Data
     */
    public function get(string $URL, array $Data = [])
    {
        $this->Curl->get($URL, $Data);
    }

    /**
     * @param string $URL
     * @param array $Data
     * @param bool $follow_303_with_post
     */
    public function post(string $URL, array $Data = [], bool $follow_303_with_post = false)
    {
        $this->Curl->post($URL, $Data, $follow_303_with_post);
    }

    public function __destruct()
    {
        self::close();
    }

    /**
     * @return CurlAlias
     */
    public function getCurl(): CurlAlias
    {
        return $this->Curl;
    }

    public function setCurl(): void
    {
        $this->Curl = new CurlAlias();
    }

    /**
     * @param mixed $CurlResponse
     */
    public function setCurlResponse($CurlResponse): void
    {
        $this->CurlResponse = $CurlResponse;
    }

    /**
     * @return mixed
     */
    public function getCurlResponse()
    {
        return $this->CurlResponse;
    }

    /**
     * @param mixed $errorResult
     */
    public function setErrorResult($errorResult): void
    {
        if ($errorResult) {
            $this->ErrorResult = [
                'code' => $this->Curl->errorCode ?? 0,
                'msg'  => $this->Curl->errorMessage ?? 'ok',
            ];
            $this->ErrorResult = json_encode($this->ErrorResult, JSON_UNESCAPED_UNICODE);
        } else {
            $this->ErrorResult = false;
        }
    }

    /**
     * @return mixed
     */
    public function getErrorResult()
    {
        return $this->ErrorResult;
    }

    public function close()
    {
        $this->Curl->close();
    }
}
