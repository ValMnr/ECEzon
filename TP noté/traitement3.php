<?php
$X =isset($_POST["X"])?$_POST["X"] : "";
$Y =isset($_POST["Y"])?$_POST["Y"] : "";


$error ="";

if($X == "") {$error .="Valeur de X vide <br/>";}
if($Y == "") {$error .="Valeur de Y vide <br/>";}

if($error==""){

    if (isset($_POST['products'])) {
        # Publish-button was clicked
    }
    elseif (isset($_POST['colors'])) {
        # Save-button was clicked
    }
    
}
else{
    echo "Erreur : $error";
}
?>    