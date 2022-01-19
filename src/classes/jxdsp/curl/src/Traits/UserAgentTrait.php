<?php


namespace jxdsp\Curl\Traits;


trait UserAgentTrait
{
    public string $UserAgent;

    public function setUserAgent(string $userAgent)
    {
        $this->UserAgent = $userAgent;
    }

    public function getUserAgent(): string
    {
        return $this->UserAgent;
    }
}
