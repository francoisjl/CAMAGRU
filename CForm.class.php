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

    public  function InputLabel($labelTitre, $id, $labelFor)
    {
        return('<LABEL for="'.$labelFor.'">'. $labelTitre."</LABEL>");
    }

    public  function InputText($Titre, $id, $post, $required)// , $required a ajouter
    {
        if ($required) $required = ' required';
        return('<INPUT type="text" name="'. $id.'" id="'. $id.'" value="'.$post.'" '.$required.'>');
    }

    public  function InputMail($Titre, $id, $post, $required)
    {
        if ($required) $required = ' required'; else $required = '';
        return('<INPUT type="mail" name="'. $id.'" id="'. $id.'" value="'.$post.'" placeholder=" yourname@domain.com" alt="Email servira au login" '.$required.'>');
    }

    public  function InputSelect($Titre, $id, $tbl, $selected, $required)
    {
        if ($required) $required = ' required';
        $retour ='<select name="'.$id.'"" id="'.$id.'"'.$required.'>';
        foreach ($tbl as $key => $value)
        {
            if ($key == $selected) {$option_select = ' selected';} else {$option_select = '';}
            $retour .= '<option value="'.$key.'"'.$option_select.'>'.$value.'</option>';
        }
        $retour .= '</select>';
        return($retour);
    }

	public  function InputPassword($Titre, $id, $required)
    {
        if ($required) $required = ' required';
        return('<INPUT type="password" name="'. $id.'" id="'. $id.'"'.$required.'>');
        // !$id || !$labelFor
    }

	public  function Submit($Titre, $id)
    {   
        return('<INPUT type="submit"  name="'. $id.'" id="'. $id.'" value="'. $Titre.'">');
        // !$id || !$labelFor
    }

public  function InputTextChk($tbl)// Form($Titre, $Tab)
    {
        $retour = '';
        foreach ($tbl as $id => $label)
        {
            if (!$_POST[$id]) $retour .= 'champ '.$label.' à renseigner<br />';
        }
        return ($retour);
    }
public  function Ctrl_Password($tbl)// Form($Titre, $Tab)
    {
        $retour = '';
        foreach ($tbl as $id => $label)
        {
            if (!$_POST[$id]) $retour .= 'champ '.$label.' à renseigner<br />';
        }
        return ($retour);
    }
}

?>