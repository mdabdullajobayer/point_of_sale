<?php

namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken
{
    public static function CreateToken($userEmail, $userId): String
    {
        $key = env('JWT_KEY');
        $payload = [
            'iss' => 'laravel-token',
            'ist' => time(),
            'exp' => time() + 60 * 60,
            'UserEmail' => $userEmail,
            'userId' => $userId
        ];
        return JWT::encode($payload, $key, 'HS256');
    }

    public static function CreateTokenForSetPassword($userEmail): String
    {
        $key = env('JWT_KEY');
        $payload = [
            'iss' => 'laravel-token',
            'ist' => time(),
            'exp' => time() + 60 * 60,
            'UserEmail' => $userEmail,
            'userId' => '0'
        ];
        return JWT::encode($payload, $key, 'HS256');
    }

    public static function VerifyToeken($token): String|object
    {
        try {
            if ($token == null) {
                return 'Unathorise';
            } else {
                $key = env('JWT_KEY');
                $decode = JWT::decode($token, new key($key, 'HS256'));
                return $decode;
            }
        } catch (Exception $e) {
            return 'Unathorise';
        }
    }
}
