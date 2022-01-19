<?php

namespace jxdsp\Casbin\Traits;


use jxdsp\Env\LoadEnv;

trait DbConfigTrait
{
    public array $dbConfig;

    public function setDbConfig()
    {
        new LoadEnv('env/.env');

        $this->dbConfig = [
            'type'     => $_ENV['DB_CONNECTION'],
            'hostname' => $_ENV['DB_HOST'],
            'username' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD'],
            'database' => $_ENV['DB_DATABASE_NAME'],
            'hostport' => $_ENV['DB_PORT'],
//            'type'     => 'mysql',
//            'hostname' => '127.0.0.1',
//            'username' => 'jxdsp',
//            'password' => '',
//            'database' => 'jxdsp',
//            'hostport' => '3306',
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
