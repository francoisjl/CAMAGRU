<?php
require_once('includes_session.php');
if ($_SESSION['valide'] != 'ok') {header('Location: login.php');}
//if ( $_SESSION["email"] != 'dominique@lievre.net' ) exit;
if ( $_SESSION['Superuser'] != 'yes' ) exit; ;
require_once('head.php');
require_once('header.php');

$CView = new CPrint;
$CSession = new CSession;
$CInscription = new CInscription;
$db = new CDatabase();

//print('<div id="main">');

$CView->titre('Liste des users');
$CSession->user_list('content_left', 'content_left');

$CView->titre('Liste Questions secrètes');
$CView->content_array($Tabquestion, 'content_left', 'content_left');

$CView->titre('Info systèmes');
$CView->content( '<b>HTTP_HOST : </b>'.$_SERVER['HTTP_HOST'], 'content_left');
$CView->content('Host : '.$CSession->host(), 'content_left');
$CView->content('<b>Chemin : </b>'. __FILE__ .'<br />', 'content_left');
$CView->content('<b>$_SERVER[\'DOCUMENT_ROOT\' : </b>'.$_SERVER['DOCUMENT_ROOT'].'<br />', 'content_left');

 $CView->content_array($_SESSION, 'content_left', 'content_left');
// $CView->content_array($GLOBALS, 'content_left', 'content_left');
$CView->content( 'Connecté depuis '.round((time() - $_SESSION['Logstart'])/60 ). ' minutes', 'content_left', 'content_left'); // 


$CView->titre('Documentation');

$fichiers[] = 'CSession.class.php'; $f[]='CS';
$fichiers[] = 'CInscription.class.php'; $f[]='CI';
$fichiers[] = 'CPrint.class.php'; $f[]='CP';
$fichiers[] = 'CForm.class.php'; $f[]='CF';
$fichiers[] = 'ajax_usr.php'; $f[]='AJ';
$fichiers[] = 'js_camera.js'; $f[]='JS';

/*On parcourt le tableau $lines et on affiche le contenu de chaque ligne précédée de son numéro*/
$needle[] = strtolower ('Class C');
$needle[] = strtolower ('function');
$needle[] = strtolower ('*****');
$needle[] = strtolower ("_GET['action']");

//$needle[] = strtolower ("INSERT INTO");
$tbl = array(); // pour afficher
$tblDoc = array(); // pour creer le fichier doc


foreach ($fichiers as $fileNumber => $fileName)
{
    $lines = file($fileName);
    $tbl[$fileName] = '<b>'.$fileName.'</b';
    $tblDoc[$fileName] = '<b>'.$fileName.'</b';

    foreach ($lines as $lineNumber => $lineContent)
    {
        foreach ($needle as $needleNumber => $needleContent)
        {

        if (strpos ( strtolower ($lineContent) , $needleContent))
            {
                $lineContent = str_replace ( 'private' , '*', strtolower ($lineContent));
                $lineContent = str_replace ( 'public' , '', strtolower ($lineContent));
                $lineContent = str_replace ( 'function' , '', strtolower ($lineContent));
                $tblDoc[$f[$fileNumber].'-'.$lineNumber] = $lineContent; // avant mise en form
                if ( $pos = strpos ($lineContent , '(')) //ne fonctionne pas si function est au debut de la ligne car strpos = 0
					$lineContent = '<b>'.substr($lineContent, 0, $pos).'</b>'.substr($lineContent, $pos);
                $lineContent = str_replace ( '//' , '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//', strtolower ($lineContent));
                //echo $lineNumber,' ',$lineContent.'<br />';
                //$lineContent =  str_replace ( 'é' , '&eacute;', $lineContent);
               // $lineContent =  str_replace ( 'Ã©' , '&eacute;', $lineContent); 
                //http://mozartsduweb.com/blog/correspondance-encodages-utf8-iso-8859-1/
                $tbl[$f[$fileNumber].'-'.$lineNumber] = $lineContent;

            }
        }
    }
}
$CView->content_array($tbl, 'content_left', 'content_left');
$ecrire = $CSession->write_doc($tblDoc);
$CView->content ($ecrire, 'content_left');
//$CSession->read_log('superuser/doc_suite.txt');
print "<p>Database<br /><img src=\"superuser/database.png\"></p>";
print "<p>Database<br /><img src=\"superuser/concept.png\"></p>";
$CView->titre('Documentation - complément');
if (file_exists('superuser/doc_suite.txt')) $CSession->read_log('superuser/doc_suite.txt');

$CView->titre('Fichier Log');
$CView->content('Test Fichier log.txt', 'content_left');
//$test = $CSession->write_log('superuser connected');
$CView->content('Test Fichier log.txt '.$CSession->write_log('superuser connected'), 'content_left');
//$CView->content($CSession->read_log('content');
$CSession->read_log('superuser/log.txt');

// afficher les chmod
$listfile = scandir (getcwd());
$result = array();
$countLnCode = 0;
foreach ( $listfile as $key => $file)
{

	if ($file != "." and $file != "..") $result[$file] = substr(sprintf('%o', fileperms($file)), -4);
    if (substr($file, -4) == '.php')
        {
            $fileLines=file($file);
            $countLnCode += count($fileLines);
        }
}
$CView->content ('Nb de ligne de code des fichiers du dossier : '.$countLnCode, 'content_left');

$CView->titre('CHMOD Fichiers');
$CView->content_array($result, 'content_left', 'content_left');


$indicesServer = array('PHP_SELF', 
'argv', 
'argc', 
'GATEWAY_INTERFACE', 
'SERVER_ADDR', 
'SERVER_NAME', 
'SERVER_SOFTWARE', 
'SERVER_PROTOCOL', 
'REQUEST_METHOD', 
'REQUEST_TIME', 
'REQUEST_TIME_FLOAT', 
'QUERY_STRING', 
'DOCUMENT_ROOT', 
'HTTP_ACCEPT', 
'HTTP_ACCEPT_CHARSET', 
'HTTP_ACCEPT_ENCODING', 
'HTTP_ACCEPT_LANGUAGE', 
'HTTP_CONNECTION', 
'HTTP_HOST', 
'HTTP_REFERER', 
'HTTP_USER_AGENT', 
'HTTPS', 
'REMOTE_ADDR', 
'REMOTE_HOST', 
'REMOTE_PORT', 
'REMOTE_USER', 
'REDIRECT_REMOTE_USER',
'REDIRECT_STATUS', 
'SCRIPT_FILENAME', 
'SERVER_ADMIN', 
'SERVER_PORT', 
'SERVER_SIGNATURE', 
'PATH_TRANSLATED', 
'SCRIPT_NAME', 
'REQUEST_URI', 
'PHP_AUTH_DIGEST', 
'PHP_AUTH_USER', 
'PHP_AUTH_PW', 
'AUTH_TYPE', 
'PATH_INFO', 
'ORIG_PATH_INFO') ; 

//$CView->content_array($indicesServer, 'content_left', 'content_left');

echo '<table cellpadding="10">' ; 
foreach ($indicesServer as $arg) { 
    if (isset($_SERVER[$arg])) { 
        echo '<tr><td>'.$arg.'</td><td>' . $_SERVER[$arg] . '</td></tr>' ; 
    } 
    else { 
        echo '<tr><td>'.$arg.'</td><td>-</td></tr>' ; 
    } 
} 
echo '</table>' ; 
//print('</div>');	// div main
include ('footer.php');
?>