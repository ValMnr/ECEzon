<?php


session_start();

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

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $conn->query("DELETE FROM Products WHERE id=$id") or die(mysqli_error($conn));

  $_SESSION['message'] = 'Record has been deleted';
  $_SESSION['msg_type'] = 'danger';

  header("location : DeleteProducts.php");
}
// To put into product.php to edit the table
if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $result = $conn->query("SELECT * FROM Products WHERE id=$id") or die(mysqli_error($conn));
  if (count($result)==1) {
    $row = $result->fetch_array();
    $name = $row['Nom'];
    $photo = $row['Photo'];
    $description = $row['Description'];
  }

  $_SESSION['message'] = 'Record has been deleted';
  $_SESSION['msg_type'] = 'danger';

  header("location : DeleteProducts.php");
}


$conn->close();

 ?>
