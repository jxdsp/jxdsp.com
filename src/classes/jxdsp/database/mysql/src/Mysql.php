<?php

namespace jxdsp\Mysql;

use jxdsp\Mysql\Traits\DbConfigTrait;
use MysqliDb;

class Mysql extends MysqliDb
{
    use DbConfigTrait;

    public function __construct()
    {
        $this->setDbConfig();

        $dbConfig = $this->getDbConfig();

        parent::__construct($dbConfig);
    }
}
