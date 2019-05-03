<?php

// Create connection
$conn = mysqli_connect("mysql", "root", "tiger", 'Marketplace');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Products WHERE ID_Vendeur=?;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt,$sql)) {
  header("Location: index.php?error=SQLError");
  exit();
}
else {

  // send to db with user info
  mysqli_stmt_bind_param($stmt,"s",$_SESSION['id']);
  mysqli_stmt_execute($stmt);
  // to fetch data to db
  $result = mysqli_stmt_get_result($stmt);
}


 ?>
