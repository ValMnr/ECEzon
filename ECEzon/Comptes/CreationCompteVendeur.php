<?php


require 'db.inc.php';


$id =0;
$email ="";
?>


<!doctype html>
<html lang="en">
  <head>
    <title></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-center">
        <form class="" action="process.php" method="post" enctype="multipart/form-data">
          <h4>Finalisation Inscription Compte Vendeur</h4>
          <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
          <input type="text" name="uid" placeholder="Pseudo" value="" class="form-control">
          <input type="text" name="mail" placeholder="Email" value="<?php echo $_GET['email']?>" class="form-control">
          <input type="file" name="profilepic" class="form-input">
          <input type="file" name="coverpic" class="form-input">
          <input type="submit" name="signup-vendeur" class="btn btn-primary">
        </form>
      </div>
    </div>

    <!-- Source : How To Create A Complete Login System In PHP | Procedural MySQLi | 2018 PHP Tutorial | mmtuts -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>
</html>
