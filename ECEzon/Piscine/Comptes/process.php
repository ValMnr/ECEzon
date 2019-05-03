<?php
// LOGIN
$IDENTIFIANT =0;
if (isset($_POST['signup'])) {


    require 'db.inc.php';


    // varibles pour récupération des champs html
    // blindage
    $login = $_POST['mail'];
    $password = $_POST['password'];
    $type = $_POST['type'];

    // empty fields
    if (empty($login) || empty($password)) {
      header("Location: index.php?error=emptyfields&uid=".$login);
      exit();
    }
    // invalid email address
    elseif (!filter_var($login,FILTER_VALIDATE_EMAIL)) {
      header("Location: index.php?error=InvalidEmail&uid=".$login);
      exit();
    }
    // no error
    else {
      // USING placeholder ? to avoid SQLInjection
      $sql = "SELECT Mail FROM Account WHERE Mail=?";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("Location: index.php?error=SQLError1");
        exit();
      }
      else {
        // send to db with user info
        mysqli_stmt_bind_param($stmt,"s",$login);
        mysqli_stmt_execute($stmt);
        // to fetch data to db
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if ($resultCheck > 0) {
          header("Location: index.php?error=usertaken&uid=".$login);
          exit();
        }
        else {
          $sql = "INSERT INTO Account (Mail, Password,Type) VALUES (?,?,?)";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("Location: index.php?error=SQLError2");
            exit();
          }
          else {

            // hashing Password
            $hashedPwd = password_hash($password,PASSWORD_DEFAULT);

            mysqli_stmt_bind_param($stmt,"sss",$login,$hashedPwd,$type);
            mysqli_stmt_execute($stmt);
            if ($type == 'Client' || $type =='Vendeur') {

              // récupération de l'id client
              $requete = "SELECT * FROM Account WHERE Mail=?";
              $stmt = mysqli_stmt_init($conn);
              if (!mysqli_stmt_prepare($stmt,$requete)) {
                header("Location: index.php?error=SQLError1");
                exit();
              } else {
                mysqli_stmt_bind_param($stmt,"s",$login);
                mysqli_stmt_execute($stmt);
                // to fetch data to db
                $result = mysqli_stmt_get_result($stmt);
                if ($row = mysqli_fetch_assoc($result)) {
                  $IDENTIFIANT = $row['ID'];
                }
              }
              // Navigation à la page suivante avec les champs crée
              $id = $IDENTIFIANT;
              $sql = "SELECT ID,Mail FROM Account WHERE ID=?";
              $stmt = mysqli_stmt_init($conn);
              if (!mysqli_stmt_prepare($stmt,$sql)) {
                header("Location: index.php?error=SQLError1");
                exit();
              } else {
                mysqli_stmt_bind_param($stmt,"s",$id);
                mysqli_stmt_execute($stmt);
                // to fetch data to db
                $result= mysqli_stmt_get_result($stmt);
                if ($row = mysqli_fetch_assoc($result)) {
                  $id = $row['ID'];
                  $email = $row['Mail'];

                  // redirection vers compte client
                  if ($type == 'Client') {
                    header("Location: CreationCompteClient.php?id=".$id."&email=".$email);
                    exit();
                  } elseif ($type == 'Vendeur') {
                    // redirection vers creation compte client
                    header("Location: CreationCompteVendeur.php?id=".$id."&email=".$email);
                    exit();
                  } else {
                    header("Location: index.php?signup=halfsuccess&id=".$id);
                    exit();
                  }

                } else {
                  header("Location: index.php?signup=halfsuccess&id=".$id);
                  exit();
                }
              }
            } else {
              header("Location: index.php?error=forbidden");
              exit();
            }
          }
        }
      }
    }
    $conn->close();
}
 // fin if button
