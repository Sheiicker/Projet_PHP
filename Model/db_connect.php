<?php
$dbhost = 'localhost';
$dbuser = 'vm950914';
$dbuser = 'vm950914';
$dbpass = 'vm950914';

// TEST DE LA BONNE FONCTION DE LA BASE DE DONNEE
try {
  $dbh = new PDO('mysql:host=localhost;dbname=vm950914', $dbuser, $dbpass);
} catch(Exception $e) {
  echo 'Erreur : '.$e->getMessage().'<br />';
  echo 'N° : '.$e->getCode();
  exit();
}

// AJOUT DU CHEMIN DE LA BD

//Permet a js d'appeler une fonction php par ajax
if (isset($_POST['func'])==true){
  session_start();
  $dbh = new PDO('mysql:host=localhost;dbname=vm950914', $dbuser, $dbpass);
  call_user_func($_POST['func'],$dbh);
} else {
  $dbh = new PDO('mysql:host=localhost;dbname=vm950914', $dbuser, $dbpass);
}

// Afficher les données en fonctions de leurs emplacement
// $nombre_changement=$dbh->query("SELECT * FROM user WHERE 1");
// while ($val = $nombre_changement->fetch()) {
//   echo $val[2]."<br />";
// }

//Afficher un seul résultat ->>> NE MARCHE PAS AVEC PLUSIEURS CAR LE CURSEUR EST UTILISABLE UNE SEULE FOIS
// $resultats=$dbh->query("SELECT * FROM user WHERE pseudo='vm950914'");
// $resultats->setFetchMode(PDO::FETCH_OBJ);
// echo 'Utilisateur : '.$resultats->fetch()->pseudo.'<br />';


// while ($rows = $resource->fetch_assoc()) {
$veriflog_prepare=$dbh->prepare("SELECT * FROM user WHERE pseudo = :id");
$verifmdp_prepare=$dbh->prepare("SELECT mdp FROM user WHERE pseudo = :id AND mdp = :mdp");
$test_prepare=$dbh->prepare("SELECT * FROM user WHERE pseudo = 'vm950914'");

//echo $test_prepare->execute();

function imglog($dbh) {
  $productname=explode("_",$_POST['prodname'])[0];
  $user=$_SESSION['logID'];
  $time=$_POST['time'];
  try {$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->beginTransaction();
    $dbh->exec("insert INTO sell (id, name, user_pseudo, comment) VALUES (".$time.",'".$productname."','".$user."', 'There is no comments for this.');");
    $dbh->commit();
    echo "Le produit est maintenant en vente !";
  } catch (Exception $e) {
    $dbh->rollBack();
    echo "\nLa poste a pas fait le taff...Echec lors de la création du produit :"  . $e->getMessage();
  }
}

function imgup ($dbh){
  $imgup=$dbh->query('SELECT * FROM sell ORDER BY id DESC');
  $imgup->setFetchMode(PDO::FETCH_OBJ);
  return $imgup->fetch()->id;
}

function getusers($dbh){
  $resultats=$dbh->query("SELECT * FROM user WHERE 1");
  $resultats->setFetchMode(PDO::FETCH_OBJ);
  while( $ligne = $resultats->fetch()){
    echo 'Utilisateur : '.$ligne->pseudo.'<br />'; // on affiche les membres
  } $resultats->closeCursor();
}

function getdesc($dbh,$id){
  $resultats=$dbh->query('SELECT * FROM sell WHERE id='.$id.';');
  $resultats->setFetchMode(PDO::FETCH_OBJ);
  while( $ligne = $resultats->fetch()){
    echo $ligne->comment;
  } $resultats->closeCursor();
}

function getmises($dbh,$user,$prodid){
  $resultats=$dbh->query('SELECT * FROM bets WHERE user_pseudo="'.$user.'" AND id_prod="'.$prodid.'" ORDER BY amount;');
  $resultats->setFetchMode(PDO::FETCH_OBJ);
  while( $ligne = $resultats->fetch()){
    echo $ligne->amount;
    echo " - ";
  } $resultats->closeCursor();
}

function takemoney($dbh,$money,$num,$logID){
  try {$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbh->beginTransaction();
  $dbh->exec('UPDATE user SET money='.($money-$num).' WHERE pseudo="'.$logID.'"');
  $dbh->commit();
} catch (Exception $e) {
  $dbh->rollBack();
  echo "\nUne erreur est survenue.." . $e->getMessage();}
}

function bet($dbh,$num,$prod,$logID){
  try {$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbh->beginTransaction();
  $dbh->exec("insert INTO bets (user_pseudo, id_prod, amount) VALUES ('".$logID."','".$prod."','".$num."');");
  $dbh->commit();}
 catch (Exception $e) {
  $dbh->rollBack();
  echo "\nUne erreur est survenue.." . $e->getMessage();}
}

