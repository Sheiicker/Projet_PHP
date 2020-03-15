<?php
session_start();
include('db_connect.php');
include('login.php');
$productname=explode("_",$_POST['prodname'])[0];
$user=$_SESSION['logID'];
$time=$_POST['time'];
$sql_insert="insert INTO sell (id, name, user_pseudo, comment) VALUES (".$time.",'".$productname."','".$user."', 'There is no comments for this.');";
// $sql_insert="insert INTO user (login_user, mdp) VALUES (login_user,mdp);";
// echo $sql_insert."<br/>";
if (!$link->query($sql_insert)) {
  echo "La poste a pas fait le taff...Echec lors de la création du produit : (" . $link->errno . ")",
  $sql_insert;
} else {
  echo "Le produit est maintenant en vente !";
}
?>
