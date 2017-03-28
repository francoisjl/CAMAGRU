<?php
if(!isset($_SESSION)) {session_start();}

require_once('database.php');

Class CSetup // ***** Class 
{
    public static $verbose = False;

    private $tbl = "tbl_camagru";
    private $tbl_photos = "photos";
    private $tbl_photos_like = "photos_like";

// **********  gestion de l'utilisateur ***********
    public function __construct() // initialise les info de la base de donnees
    {
        $db = new CDatabase();
        $this->conn = $db->database('setup');

        return;
    }

    public function host() // précise le nom du serveur pour l'envoi des liens par mail
    {
        $host = 'http://'.$this->servername.':8080/camagru/';
        return ($host);
    }

    public function create_base() // check si login mot de passe sont valides
    {
        //***** create database
        try {
            $rq = $this->secure("CREATE DATABASE IF NOT EXISTS `camagru` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci; USE `camagru`;");
            $requete = $this->conn->prepare($rq); //
            $requete->execute();
            }
        catch(PDOException $e)
        { echo "Error Database : " . $e->getMessage(); }

        print ' ok create database camagru <br/>'. '<br />';
        
        //***** create table camagru
        try {
            $rq = $this->secure("CREATE TABLE `tbl_camagru` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Prenom` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Confirm` int(11) NOT NULL DEFAULT '0',
  `Keyuser` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Cpt_reinit` int(11) NOT NULL DEFAULT '5',
  `Questionsecrete` int(11) NOT NULL,
  `Reponsesecrete` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Info` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
            $requete = $this->conn->prepare($rq); //
            $requete->execute();
            }
        catch(PDOException $e)
        { echo "Error Database : " . $e->getMessage(); }

        print ' ok create table camagru <br/>'. '<br />';

        //***** create database
        try {
            $rq = $this->secure("INSERT INTO `tbl_camagru` (`Id`, `Nom`, `Prenom`, `email`, `Password`, `Confirm`, `Keyuser`, `Cpt_reinit`, `Questionsecrete`, `Reponsesecrete`, `Info`) VALUES
(1, 'FRANCOIS', 'Jean-Luc', 'jfrancoi@student.42.fr', '6fc34d89e5a8d7d8829bdc2984fb20e60b31cbc52e3b01358cb2b35dc26237ecf6ab7127f4c2e76ad1b611e4aea626ac27557c11f30d8e5bf7dde9e18953db05', 1, '58ac76129d418', 5, 4, 'bad', 'Info'),
(2, 'DUPEYROU', 'Franck', 'fdupeyro@student.42.fr', '6fc34d89e5a8d7d8829bdc2984fb20e60b31cbc52e3b01358cb2b35dc26237ecf6ab7127f4c2e76ad1b611e4aea626ac27557c11f30d8e5bf7dde9e18953db05', 1, '589b3c7428e19', 5, 3, 'cheval', 'info'),
(5, 'AZZOUT', 'Hischam', 'hazzout@student.42.fr', '6fc34d89e5a8d7d8829bdc2984fb20e60b31cbc52e3b01358cb2b35dc26237ecf6ab7127f4c2e76ad1b611e4aea626ac27557c11f30d8e5bf7dde9e18953db05', 1, '589a0199da59a', 5, 0, '', 'info'),
(6, 'PASQUALI', 'thierry', 'tpasqual@student.42.fr', 'test', 1, 'sdfgsdhf', 5, 0, '', 'info'),
(7, 'AZRIA', 'Bruno', 'bazria@student.42.fr', '6fc34d89e5a8d7d8829bdc2984fb20e60b31cbc52e3b01358cb2b35dc26237ecf6ab7127f4c2e76ad1b611e4aea626ac27557c11f30d8e5bf7dde9e18953db05', 1, 'sdfgsdhf', 5, 0, 'vÃ©lo, info');
");
            $rq = utf8_decode ($rq); 
            $requete = $this->conn->prepare($rq); //
            $requete->execute();
            }
        catch(PDOException $e)
        { echo "Error Database : " . $e->getMessage(); }

        print ' ok insert data tbl camagru <br/>'. '<br />';

        //***** CREATE TABLE `photos`
        try {
            $rq = $this->secure("CREATE TABLE `photos` (
  `Id` int(11) NOT NULL,
  `Id_owner` int(11) NOT NULL,
  `Name_img` int(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Nb_liked` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
            $requete = $this->conn->prepare($rq); //
            $requete->execute();
            }
        catch(PDOException $e)
        { echo "Error Database : " . $e->getMessage(); }

        print ' ok create table photos <br/>'. '<br />';

                //***** INSERT INTO `photos` 
        try {
            $rq = $this->secure("INSERT INTO `photos` (`Id`, `Id_owner`, `Name_img`, `Date`, `Nb_liked`) VALUES
(20, 2, 1490624561, '2017-03-27 16:22:41', 0),
(24, 2, 1490630371, '2017-03-27 17:59:32', 0);");
            $requete = $this->conn->prepare($rq); //
            $requete->execute();
            }
        catch(PDOException $e)
        { echo "Error Database : " . $e->getMessage(); }

        print ' ok insert data table photo<br/>'. '<br />';

                //***** CREATE TABLE `photos_like`
        try {
            $rq = $this->secure("CREATE TABLE `photos_like` (
  `Id` int(11) NOT NULL,
  `Id_tblphotos` int(11) NOT NULL,
  `Id_img` int(11) NOT NULL,
  `Id_user_comment` int(11) NOT NULL,
  `Comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Grave_bien` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
            $requete = $this->conn->prepare($rq); //
            $requete->execute();
            }
        catch(PDOException $e)
        { echo "Error Database : " . $e->getMessage(); }

        print ' ok create table photos_like <br/>'. '<br />';

                //***** INSERT INTO `photos_like`
        try {
            $rq = $this->secure("INSERT INTO `photos_like` (`Id`, `Id_tblphotos`, `Id_img`, `Id_user_comment`, `Comment`, `Grave_bien`) VALUES
(30, 20, 1490624561, 1, 'trop top', 0);");
            $rq = utf8_decode ($rq); 
            $requete = $this->conn->prepare($rq); //
            $requete->execute();
            }
        catch(PDOException $e)
        { echo "Error Database : " . $e->getMessage(); }

        print ' ok data database photos_like <br/>'. '<br />';

        //***** create index
        try {
            $rq = $this->secure("ALTER TABLE `photos`
  ADD PRIMARY KEY (`Id`);
ALTER TABLE `photos_like`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_img` (`Id_tblphotos`);
ALTER TABLE `tbl_camagru`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `email` (`email`);");
            $requete = $this->conn->prepare($rq); //
            $requete->execute();
            }
        catch(PDOException $e)
        { echo "Error Database : " . $e->getMessage(); }

        print ' ok create Index <br/>'. '<br />';

        //***** create AUTO_INCREMENT
        try {
            $rq = $this->secure("ALTER TABLE `photos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
ALTER TABLE `photos_like`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
ALTER TABLE `tbl_camagru`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;");
            $requete = $this->conn->prepare($rq); //
            $requete->execute();
            }
        catch(PDOException $e)
        { echo "Error Database : " . $e->getMessage(); }

        print ' ok create AUTO_INCREMENT <br/>'. '<br />';

        //***** create CONSTRAINT
        try {
            $rq = $this->secure("ALTER TABLE `photos_like` ADD CONSTRAINT `delete_img` FOREIGN KEY (`Id_tblphotos`) REFERENCES `photos` (`Id`) ON DELETE CASCADE;");
            $requete = $this->conn->prepare($rq); //
            $requete->execute();
            }
        catch(PDOException $e)
        { echo "Error Database : " . $e->getMessage(); }

        print ' ok create CONSTRAINT <br/>'. '<br />';

        print ' Database valide <br/>'. '<br />';

$conn = null;
        return ;
    }

    function secure($var) // supprime les tag html
    {
        $var = strip_tags($var);
        //$var = addslashes ($var); // ajoute \ au string avec ' " exemple (c'est)
        $var = str_replace ( '$' , '', $var);
        return($var); // pour l'instant on ne fait que le strip_tags car protege par 'value'
        //return (mysql_real_escape_string($var)); // ne fonctionne pas
        //return($var);
    }

    private function quotesep($val)// securise les variables dans sql, avec separateur
    {
        return("'".$val."', ");
    }

    private function quote($val)// securise le passage des variables dans la requete sql, sans separateur
    {
        return("'".$val."'");
    }


    public function kill_session() // on tue la session et les variables
    {
        $_SESSION = array(); session_destroy(); 
        return('ok');
    }


 
    //***** structure *****

    public function __destruct() // on efface la connexion a la base
    {
        //print ('<p>destruct</p>');
        $this->conn = null; 
        return;
    }

   public function __toString() //print ($Form);
   {
    return('toString');
}

   public function __invoke() //print ($Form());
   {
    return('invoke');
}

static function doc()
{
    $info = '';
    return (file_get_contents('superuser/documentation.txt'));
}


}

$CSetup = new CSetup();

print 'Initialisation de la base<br />';
$CSetup->create_base();


?>
