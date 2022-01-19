<?php

namespace jxdsp\Jwt\Easy;

use jxdsp\Jwt\JWK;

class Load extends \Jose\Easy\Load
{
    public static function set_jws(string $jws)
    {
        return parent::jws($jws)
//            ->algs(['RS256', 'RS512']) // The algorithms allowed to be used
//            ->exp() // We check the "exp" claim
//            ->iat(1000) // We check the "iat" claim. Leeway is 1000ms (1s)
//            ->nbf() // We check the "nbf" claim
//            ->aud('audience1') // Allowed audience
//            ->iss('issuer') // Allowed issuer
//            ->sub('subject') // Allowed subject
            ->jti('012311456789') // Token ID
            ->key(new JWK()) // Key used to verify the signature
            ->run();
    }
}
