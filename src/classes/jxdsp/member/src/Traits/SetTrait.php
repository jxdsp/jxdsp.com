<?php

namespace jxdsp\Member\Traits;

trait SetTrait
{
    public function setUserCore($uid, $username, $password)
    {
        $data = [
            'uid'      => $uid,
            'username' => $username,
            'password' => $password
        ];
        return $this->setValue($data, 'user');
    }

    public function setUserInfo($uid, $phone_prefix, $phone, $email, $nickname)
    {
        $data = [
            'uid'          => $uid,
            'phone_prefix' => $phone_prefix,
            'phone'        => $phone,
            'email'        => $email,
            'nickname'     => $nickname
        ];
        return $this->setValue($data, 'user_info');
    }

    public function setUserCasbin($uid, $base, $sequence, $vip_expire_times)
    {
        $data = [
            'uid'              => $uid,
            'base'             => $base,
            'sequence'         => $sequence,
            'vip_expire_times' => $vip_expire_times,
        ];
        return $this->setValue($data, 'user_casbin');
    }
}
