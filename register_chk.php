<?php
// on recupere le mail pour envoyer un lien de reinitialisation de password
require_once('includes_session.php');
$CPrint = new CPrint();
$CForm = new CForm;
$CSession = new CSession();

$aff_formulaire = 'yes';
$error_field = '';
$suite = 'login.php';

//$CPrint->content(' key '.$_GET['key'], 'content');
if (!$_GET['key'] and !$_SESSION['key']) exit;
//if exist($_GET['key']) print 'check en cours';// a faire pour s'assurer que la cle existe pour reinitialiser
// on doit passer par une session pour gerer ensuite le formulaire car on perd le get key
if ($_GET['key']) {$_SESSION['key'] = $_GET['key']; $key = $_GET['key'];}// uniquement si la key est valide , a finir 

// validation dans la base de cet utilisateur

require_once('head.php');
require_once('header.php');
print('<div id="main">');

 $retour = $CSession->userkey_exist($key);
 
if ( $retour and $retour != 'no')
{ 
	if ($CSession->user_add_confirm($key) == 'user_add_confirm')
	{
		$CPrint->Titre('Inscription validée', $class_msg);
		$CPrint->content("Cliquez maintenant sur 'login' pour vous connecter ", $class_msg);
	}
	else
		$CPrint->Titre('Erreur Inscription refusée, contactez le support', $class_msg);

}

	print('</div>');	
	include ('footer.php');
?>