<?php
namespace lerefcode ;
/**
 * Va servir à verifier les input des formulaires ainsi que protéger les entrées des formulaires.
 * Va aussi aussi retourner les messages de reponses du script php courant lors des requetes ajax
 * @author Picasso Houessou
 * @package lerefcode
*/

class FormMask 
{

    public static function getInputFormIsEnter($param)
    {
        return isset($param) ;

    }
    public static function getInputFormValid ($param)
    {
        if (isset($param) && !empty($param) )
        {
            return true ;
        } else
        {
            return false ;
        }
    }
    public static function getInputFormIsEnterAndNotEmpty($param)
    {
        return self::getInputFormIsEnter($param) && !empty($param)  ;
    }

    /**
     * Protège les entées des formulaires html
     * @param $param
     * @return string
     */
    public static function parseInputForm($param) 
    {
        return (string) htmlspecialchars($param) ;
		// return (string) htmlspecialchars(trim($param)) ;
    }

    /**
     * Verifie si un fichier uploadé est valide
     * @param $file le nom du fichier à vérifier
     * @return bool true si le fichier est valide sinon false
     */
	public static function verifyFile ($file)
    {
        if (isset($_FILES[$file]) AND $_FILES[$file]['error'] == 0)
		{
		// Testons si le fichier n'est pas trop gros
			if ($_FILES[$file]['size'] <= 2000000)
			{
					// Testons si l'extension est autorisée
					$infosfichier = pathinfo($_FILES[$file]['name']);
					$extension_upload = strtolower($infosfichier['extension']) ;
					$extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
					if (in_array($extension_upload, $extensions_autorisees))
					{
						return true ;
					} else 
					{
						return false ;
					}
			}
			else {
				return false ;
			}
		} else return false ;
    }

    /**
     * Retourne l'extension d'un fichier
     * @param $file le fichier
     * @return mixed|string
     */
	public static function getExtensionFile($file) 
	{
		$infosfichier = pathinfo($_FILES[$file]['name']);
		$extension_upload = $infosfichier['extension'];
		return $extension_upload ;
	}

    /**
     * Retourne Le message à envoyer sous forme d'objets json qui represente les retours lors des requetes ajax
     * @param array $message
     * @return false|string
     */
	public static function message(array $message)
    {
        return json_encode($message) ;
    }
    /**
     * Retourne un tableau d'erreur sous forme d'objets json qui represente les retours lors des requetes ajax
     * @param array $error tableau qui
     * @return false|string
     */
	public static function error(array $error)
	{
		return json_encode($error) ;	
	}

    /**
     * Retourne un objet json qui represente les retours lors des requetes ajax
     * Surchage l'objet pour que son etat soit directement "state"=true
     * @param array $success
     * @return false|string
     * @see FormMask::message()
     */
	public  static function success(array $success)
    {
        $success["state"] = true ;
        return json_encode($success) ;
    }
}
/* les retours au format json
{
	state : ,
	code : ,
	description , 
	redirect : // Dans ce cas le script js va rediriger vers ce lien
}

["state" =>TRUE , "code" => "description" =>,  "redirect"=>]
*/




?>