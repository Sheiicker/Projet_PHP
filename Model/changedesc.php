<?php
session_start();
include('db_connect.php');
include('login.php');
$prod=$_POST['prod'];
$desc=$_POST['desc'];
if (isset($admin) && ($admin==true)){
  print_r('UPDATE sell SET comment="'.$desc.'" WHERE id='.$prod.';');
  $link->query('UPDATE sell SET comment="'.$desc.'" WHERE id='.$prod.';');
}
?>
