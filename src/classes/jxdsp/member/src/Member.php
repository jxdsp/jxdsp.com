<?php

namespace jxdsp\Member;

use Exception;
use jxdsp\Member\Traits\ChangeTrait;
use jxdsp\Member\Traits\GetTrait;
use jxdsp\Member\Traits\SetTrait;
use jxdsp\Member\Traits\TableNameTrait;
use jxdsp\Member\Traits\UidTrait;
use jxdsp\Member\Traits\VerifyPW;
use jxdsp\Mysql\Mysql;

class Member
{
    use ChangeTrait;
    use GetTrait;
    use SetTrait;
    use TableNameTrait;
    use UidTrait;
    use VerifyPW;

    /**
     * 数据库
     *
     * @var Mysql
     */
    public Mysql $db;

    public function __construct()
    {
        $this->db = new Mysql();
    }

    /**
     * 通过 $whereValue 获取单一的 $columnName
     *
     * @param string $columnName
     * @param string $whereProp
     * @param string $whereValue
     * @param string $tableName
     * @param int    $limit
     *
     * @return array|mixed|void|null
     */
    protected function getValue(string $columnName, string $whereProp, string $whereValue, string $tableName, int $limit = 1)
    {
        $this->setTableName($tableName);

        $this->db->where($whereProp, $whereValue);

        try {
            $userValue = $this->db->getValue($this->getTableName(), $columnName, $limit);
        } catch (Exception $e) {
            $errorMsg = [
                'msg' => $e->getMessage(),
            ];
            exit(json_encode($errorMsg, JSON_UNESCAPED_UNICODE));
        }

        return $userValue;
    }

    /**
     * 通过 $whereValue 获取多个 $columnName
     *
     * @param array  $columnName
     * @param string $whereProp
     * @param string $whereValue
     * @param string $tableName
     * @param int    $limit
     *
     * @return array|Mysql|string|void
     */
    protected function get(array $columnName, string $whereProp, string $whereValue, string $tableName, int $limit = 1)
    {
        $this->setTableName($tableName);

        $this->db->where($whereProp, $whereValue);

        try {
            $userValue = $this->db->get($this->getTableName(), $limit, $columnName);
        } catch (Exception $e) {
            $errorMsg = [
                'msg' => $e->getMessage(),
            ];
            exit(json_encode($errorMsg, JSON_UNESCAPED_UNICODE));
        }

        return $userValue;
    }

    /**
     * 通过 $whereProp 和 $whereValue 的组合，修改相应表中的指定数据
     *
     * @param array    $newData
     * @param string   $whereProp
     * @param string   $whereValue
     * @param string   $tableName
     * @param int|null $limit
     *
     * @return bool|void
     */
    protected function changeValue(array $newData, string $whereProp, string $whereValue, string $tableName, int $limit = null)
    {
        $this->setTableName($tableName);

        $this->db->where($whereProp, $whereValue);

        try {
            $bool = $this->db->update($this->getTableName(), $newData, $limit);
        } catch (Exception $e) {
            $errorMsg = [
                'msg' => $e->getMessage(),
            ];
            exit(json_encode($errorMsg, JSON_UNESCAPED_UNICODE));
        }

        return $bool;
    }

    /**
     * 向表中插入数据（带事务返回）
     *
     * @param array  $insertData
     * @param string $tableName
     *
     * @return bool|void
     */
    protected function setValue(array $insertData, string $tableName)
    {
        $this->setTableName($tableName);

        try {
//            $bool = $this->db->insert($this->getTableName(), $insertData);
            $this->db->startTransaction();
            if (!$this->db->insert($this->getTableName(), $insertData)) {
                return $this->db->rollback();
            } else {
                return $this->db->commit();
            }
        } catch (Exception $e) {
            $errorMsg = [
                'msg' => $e->getMessage(),
            ];
            exit(json_encode($errorMsg, JSON_UNESCAPED_UNICODE));
        }

//        return $bool;
    }

    public function setMultiValue(array $insertData, string $tableName, array $dataKeys = null)
    {
        $this->setTableName($tableName);

        try {
//            $bool = $this->db->insertMulti($this->getTableName(), $insertData, $dataKeys);
            $this->db->startTransaction();
            if (!$this->db->insertMulti($this->getTableName(), $insertData, $dataKeys)) {
                return $this->db->rollback();
            } else {
                return $this->db->commit();
            }
        } catch (Exception $e) {
            $errorMsg = [
                'msg' => $e->getMessage(),
            ];
            exit(json_encode($errorMsg, JSON_UNESCAPED_UNICODE));
        }

//        return $bool;
    }

    public function deleteValue()
    {
    }

    /**
     * 判断 $tableName 表中是否存在 where 条件的指定值
     *
     * @param string $whereProp
     * @param string $whereValue
     * @param string $tableName
     *
     * @return bool|void
     */
    protected function hasValue(string $whereProp, string $whereValue, string $tableName)
    {
        $this->setTableName($tableName);

        $this->db->where($whereProp, $whereValue);

        try {
            return $this->db->has($this->getTableName());
        } catch (Exception $e) {
            $errorMsg = [
                'msg' => $e->getMessage(),
            ];
            exit(json_encode($errorMsg, JSON_UNESCAPED_UNICODE));
        }
    }
}
