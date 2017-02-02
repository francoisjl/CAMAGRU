<?php
Class CForm{
    public $newvar = 0;
    public static $verbose = False;
    //private tabpost = array();

    public function __construct()
    {
             //print('C').PHP_EOL;

        return;
    }

    public function __destruct()
    {
         if (self::$verbose == True)
           // print('D').PHP_EOL;
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
       return (file_get_contents('Form.doc.txt'));
    }

   public  function FormTitre($titre)
    {
        print('<table>');
        print ('<h2 class="FormTitre">'.$titre.'</h2>');
        return;
    }
   public  function Form($uri, $class, $method )
    {
        return('<FORM class="'.$class.'" action="'. $uri.'" method="'.$method.'">');
        // !$uri || !$method
    }

    public  function InputLabel($labelFor, $labelTitre, $id)
    {
        return('<LABEL for="'.$labelFor.'">'. $labelTitre."</LABEL>");
    }

    public  function InputText($Titre, $id)
    {
        return('<INPUT type="text" name="'. $id.'" id="'. $id.'" value="'.$value.'">');
        // !$id || !$labelFor
    }

    public  function InputMail($Titre, $id)
    {
        return('<INPUT type="mail" name="'. $id.'" id="'. $id.'" value="'.$value.'" placeholder=" yourname@domain.com" alt="Email servira au login" required>');
        // !$id || !$labelFor
    }

	public  function InputPassword($Titre, $id)
    {
        return('<INPUT type="password" name="'. $id.'" id="'. $id.'" required>');
        // !$id || !$labelFor
    }

	public  function Submit($Titre)
    {   
        return('<INPUT type="submit" value="'. $Titre.'">');
        // !$id || !$labelFor
    }


}


/*



$TabForm = array();

$inscription = new CForm;
$TabForm[] = $inscription->Form('FormGet.class.php', 'Form', 'POST');
$TabForm[] = $inscription->InputLabel("Nom", "Votre Nom", "Nom");
$TabForm[] = $inscription->InputText("Votre Nom", "Nom");
$TabForm[] = $inscription->InputLabel("Prenom", "Votre Prénom", "Prenom");
$TabForm[] = $inscription->InputText("Votre Prénom", "Prenom");
$TabForm[] = $inscription->InputLabel("Mail", "Votre Mail", "Mail");
$TabForm[] = $inscription->InputMail("Votre Mail", "email");
$TabForm[] = $inscription->InputLabel("Password", "Password", "Password");
$TabForm[] = $inscription->InputPassword("Password", "Password");
$TabForm[] = $inscription->Submit("Envoyer");

include_once ('FormPrint.class.php');
$a = new CFormPrint('test');
$a->FormPrint('Inscriptions', $TabForm);

//var_dump($TabForm);
*/
?>