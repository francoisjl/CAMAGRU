<?php
require_once('includes_session.php');
if ($_GET['cmd']=='list') { print '<p>Lecture Base</p>';$session = new CSession(); $session->user_list();exit;}
if (!$_SESSION["email"] || $_SESSION["valide"] !='ok') {header('Location: login.php');} 
//if ($_GET['raz']=='1') {$_SESSION = array(); session_destroy(); print '<p>Session destroye</p>';exit;}
if ($_SESSION["valide"]=='ok') {header('Location: home.php');}



require_once('head.php');
require_once('header.php');

$session = new CSession();
if ($session->user_login() == 'user_login')
	{
	if ($_SESSION['valide'] == 'ok') 
		header('Location: home.php');
	}
if ($session->user_login() == 'user not confirm')
	{
		$CPrint = new CPrint();
    	$CPrint->content("....Votre inscription n'est pas validée<br />Un mail de validation vient de vous être envoyé pour confirmer votre inscription", 'msg_err');
    	$CInscription = new CInscription();
    	$CInscription->send_validation($email, $lignes->Prenom, $lignes->Nom, $lignes->Keyuser);
	}

exit;
print ('sess '.$_SESSION['valide']);
if ($_SESSION['valide'] == 'ok') 
	{
		header('Location: home.php');
	}
else
	{
		header('Location: index.php');
	}

print('<div id="main">');


	//include ('main.php');
//include ('aside.php');

print ('<p>Index</p>');

print('</div>');	
include ('footer.php');

?>
