<?php 

namespace HGSI\Repository;

interface EncryptInterface{
    
    // define function to create random token
    public function generate_key();

    // define function to encrypt string
    public function getEncrypt(string $string);

    // define function to encrypt string
    public function getDecrypt(string $string);
}
