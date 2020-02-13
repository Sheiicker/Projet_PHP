<div class="wrapper">
  <?php if (isset($admin) && ($admin==true)) :?>
    <h1>Glissez l'image de votre enchère dans ce drop ou choisissez-la</h1>
    <div id="gallery"></div>
    <form class="my-form">
      <input type="file" id="fileElem" multiple onchange="handleFiles(this.files)">
      <label class="button" id="dragonme" for="fileElem" onchange="drop(event)" ondrop="drop(event)" ondragover="allowDrop(event)">
        <p>Drop your picture</p>
      </label>
    </form>
    <div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
  <?php else :?>
    <h1>Seuls les administrateurs sont autorisés à déposer des objets</h1>
    <p>Les enchères inversées sont basées sur le principe opposé aux enchères classiques : dans l'enchère inversée, celui qui remporte la mise n'est pas celui qui propose le prix le plus élevé, mais celui qui offre le prix le plus bas.</p>
    <?php if (isset($user) && ($user==true)) : ?>
      <p>Vous êtes enregistré sous le nom de <b><?=$_SESSION["logID"]?></b>. Vous avez actuellement $<?=$money?> sur votre compte.</p>
    <?php else: ?>
      <p><b>Pour miser il vous faut être un utilisateur, enregistrez vous via la page account !</b></p>
    <?php endif;?>
  <?php endif;?>
  <?php
    // echo ip();
  ?>
</div>
