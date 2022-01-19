<?php

namespace jxdsp\Member;

use Exception;
use jxdsp\Mysql\Mysql;

class History
{
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
     * @param string|null $uid
     *
     * @return bool|void
     */
    public function registerSuccess(string $uid = null)
    {
        return $this->log('register', 'success', $uid);
    }

    /**
     * @param string|null $uid
     *
     * @return bool|void
     */
    public function registerFail(string $uid = null)
    {
        return $this->log('register', 'fail', $uid);
    }

    /**
     * @param string $uid
     *
     * @return bool|void
     */
    public function loginSuccess(string $uid)
    {
        return $this->log('login', 'success', $uid);
    }

    /**
     * @param string $uid
     *
     * @return bool|void
     */
    public function loginFail(string $uid)
    {
        return $this->log('login', 'fail', $uid);
    }

    /**
     * @param string $uid
     *
     * @return bool|void
     */
    public function passwordWrong(string $uid)
    {
        return $this->log('password', 'wrong', $uid);
    }

    /**
     * @param string $uid
     *
     * @return bool|void
     */
    public function changePasswordSuccess(string $uid)
    {
        return $this->log('changePassword', 'success', $uid);
    }

    /**
     * @param string $uid
     *
     * @return bool|void
     */
    public function changePasswordFail(string $uid)
    {
        return $this->log('changePassword', 'fail', $uid);
    }

    /**
     * @param string|null $uid
     *
     * @return bool|void
     */
    public function usernameWrong(string $uid = null)
    {
        return $this->log('username', 'wrong', $uid);
    }

    /**
     * @param string|null $uid
     *
     * @return bool|void
     */
    public function captchaWrong(string $uid = null)
    {
        return $this->log('captcha', 'wrong', $uid);
    }

    /**
     * 验证码超时
     *
     * @param string|null $uid
     *
     * @return bool|void
     */
    public function captchaTimeout(string $uid = null)
    {
        return $this->log('captcha', 'timeOut', $uid);
    }

    /**
     * 验证码不存在
     *
     * @param string|null $uid
     *
     * @return bool|void
     */
    public function captchaNotExist(string $uid = null)
    {
        return $this->log('captcha', 'notExist', $uid);
    }

    /**
     * @param string $uid
     *
     * @return bool|void
     */
    public function logoutSuccess(string $uid)
    {
        return $this->log('logout', 'success', $uid);
    }

    /**
     * @param string      $type
     * @param string      $result
     * @param string|null $uid
     * @param string      $tableName
     *
     * @return bool|void
     */
    public function log(string $type, string $result, string $uid = null, string $tableName = 'user_history')
    {
        $data = [
            'type'   => $type,
            'result' => $result,
            'uid'    => $uid,
        ];
        try {
            return $this->db->insert($tableName, $data);
        } catch (Exception $e) {
            $errorMsg = [
                'msg' => $e->getMessage(),
            ];
            exit(json_encode($errorMsg, JSON_UNESCAPED_UNICODE));
        }
    }
}
