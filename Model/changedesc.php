<?php
session_start();
include('db_connect.php');
include('login.php');
$prod=$_POST['prod'];
$desc=$_POST['desc'];
if (isset($admin) && ($admin==true)){
  print_r('UPDATE sell SET comment="'.$desc.'" WHERE id='.$prod.';');
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbh->beginTransaction();
  $dbh->exec('UPDATE sell SET comment="'.$desc.'" WHERE id='.$prod.';');
  $dbh->commit();}
}
?>
