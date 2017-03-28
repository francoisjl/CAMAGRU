<?php
if(!isset($_SESSION)) {session_start(); $_SESSION['valide'] = ' ';}
$CView = new CPrint;
//print '<div id="header"><div class="header_titre"><h1> </h1></div>';
$CView->div('header', '');
$CView->div('', 'header_titre');
print "<h1> </h1>";
$CView->div_end();

if (!$_SESSION['valide'])  $_SESSION['valide'] = ' ';
if ($_SESSION['valide'] == 'ok') {
	$status = 'Login';
	$nom = 'Nom';
	$SuperUser = '';

	$CView->div('header_user', 'header_user');
	print'<p class="header_user">';
	print $status. ' Id '.$_SESSION['Id'].'<br />'.$_SESSION["email"].'<br />';
	if ($_SESSION['Superuser'] == 'yes')
		$CView->link('superuser.php', 'SuperUser', '', '', ''); 
	print '</p>';
	$CView->div_end();

	$CView->div('header_menu', 'header_menu');
	print '<p class="header_menu">';
	$CView->link('index.php', 'Home', '', '', '|');
	$CView->link('galerie.php', 'Galerie', '', '', '|');
	$CView->link('profile.php', 'Profile', '', '', '|');
	$CView->link('logoff.php', 'Log out', '', '', '');
	print '</p>';
	$CView->div_end();
}
else
{
	$CView->div('header_user', 'header_user');
	print '<p class="header_user">';
	print 'Not Logged<br />';
	$CView->link('login.php', 'login', '', '', '');
	print '</p>';
	$CView->div_end();
}

$CView->div_end(); // fin div header

$CView->div('global', '');
?>