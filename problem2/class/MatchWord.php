<?php
class MatchWord {
  public $result; 
  private function stringMatchWithWildcard($source,$pattern) {
    
  }
  private function validate(array $condition){
    $is_matched = 'No Worries';
    switch ($condition['is_checked']) {
      case 'Y':
        preg_match('#\\b'.preg_quote($condition['second_string'],'#').'\\b#i',$condition['first_string'],$matches,PREG_OFFSET_CAPTURE,$condition['start_index']);
        if(!empty($matches)){
          $is_matched = $matches[0][1];
        }
        break;      
      default:
        $is_matched = strpos($condition['first_string'],$condition['second_string'],$condition['start_index']);
        break;
    }
    return $is_matched;
  }

  public function checkMatchWord(array $data){
    foreach ($data['first_string'] as $index => $string) {
      $check_index = $index+1; 
      $conditions = ['first_string'=>$string,'second_string'=>$data['second_string'][$index],'is_checked'=>$data['is_checked'][$check_index][0],'start_index'=>$data['start_index'][$index]];
      $this->result[] = $this->validate($conditions);
    }
    return $this->result;
  }
}