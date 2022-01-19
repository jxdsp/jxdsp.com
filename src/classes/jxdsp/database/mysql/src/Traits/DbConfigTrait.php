<?php

namespace jxdsp\Mysql\Traits;


use jxdsp\Env\LoadEnv;

trait DbConfigTrait
{
    public array $dbConfig;

    public function setDbConfig(): void
    {
        new LoadEnv('env/.env');

        $this->dbConfig = [
            'host'     => $_ENV['DB_HOST'],
            'username' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD'],
            'db'       => $_ENV['DB_DATABASE_NAME'],
            'port'     => $_ENV['DB_PORT'],
            'charset'  => $_ENV['DB_CHARSET'],
            'socket'   => null,
        ];
    }

    /**
     * @return array
     */
    public function getDbConfig(): array
    {
        return $this->dbConfig;
    }

}
