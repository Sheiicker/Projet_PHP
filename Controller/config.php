<?php

//Settings DB
// echo $db->dbh;

$pagename = basename($_SERVER['PHP_SELF']);
define("NBMENU","4");
$menu = array(
    1 => array(
      'page' => 'accueil',
      'titre' => 'Home',
    ),
    2 => array(
      'page' => 'shopping',
      'titre' => 'Shopping',
    ),
    3 => array(
      'page' => 'enchereencours',
      'titre' => 'Enchères en cours',
    ),
    4 => array(
      'page' => 'account',
      'titre' => 'Account',
    ),
);

global $dir;
global $files;

$dir    = '../uploads';
$files = scandir($dir);
$pagename = str_replace('.php', '', $pagename);
// $link = mysqli_connect('localhost', 'vm950914', 'vm950914', 'vm950914')
// or die ("Impossible de se connecter : ".mysqli_error());
// echo "Connexion reussi";
// mysqli_select_database('db_name') or die ("Impossible d'effectuer la requete") ;
// $resultat_sql=mysqli_query($link,$chaine_sql_select);
// mysqli_close($link)

$id = 1;
if (isset($_GET["page"])){
  for ($i=0;$i<NBMENU;$i++) {
    if ($_GET["page"]==$menu[$i+1]["page"]){
      $id = $i+1;
    }
  }
}

$m=$menu[$id];

session_start();
include("Model/login.php");
if (isset($logged) && $logged==false) {
  $_GET["page"]="account";
}


if (isset($admin) && $admin==true && $m['page']=='account') {
  $m['page']='account2';
  $_GET["page"]="account2";
}
// LES FONCTIONS AVAILABLES

// Affichage supression d'un fichier
function remove(){
  print_r('Deleting file<br/>');
}

// Affichage de l'ip de l'utilisateur
function ip(){
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
      $ip = $_SERVER['REMOTE_ADDR'];
  }
  print_r($ip);
}

function debug($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug: " . $output . "' );</script>";
}

function signinerror($error) {
  switch ($error) {
    case '1062':
      echo 'Error: User already token';
      break;

    default:
      echo 'Error: Contact administrator for more informations';
      break;
  }
}

function recupimg($prodid,$style){
  $dir    = '../uploads';
  $files = scandir($dir);
  if ($style=="list"){
    $styleimg = "style='max-width:100px;height:100px;'";
  } else {
    $styleimg = "style='max-width:500px;width100%;float:left;'";
  }

  // PRINTS ALL FILES AND DELETE THEM *****************************
  // for ($i=0; $i < count($files); $i++) {
  //     if ($i>1) {
  //         print_r('Deleting file '.$files[$i].'<br/>');
  //         unlink($dir.'/'.$files[$i]);
  //     }
  // }

  // DISPLAY SHOP IN DIV *****************************
  for ($i=0; $i < count($files); $i++) {
    if ($i>1) {
      if (explode('_', $files[$i])[0]==$prodid) {
        $pieces = explode('_', $files[$i])[1];
        echo "<img ".$styleimg." src='../uploads/".$files[$i]."' alt='".$files[$i]."'>";
      }

    }
  }
}

function getvarprod($prod){
  $dir = '../uploads';
  $files = scandir($dir);
  $o=0;
  for ($i=2; $i < count($files); $i++) {
    $produrl = explode('_', $files[$i])[0];
    // echo '<p>'.$files[$i].'</p>';
    $prodname = explode('_', $files[$i])[1];
    if ($prod==$produrl) {
      $o=$o+1;
      global $prod;
      global $prodid;
      $prod=$prodname;
      $prodid=$produrl;
    }
  }
  global $prodname;
  $prodname=explode('.',$prod)[0];
}

// mysql_free_result($result);
?>
