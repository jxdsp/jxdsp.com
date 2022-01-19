<?php

namespace jxdsp\Env;

use Dotenv\Dotenv;

class LoadEnv
{

    public function __construct(string $envFileName = 'env/.env')
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 5), $envFileName);
        $dotenv->load();
    }
}
