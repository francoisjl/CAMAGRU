<?php
require_once('includes_session.php');
if ($_SESSION['valide'] != 'ok') {header('Location: login.php');}
if ( $_SESSION["email"] != 'dominique@lievre.net' ) exit;
require_once('head.php');
require_once('header.php');

$CPrint = new CPrint;
$CSession = new CSession;
print('<div id="main">');

$CPrint->titre('Liste des users');
$CSession->user_list();

// afficher les chmod
$listfile = scandir (getcwd());
$result = array();
foreach ( $listfile as $key => $file)
	$result[$file] = substr(sprintf('%o', fileperms($file)), -4);

$CPrint->titre('CHMOD Fichiers');
$CPrint->content_array($result, 'form');

print('</div>');	
include ('footer.php');
?>