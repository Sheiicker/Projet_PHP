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
    echo "mise";
  } else {
    echo "no money";
  }
}

function rangemise(){
  $link = mysqli_connect('localhost', 'vm950914', 'vm950914', 'vm950914')
  or die ("Impossible de se connecter : ".mysqli_error());

  $logID=$_SESSION['logID'];
  $money=$_SESSION['money'];
  $prod=$_POST['prod'];
  $num1=$_POST['num1'];
  $num2=$_POST['num2'];
  $num=0;
  $list=[];
  for ($i=$num1;$i<=$num2;){
      array_push($list,$i);
      $i=$i+0.01;
      $num=$num+$i;
  }

  if ($money>=$num) {
    foreach ($list as $elem) {
      takemoney($link,$money,$elem,$logID);
      $money=$money-$elem;
      bet($link,$elem,$prod,$logID);
    }
    echo "mise";
  } else {
    echo "no money";
  }
}
?>
