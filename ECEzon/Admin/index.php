<?php

require_once 'Requete.php';
 ?>


<!doctype html>
<html lang="en">
  <head>
    <title>Affichage de la base de Donnée de vendeurs</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <style>
            img {
                width: 64px;
                height: 64px;
                object-fit: contain;
            }
        </style>
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



    <h4> Display Vendors from database </h4>
    <div class="row justify-content-center">
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Pseudo</th>
            <th>Photo</th>
          </tr>
        </thead>
        <?php
        while ($data = mysqli_fetch_assoc($result)):
          ?>
          <tr>
            <td><?php echo $data['ID'];?></td>
            <td><?php echo $data['Email'];?></td>
            <td><?php echo $data['Pseudo'];?></td>
            <?php
            $imageData = base64_encode(file_get_contents($data['Profile']));
            ?>
            <td><?php echo '<img src="data:image/jpeg;base64,'.$imageData.'">';?></td>
            <!-- edit delete button -->
            <td>
              <a href="../Comptes/CreationCompteVendeur.php?edit= <?php echo $data['ID'];?>" class="btn btn-info">Edit</a>
              <a href="process.php?delete= <?php echo $data['ID'];?>" class="btn btn-danger">Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </table>
    </div>

    <div class="row justify-content-center">

      <form method="post">
        <div class="form-group">
          <a href="../Comptes/CreationCompteVendeur.php" class="btn btn-success">Add</a>
          <!-- <input type="button" name="display" value="display"> -->

        </div>
      </form>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </div>
  <!-- End of main container -->
  </body>
</html>
