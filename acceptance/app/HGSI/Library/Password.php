<?php

namespace HGSI\Library;

use HGSI\Repository\EncryptInterface;

class Password {
    
    private $encrypt;
    private $encrypt_key;
    protected $_hash_type = 'sha1';

    public function __construct(EncryptInterface $encrypt) {
        $this->encrypt = $encrypt;
    }
    
    public function generateKey(){
       return $this->encrypt->generate_key();
    }

    public function encryptString(string $string){
        return $this->encrypt->getEncrypt($string);
    }

    public function decryptString(string $string){
        return $this->encrypt->getDecrypt($string);
    }
}
