<?php

$result=false;
// READ

// echo $_POST['logID'];
// echo $_SESSION['logID'];

if (isset($_POST['logID']) && isset($_POST['logMDP'])){
  $logID= $_POST['logID'];
  $logMDP= $_POST['logMDP'];
} elseif (isset($_SESSION['logID']) && isset($_SESSION['logMDP'])){
  $logID= $_SESSION['logID'];
  $logMDP= $_SESSION['logMDP'];
}

if (isset($logID) && isset($logMDP)){
  $nbresultat = $veriflog_prepare->execute(array( 'id' => $logID ));
  if ($nbresultat==0) {
    echo "Echec lors de la connection : Nom d'utilisateurs inconnu";
    $result="unset";
  } elseif ($nbresultat>0) {
    $nbmdp = $verifmdp_prepare->execute(array( 'id' => $logID, 'mdp' => $logMDP ));
    if ($nbmdp==0) {
      $result="wrong";
    } else {
      $resultats=$dbh->query("select * from user WHERE pseudo='".$logID."' AND mdp='".$logMDP."';");
      $resultats->setFetchMode(PDO::FETCH_OBJ);
      while( $cur = $resultats->fetch()){
        if($cur->owner==1){
          $result="adminlogged";
        } elseif ($cur->user==1) {
          $result="logged";
          $money=$cur->money;
          $_SESSION['money']=$money;
        } else {
          $result="guest";
        }
      } $resultats->closeCursor();
      // echo "Connexion réussie";
    }
  }
}
// ALERT USER
switch ($result) {
  case 'adminlogged':
    $status="Hello my master ".$logID;
    $admin=true;
    $user=true;
    $logged=true;
    $_SESSION['logID']=$logID;
    $_SESSION['logMDP']=$logMDP;
    break;
  case 'logged':
    $status="You're logged in as ".$logID;
    $admin=false;
    $user=true;
    $logged=true;
    $_SESSION['logID']=$logID;
    $_SESSION['logMDP']=$logMDP;
    break;
  case 'guest':
    $status="You're logged in as ".$logID;
    $admin=false;
    $user=false;
    $logged=true;
    $_SESSION['logID']=$logID;
    $_SESSION['logMDP']=$logMDP;
    break;
  case 'wrong':
    $status="Wrong password";
    $admin=false;
    $user=false;
    $logged=false;
    break;
  case 'unset':
    $status="Unknown user";
    $admin=false;
    $user=false;
    $logged=false;
    break;
  case false:
    $status="Unlogged";
    $admin=false;
    break;
}

?>
