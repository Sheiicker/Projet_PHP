<fieldset>
  <legend>Log in</legend>
  <form action="index.php" method="post">
    <?=meta_input($link,1,1);?>
    <span class='user'><?=$status?>
    <?php if(isset($logged) && $logged==true): ?>
      <a id='disconnect' title="disconnect" href='Model/disconnect.php'> Disconnect</a></span>
    <?php else: echo "</span>"; endif; ?>
    <?=meta_input($link,2,3);?>
  </form>
</fieldset>
<fieldset>
  <legend>Sign in</legend>
  <form action="./Model/signin.php" method="post">
    <?php if(isset($_GET['error'])) : ?><p><?=signinerror($_GET['error']);?></p><?php endif; ?>
    <?=meta_input($link,4,8);?>
  </form>
</fieldset>

<h2>Liste des utilisateurs:</h2>
<?=getusers($link);?>
<p></p>
