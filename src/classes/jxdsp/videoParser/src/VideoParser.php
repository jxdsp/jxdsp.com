<?php


namespace jxdsp\VideoParser;


use jxdsp\VideoParser\Interfaces\VideoParserInterface;
use jxdsp\VideoParser\Traits\getENV;

abstract class VideoParser implements VideoParserInterface
{
    use getENV;

    private string $appId;

    private string $appSecret;

    private string $APiUrl;

    private int $timestamp;

    public function __construct()
    {
    }

    public function parse()
    {
        // TODO: Implement parse() method.
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }
}