function meta_input($dbh,$min="",$max=""){
  $resultats=$dbh->query("select * from input ORDER BY ordre");
  $resultats->setFetchMode(PDO::FETCH_OBJ);
  while( $ligne = $resultats->fetch()){
// echo $row->typecase;
    $ordre=$ligne->ordre;
    $name=$ligne->name;
    $id=$ligne->id;
    $typecase=$ligne->typecase;
    $type=$ligne->type;
    $onchange=$ligne->onchange;
    $value=$ligne->value;
    $href=$ligne->href;
    $label=$ligne->label;
    $required=$ligne->required;
    $minlength=$ligne->minlength;
    $maxlength=$ligne->maxlength;
    if ($ordre>=$min && $ordre<=$max) {
     switch ($typecase) {
       case 'text':
       echo "<p>".$label."<input id='".$id."' ".$required." minlength='".$minlength."' maxlength='".$maxlength."' type='".$type."' name='".$name."' value='".$value."'/></p>";
       break;
       case 'a':
       echo "<a id='".$id."' href='".$href."'>".$label."</a></span>";
       break;
     }
    }
  } $resultats->closeCursor();
}

function admingetusers($dbh){
  $resultats=$dbh->query("SELECT * FROM user WHERE 1");
  $resultats->setFetchMode(PDO::FETCH_OBJ);
  while( $ligne = $resultats->fetch()){
    echo '<tr>',
    '<td class="adminusers">'.$ligne->pseudo.'</td>',
    '<td class="adminusers">'.$ligne->money.'</td>',
    '<td class="adminaddmoney" onclick="addmoney(event)">Ajout $5</td>',
    '<td class="adminaddmoney" onclick="takemoney(event)">Retrait $5</td>',
    '</tr>';
  } $resultats->closeCursor();
}


// POUR MYSQLI
//
// $link = mysqli_connect('localhost', 'vm950914', $user, $pass)
// or die ("Impossible de se connecter : ".mysqli_error());
// function getusers($link){
//   $resource = $link->query('SELECT * FROM user WHERE 1');
//   while ( $rows = $resource->fetch_assoc() ) {
//       echo"{$rows['pseudo']}<br/>";
//   }
// }
//
// function getdesc($link,$id){
//   $resource = $link->query('SELECT * FROM sell WHERE id='.$id.';');
//   while ( $rows = $resource->fetch_assoc() ) {
//       echo"{$rows['comment']}";
//   }
// }
//
// function getmises($link,$user,$prodid){
//   $resource = $link->query('SELECT * FROM bets WHERE user_pseudo="'.$user.'" AND id_prod="'.$prodid.'" ORDER BY amount;');
//   while ( $rows = $resource->fetch_assoc() ) {
//       echo "{$rows['amount']}";
//       echo " - ";
//   }
// }
//
// function takemoney($link,$money,$num,$logID){
//   $sql_update='UPDATE user SET money='.($money-$num).' WHERE pseudo="'.$logID.'"';
//   if (!$link->query($sql_update)) {
//     // debug("<p>Utilisateur $_POST['logID'] enregistré.</p>",
//     echo "\nUne erreur est survenue..";
//     print_r($sql_update);
//   }
// }
//
// function bet($link,$num,$prod,$logID){
//   $sql_insert="insert INTO bets (user_pseudo, id_prod, amount) VALUES ('".$logID."','".$prod."','".$num."');";
//   if (!$link->query($sql_insert)) {
//     // debug("<p>Utilisateur $_POST['logID'] enregistré.</p>",
//     echo "\nUne erreur est survenue..";
//     print_r($sql_update);
//   }
// }
//
// function meta_input($link,$min="",$max=""){
//   // echo "Hello";
//   $select = mysqli_query($link,"select * from input ORDER BY ordre");
//   while ($row = mysqli_fetch_object($select)) {
//     // echo $row->typecase;
//      $ordre=$row->ordre;
//      $name=$row->name;
//      $id=$row->id;
//      $typecase=$row->typecase;
//      $type=$row->type;
//      $onchange=$row->onchange;
//      $value=$row->value;
//      $href=$row->href;
//      $label=$row->label;
//      $required=$row->required;
//      $minlength=$row->minlength;
//      $maxlength=$row->maxlength;
//      if ($ordre>=$min && $ordre<=$max) {
//        switch ($typecase) {
//          case 'text':
//          echo "<p>".$label."<input id='".$id."' ".$required." minlength='".$minlength."' maxlength='".$maxlength."' type='".$type."' name='".$name."' value='".$value."'/></p>";
//          break;
//          case 'a':
//          echo "<a id='".$id."' href='".$href."'>".$label."</a></span>";
//          break;
//        }
//      }
//   }
// }

?>
