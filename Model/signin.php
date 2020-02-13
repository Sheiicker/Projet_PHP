<?php
$link = mysqli_connect('localhost', 'vm950914', 'vm950914', 'vm950914');
$Date=$_POST['logAGE'][8].$_POST['logAGE'][9].$_POST['logAGE'][5].$_POST['logAGE'][6].$_POST['logAGE'][0].$_POST['logAGE'][1].$_POST['logAGE'][2].$_POST['logAGE'][3];
$logID=$_POST['logID'];
$logMDP=$_POST['logMDP'];
$logMAIL=$_POST['logMAIL'];
$sql_insert="insert INTO user (owner, user, pseudo, mdp, mail, age, money) VALUES (0,1,'".$logID."','".$logMDP."','".$logMAIL."','".$Date."',0);";
// $sql_insert="insert INTO user (login_user, mdp) VALUES (login_user,mdp);";
// echo $sql_insert."<br/>";
if (!$link->query($sql_insert)) {
  if ($link->errno=="1062"){
    header('Location:./index.php?page=account&error=1062');
  } else {
    echo "Echec lors de la création de la table : (" . $link->errno . ") " . $link->error."<br/>",
    "Envoyez cette erreur a l'administrateur pour qu'il corrige tout ça et vous récompense...";
    header('Location:./index.php?page=account');
  }
} else {
  echo "<p>Utilisateur $logID enregistré.</p>",
  "<a href='./index.php?page=account'>Essayez de vos log in !</a>";
  header('Location:./index.php?page=account');
}

// // REGISTER A USER
// $users = fopen($usersfile, "a") or die("Unable to open file!");
// fwrite($users, "0"."Ø × ƒ".$_POST["logID"]."Ø × ƒ".$_POST["logMDP"]."Ø × ƒ".$_POST["logMAIL"]."Ø × ƒ".$_POST["logDATE"]."\n");
// fclose($users);
// echo "Sign sucessful";
//
// // READ
// $handle = fopen($usersfile, 'r');
// $data = fread($handle,filesize($usersfile));
// // $parts = explode("\n",$data);
// // for ($i=0; $i < count($parts) ; $i++) {
// //   echo "<p>".$parts[$i]."</p>";
// // }
//
// // CLEAR FILES
//
// // $users = fopen($usersfile, "w") or die("Unable to open file!");
// // fwrite($users,$save);
//
// $_GET["page"]='account';
// include("index.php");
?>
