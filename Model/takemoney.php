<?php
  include('db_connect.php');
  // $link = mysqli_connect('localhost', 'vm950914', 'vm950914', 'vm950914')
  // or die ("Impossible de se connecter : ".mysqli_error());
  $resource = $link->query('SELECT * FROM user WHERE 1');
  while ( $rows = $resource->fetch_assoc() ){
    // print_r($rows["pseudo"]."\n");
    // print_r($_POST["user"]."\n");
    $moneyadd=$_POST["money"];
    $moneynow=$rows["money"];
    $user=$_POST["user"];
      if ($_POST["user"]==$rows["pseudo"]){
        $sql_update='UPDATE user SET money='.($moneynow-$moneyadd).' WHERE pseudo="'.$user.'"';
        if ($link->query($sql_update)) {
          print_r("\nL'argent a été retiré.");
        } else {
          // debug("<p>Utilisateur $_POST['logID'] enregistré.</p>",
          echo "\nUne erreur est survenue..";
          print_r($sql_update);
        }
      }
  }
?>
