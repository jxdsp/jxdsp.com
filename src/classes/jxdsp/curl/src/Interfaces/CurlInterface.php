<?php

namespace jxdsp\Curl\Interfaces;

interface CurlInterface
{
    public function __construct();

    public function close();

    public function __destruct();
}
