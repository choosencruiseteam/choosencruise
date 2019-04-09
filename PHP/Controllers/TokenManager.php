<?php
class TokenManager
{
    public static function newToken()
    {
        return bin2hex(random_bytes(32));
    }

    public static function compare($token1, $token2)
    {
        if ($token1 === $token2) {
            return true;
        } elseif ($token1 !== $token2) {
            return false;
        } else {
            return null;
        }
    }
}
?>
