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

$imgContent = "";

if (isset($_FILES['Photo'])) {
  // chemin relatif au répertoire courant
  $dirpath = realpath(dirname(getcwd()))."/images/";
  // gestion des erreurs
  $phpFileUploadErrors = array(
   0 => 'There is no error, the file uploaded with success',
   1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
   2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
   3 => 'The uploaded file was only partially uploaded',
   4 => 'No file was uploaded',
   6 => 'Missing a temporary folder',
   7 => 'Failed to write file to disk.',
   8 => 'A PHP extension stopped the file upload.',
 );

  // verification du format de l'upload des images
  $ext_error = false;
  $extensions = array('jpg', 'jpeg' , 'gif', 'png' );
  $file_ext = explode('.',$_FILES['Photo']['name']);
  $file_ext = end($file_ext);

  if (!in_array($file_ext,$extensions)) {
    $ext_error = true;
  }

  // gestion des erreurs
  if ($_FILES['Photo']['error']) {
    echo $phpFileUploadErrors[$_FILES['Photo']['error']];
  }
  elseif ($ext_error) {
    echo "Invalid file extension";
  }
  else {
    // echo "Image successfully uploaded <br>";
  }

  move_uploaded_file($_FILES['Photo']['tmp_name'], $dirpath.$_FILES['Photo']['name']);

  // get image from the server
  $image = $dirpath.$_FILES['Photo']['name'];
}

if (isset($_POST['add'])) {
    // code...
    // varibles pour récupération des champs html
    // blindage
    $name = isset($_POST['Name'])?$_POST['Name']:"";

    $description = $_POST['Caption']?$_POST['Caption']:"";
    $categorie = $_POST['Categorie']?$_POST['Categorie']:"";
    $quantite = $_POST['Quantity']?$_POST['Quantity']:0;
    $prix = $_POST['Price']?$_POST['Price']:0;
    $idvendor = $_POST['Id_saler']?$_POST['Id_saler']:"";
    $video = $_POST['Video']?$_POST['Video']:"";
    $taille = $_POST['Size']?$_POST['Size']:0.0;
    $genre = $_POST['Gender']?$_POST['Gender']:"";
    $couleur = $_POST['Color']?$_POST['Color']:"";


    $produit = "INSERT INTO Products (Nom, Photo,Description,Categorie,Quantite,Prix,ID_Vendeur,Video,Taille,Genre,Couleur)
    VALUES ('$name','$image','$description', '$categorie','$quantite','$prix','$idvendor','$video','$taille' ,'$genre','$couleur')";

} // fin if button

if ($conn->query($produit) === TRUE) {
    echo "New Product added successfully";
} else {
    echo "Error: " . $produit . "<br>" . $conn->error;
}

$conn->close();
?>
