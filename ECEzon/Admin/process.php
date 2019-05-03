<?php

session_start();

// Create connection
$conn = mysqli_connect("mysql", "root", "tiger", 'Marketplace');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$imgContent = "";
$update = false;
$id = 0;

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

    $description = isset($_POST['Caption'])?$_POST['Caption']:"";
    $categorie = isset($_POST['Categorie'])?$_POST['Categorie']:"";
    $quantite = isset($_POST['Quantity'])?$_POST['Quantity']:0;
    $prix = isset($_POST['Price'])?$_POST['Price']:0;
    $idvendor = isset($_POST['Id_saler'])?$_POST['Id_saler']:"";
    $video = isset($_POST['Video'])?$_POST['Video']:"";
    $taille = isset($_POST['Caption'])?$_POST['Size']:0.0;
    $genre = isset($_POST['Size'])?$_POST['Gender']:"";
    $couleur = isset($_POST['Color'])?$_POST['Color']:"";


    $produit = "INSERT INTO Products (Nom, Photo,Description,Categorie,Quantite,Prix,ID_Vendeur,Video,Taille,Genre,Couleur)
    VALUES ('$name','$image','$description', '$categorie','$quantite','$prix','$idvendor','$video','$taille' ,'$genre','$couleur')";

    if ($conn->query($produit) === TRUE) {
    } else {
      echo "Error: " . $produit . "<br>" . $conn->error;
    }
    $_SESSION['message'] = 'Article has been added';
    $_SESSION['msg_type'] = 'success';
    header("location: index.php");
    exit();
} // fin if button


if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $conn->query("DELETE FROM Products WHERE id=$id") or die(mysqli_error($conn));

  $_SESSION['message'] = 'Record has been deleted';
  $_SESSION['msg_type'] = 'danger';

  header("location: index.php");
  exit();
}

if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $result = $conn->query("SELECT * FROM Products WHERE id=$id") or die(mysqli_error($conn));
  if (count($result)==1) {
    $row = $result->fetch_array();
    $name = $row['Nom'];
    $description = $row['Description'];
    $categorie = $row['Categorie'];
    $quantite = intval($row['Quantite']);
    $idvendor = intval($row['ID_Vendeur']);
    $prix = intval($row['Prix']);
    $update = true;
  }

  header("location : Items.php");
}


if (isset($_POST['update'])) {
    // code...
    // varibles pour récupération des champs html
    // blindage
    $id = isset($_POST['id'])?$_POST['id']:0;

    $name = isset($_POST['Name'])?$_POST['Name']:"";
    $description = isset($_POST['Caption'])?$_POST['Caption']:"";
    $categorie = isset($_POST['Categorie'])?$_POST['Categorie']:"";
    $quantite = isset($_POST['Quantity'])?$_POST['Quantity']:0;
    $prix = isset($_POST['Price'])?$_POST['Price']:0;
    $idvendor = isset($_POST['Id_saler'])?$_POST['Id_saler']:"";
    $video = isset($_POST['Video'])?$_POST['Video']:"";
    $taille = isset($_POST['Caption'])?$_POST['Size']:0.0;
    $genre = isset($_POST['Size'])?$_POST['Gender']:"";
    $couleur = isset($_POST['Color'])?$_POST['Color']:"";


    $produit = "UPDATE Products SET  Nom='$name', Photo='$image',Description='$description',
    Categorie='$categorie',Quantite=$quantite,Prix=$prix,ID_Vendeur=$idvendor,
    Video='$video',Taille=$taille,Genre='$genre',Couleur='$couleur' WHERE ID=$id";

    if ($conn->query($produit) === TRUE) {
      $_SESSION['message'] = 'Article has been updated';
      $_SESSION['msg_type'] = 'warning';
      header("location: index.php?article=modified");

    } else {
      echo "Error: " . $produit . "<br>" . $conn->error;
    }
} // fin if button

$conn->close();


?>
