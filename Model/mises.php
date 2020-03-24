<?php
include("db_connect.php");
function mise($dbh){
  $logID=$_SESSION['logID'];
  $money=$_SESSION['money'];
  $num=$_POST['num'];
  $prod=$_POST['prod'];
  if ($money>=$num) {
    takemoney($dbh,$money,$num,$logID);
    bet($dbh,$num,$prod,$logID);
    echo "mise";
  } else {
    echo "no money";
  }
}

function rangemise($dbh){
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
  array_push($list,$num2);
  $i=$i+0.01;
  $num=$num+$i;

  if ($money>=$num) {
    foreach ($list as $elem) {
      takemoney($dbh,$money,$elem,$logID);
      $money=$money-$elem;
      bet($dbh,$elem,$prod,$logID);
    }
    echo "mise";
  } else {
    echo "no money";
  }
}
?>
