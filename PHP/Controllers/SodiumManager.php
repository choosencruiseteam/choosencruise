<?php
class SodiumManager
{
    public static function encode($plain_text)
    {
        $MASTER_KEY = file_get_contents('../controllers/key.dat');
        $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
        $ciphertext = sodium_crypto_secretbox($plain_text, $nonce, $MASTER_KEY);
        $encoded = base64_encode($nonce . $ciphertext);
        return $encoded;
    }
    /*
    public function decode($encoded_text)
    {
        $MASTER_KEY = file_get_contents('../controllers/key.dat');

        $decoded = base64_decode($encoded_text);
        $nonce = mb_substr($decoded, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, '8bit');
        $ciphertext = mb_substr($decoded, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, null, '8bit');
        $plain_text = sodium_crypto_secretbox_open($ciphertext, $nonce, $MASTER_KEY);
        return $plain_text;
    }
    */
    public static function compare($plain_text, $encoded_text)
    {
        $MASTER_KEY = file_get_contents('../controllers/key.dat');

        //get nonce value from encoded value
        $decoded = base64_decode($encoded_text);
        $nonce = mb_substr($decoded, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, '8bit');

        //Encode value with pulled nonce value for comparison
        $ciphertext = sodium_crypto_secretbox($plain_text, $nonce, $MASTER_KEY);
        $encoded_plain_text = base64_encode($nonce . $ciphertext);

        if ($encoded_plain_text === $encoded_text) {
            return true;
        } else {
            return false;
        }
    }
}
/*
$pass = SodiumManager::encode('password');
print_r($pass);
*/
