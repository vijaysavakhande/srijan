<?php
namespace HGSI\Repository;

use HGSI\Repository\EncryptInterface;

class Mcrypt implements EncryptInterface{

    private $key_length = 8;
    private $secret_key, $iv,$encrypt_string,$decrypt_string;
    public function __construct(){
        $this->iv = base64_encode(openssl_random_pseudo_bytes(3 * ($this->key_length >> 2)));
    }

    public function generate_key(){
        $this->secret_key = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $this->key_length);
        return $this->secret_key;
    }

    public function getEncrypt(string $string) { 
        $text_num =str_split($string,$this->key_length);
        $text_num = $this->key_length-strlen($text_num[count($text_num)-1]);
        for ($i=0;$i<$text_num; $i++) {
            $string = $string . chr($text_num);
        }
        $cipher = mcrypt_module_open(MCRYPT_TRIPLEDES,'','cbc','');
        mcrypt_generic_init($cipher, $this->secret_key, $this->iv);
        $this->encrypt_string = mcrypt_generic($cipher,$string);
        mcrypt_generic_deinit($cipher);
        return base64_encode($this->encrypt_string);
    }

    public function getDecrypt(string $string) {
        $cipher = mcrypt_module_open(MCRYPT_TRIPLEDES,'','cbc','');
        mcrypt_generic_init($cipher, $this->secret_key, $this->iv);
        $this->decrypt_string = mdecrypt_generic($cipher,base64_decode($this->string));
        mcrypt_generic_deinit($cipher);
        $last_char=substr($this->decrypt_string,-1);
        for($i=0;$i<$bit_check-1; $i++){
            if(chr($i)==$last_char){                
                $this->decrypt_string=substr($this->decrypt_string,0,strlen($this->decrypt_string)-$i);
                break;
            }
        }
        return $this->decrypt_string;
    }
}
