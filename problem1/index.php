<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
include_once 'class/MatchString.php';
include_once 'getResult.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Match String with Wild Card</title>
  </head>
  <body>
  <div class="container">  

    <h1>Problem 1: Match String with Wild Card</h1>
    <form action="<?php $_SERVER['PHP_SELF']?>" method="post" class="" novalidate>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="dictionay_count">Dictionary Words </label>
        <input type="number" name="dictionay_count" id="dictionay_count" class="form-control" placeholder="Dictionary Count" required>
      </div>
      <div class="form-group col-md-6">
         <label for="char_count">Character Counts </label>
        <input type="number" name="char_count" id="char_count" class="form-control" placeholder="Char Count">
      </div>
    </div>    
    <div id="dictionay_words"></div>
    <div id="charactor_words"></div>
    <div class="form-group">
      <label for="number_query">Query Lines </label>
      <input type="number" name="number_query" id="number_query" class="form-control" placeholder="Number of Queries">
    </div>
    <div id="queries"></div>
    <button type="submit" class="btn btn-primary" name="btnsubmit" value=1>Submit Query</button> 
    </form>
    <?php if(!empty($match_string_count)):?>
    <br>
    <div class="result table-responsive">
      <table cellpadding="3" cellspacing="1" width="60%" class="table table-hover">
        <thead>
          <tr>
            <th>Dictionary Word Used:</th>
            <th colspan="2"><?php print implode(', ',$sanitise_words);?></th>
          </tr>
          <tr>
            <th>Query Option Used:</th>
            <th colspan="2"><?php print implode(', ', $sanitise_queries);?></th>
          </tr>
          <tr>
            <td colspan="3"> Match Result details </td>
          </tr>
          <?php $sr_no=1; foreach($sanitise_words as $index=>$word):?>
          <tr>
            <td><?php echo $sr_no++;?></td>
            <td><?php echo $word;?></td>
            <td><?php echo $match_string_count[$index]?? 0;?></td>
          </tr>
          <?php endforeach;?>
        </thead>
      </table>
    </div>
    <?php endif;?>
  </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
  </body>
</html>