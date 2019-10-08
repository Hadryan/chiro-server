<?php

namespace App\Services\JWT;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Hmac\Sha512;
use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Parser;

class JWTService implements JWTServiceInterface
{

    private $jwtKey;
    public function __construct($jwtKey)
    {
        $this->jwtKey = $jwtKey;
    }

    public function generateJwtToken(array $claims): string
    {
        $time = time();
        $signer = new Sha512();
        $builder = (new Builder())
            ->issuedAt($time)
            ->setIssuer(app('url')->to('/')); // Configures the time that the token was issue (iat claim)
        foreach ($claims as $k => $v) {
            $builder->withClaim($k, $v);
        }
        $token = $builder->getToken($signer, new Key($this->jwtKey));
        return (string) $token;
    }

    public function validateJwtToken(string $token): bool
    {

        try {
            $data = new ValidationData();
            $data->setIssuer(app('url')->to('/'));

            $token = (new Parser())->parse((string) $token);
            return $token->validate($data);
        } catch (\Exception $e) {
            \Log::error($e);
            return false;
        }
    }


    public function getUserId($token): array
    {
        $token = (new Parser())->parse((string) $token);

        return $token->getClaims();
    }
}
