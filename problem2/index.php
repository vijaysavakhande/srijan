<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
include_once 'class/MatchWord.php';
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

    <h1>Problem 2:Condition based Match Word </h1>
    <form action="<?php $_SERVER['PHP_SELF']?>" method="post" class="" novalidate>
      <div class="form-group row">
        <label for="number_tests" class="col-sm-4 col-form-label">Number of test cases</label>
        <div class="col-sm-8">
        <input type="number" name="number_tests" id="number_tests" class="form-control" placeholder="Number Of Test" required>
        </div>
      </div>
      <div class="query_wrapper"></div>   
    <button type="submit" class="btn btn-primary" name="btnsubmit" value=1>Submit Query</button> 
    </form>
    <?php if(!empty($result)):?>
    <br>
    <div class="result table-responsive">
      <table cellpadding="3" cellspacing="1" width="60%" class="table table-hover">
        <thead>
          <tr>
            <td colspan="3"> Match Result details </td>
          </tr>
          <?php $sr_no=1; foreach($result as $index=>$count):?>
          <tr>
            <td><?php echo $sr_no++;?></td>
            <td><?php echo $count;?></td>
          </tr>
          <?php endforeach;?>
        </thead>
      </table>
    </div>
    <?php endif;?>
  </div>

  <script type="text/x-handlebars-template" id="fieldset_html">
  <div class="row"> Test Case {{index}} </div>
  <fieldset class="">
    <div class="form-group row">
      <label for="first_string{{index}}" class="col-sm-2 col-form-label">First String</label>
      <div class="col-sm-8">
        <input class="form-control" type="text" name="first_string[]" id="first_string{{index}}" value="">
      </div>        
    </div>
    <div class="form-group row">
    <label for="second_string{{index}}" class="col-sm-2 col-form-label">Second String</label>
      <div class="col-sm-8">
        <input class="form-control" type="text" name="second_string[]" id="second_string{{index}}" value="">
      </div>        
    </div>
    <div class="form-group row">
      <div class="col-sm-4">Is checked</div>
      <div class="col-sm-8">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="is_checked[{{index}}][]" id="gridRadios1{{index}}" value="Y" checked>
          <label class="form-check-label" for="gridRadios1{{index}}">Yes</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="is_checked[{{index}}][]" id="gridRadios2{{index}}" value="N">
          <label class="form-check-label" for="gridRadios2{{index}}">No</label>
        </div>
      </div>
    </div>
    <div class="form-group row">
      <label for="start_index{{index}}" class="col-sm-2 col-form-label">Start Index</label>
      <div class="col-sm-8">
        <input class="form-control" type="number" name="start_index[]" id="start_index{{index}}" value="">
      </div>
    </div>
    </div>
  </fieldset>
  <hr>
  </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.12/handlebars.min.js"></script>
    <script src="js/script.js"></script>
  </body>
</html>