<?php

namespace jxdsp\Member\Traits;

trait ChangeTrait
{
    public function hasUsername(string $username)
    {
        return $this->hasValue('username', $username, 'user');
    }

    /**
     * 通过 uid 修改用户名
     *
     * @param string $newUsername
     * @param string $uid
     *
     * @return bool|void
     */
    public function changeUsername(string $newUsername, string $uid)
    {
        return $this->changeValueFormUid('username', $newUsername, $uid, 'user');
    }

    /**
     * 通过 uid 修改密码
     *
     * @param string $newPassword
     * @param string $uid
     *
     * @return bool|void
     */
    public function changePassword(string $newPassword, string $uid)
    {
        return $this->changeValueFormUid('password', $this->hashPassword($newPassword), $uid, 'user');
    }

    /**
     * 通过用户名修改密码
     *
     * @param string $newPassword
     * @param string $username
     *
     * @return bool|void
     */
    public function changePasswordFormUsername(string $newPassword, string $username)
    {
        return $this->changeValueFormUsername('password', $this->hashPassword($newPassword), $username, 'user');
    }

    /**
     * 通过 uid 修改昵称
     *
     * @param string $newNickname
     * @param string $uid
     *
     * @return bool|void
     */
    public function changeNickname(string $newNickname, string $uid)
    {
        return $this->changeValue(['nickname' => $newNickname], 'uid', $uid, 'user_info', 1);
    }

    /**
     * 通过 uid 修改电话
     *
     * @param string $newPhone
     * @param string $uid
     *
     * @return bool|void
     */
    public function changePhone(string $newPhone, string $uid)
    {
        return $this->changeValueFormUid('phone', $newPhone, $uid, 'user_info');
    }

    /**
     * 通过 $uid 修改 $newFieldName 对应的 $newFieldValue 的值
     *
     * @param string $newFieldName
     * @param string $newFieldValue
     * @param string $uid
     * @param string $tableName
     *
     * @return bool|void
     */
    public function changeValueFormUid(string $newFieldName, string $newFieldValue, string $uid, string $tableName)
    {
        return $this->changeValue([$newFieldName => $newFieldValue], 'uid', $uid, $tableName, 1);
    }

    /**
     * 通过 $username 修改 $newFieldName 对应的 $newFieldValue 的值
     *
     * @param string $newFieldName
     * @param string $newFieldValue
     * @param string $username
     * @param string $tableName
     *
     * @return bool|void
     */
    public function changeValueFormUsername(string $newFieldName, string $newFieldValue, string $username, string $tableName)
    {
        return $this->changeValue([$newFieldName => $newFieldValue], 'username', $username, $tableName, 1);
    }

}
