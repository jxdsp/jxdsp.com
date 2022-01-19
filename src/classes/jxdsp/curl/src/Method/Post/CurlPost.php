<?php

namespace jxdsp\Curl\Method\Post;

use jxdsp\Curl\Curl;

class CurlPost extends Curl
{
    public function __construct(string $RequestURL = '', array $SendData = [], bool $follow_303_with_post = false)
    {
        parent::__construct();

        self::setReferer($_SERVER['HTTP_REFERER'] ?? '-');
        self::setCurlReferer(parent::getCurl(), self::getReferer());
        self::setUserAgent($_SERVER['HTTP_USER_AGENT']);
        self::setCurlUserAgent(parent::getCurl(), self::getUserAgent());
        parent::post($RequestURL, $SendData, $follow_303_with_post);
        parent::setErrorResult(parent::getCurl()->error);
        parent::setCurlResponse(parent::getCurl()->response);
    }
}
