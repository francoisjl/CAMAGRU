<?php
//session_start();
require_once('includes_session.php');
require_once('head.php');
require_once('header.php');

$content = '';
print('<div id="main">');

$CPrint = new CPrint();
$CForm = new CForm;

$aff_formulaire = 'yes';

if (isset($_POST['Reinit']) == TRUE) // controle des champs
	{
		$TabFormChk["email"] = "Votre Mail";

		$error_field = $CForm->InputTextChk($TabFormChk);
		
	}

if (isset($_POST['Reinit']) == TRUE and !$error_field)
{
	$CSession = new CSession();
	$user_exist = $CSession->user_exist($_POST['email']);

	if ($user_exist != 'yes' and $user_exist != 'no') 
	{ 
		$content = 'Création impossible :'.$user_exist;
		$class_msg = 'msg_err';
		$aff_formulaire = 'yes';
	}

	if ($user_exist == 'yes')
	{
		$CInscription = new CInscription();
		$email = strip_tags($_POST['email']);
		$action = $CInscription->send_reinitialisation($email);

		if ($action == 'send email')
		{
			$content = 'Un mail de réinitialisation vient de vous être envoyé à l\'adresse '.$email.'<br />';
			$content .= 'Vérifiez par précaution votre dossier SPAM si nécessaire.';
			$class_msg = 'content';
			$aff_formulaire = 'no';
		}
		else
		{
			$class_msg = 'msg_err';
			$CPrint->content('Impossible d\'envoyer le mail de réinitialisation, contactez le support technique', $class_msg);
			$aff_formulaire = 'yes';
			exit;
		}
	}


}

if ($content) $CPrint->content($content, $class_msg);

if ( $aff_formulaire == 'yes' )
{
	$TabForm = array();

	$TabForm[] = $CForm->Form('pwd_reinit.php', 'Form', 'POST');
	$TabForm[] = $CForm->InputLabel("Votre Mail * ", "LabelMail", "LabelMail");
	$TabForm[] = $CForm->InputMail("Votre Mail ", "email", $_POST['email'], '*');
	$TabForm[] = $CForm->Submit(" Réinitialisation ", "Reinit");

	$CPrint = new CPrint();

	if ($error_field) $CPrint->content($error_field, 'msg_err');

	$CPrint->Form('Réinitialisation Mot de passe', $TabForm);
	$CPrint->content("Renseignez votre email, pour recevoir un lien de réinitialisation", 'content');
	//var_dump($TabForm);
}

?>