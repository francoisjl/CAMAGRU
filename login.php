<?php
session_start();
require_once('includes_session.php');
$aff_formulaire = 'yes';
$CForm = new CForm;

if (isset($_POST['Envoyer']) == TRUE) // controle des champs
    {
        $TabFormChk["email"] = "Votre Mail";
        $TabFormChk["Password"] = "Password";

        $error_field = $CForm->InputTextChk($TabFormChk);
    }

if (isset($_POST['Envoyer']) == TRUE and !$error_field)
{
$CSession = new CSession();
$user_ckeck = $CSession->user_login();

if (!$user_ckeck) header('Location: login.php');
if ($user_ckeck == 'user_login')
    {
    if ($_SESSION['valide'] == 'ok') 
        header('Location: home.php');
    exit;
    }
$class_msg = '';
if ($user_ckeck == 'user not confirmed')
    {
        $content = "Votre inscription n'est pas encore validée<br />Vous avez dû recevoir un mail pour finaliser votre inscription";
        $class_msg = 'msg_err';
        $aff_formulaire = 'no';
    }
if ($user_ckeck == 'user password bad')
    {
        $content = "Votre Mot de passe n'est pas valide<br />Vérifiez votre saisie";
        if ($CSession->ismajuscule($_POST['Password']) == 'majuscule') $content .= "<br />Vérifiez les majuscules de votre mot de passe";
        $class_msg = 'msg_err';
        $aff_formulaire = 'yes';
    }
if ($user_ckeck == 'user not exit')
    {
        $content = " Votre Login ".$_POST['email']." n'existe pas dans la base<br />Vérifiez votre saisie";
        $class_msg = 'msg_err';
        $aff_formulaire = 'yes';
    }
}
require_once('head.php');
require_once('header.php');
print('<div id="main">');

$CPrint = new CPrint();
$CPrint->titre('Login');
if ($content) $CPrint->content($content, $class_msg);

if ( $aff_formulaire == 'yes' )
    {
    $TabForm = array();

    $TabForm[] = $CForm->Form('login.php', 'Form', 'POST');
    $TabForm[] = $CForm->InputLabel("Votre Mail", "LabelMail", "Mail");
    $TabForm[] = $CForm->InputMail("Votre Mail", "email", $_POST['email'], '*');
    $TabForm[] = $CForm->InputLabel("Password", "LabelPassword", "LabelPassword");
    $TabForm[] = $CForm->InputPassword("Password", "Password", '*'); // InputPassword($Titre, $id)
    $TabForm[] = $CForm->Submit("Envoyer", "Envoyer");

    $CPrint->Form('', $TabForm);

    if ($error_field) $CPrint->content($error_field, 'msg_err');

    $CPrint->content( 'Mot de passe oublié  : <a href="pwd_reinit.php" target="_self">Réinitialisation</a>', 'lien');
    $CPrint->content( 'Inscription : <a href="register.php" target="_self">S\'enregister</a>', 'lien');


}
print('</div>');
include ('footer.php');
?>