elseif (isset($_POST['signup-client'])) {
  require 'db.inc.php';
  $id = $_POST['id'];
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $mail = $_POST['mail'];
  $rue = $_POST['rue'];
  $ville = $_POST['city'];
  $region = $_POST['region'];
  $zip = $_POST['zip'];
  $pays = $_POST['country'];
  $num = $_POST['num'];
  $expiration = $_POST['expiration'];
  $csv = $_POST['csv'];

  // error checking
  if (empty($nom) || empty($prenom) || empty($mail || empty($rue) || empty($ville) || empty($region) || empty($zip) || empty($pays) || empty($num) || empty($expiration) || empty($csv) )) {
    header("Location: index.php?error=emptyfields");
    exit();
  } else {
    // Checking for existing account
    // USING placeholder ? to avoid SQLInjection
    $sql = "SELECT Mail FROM Clients WHERE Mail=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
      header("Location: index.php?error=SQLError1");
      exit();
    } else {
      // send to db with user info
      mysqli_stmt_bind_param($stmt,"s",$mail);
      mysqli_stmt_execute($stmt);
      // to fetch data to db
      mysqli_stmt_store_result($stmt);
      $resultCheck = mysqli_stmt_num_rows($stmt);
      if ($resultCheck > 0) {
        header("Location: index.php?error=usertaken&uid=".$mail);
        exit();
      } else {
        $sql = "INSERT INTO Clients (ID,Nom,Prenom,Mail,Rue,ZIP,Pays,NumCarte,Expiration,CSV) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
          header("Location: index.php?error=SQLError");
          exit();
        } else {
          mysqli_stmt_bind_param($stmt,"issssisiii",$id,$nom,$prenom,$mail,$rue,$zip,$pays,$num,$expiration,$csv);
          mysqli_stmt_execute($stmt);
          header("Location: CreationCompteClient.php?signup=finished");
          exit();
        }
      }
    }


  }

}
elseif (isset($_POST['signup-vendeur'])) {
  require 'db.inc.php';
  $id = $_POST['id'];
  $pseudo = $_POST['uid'];
  $mail = $_POST['mail'];

  // error checking
  if (empty($pseudo) || empty($mail)) {
    header("Location: index.php?error=emptyfields");
    exit();
  } else {
    // Checking for existing account
    // USING placeholder ? to avoid SQLInjection

    $profile = ImageUpload('profilepic');
    $cover = ImageUpload('coverpic');

    $sql = "SELECT EMail FROM Vendeurs WHERE EMail=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
      header("Location: index.php?error=SQLError1");
      exit();
    } else {
      // send to db with user info
      mysqli_stmt_bind_param($stmt,"s",$mail);
      mysqli_stmt_execute($stmt);
      // to fetch data to db
      mysqli_stmt_store_result($stmt);
      $resultCheck = mysqli_stmt_num_rows($stmt);
      if ($resultCheck > 0) {
        header("Location: index.php?error=usertaken&uid=".$mail);
        exit();
      } else {
        $sql = "INSERT INTO Vendeurs (ID,Email,Pseudo,Profile,Couverture) VALUES (?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
          header("Location: index.php?error=SQLError");
          exit();
        } else {
          mysqli_stmt_bind_param($stmt,"issss",$id,$mail,$pseudo,$profile,$cover);
          mysqli_stmt_execute($stmt);
          header("Location: Index.php?signupVendeur=finished");
          exit();
        }
      }
    }


  }

}
else {
  header("Location: index.php");
  exit();
}


// check for image update
function ImageUpload($pic)
{
  if (isset($_FILES[$pic])) {
    // header("Location: CreationCompteVendeur.php?functionpremièrecondition&pic=".$pic);
    // exit();
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
    $file_ext = explode('.',$_FILES[$pic]['name']);
    $file_ext = end($file_ext);

    if (!in_array($file_ext,$extensions)) {
      $ext_error = true;
    }

    // gestion des erreurs
    if ($_FILES[$pic]['error']) {
      echo $phpFileUploadErrors[$_FILES[$pic]['error']];
    }
    elseif ($ext_error) {
      echo "Invalid file extension";
    }
    else {
      // echo "Image successfully uploaded <br>";
    }

    move_uploaded_file($_FILES[$pic]['tmp_name'], $dirpath.$_FILES[$pic]['name']);

    // get image from the server
    $image = $dirpath.$_FILES[$pic]['name'];
    return $image;
  }
}
?>
