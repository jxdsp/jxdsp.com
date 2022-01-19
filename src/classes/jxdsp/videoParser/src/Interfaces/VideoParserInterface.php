<?php


namespace jxdsp\VideoParser\Interfaces;


interface VideoParserInterface
{
    public function __construct();

    public function parse();

    public function __destruct();
}
