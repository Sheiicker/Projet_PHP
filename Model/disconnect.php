<?php
session_start();
session_unset('logID');
session_destroy();
header('Location:../index.php');
exit();
?>
