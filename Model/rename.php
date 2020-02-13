<?php
include('db_connect.php');
$url="../../uploads/";
$filename=$_POST["name"];
$filerename=$_POST["rename"];
rename ($url.$filename,$url.$filerename);
$name=explode(".",explode("_",$_POST["name"])[1])[0];
$rename=explode(".",explode("_",$_POST["rename"])[1])[0];
$sql_update='UPDATE sell SET name="'.$rename.'" WHERE name="'.$name.'";';
if (!$link->query($sql_update)) {
  echo "La poste a pas fait le taff...Echec du renommage du produit : (" . $link->errno . ")",$sql_insert;
} else {
  echo 'UPDATE sell SET name="'.$rename.'" WHERE name="'.$name.'";';
  echo "Le produit est maintenant renommé !";
}
?>
