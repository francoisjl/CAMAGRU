<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd"> 
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<html lang="fr">
<head>
<title>Camagru</title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans|Titillium+Web" rel="stylesheet">
<script src="syntax.js" type="text/javascript"></script>';
</head>
<body>

<?php

print '<p>test</p>';
print "<div id=\"div1\" style=\"display:inline; margin:10px;\">";


?>
<script>

	dom.form("id:myForm, action:page.php, method:POST"); // id:[], action:[action.php], method:[(GET || POST)]
	dom.inputText("form:myForm, id:Votre Nom, value:votre nom, placeholder:tapez votre nom"); // form:[],id:[], value:[]
	dom.inputText("form:myForm, id:Votre Prenom, value:, placeholder:tapezvotre prenom"); // form:[],id:[], value:[]
	dom.p("id:p, content:envoyez le formulaire, classe:content");
	dom.submit("form:myForm, id:submit, value:Envoyer"); // form:[],id:[], value:[]

	</script>
</div>
</body>
</html>

