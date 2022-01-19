<?php

namespace jxdsp\Curl\Method\Get;

use jxdsp\Curl\Curl;

class CurlGet extends Curl
{
    public function __construct(string $RequestURL = '', array $SendData = [])
    {
        parent::__construct();

        self::setReferer($_SERVER['HTTP_REFERER'] ?? '-');
        self::setCurlReferer(parent::getCurl(), self::getReferer());
        self::setUserAgent($_SERVER['HTTP_USER_AGENT']);
        self::setCurlUserAgent(parent::getCurl(), self::getUserAgent());

        parent::get($RequestURL, $SendData);
        parent::setErrorResult(parent::getCurl()->error);
        parent::setCurlResponse(parent::getCurl()->response);
    }
}
