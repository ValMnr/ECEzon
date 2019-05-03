<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Display db</title>
  </head>
  <body>
    <form method="post">
      <input type="submit" name="display" value="display">
    </form>
  </body>
</html>

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



if (isset($_POST['display'])) {

  echo "Displaying table Produits <br>";
  // $sql = "SELECT * FROM EtatCivil";
  // $result = mysqli_query($conn,$sql);
  $result = $conn->query("SELECT * FROM Items") or die(mysqli_error($conn));
  while ($data = mysqli_fetch_assoc($result)) {
    echo "ID : " .$data['ID'] . '<br>';
    echo "Nom : " .$data['Nom'] . '<br>';
    echo "Photo : " .$data['Photo'] . '<br>';
    // affichage de la photo basée sur son url
    $imageData = base64_encode(file_get_contents($data['Photo']));
    echo '<img src="data:image/jpeg;base64,'.$imageData.'">';
    echo "Description : " .$data['Description'] . '<br>';
    echo "Categorie : " .$data['Categorie'] . '<br>';
    echo "Quantite : " .$data['Quantite'] . '<br>';
    echo "Prix : " .$data['Prix'] . '<br>';
    echo "ID_VENDEUR : " .$data['ID_Vendeur'] . '<br>';
    echo "<br>";
  }// end while
}

$conn->close();

 ?>
