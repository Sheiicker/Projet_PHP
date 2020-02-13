<?php
$page=$_GET["page"];
if (is_file('View/content-'.$page.'.php')==1){
  include 'View/content-'.$page.'.php';
} else {
  echo '<h1>ERREUR 404</h1>';
  echo '<p>La page: <strong>'.'content-'.$page.'</strong> n\'existe pas ou plus.</p>';
}
?>
