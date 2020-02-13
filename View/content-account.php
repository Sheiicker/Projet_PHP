<fieldset>
  <legend>Log in</legend>
  <form action="index.php" method="post">
    <p>User : <input id="userlog" required type="text" name="logID"/></p>
    <span class='user'><?=$status?>
    <?php if(isset($logged) && $logged==true): ?>
      <a id='disconnect' href='Model/disconnect.php'> Disconnect</a></span>
    <?php else: echo "</span>"; endif; ?>
    <p>Password : <input id="passlog" required type="password" name="logMDP"/></p>
    <p><input type="submit" value="Submit"/>
  </form>
</fieldset>
<fieldset>
  <legend>Sign in</legend>
  <form action="Model/signin.php" method="post">
    <?php if(isset($_GET['error'])) : ?><p><?=signinerror($_GET['error']);?></p><?php endif; ?>
    <p>User : <input onchange="verif(event)" minlength="4" maxlength="15" required type="text" name="logID"/></p>
    <p>Password : <input required type="password" name="logMDP"/></p>
    <p>Email : <input required type="email" name="logMAIL"/></p>
    <p>Date of birth : <input required type="date" name="logAGE"/></p>
    <p><input type="submit" name="submit" value="Submit"/>
  </form>
</fieldset>

<h2>Liste des utilisateurs:</h2>
<?=getusers($link);?>
