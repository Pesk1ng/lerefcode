<?php
namespace lerefcode ;
/**
 * Permet d'envoyer des mails
 * @author Picasso Houessou aka Loda Yacamazuka
 */
class Mail
{
	protected static $message = null  ;
    /**
     * Entete par défaut pour les mails
     * @var string[]
     */
	protected static $headers = array( 'MIME-Version'=>'MIME-Version: 1.0' ,'Content-type'=> 'Content-type: text/html; charset=UTF-8') ;

	public static $completeUrlToken = null ;
	
	function __construct($argument){}
	/*
	public static function sendWelcomeMail($mailAddress,$code, $urlToken , $header=null)
	{
		$subject = "Bienvenue dans lerefcode" ;
		
		return mail($mailAddress, $subject , self::$message, $header) ;
	}
	*/

    /**
     * Permet d'envoyer un mail de validation lors de la création d'un compte candidat
     * @param $mailAddress
     * @param Candidate $candidate
     * @param CheckingAccount $checkingAccount
     * @param null $headers
     * @return bool true si le mail a été envoyé sinon retourne false
     */
	public static function sendWelcomeMailToCandidate($mailAddress, \lerefcode\Candidate $candidate, \lerefcode\CheckingAccount $checkingAccount, $headers = null)
	{
		if (is_null($candidate) || empty($candidate))
			return FALSE ;

		$subject = "Bienvenue dans lerefcode" ;

		//Recuperation et modification du message
		$filePath = str_replace("\\", "/", $_SERVER['DOCUMENT_ROOT'].'/view/mailMessage.static' ) ;
		$message = file_get_contents($filePath) ;

		if ($message==false)
        {
            return false ;
        }
		$message = str_replace('{{firstName}}', $candidate->firstName(), $message) ;
		$message = str_replace('{{email}}', $mailAddress , $message) ;
		$message = str_replace('{{code}}', $checkingAccount->code(), $message) ;
		$mailEncode = base64_encode($mailAddress) ; // Encodage utilisé pour l'adresse email
		$url = null ;
		if (isset ($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) )
		{
			$url = 'https://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/?action=confirmEmail&amp;lg='.$mailEncode.'&amp;urlTok='.urlencode($checkingAccount->urlToken()) ;
		} else 
		{
			$url = $url = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/?action=confirmEmail&amp;lg='.$mailEncode.'&amp;urlTok='.$checkingAccount->urlToken() ;
		}
		self::$completeUrlToken = $url ;
		$message = str_replace('{{urlToken}}', $url, $message) ;

		$message = wordwrap($message, 70, "\r\n");
		if (is_null($headers))
		{
			//$headers['MIME-Version'] = 'MIME-Version: 1.0';
     		//$headers['Content-type'] = 'Content-type: text/html; charset=UTF-8';
			return mail($mailAddress, $subject , $message, implode("\r\n", self::$headers)) ;
		}
		else 
			mail($mailAddress, $subject , $message, implode("\r\n",$headers)) ;
	}
}

?>