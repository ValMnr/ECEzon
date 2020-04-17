<?php


// Create connection
$conn = mysqli_connect("mysql", "root", "tiger", 'Marketplace');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = "";
$photo = "";
$description = "";
$categorie = "";
$quantite = 0;
$prix = 0;
$idvendor = "";
$video = "";
$taille = 0.0;
$genre = "";
$couleur = "";

 ?>



<!doctype html>
<html lang="en">
  <head>
    <title>Items.php</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>
  <body>

    <!-- <?php require_once 'process.php'; ?> -->

    <div class="container">

      <!-- Message d'alerte -->
     <?php
     if (isset($_SESSION['message'])):
      ?>
      <div class="alert alert-<?=$_SESSION['msg_type']?>">
        <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
         ?>
       </div>
     <?php endif; ?>
      <h4 class="row justify-content-center">Adding product to the db</h4>
      <div class="row justify-content-center">
        <form action="process.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Photo</th>
                <th>Description</th>
                <th>Catégorie</th>
                <th>Quantité</th>
                <th>Id Vendeur</th>
                <th>Prix</th>
              </tr>
            </thead>
            <tr>
              <td><input type="text" name="Name" value="<?php echo $name ?>" class="form-control"></td>
              <td><input type="file" name="Photo" value="<?php echo $photo ?>" class="form-input"></td>
              <td><input type="text" name="Caption" value="<?php echo $description ?>" class="form-control"></td>
              <td><input type="text" name="Categorie" value="<?php echo $categorie ?>" class="form-control"></td>
              <td><input type="number" name="Quantity" value="<?php echo $quantite ?>" class="form-control" value="1"></td>
              <td><input type="number" name="Id_saler" value="<?php echo $idvendor ?>" class="form-control" value="0"></td>
              <td><input type="number" name="Price"  value="<?php echo $prix ?>" class="form-control" value="0"></td>
            </tr>
          </table>
          <table class="table">
            <thead>
              <tr>
                <th>Video</th>
                <th>Size</th>
                <th>Gender</th>
                <th>Color</th>
              </tr>
            </thead>
            <tr>
              <td><input type="file" class="form-input" name="Video"/></td>
              <td><input type="number" name="Size" class="form-control" value="0.0"></td>
              <td>
                <div class="radio">
                  <label><input type="radio" name="Gender" value="Women" checked> Women</label>
                </div>
                <div class="radio">
                  <label><input type="radio" name="Gender" value="Man"> Man</label>
                </div>
                <div class="radio">
                  <label><input type="radio" name="Gender" value="Other"> Other</label>
                </div>
              </td>
              <td><input type="text" name="Color" class="form-control" value="Enter the product Color"></td>
            </tr>

          </table>
          <div class="row justify-content-center">
            <!-- <input type="submit" class="btn btn-primary"name="add" value="Add"> -->
          <?php if ($update == true ): ?>
              <input type="submit" class="btn btn-info"name="update" value="Update">
              <?php else: ?>
              <input type="submit" class="btn btn-primary"name="add" value="Add">
          <?php endif; ?>
          </div>
      </form>
      </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>
</html>
