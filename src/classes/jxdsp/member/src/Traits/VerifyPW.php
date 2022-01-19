<?php

namespace jxdsp\Member\Traits;

trait VerifyPW
{

    /**
     * 验证 $password 是否跟对应 $uid 的密码散列匹配。
     * 如果匹配,返回 true，并且将判断当前密码散列跟算法的匹配情况，并进行更新，以保证散列的安全有效
     * 如果不匹配，返回 false
     *
     * @param string $password
     * @param string $uid
     *
     * @return bool
     */
    public function verifyPassword(string $password, string $uid): bool
    {
        $currentUidPasswordHash = $this->getPassword($uid);

        if (password_verify($password, $currentUidPasswordHash)) {
            $this->rehashChangePassword($password, $currentUidPasswordHash, $uid);
            return true;
        }
        return false;
    }

    /**
     * 如果当前的密码哈希跟算法不匹配，那么将 $password 进行哈希，并且应用于对应 $uid 的密码
     *
     * @param string $password
     * @param string $passwordHash
     * @param string $uid
     */
    public function rehashChangePassword(string $password, string $passwordHash, string $uid)
    {
        if (password_needs_rehash($passwordHash, PASSWORD_DEFAULT)) {
            $this->hashChangePassword($password, $uid);
        }
    }

    /**
     * 重新哈希密码，并将哈希值应用于对应的$uid
     *
     * @param string $password
     * @param string $uid
     *
     * @return bool|void
     */
    public function hashChangePassword(string $password, string $uid)
    {
        $passwordHash = $this->hashPassword($password);
        return $this->changePassword($passwordHash, $uid);
    }

    /**
     * 创建密码哈希
     *
     * @param string $password
     *
     * @return false|string|null
     */
    public function hashPassword(string $password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

}
