<?php

namespace jxdsp\Member\Traits;

use jxdsp\Mysql\Mysql;

trait GetTrait
{

    /**
     * 根据用户名获取 uid
     *
     * @param string $username
     *
     * @return array|mixed|void|null
     */
    public function getUid(string $username)
    {
        return $this->getValue('uid', 'username', $username, 'user');
    }

    /**
     * 根据 uid 获取用户名
     *
     * @param string $uid
     *
     * @return array|mixed|void|null
     */
    public function getUsername(string $uid)
    {
        return $this->getValue('username', 'uid', $uid, 'user');
    }

    /**
     * 根据用户名获取密码
     *
     * @param string $username
     *
     * @return array|mixed|void|null
     */
    public function getPasswordFormUsername(string $username)
    {
        return $this->getValue('password', 'username', $username, 'user');
    }

    /**
     * 根据 uid 获取密码
     *
     * @param string $uid
     *
     * @return array|mixed|void|null
     */
    public function getPassword(string $uid)
    {
        return $this->getValue('password', 'uid', $uid, 'user');
    }

    /**
     * 根据 uid 获取用户核心表中对应的指定的列值
     *
     * @param string $uid
     * @param array  $columnName
     *
     * @return array|Mysql|string|void
     */
    public function getUserCore(string $uid, array $columnName)
    {
        return $this->get($columnName, 'uid', $uid, 'user');
    }

    /**
     * 根据 uid 获取用户信息表中对应的指定的列值
     *
     * @param string $uid
     * @param array  $columnName
     *
     * @return array|Mysql|string|void
     */
    public function getUserInfo(string $uid, array $columnName)
    {
        return $this->get($columnName, 'uid', $uid, 'user_info');
    }

    /**
     * 通过 uid 获取用户昵称
     *
     * @param string $uid
     *
     * @return array|mixed|void|null
     */
    public function getNickname(string $uid)
    {
        return $this->getValue('nickname', 'uid', $uid, 'user_info');
    }

    /**
     * 通过 uid 获取电话号码
     *
     * @param string $uid
     *
     * @return array|mixed|void|null
     */
    public function getPhone(string $uid)
    {
        return $this->getValue('phone', 'uid', $uid, 'user_info');
    }

    /**
     * 通过 uid 获取电子邮箱
     *
     * @param string $uid
     *
     * @return array|mixed|void|null
     */
    public function getEmail(string $uid)
    {
        return $this->getValue('email', 'uid', $uid, 'user_info');
    }

}
