<?php

namespace jxdsp\Member\Traits;

use jxdsp\Env\LoadEnv;

trait TableNameTrait
{
    public string $tableName;

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->tableName;
    }

    /**
     * @param string $tableName
     */
    public function setTableName(string $tableName): void
    {
        new LoadEnv();

        $this->tableName = getenv('DB_DATABASE_NAME') . $tableName;
    }

}
