<?php
$N =isset($_POST["nom"])?$_POST["nom"] : "";
$A =isset($_POST["age"])?$_POST["age"] : "";
$T =isset($_POST["telephone"])?$_POST["telephone"] : "";
$DN =isset($_POST["naissance"])?$_POST["naissance"] : "";

$error ="";

if($N == "") {$error .="Nom vide <br/>";}
if($A == "") {$error .="Age vide <br/>";}
if($T == "") {$error .="Telephone vide <br/>";}
if($DN == "") {$error .="Date de naissance vide <br/>";}

if($error=""){
    echo "formulaire valide";
}
else{
    echo "Erreur : $error";
}
?>      