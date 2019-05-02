<?php
$V1 =isset($_POST["val1"])?$_POST["val1"] : "";
$V2 =isset($_POST["val2"])?$_POST["val2"] : "";
$OP = isset($_POST["oper"])?$_POST["oper"] : "";

if ($OP == "+"){$VF = $V1+$V2;}
if ($OP == "-"){$VF = $V1-$V2;}
if ($OP == "*"){$VF = $V1*$V2;}
if ($OP == "/"){$VF = $V1/$V2;}

$error ="";

if($V1 == "") {$error .="Valeur 1 vide <br/>";}
if($V2 == "") {$error .="Valeur 2 vide <br/>";}
if($OP == "") {$error .="Operateurnon défini <br/>";}

if($error==""){
    echo " <h1>L'operation demandée est : </h1>
    <h3>  $V1 $OP  $V2 = $VF    </h3>";
}
else{
    echo "Erreur : $error";
}
?>    