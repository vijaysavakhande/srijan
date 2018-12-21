<?php
$match_string_count = $sanitise_words = $sanitise_queries =[];
if (isset($_POST['btnsubmit'])) {
  $sanitise_words = array_map('strip_tags',$_POST['dictn_word']);
  $sanitise_queries = array_map('strip_tags',$_POST['query_option']);  
  $obj_match = new MatchString($sanitise_words,$sanitise_queries);
  $match_string_count = $obj_match->getUserInput();
}
?>