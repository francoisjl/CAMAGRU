<?php
require_once('includes_session.php');
if ($_SESSION['valide'] != 'ok') {header('Location: login.php');}
require_once('head.php');
require_once('header.php');
$CView = new CPrint();
$CSession = new CSession();
$CForm = new CForm;
//print('<div id="main">');

	$Id = $_SESSION['Id'];

	$taille_img = ' width="150px" height="auto" ';
	print('<div id="div_galerie">');

	// important sinon erreur javascript sur le constructor
	print("<div style=\"display:none\"  id=\"div_video\"><video id=\"video\" width=\"100px\" height=\"50px\"></video></div>");
	print('</div>'); // div  galerie

	print('<div id="div_galerie_cmt">');

	//$CView->div('form_cmt','');
	//print("<div id=\"div_form_cmt\">");// style=\"display:none\" >");
	$CView->div('div_form_cmt','');
	$CView->titre('Votre Commentaire');

	print "<textarea id=\"send_comment\" rows=\"4\" cols=\"35\" placeholder=\"Saisissez votre commentaire\"></textarea>";
	print("<div id=\"div_send_cmt\"><button id=\"btn_send_cmt\" onclick=\"traitement.send_comment($Id, 'div_cmt');\">Envoyer</button></div>");
	$CView->div_end(); // form_cmt

	//$CView->div('div_cmt','');
	print("<div id=\"div_cmt\">");// style=\"display:none\" >");
	$CView->content('Cliquez sur une photo <br/>&bull; pour voir les commentaires des utilisateurs<br />&bull; pour Liker et envoyer votre commentaire ', 'content');
	$CView->div_end(); // div_cmt

	print('</div>'); // div  div_galerie_cmt
	print('</div>'); // div  galerie

//print('</div>'); // fin div main

print '<script src="js_camera.js" type="text/javascript"></script>';
//print '<script src="js_galerie.js" type="text/javascript"></script>';
//print '<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>';
print "<script>traitement.display_galerie(1, 'div_galerie');</script>";
include ('footer.php');
?>
