<?php

// Create connection
$conn = mysqli_connect("mysql", "root", "tiger", 'Marketplace');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


 ?>
