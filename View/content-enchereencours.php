<div class="wrapper">
<?php



  // PRINTS ALL FILES AND DELETE THEM *****************************
  // for ($i=0; $i < count($files); $i++) {
  //     if ($i>1) {
  //         print_r('Deleting file '.$files[$i].'<br/>');
  //         unlink($dir.'/'.$files[$i]);
  //     }
  // }

  // DISPLAY SHOP IN DIV *****************************
  if (isset($_GET['produit'])){
    getvarprod($_GET['produit']);
    if (isset($prod)==false || $o=0):?>
      <h1>La fiche du produit n'a pas été trouvée. Contactez l'administrateur.</h1>
    <?php else :?>
      <h1>Fiche Produit de <?=$prodname?></h1>
      <div class="flex">
        <?=recupimg($prodid,"big");?>
        <?php if (isset($admin) && ($admin==true)){ ?>
          <textarea onchange="changedesc(<?=$prodid?>)"><?=getdesc($link,$prodid);?></textarea>
        <?php } else { ?>
          <p><?=getdesc($link,$prodid);?></p>
        <?php }?>
      </div>
      <?php if(isset($user) && $user==true && $admin==false): ?><p><b id='mon'>Vous avez $<?=$money?></b></p>
      <p>Vos mises actuelles sur ce produit:</p>
      <p id='mise'><?=getmises($link,$logID,$prodid)?></p>
      <fieldset>
        <legend>Miser</legend>
        <input id='m1' min="0.10" type="number" step="0.01"></input>
        <a class="mise" onclick='mise()'>Miser !</a>
      </fieldset>
      <fieldset>
        <legend>Miser avec une plage</legend>
        <input id='mr1' min="0.10" onchange="mr1()" type="number" step="0.01"></input>
        <input id='mr2' min="" type="number" step="0.01"></input>
        <a class="mise" onclick='rangemise()'>Miser dans cette plage !</a>
      </fieldset>
      <?php endif;?>
    <?php endif;
  } else {
    include("View/content-shopping.php");
  }


  // REMOVE ALL FILES *****************************
  // print_r('Will be removed');
  // for ($i=0; $i < count($files); $i++) {
  //   print_r($files[$i].'<br/>');
  // }

  // REMOVE FOLDER *****************************
  // rmdir('uploads');


?>
</div>
