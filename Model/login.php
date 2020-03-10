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
  $sql_verify_log = "select pseudo from user where pseudo='".$logID."';";
  // $sql_insert="insert INTO user (pseudo, mdp) VALUES (pseudo,mdp);";
  // echo $sql_verify_log."<br/>";
  $query = mysqli_query($link,$sql_verify_log);
  $nbresultat = mysqli_num_rows($query);
  if ($nbresultat==0) {
    echo "Echec lors de la connection : Nom d'utilisateurs inconnu";
    $result="unset";
  } else {
    $sql_verify_mdp = "select mdp from user where pseudo='".$logID."' AND mdp='".$logMDP."';";
    // echo $sql_verify_mdp."<br/>";
    $querymdp = mysqli_query($link,$sql_verify_mdp);
    $nbmdp = mysqli_num_rows($querymdp);
    if ($nbmdp==0) {
      $result="wrong";
    } else {
      $val = mysqli_query($link, "select * from user WHERE pseudo='".$logID."' AND mdp='".$logMDP."';");
      $fetch=mysqli_fetch_assoc($val);
      if($fetch["owner"]==1){
        $result="adminlogged";
      } elseif ($fetch["user"]==1) {
        $result="logged";
        $money=$fetch["money"];
        $_SESSION['money']=$money;
      } else {
        $result="guest";
      }
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
