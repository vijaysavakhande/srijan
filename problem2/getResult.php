<?php
$result = $sanitise_first_string = $sanitise_second_string =[];
if (isset($_POST['btnsubmit'])) {
  $sanitise_first_string = array_map('strip_tags',$_POST['first_string']);
  $sanitise_second_string = array_map('strip_tags',$_POST['second_string']);
  $post_data = ['first_string'=>$sanitise_first_string, 'second_string'=>$sanitise_second_string,'is_checked'=>$_POST['is_checked'], 'start_index'=>$_POST['start_index']];
  $obj_match = new MatchWord();
  $result = $obj_match->checkMatchWord($post_data);  
}
?>