<?php
print '<div id="header"><div class="header_titre"><h1>Camagru</h1></div>';
print '<div id="header_user" class="header_user"><p class="header_user">';

if ($_SESSION["valide"]=='ok') {
	$status = ' : Login';
	$nom = 'Nom';
	$SuperUser = '';
	if ($_SESSION['Superuser'] == 'yes')
		$SuperUser = '<a href="superuser.php">SuperUser</a><br />';
	
	print $_SESSION["email"].$status.'<br />';
	print $SuperUser;
	print '<a href="logoff.php">Log out</a>'.'<br />';
	print '<a href="profile.php">Profile</a>'.'<br />';
	print '<a href="index.php">Home</a>';
}
else
	print 'Not Logged<br /><a href="login.php">Login</a>';
print '</p></div>'.'</div>';
?>