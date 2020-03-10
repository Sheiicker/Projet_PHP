<?php
$link = mysqli_connect('localhost', 'vm950914', 'vm950914', 'vm950914')
or die ("Impossible de se connecter : ".mysqli_error());

function getusers($link){
  $resource = $link->query('SELECT * FROM user WHERE 1');
  while ( $rows = $resource->fetch_assoc() ) {
      echo"{$rows['pseudo']}<br/>";
  }
}

function getdesc($link,$id){
  $resource = $link->query('SELECT * FROM sell WHERE id='.$id.';');
  while ( $rows = $resource->fetch_assoc() ) {
      echo"{$rows['comment']}";
  }
}

function getmises($link,$user,$prodid){
  $resource = $link->query('SELECT * FROM bets WHERE user_pseudo="'.$user.'" AND id_prod="'.$prodid.'" ORDER BY amount;');
  while ( $rows = $resource->fetch_assoc() ) {
      echo "{$rows['amount']}";
      echo " - ";
  }
}

function takemoney($link,$money,$num,$logID){
  $sql_update='UPDATE user SET money='.($money-$num).' WHERE pseudo="'.$logID.'"';
  if (!$link->query($sql_update)) {
    // debug("<p>Utilisateur $_POST['logID'] enregistré.</p>",
    echo "\nUne erreur est survenue..";
    print_r($sql_update);
  }
}

function bet($link,$num,$prod,$logID){
  $sql_insert="insert INTO bets (user_pseudo, id_prod, amount) VALUES ('".$logID."','".$prod."','".$num."');";
  if (!$link->query($sql_insert)) {
    // debug("<p>Utilisateur $_POST['logID'] enregistré.</p>",
    echo "\nUne erreur est survenue..";
    print_r($sql_update);
  }
}
// echo "\nConnexion reussi\n";
// mysqli_select_database('vm950914') or die ("Impossible d'effectuer la requete") ;
// $resultat_sql=mysqli_query($link,$chaine_sql_select);
// mysqli_close($link);
// vm950914@aragon
// mysql -u vm950914 -p
// use vm950914

?>
