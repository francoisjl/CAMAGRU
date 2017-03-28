<?php
if(!isset($_SESSION)) {session_start();}
require_once('includes_session.php');
$CView = new CPrint();
$CSession = new CSession();
header('content-type : text/plain');
header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1';

$Err = 'Erreur ajx '.$_GET['action'];
$Id = $_SESSION['Id'];
$dir_user = "upload/user_".$Id.'/';

if( $_GET['action'] == 'refresh') // afficher les images crees sur le serveur
{
	
	if (!is_dir($dir_user)) mkdir($dir_user, 0700);
	$list_img = scandir ($dir_user, SCANDIR_SORT_DESCENDING);
	$taille_img = ' width="100px" ';
	//print('<div id="user_imgs">');
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
	$Err = '';
}

if( $_GET['action'] == 'display_galerie' && $_GET['no_page']) // afficher les images crees sur le serveur
{
	$actual_page = $_GET['no_page'];
	$_SESSION['actual_page'] = $actual_page;
	$Err = display_galerie($actual_page, $Id);
}


if( $_GET['action'] == 'delete') //  action=delete image
{
	$Id_img = $_GET['id_photo'];

	try {
		$rq = $CSession->secure("DELETE FROM photos WHERE Id_owner = $Id AND Name_img = '$Id_img'");
		
		$requete = $CSession->conn->prepare($rq); 
		$requete->execute();
		if ($requete)
		{	
			unlink($dir_user.$Id_img.".png");
			$retour = 'ok';
		}
		else
		{
			$retour = 'delete img err';
			exit;
		}
	}

	catch(PDOException $e)
	{ $retour = "delete img, Error Database : " . $e->getMessage();}
        //$conn = null;
	echo $retour;
	$Err = '';
}


if( $_GET['action'] == 'view_comment' && $_GET['image']) // action=view_comment 
{
	// afficher les comment images 
	$id_img = $_GET['image'];
	//print('<div id="div_galerie_cmt">');
	$CView->Titre('Commentaires des users');
	$prenom = $CSession->get_owner_image($id_img);

	$CView->content(' Image de : '.ucfirst($prenom).' Id '.$id_img.'<br />'.'<br />', 'content');
	$images_comment = $CSession->image_comment($id_img);
	if (!$images_comment) $images_comment['Aucun commentaire'] = ' ';
	foreach ($images_comment as $key => $value)
		if ($value) $CView->content('&bull; '.ucfirst($key).'<br />'.$value, 'content');
	$Err = '';
}

if( $_GET['action'] == 'nb_img_page' && $_GET['value']) // action=view_comment // ?action=nb_img_page'+'&value='+valeur;
{
	// changer le nb d'image par images 
	$no_page = $_SESSION['actual_page'];
	display_galerie($no_page, $Id);

	$Err = '';
}

if( $_GET['action'] == 'send_comment' && $_GET['image']  && $_GET['user_comment'] ) // action=send_comment 
{
	// mettre a jour les comment images 
	$id_img = $_GET['image'];
	$user_comment = $_GET['user_comment'];
	$comment = $_GET['comment'];
	// fait dans $cession $comment = addslashes ($comment);
	if (!$comment) $comment = '';
	if ( $user_comment == 'not selected') { echo 'ajax : image not selected'; exit; }
	$image_addcomment = $CSession->comment_add($id_img, $user_comment, $comment);

	if ( $image_addcomment == 'interdit') {echo 'interdit'; exit;}
	if ( $image_addcomment == 'comment_add' )
	{
		//print('<div id="div_galerie_cmt">');
		$CView->Titre('Commentaires des users');
		$images_comment = $CSession->image_comment($id_img);
		if (!$images_comment) $images_comment['Aucun commentaire'] = ' ';
		foreach ($images_comment as $key => $value)
			if ($value) $CView->content('&bull; '.ucfirst($key).'<br />'.$value, 'content');
		$Err = '';
	}
}

if( $_GET['action'] == 'send_like' && $_GET['image']  && $_GET['user_like'] ) // action=send_like 
{
	$id_img = $_GET['image'];
	$user_like = $_GET['user_like'];

	$image_addlike = $CSession->like_add($id_img, $user_like);
	
	if ( $image_addlike == 'interdit') {echo 'interdit'; exit;}

	if ( $image_addlike == 'like_add insert' || $image_addlike == 'like_add update')
		{
			$no_page = $_SESSION['actual_page'];
			display_galerie($no_page, $Id);
		}
	$Err = '';
}

echo $Err;

function display_galerie($no_page, $Id) // $_GET['action'] == 'display_galerie' && $_GET['no_page']) || $source == 'add_like'
{

	$CSession = new CSession();
	$CView = new CPrint();
	$images_galerie = $CSession->images_galerie();
	$taille_img = ' width="150px" height="auto" ';

	$nb_img_page = 8;
	$nb_img_base = count($images_galerie);
	$nb_pages = ceil ($nb_img_base / $nb_img_page);

	$actual_page = $no_page;
	$tranche_basse = strval($actual_page - 1 ) * $nb_img_page;
	$tranche_haute = ($actual_page * $nb_img_page) - 1;
	$page_previous = ( $actual_page >1 ? $actual_page -1 : '');
	$page_previousbis = ( $page_previous >1 ? $page_previous -1 : '');
	$page_next = ( $actual_page < $nb_pages ? $actual_page+1 : '');
	$page_nextbis = ( ($page_next < $nb_pages && $page_next ) ? $page_next+1 : '');

	foreach ($images_galerie as $key => $value) 
	{
		if ($key >= $tranche_basse and $key <= $tranche_haute)
		{
		$CView->div('','div_img_like_cmt');
		$CView->div('','div_img');
		$id_img = $images_galerie[$key]['Id'];
		$name_img = $images_galerie[$key]['Name_img'];
		$images_like = $CSession->image_nb_liked($name_img);
		if ($images_like > 0) $info_images_like = 'Like '.$images_like; else $info_images_like = '';
		$dir_user = 'upload/user_'.$images_galerie[$key]['Id_owner'].'/';
		$value = $name_img.'.png';
		print "<img class=\"galerie_img\" onclick=\"traitement.view_comment($name_img, 'div_cmt');\" $taille_img id=\"$id_img\" src=\"$dir_user$value\">";
		$CView->div_end(); // div_img
		print "<div class=\"div_like\" ><p class=\"like\">$info_images_like</p></div>"; 
		print "<div class=\"div_likesend\" ><p class=\"likesend\"><a onclick=\"traitement.send_like($name_img, $Id, 'div_galerie');\" onmouseover=\"traitement.show_like($key)\">+</a></p></div>";
		$CView->div_end(); // div_img_like_cmt
		}

	}
	print '<p>&nbsp;</p>';
	print "<p class=\"nav_galerie\"><a href=\"#\" onclick=\"traitement.display_galerie($page_previousbis, 'div_galerie');\"> $page_previousbis&nbsp;</a> ";
	print " <a href=\"#\" onclick=\"traitement.display_galerie($page_previous, 'div_galerie');\"> $page_previous </a> ";
	print '&nbsp; <span>( ' . $actual_page . ' )</span>  &nbsp;';
	print " <a href=\"#\" onclick=\"traitement.display_galerie($page_next, 'div_galerie');\"> $page_next </a> &nbsp;";
	print " <a href=\"#\" onclick=\"traitement.display_galerie($page_nextbis, 'div_galerie');\"> $page_nextbis </a></p>";

	return ($Err = '');
}


?>