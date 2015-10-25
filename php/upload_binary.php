<?php
//die(var_dump($_POST));
//print_r($_POST);
$img = $_POST['imgBase64'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$fileData = base64_decode($img);
//saving
$fileName = '../images/photo.png';
file_put_contents($fileName, $fileData);
echo $fileName
?>

