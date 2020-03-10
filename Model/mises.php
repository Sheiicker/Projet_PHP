<?php
session_start();
include('db_connect.php');
call_user_func($_POST['func']);

function mise(){
  $link = mysqli_connect('localhost', 'vm950914', 'vm950914', 'vm950914')
  or die ("Impossible de se connecter : ".mysqli_error());
  $logID=$_SESSION['logID'];
  $money=$_SESSION['money'];
  $num=$_POST['num'];
  $prod=$_POST['prod'];
  if ($money>=$num) {
    takemoney($link,$money,$num,$logID);
    bet($link,$num,$prod,$logID);
  } else {
    echo "no money";
  }
}

function rangemise(){
  echo $_POST['num1'];
  echo $_POST['num2'];
  echo $_POST['prod'];
}
?>
