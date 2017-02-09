<?php
session_start();

$stamp = mktime();
$folder_fond = 'fonds/';

$img = $_POST['hidden_data'];
$fond = $_POST['hidden_fond'].'.png';

$upload_dir = "upload/".'user_'.$_SESSION['Id'].'/';
if (!is_dir($upload_dir)) mkdir($upload_dir, 0700);
if (!$fond or !$_SESSION['Id']) exit;

$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$file = $upload_dir . $stamp . ".png";
$success = file_put_contents($file, $data);
//print $success ? $file : 'Unable to save the file.';

if (!$success) exit;
// fusion de l'image et du fond 

$dessous = imagecreatefrompng($file); //on ouvre l'image source
$dessus = imagecreatefrompng($folder_fond.$fond); //on ouvre l'image source
$infosize = getimagesize($file); // on recupere la taille dans un array
$width_dessous = $infosize[0];
$height_dessous = $infosize[1];

$dst_x = 0;
$dst_y = 0;
$src_x = 0;
$src_y = 0;
$src_w = $width_dessous;
$src_h = $height_dessous;

$result = imagecopy ( $dessous, $dessus, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h );

imagepng($dessous, $file); // on ecrit l'image traitee $dest vers le fichier $file

?>