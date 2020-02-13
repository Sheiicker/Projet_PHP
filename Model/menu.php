<header>
  <?php
    if (isset($_GET['page'])==false) {
      $_GET['page']='accueil';
    }
  ?>
  <nav id="menu">
    <ul>
      <?php foreach( $menu as $menpage => $menlabel ) : ?>
        <li><a<?php if($menlabel["page"] == $_GET['page']){echo ' class="active"';} ?> href="<?php echo '?page='.$menlabel["page"] ; ?>"><?php echo $menlabel["titre"] ; ?></a></li>
      <?php endforeach ?>
    </ul>
  </nav>
  <?php

    if ($_GET["page"]!='account' && isset($logged) && $logged==true){
      echo "<p class='user'>".$status."<span><a id='disconnect' href='Model/disconnect.php'> Disconnect</a></span></p>";
    }
  ?>
</header>
