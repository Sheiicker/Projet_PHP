<?php

include('db_connect.php');

$arr_file_types = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg'];

if (!(in_array($_FILES['file']['type'], $arr_file_types))) {
  echo "false";
  return;
}

if (!file_exists('../../uploads')) {
  mkdir('../../uploads', 0775);
}

$time = imgup($dbh);

$dir    = '../../uploads';
$files1 = scandir($dir);
for ($i=0; $i < (count($files1)-1); $i++) {
}
move_uploaded_file($_FILES['file']['tmp_name'], '../../uploads/' . $time . '_' . $_FILES['file']['name']);
chmod('../../uploads/' . ($i) . '_' . $_FILES['file']['name'],0777);
echo $_POST['froz'];
echo "File uploaded successfully.";
?>
