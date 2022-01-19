<?php

namespace jxdsp\Jwt\Easy;


use jxdsp\Jwt\JWK;

class Build extends \Jose\Easy\Build
{
    public static function set_jws($username)
    {
        $time = time();
        return parent::jws()
            ->payload([
                'exp'      => $time + 60 * 60 * 24 * 2, // The "exp" claim
                'username' => $username, // The "jti" claim
//                'jti' => '0123456789', // The "jti" claim
//                'iat' => $time, // The "iat" claim
//                'nbf' => $time, // The "nbf" claim
//                'iss' => 'issuer', // The "iss" claim
//                'aud' => ['audience1', 'audience2'], // Add an audience ("aud" claim)
//                'sub' => 'subject', // The "sub" claim
            ])
//            ->header('prefs', ['field1', 'field7'])
            ->header('tokenId', '0123456789')
            ->header('alg', 'RS512')
            ->sign(new JWK());
    }
}
