<?php
include('db_connect.php');
  $url="../../uploads/";
  $filename=$_POST["name"];
  $filerename=$_POST["rename"];
  $id=explode("_",$_POST["name"])[0];
  $rename=explode("_",$_POST["rename"])[1];
try {$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbh->beginTransaction();
  $dbh->exec('UPDATE sell SET name="'.$rename.'" WHERE id="'.$id.'";');
  $dbh->commit();
  echo "Le produit est maintenant renommé !";
  rename ($url.$filename,$url.$filerename);
} catch (Exception $e) {
  echo 'UPDATE sell SET name="'.$rename.'" WHERE id="'.$id.'";';
  echo "\nLa poste a pas fait le taff...Echec du renommage du produit : (" . $e->getMessage();
  $dbh->rollBack();
}
?>
