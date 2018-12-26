<?php

namespace HGSI\Repository;

use HGSI\Repository\EncryptInterface;

class OpenSSL implements EncryptInterface {

    private $key_length = 8;
    private $secret_key, $iv,$encrypt_string, $decrypt_string;
    public $hash_type = 'sha256';
    public $cipher = 'AES-256-CBC';
    
    /**
     * function to generates cryptographically secure pseudo-random bytes
     * return string containing the requested number of cryptographically secure random bytes.
     * @return [type] string
     */
    public function generate_key(){
        $random_bytes = random_bytes($this->key_length);
        $bytes = bin2hex($random_bytes);
        $this->secret_key = hash($this->hash_type, $bytes);
        return $this->secret_key;
    }
    /**
     * [encrypt description]
     * @param  string $string [description]
     * @return [type]         [description]
     */
    public function getEncrypt(string $string){
        if (!$this->isCipherMethod($this->cipher)) {
            throw new Exception($this->cipher ." method is not valid encrypt method");
        }
        $ivlen = openssl_cipher_iv_length($this->cipher);
        $this->iv = openssl_random_pseudo_bytes($ivlen);
        $this->encrypt_string = openssl_encrypt($string, $this->cipher, $this->secret_key,0,$this->iv);        
        return base64_encode($this->encrypt_string);
    }
    /**
     * check provided cipher method is valid or not
     * @param  string  $cipher e.g.'aes-128-gcm'
     * @return boolean True|False 
     */
    private function isCipherMethod(string $cipher){
        $cipher_methods = openssl_get_cipher_methods();
        return in_array($cipher,$cipher_methods);
    }

    public function getDecrypt(string $string){
        if (!$this->isCipherMethod($this->cipher)) {
            throw new Exception($this->cipher ." method is not valid encrypt method");
        }        
        $this->decrypt_string = openssl_decrypt(base64_decode($string), $this->cipher,$this->secret_key,0,$this->iv);
        return $this->decrypt_string;
     } 

}
