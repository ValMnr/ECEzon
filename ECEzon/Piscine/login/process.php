<?php
// LOGIN
if (isset($_POST['login'])) {


    require 'login.inc.php';


    // varibles pour récupération des champs html
    // blindage
    $login = $_POST['login'];
    $password = $_POST['password'];

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

      $sql = "SELECT * FROM Account WHERE Mail=?;";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("Location: index.php?error=SQLError");
        exit();
      }
      else {

        // TODO: checker password




        // send to db with user info
        mysqli_stmt_bind_param($stmt,"s",$login);
        mysqli_stmt_execute($stmt);
        // to fetch data to db
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
          // check if pwd are equal
          $pwdcheck = password_verify($password,$row['Password']);
          if ($pwdcheck == false) {
            header("Location: index.php?error=WrongPassword");
            exit();
          } // fin if mauvais mot de passe
          elseif ($pwdcheck == true) {
            // LOGIN INTO THE SYSTEM
            // USE SESSION global variable
            session_start();
            $_SESSION['id'] = $row['ID'];
            $_SESSION['uid'] = $row['Mail'];
            $_SESSION['TypeCompte'] = $row['Type'];

            // display message
            $_SESSION['message'] = 'You are log in';
            $_SESSION['msg_type'] = 'success';

            if ($row['Type'] == 'Client') {
              // Log to client dashboard
              header("Location: /../site/account/client/infos/infos.html?success=LoginClient");
              exit();
            } // fin else if connection client
            elseif ($row['Type'] == 'Vendeur') {
              // Log to client dashboard
              header("Location: index.php?success=LoginVendeur");
              exit();
            } // fin elseif connection vendeur
            elseif ($row['Type'] == 'Admin') {
              // Log to client dashboard
              header("Location: index.php?success=LoginAdmin");
              exit();
            } // fin elseif connection admin
            else {
              header("Location: index.php?error=WrongAccount");
              exit();
            } // fin condition login account
          } // fin else if connection établie
          }
          else {
            header("Location: index.php?error=Cantfetch");
            exit();
          } // fin else mot de passe invalide
    } // fin else pas d'erreur sql
  } // fin else pas de mauvais champs
  $conn->close();
} // fin if button
else {
  header("Location: login.php?nothing");
  exit();
}
?>
