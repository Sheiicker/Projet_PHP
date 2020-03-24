<?php
include("db_connect.php");
function adminaddmoney($dbh){
  $resultats=$dbh->query('SELECT * FROM user WHERE 1');
  $resultats->setFetchMode(PDO::FETCH_OBJ);
  while( $ligne = $resultats->fetch()){
    // print_r($ligne->pseudo."\n");
    // print_r($_POST["user"]."\n");
    $moneyadd=$_POST["money"];
    $moneynow=$ligne->money;
    $user=$_POST["user"];
    if ($user==$ligne->pseudo){
      try {$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->beginTransaction();
        $dbh->exec('UPDATE user SET money='.($moneyadd+$moneynow).' WHERE pseudo="'.$user.'"');
        $dbh->commit();
        print_r("\nL'argent a été versé.");
      } catch (Exception $e) {
        $dbh->rollBack();
        echo "\nUne erreur est survenue.." . $e->getMessage();
        print_r($sql_update);
      }
    }
  } $resultats->closeCursor();
}

function admintakemoney($dbh){
  $resultats=$dbh->query('SELECT * FROM user WHERE 1');
  $resultats->setFetchMode(PDO::FETCH_OBJ);
  while( $ligne = $resultats->fetch()){
    // print_r($ligne->pseudo."\n");
    // print_r($_POST["user"]."\n");
    $moneysupp=$_POST["money"];
    $moneynow=$ligne->money;
    $user=$_POST["user"];
    if ($user==$ligne->pseudo){
      try {$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->beginTransaction();
        $dbh->exec('UPDATE user SET money='.($moneynow-$moneysupp).' WHERE pseudo="'.$user.'"');
        $dbh->commit();
        print_r("\nL'argent a été versé.");
      } catch (Exception $e) {
        $dbh->rollBack();
        echo "\nUne erreur est survenue.." . $e->getMessage();
        print_r($sql_update);
      }
    }
  } $resultats->closeCursor();
}

?>
