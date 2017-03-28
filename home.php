<?php
require_once('includes_session.php');
if ($_SESSION['valide'] != 'ok') {header('Location: login.php');}
require_once('head.php');
$Id = $_SESSION['Id'];
require_once('header.php');
$CPrint = new CPrint;
//$CPrint = new CPrint();
print('<div id="main">');
?>
<style> 
#video { border: 1px solid #000000;margin : 0;}
#canvas { border: 1px solid #000000;margin : 0;}
.btn { padding: 5px; margin: 10px;}
</style>
<?php

$W = "480px";
$H = "360px";

print "<form method='post' accept-charset='utf-8' name='form1'>";
print "<input name='hidden_data' id='hidden_data' type='hidden'/>";
print "<input name='hidden_fond' id='hidden_fond' type='hidden'/>";
//print "<input name='hidden_file' id='hidden_file' type='hidden'/>";
print "<img id=\"img_file\" src=\"\"  style=\"display:none\" width=\"480px\" height=\"360px\"></img>";
//print "<input name='hidden_id' id='hidden_id' type='hidden' value='$Id'/>";
print "</form>";

print '<div id="div_video_fond">';
print("<div  id=\"div_video\"><video id=\"video\" width=\"$W\" height=\"$H\"></video></div>");
print("<div  id=\"div_fond\" width=\"$W\" height=\"$H\"><p id=\"div_fond_text\">Choisir votre fond<p></div>");
print("<div  id=\"div_canvas\"><canvas style=\"display:none\" width=\"480px\" height=\"360px\"  id=\"canvas\"></canvas></div>");

print '</div>'; // fin div div_video_fond
//print('<div id="draw" style="display:none"><button id="btn_draw" onclick="traitement.draw(\'fond01\');">Prendre une photo</button></div>');
print("<div id=\"draw\" style=\"display:none\"><button id=\"btn_draw\" onclick=\"traitement.draw($Id);\">Prendre une photo</button></div>");
print("<div id=\"activer_camera\" style=\"display:none\"><button id=\"btn_cam\" onclick=\"traitement.camera($Id);\">Revenir à la caméra</button></div>");
print '<div id="div_transfert" style="display:none">';
print "<input type=\"file\" id=\"inputfile\" value=\"Transfert\" class=\"hidden\" onchange=\"traitement.draw_file($Id);\"  value=\"Transférer un Fichier...\" />";
print '</div>';

$dir_fonds = "fonds";
$listfond = scandir ('fonds');
$taillefond = ' width="51px" ';
print("<div id=\"fonds\" width=\"$W\">");


$compteur = 0;
foreach ( $listfond as $key => $value)
{
	if (substr($value, -4) == '.png')
	{
		if ( ++$compteur > 9 )  { print '<br />'; $compteur = 0; }
		$id = substr($value, 0, strlen($value)-4);
		
		 if ($key < 19 )print '<img onclick="traitement.changefond('."'".$id."')".'" '.$taillefond.'id="'.$id.'" class="img_fond" src="fonds/'.$value.'"> ';
	}

}

print('</div>'); // div fonds
print ('<div id="msg_fonds">');
$CPrint->content(' Choisissez votre fond avant de prendre la photo', 'content');
print ('</div>');
print('</div>'); // fin div main

// afficher les images crees sur le serveur
$dir_user = "upload/user_".$Id.'/';
if (!is_dir($dir_user)) mkdir($dir_user, 0700);
$list_img = scandir ($dir_user, SCANDIR_SORT_DESCENDING);
$taille_img = ' width="100px" ';
print('<div id="user_imgs">');
foreach ( $list_img as $key => $value)
{
	if (substr($value, -4) == '.png')
	{
		$id = substr($value, 0, strlen($value)-4);
		$id_div = $id;
		$id_photo = $id;
		print "<div id=\"$id_div\"><img class=\"user_img\" onclick=\"traitement.delete_img_usr($id_photo, $id_div)\" $taille_img id=\"img$id_photo\" src=\"$dir_user$value\"></div>"; //delete_img_usr(id_photo, id_div)
	}

}
print('</div>'); // div  user_imgs
print('<div id="user_texte">');
$CPrint->content('<b>Prise de photos</b><br />Choisissez un fond en premier, un bouton apparaitra pour prendre votre photo et la stocker dans votre espace privé', 'notice');
$CPrint->content('<b>Supprimer des photos</b><br />Cliquez sur une photo et confirmer la suppression si souhaité', 'notice');
$CPrint->content('<b>Sans Caméra</b><br />Si vous n\'avez pas de caméra le transfert de fichier jpg est envisageable, à l\'aide du bouton \'Transférer un Fichier..\' une fois le fond choisi', 'notice');

print('</div>'); // div  user_texte
print '<script src="js_camera.js" type="text/javascript"></script>';

include ('footer.php');
?>
