<div class="wrapper">
<?php if (isset($admin) && ($admin==false)) :?>
<input id="search" onchange="search(event)" type="text"></input>
<?php endif; ?>
  <!-- // PRINTS ALL FILES AND DELETE THEM *****************************
  // for ($i=0; $i < count($files); $i++) {
  //     if ($i>1) {
  //         print_r('Deleting file '.$files[$i].'<br/>');
  //         unlink($dir.'/'.$files[$i]);
  //     }
  // }

  // DISPLAY SHOP IN DIV ***************************** -->
  <div class='flex'>
  <?php
  for ($i=0; $i < count($files); $i++) {
    if ($i>1) { ?>
      <?php getvarprod(explode("_",$files[$i])[0]);
      if (isset($admin) && ($admin==true)){ ?>
        <div>
      <?php }?>
      <a href='?page=enchereencours&produit=<?=$prodid?>' class='shop' id='shop<?=$i?>'>
      <?=recupimg($prodid,"list");?>
      <?php if (isset($admin) && ($admin==true)){ ?>
        </a>
        <input style='text-align:center;' type='text' onchange='rename(event)' maxlength='25' value='<?=explode('.', $prod)[0]?>'/>
        <a class='remove' onclick='remove(event)'>Remove</a>
        </div>
      <?php } else { ?>
        <p><script>document.write('<?=$files[$i]?>'.split('_',2)[1].split('.jpg',1)[0])</script></p>
        </a>
      <?php }
    }?>
  <?php } ?>
  </div>


  <!-- // REMOVE ALL FILES *****************************
  // print_r('Will be removed');
  // for ($i=0; $i < count($files); $i++) {
  //   print_r($files[$i].'<br/>');
  // }

  // REMOVE FOLDER *****************************
  // rmdir('uploads'); -->


</div>
