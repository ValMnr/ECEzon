<!doctype html>
<html lang="en">
  <head>
    <title>Display Db</title>
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
    <div class="container">

      <?php

      $servername = "mysql";
      $username = "root";
      $password = "tiger";
      $dbname = "Marketplace";

      // Create connection
      $conn = mysqli_connect("mysql", "root", "tiger", 'Marketplace');
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      $result = $conn->query("SELECT * FROM Products") or die(mysqli_error($conn));


      // if (isset($_POST['display'])) {
      //
      //   echo "Displaying table Produits <br>";
      //   // $sql = "SELECT * FROM EtatCivil";
      //   // $result = mysqli_query($conn,$sql);
      //   while ($data = mysqli_fetch_assoc($result)) {
      //     echo "ID : " .$data['ID'] . '<br>';
      //     echo "Nom : " .$data['Nom'] . '<br>';
      //     echo "Photo : " .$data['Photo'] . '<br>';
      //     // affichage de la photo basée sur son url
      //     $imageData = base64_encode(file_get_contents($data['Photo']));
      //     echo '<img src="data:image/jpeg;base64,'.$imageData.'">';
      //     echo "Description : " .$data['Description'] . '<br>';
      //     echo "Categorie : " .$data['Categorie'] . '<br>';
      //     echo "Quantite : " .$data['Quantite'] . '<br>';
      //     echo "Prix : " .$data['Prix'] . '<br>';
      //     echo "ID_VENDEUR : " .$data['ID_Vendeur'] . '<br>';
      //     echo "<br>";
      //   }// end while
      // }
       ?>

    <h4> Display entry from database </h4>
    <div class="row justify-content-center">
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Photo</th>
            <th>Description</th>
            <th>Catégorie</th>
            <th>Quantité</th>
            <th>Id Vendeur</th>
            <th>Prix</th>
          </tr>
        </thead>
        <?php
        while ($data = mysqli_fetch_assoc($result)):
          ?>
          <tr>
            <td><?php echo $data['ID'];?></td>
            <td><?php echo $data['Nom'];?></td>
            <?php
            $imageData = base64_encode(file_get_contents($data['Photo']));
            ?>
            <td><?php echo '<img src="data:image/jpeg;base64,'.$imageData.'">';?></td>
            <td><?php echo $data['Description'];?></td>
            <td><?php echo $data['Categorie'];?></td>
            <td><?php echo $data['Quantite'];?></td>
            <td><?php echo $data['ID_Vendeur'];?></td>
            <td><?php echo $data['Prix'];?></td>
            <!-- edit delete button -->
            <td></td>
          </tr>
        <?php endwhile; ?>
      </table>
    </div>

    <div class="row justify-content-center">

      <form method="post">
        <div class="form-group">
          <input type="submit" name="display" value="display">

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


<?php
$conn->close();
 ?>
