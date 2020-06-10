<?php

namespace Scooby\Helpers;

class Jwt
{
    /**
     * Cria um novo token JWT
     *
     * @param array $data
     * @return string
     */
    public static function jwtCreate(array $data): string
    {
        $header = json_encode([
            'typ' => 'JWT',
            'alg' => 'HS256'
        ]);
        $payload = json_encode($data);

        $headerToken = self::base64_encode_url($header);
        $payloadToken = self::base64_encode_url($payload);

        $signature = hash_hmac("sha256", $headerToken.'.'.$payloadToken, SECRET_KEY, true);
        $signatureToken = self::base64_encode_url($signature);
        $jwt = $headerToken.'.'.$payloadToken.'.'.$signatureToken;
        return $jwt;
    }

    /**
     * Valida um token JWT informado
     *
     * @param string $token
     * @return boolean
     */
    public static function jwtValidate(string $token): bool
    {
        if (self::jwtSearchTokenBlackList($token) === true) {
            Response::json(['data' => 'Token Inválido']);
            return false;
        }
        $jwt = explode('.', $token);
        if (count($jwt) == 3) {
            $signature = hash_hmac("sha256", $jwt[0].'.'.$jwt[1], SECRET_KEY, true);
            $signatureToken = self::base64_encode_url($signature);

            if ($signatureToken == $jwt[2] and isset($jwt[2])) {
                return true;
            }else{
                Response::json(['data' => 'Token Inválido']);
                return false;
            }
        }else{
            Response::json(['data' => 'Token não enviado']);
            return false;
        }
    }

    /**
     * Decodifica o payload do token informado
     *
     * @param string $token
     * @return array
     */
    public static function jwtPayloadDecode(string $token): object
    {
        $tokenSplit = explode('.', $token);
        return (object) json_decode(self::base64_decode_url($tokenSplit[1]));
    }

    /**
     * Recupera o token JWT passado na requisição pelo header da aplicação
     *
     * @param string $token
     * @return void|string
     */
    public static function jwtGetToken(string $token = 'Authorization')
    {
        if (!isset(apache_request_headers()[$token])) {
            return false;
        }
        $t = apache_request_headers()[$token];
        $jwt = str_replace('Bearer ', '', $t);
        return $jwt;
    }

    /**
     * Expira o JWT o colocando na black list
     *
     * @param string $token
     * @param string $path
     * @return void
     */
    public static function jwtExpire(string $token, string $path = 'System/SysConfig/BlackList.txt')
    {
        if (!self::jwtSearchTokenBlackList($token)) {
            $f = fopen($path, 'a+');
            fwrite($f, $token.PHP_EOL);
            fclose($f);
        }
    }

    /**
     * Valida o JWT novamente o retirando da black list
     *
     * @param string $token
     * @param string $path
     * @return void
     */
    public static function jwtRefresh(string $token, string $path = 'System/SysConfig/BlackList.txt')
    {
        // Resgata o token na black list
        $blackList = file_get_contents($path);
        $new = str_replace($token, '', $blackList);
        $f = fopen($path, 'w');
        fwrite($f, $new);
        fclose($f);
    }

    /**
     * Pesquisa se um token JWT já existe na black list
     *
     * @param string $token
     * @param string $path
     * @return void
     */
    private static function jwtSearchTokenBlackList(string $token, string $path = 'System/SysConfig/BlackList.txt')
    {
        // Pesquisa um token na black list
        $blackList = file_get_contents($path);
        if (strpos($blackList, $token) === false) {
            return false;
        }
        return true;
    }

    /**
     * Codifica uma string em base64
     *
     * @param string $string
     * @return string
     */
    private static function base64_encode_url(string $string): string
    {
        return str_replace(['+','/','='], ['-','_',''], base64_encode($string));
    }

    /**
     * Decodifica uma string em base64
     *
     * @param string $string
     * @return string
     */
    private static function base64_decode_url(string $string): string
    {
        return base64_decode(str_replace(['-','_'], ['+','/'], $string));
    }

    /**
     * Cria um token jwt
     *
     * @return void
     */
    public static function jwtKeyGenerate()
    {
        if (SECRET_KEY == "secret") {
            $key = hash('sha256', md5(rand(11111111, 99999999) . uniqid(rand(), true) . time()));
            $generate = file_get_contents('.env');
            $generate = strtr($generate, [
                'secret' =>  "$key"
            ]);
            $f = fopen(".env", 'w+');
            fwrite($f, $generate);
            fclose($f);
        }
    }
}
