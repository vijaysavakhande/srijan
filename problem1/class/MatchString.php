<?php
class MatchString {
  private $dictionary_words;
  private $query_options;
  private $result;
  public function __construct(array $dictionary_words, array $query_options){
    $this->dictionary_words = $dictionary_words;
    $this->query_options =$query_options;
  }

  private function stringMatchWithWildcard($source,$pattern) {
    $pattern = preg_quote($pattern,'/');        
    $pattern = str_replace( '\?' , '.*', $pattern);   
    return preg_match( '/^' . $pattern . '$/i' , $source );
  }
  
  public function getUserInput(){    
    foreach ($this->query_options as $index => $query_pattern) {
      $count = 0;
      foreach ($this->dictionary_words as $word) {
        if($this->stringMatchWithWildcard($word,$query_pattern)){
          $count++;
        }
      }
      $this->result[] = $count;
    }
    return $this->result;
  }
}