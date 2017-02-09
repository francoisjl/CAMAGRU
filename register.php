<?php
//session_start();
require_once('includes_session.php');
require_once('head.php');
require_once('header.php');

$CForm = new CForm;

$aff_formulaire = 'yes';
print '....'.$_POST['Question'].'<br>';

if (isset($_POST['Envoyer']) == TRUE) // controle des champs
	{
		$TabFormChk["Nom"] = "Votre Nom";
		$TabFormChk["email"] = "Votre Mail";
		$TabFormChk["Password"] = "Password";
		$TabFormChk["Passwordbis"] = "Confirmez le Password";
		$TabFormChk["Reponse"] = "Réponse";

		$error_field = $CForm->InputTextChk($TabFormChk);
		
	}

if (isset($_POST['Envoyer']) == TRUE and !$error_field )
	{
		$CSession = new CSession();
		$user_exist = $CSession->user_exist($_POST['email']);
		$CInscription = new CInscription();
		$CPrint = new CPrint();

	if ($user_exist != 'yes' and $user_exist != 'no') 
	{ 
		$content = 'Création impossible :'.$user_exist;
		$class_msg = 'msg_err';
		$aff_formulaire = 'yes';
		//$suite = 'index.php';
	}

	if ($user_exist == 'yes')
	{
		$content = 'Erreur : Cet utilisateur existe dans la base';
		$class_msg = 'msg_err'; 
		$aff_formulaire = 'yes';
		//$suite = 'register.php';
	}

	if ($user_exist == 'no')
	{
		$content = 'Utilisateur à créer dans la base<br />'; 
		$class_msg = 'content';
		$action = $CSession->user_add();
	//$action = 'ok'; /////// a remettre apres validation
		if ($action == 'user_add' ) 
		{
			$content .= 'Utilisateur validé dans la base';
			$class_msg = 'content';
		//if ($CInscription->send_validation($_SESSION) == 'ok'){$print->content('send ok');}
			$content .= '<br />Un mail de validation de compte vient de vous être envoyé à '.strip_tags($_POST['email']).'<br /> pour finaliser votre inscription';
			$aff_formulaire = 'no';
			//$suite = 'index.php';
		}
		else
		{
			$content .= "Impossible de créer l'utilisateur";
			$class_msg = 'msg_err';
			$aff_formulaire = 'no';
			//$suite = 'register.php';	
		}
	
	}
}

$CPrint = new CPrint();
print('<div id="main">');
$CPrint->titre('Inscription');
if ($content) $CPrint->content($content, $class_msg);

if ( $aff_formulaire == 'yes' )
{
	$TabForm = array();

	$CForm = new CForm;
	$TabForm[] = $CForm->Form('register.php', 'Form', 'POST');
	$TabForm[] = $CForm->InputLabel("Votre Nom *", "LabelNom", "Notused");// InputLabel(new = ($labelTitre, $id, $labelFor)
	$TabForm[] = $CForm->InputText("Votre Nom", "Nom", $_POST['Nom'], '*');

	$TabForm[] = $CForm->InputLabel("Votre Prénom", "LabelPrenom", "Notused");
	$TabForm[] = $CForm->InputText("Votre Prénom", "Prenom", $_POST['Prenom'], '');
	$TabForm[] = $CForm->InputLabel("Votre Mail *", "LabelMail", "Notused");
	$TabForm[] = $CForm->InputMail("Votre Mail", "email", $_POST['email'], '*');

	$TabForm[] = $CForm->InputLabel("Password *", "LabelPassword", "Notused");
	$TabForm[] = $CForm->InputPassword("Password", "Password", '*');

	$TabForm[] = $CForm->InputLabel("Confirmez le Password *", "LabelPassword", "Notused");
	$TabForm[] = $CForm->InputPassword("Passwordbis", "Passwordbis", '*');

/*	$Tabquestion[] = "Le nom de votre chien";
	$Tabquestion[] = "Le prénom de votre meilleur ami";
	$Tabquestion[] = "Votre nom de jeune fille";
	$Tabquestion[] = "Votre sport favori";*/
	$TabForm[] = $CForm->InputLabel("Question secrète *", "LabelQuestion", "Notused");
	$TabForm[] = $CForm->InputSelect("Question secrète ", "Question", $Tabquestion, '0', '*');
	$TabForm[] = $CForm->InputLabel("Réponse *", "LabelReponse", "Notused");
	$TabForm[] = $CForm->InputText("Reponse", "Reponse", $_POST['Reponse'], '*');

	$TabForm[] = $CForm->Submit("Envoyer", "Envoyer");

	$CPrint->Form('', $TabForm);

	if ($error_field) $CPrint->content($error_field, 'msg_err'); 

	$CPrint->content('* champ impératif', 'content');
}
print('</div>');	
include ('footer.php');
?>