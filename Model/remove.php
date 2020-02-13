<?php
  include('db_connect.php');
  $dir = '../../uploads';
  $_POST['remove'] = str_replace('%20', ' ', $_POST['remove']);
  unlink($dir.'/'.$_POST['remove']);
  echo 'File '.$_POST['remove']." have been deleted.";
  // echo explode('_',$_POST['remove'])[0];
  $prodID=explode('_',$_POST['remove'])[0];
  $sql_delete='DELETE FROM sell WHERE id='.$prodID.';';
  if (!$link->query($sql_delete)) {
    echo "La poste a pas fait le taff...Echec lors de la suppression du produit : (" . $link->errno . ")",$sql_insert;
  } else {
    // echo "Le produit est maintenant supprimé de la vente !";
  }
?>
