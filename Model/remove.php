<?php
  include('db_connect.php');
  $dir = '../../uploads';
  $_POST['remove'] = str_replace('%20', ' ', $_POST['remove']);
  unlink($dir.'/'.$_POST['remove']);
  echo 'File '.$_POST['remove']." have been deleted.";
  // echo explode('_',$_POST['remove'])[0];
  $prodID=explode('_',$_POST['remove'])[0];
  try {$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbh->beginTransaction();
  $dbh->exec('DELETE FROM sell WHERE id='.$prodID.';');
  $dbh->commit();
} catch (Exception $e) {
  $dbh->rollBack();
  echo "\nLa poste a pas fait le taff...Echec lors de la suppression du produit : " . $e->getMessage();
}

?>
