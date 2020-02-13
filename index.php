<!DOCTYPE html>
<html lang="fr">
<?php
  include 'head.php';
  include 'Model/db_connect.php';
  include 'Controller/config.php';
?>
<body>
  <?php include 'Model/menu.php'; ?>
  <div class="wrapper">
    <?php
      // if ($_GET["page"]=='accueil') {
      //   include 'content-accueil.php';
      // } elseif ($_GET["page"]=='shopping') {
      //   include 'content-shopping.php';
      // } elseif ($_GET["page"]=='account') {
      //   include 'content-account.php';
      // } else {
      //   echo 'ERREUR 404';
      // }
      include 'Model/choix_page.php';
     ?>
   </div>
</body>
<?php include 'Model/footer.php'; ?>
