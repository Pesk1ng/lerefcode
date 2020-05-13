<?php 
use \model\CandidateManager ;
use \model\LoginManager;
use \model\CheckingAccountManager;
use \lerefcode\Candidate; 
use \lerefcode\Login;
use \lerefcode\Database ;
use \lerefcode\CheckingAccount; 
use \lerefcode\FormMask;

require ('backend/autoload.php') ;
const REDIRECTION_TIME= 5; // Le temps d'attente lors des redirections
/*
header("Refresh: 3; url=http://www.monurl.com"); // redirection après 3 secondes
 * <script type="text/javascript" language="JavaScript">
    setTimeout(function () {
                      location.href = 'mapage.php';
               }, 4000);
</script>
if (
	FormMask::getInputFormValid($_GET['lg']) &&
	FormMask::getInputFormValid($_GET['urlTok'])
	//FormMask::getInputFormIsEnterAndNotEmpty($_GET['lg']) &&
	//FormMask::getInputFormIsEnterAndNotEmpty($_GET['urlTok'])
)
*/

$db =null;
try {
	$db = Database::getMysqlConnectWithPDO ();
} catch (Exception $e)
{
	die ($e->getMessage()) ; exit ;
}
$url =null ; // Va servir pour les rredirections
if (isset ($_SERVER['HTTPS']))
{
	$url = $url= 'https://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/?action=' ;

} else {
	$url= 'http://'. $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/?action=' ;
}

// Dans le cas où on demande un nouveau code
if ( isset($_POST['lg']) && !empty($_POST['lg']) && isset($_POST['resendCode']) && ( strcmp($_POST['resendCode'], "resendCode" ) == 0  ) )
{
	// Instanciation des objets models
	$loginManager = new LoginManager($db) ;
	$checkingAccountManager = new CheckingAccountManager($db);
	$candidateManager = new CandidateManager($db) ;

	//Recuperation des parametres de l'url
	$lgEncode = $_POST['lg'] ;
	$lg =  base64_decode($_POST['lg']) ;

	$login = $loginManager->get($lg);
	if (!$login->isValid())
	{
		FormMask::error(array("state"=>false, "description"=>"Une erreur est survenue lors de l'obtention du mail. Veuillez réessayer")) ; exit ;
	}
	//si le compte n'existe pas
	if (is_null($login) )
	{
		echo FormMask::error( array("state"=> false  , "description" => "Le compte email ".$lg." n'est pas inscrit. Veuillez vous inscrire d'abord."  )) ;	exit ;
	}
	// Si le compte est deja activé
	if ($login->state() == 1 || $login->state() ==true)
	{
		FormMask::error(array("state"=>false, "description"=>"Ce compte email est déja validé.", "redirect"=>$url."defaultPage")) ;	exit ;
	}

	$candidate = $candidateManager->get($login->id()) ;
	$checkingAccount = $checkingAccountManager->get($login->id()) ;

	//S'il ya un probleme lors de l'obtention des informations de validation on genere de nouveaux codes
	if (is_null($checkingAccount) || !$checkingAccount->isValid())
	{
		$checkingAccount = new CheckingAccount(array(
		'code'			=> \lerefcode\Security::getSimpleToken(),
		'loginId' 		=> $login->id() ,
		'urlToken'		=> \lerefcode\Security::urlToken(),
		'timeOver' 		=> new \Datetime("+3 hour"))
		) ;
		// Enregistrement dans la base de donnée
		try {
			$checkingAccountManager->add($checkingAccount);
		} catch (PDOException $e)
		{
			echo FormMask::error(array("state"=>false, "description"=>"Une erreur est survenue ".$e->getMessage())) ; exit;
		}
		//Envoie du mail
		$emailState= \lerefcode\Mail::sendWelcomeMailToCandidate($lg, $candidate , $checkingAccount) ;
		if ($emailState)
		{
			echo FormMask::error(array("state"=>true , "description" => "Un mail contenant le code vous a été envoyé. Si vous ne l'avez pas reçu vérifier dans la liste des spams.")) ;	exit;
		}
		else
		{
			echo FormMask::error(array("state"=>false, "description"=>"Impossible de vous envoyer le mail")) ; 	exit;
		}
	}

	//Dans le cas où les codes de validations sont expirés on genère de nouveaux codes
	$now = new  \Datetime() ;
	if ($checkingAccount->timeOver()->getTimestamp() < $now->getTimestamp() )
	{
		$checkingAccount->setTimeOver(new \DateTime(" +3 hour")) ;
		$checkingAccount->setUrlToken(\lerefcode\Security::urlToken()) ;
		$checkingAccount->setCode(\lerefcode\Security::getSimpleToken()) ;
		$checkingAccountManager->update($checkingAccount);
	}
	// On envoie le mail de validation
	$emailState= \lerefcode\Mail::sendWelcomeMailToCandidate($lg, $candidate , $checkingAccount) ;
	if ($emailState)
	{
		echo FormMask::error(array("state"=>true , "description" => "Un mail contenant le code vous a été envoyé. Si vous ne l'avez pas reçu vérifier dans la liste des spams.")) ;	exit;
	}
	else
	{
		echo FormMask::error(array("state"=>false, "description"=>"Impossible de vous envoyer le mail")) ;	exit;
	}
}

//Dans le cas ou on active le compte par le lien d'activation
if ( isset($_GET['lg']) && isset($_GET['urlTok']) && !empty($_GET['lg']) && !empty($_GET['urlTok']) )
{
	$html = "<!DOCTYPE html><html><head><meta charset='utf-8'> <title> Erreur de Validation de compte</title></head><body style='font-size: x-large;text-align: center;' >{{contentHtml}}<p>Si la redirection ne marche pas cliquez <a href=\"{{url}}\" style='text-decoration: none;'> ici.</a></p></body></html>"   ;
	$loginManager = new LoginManager($db);
	$checkingAccountManager = new CheckingAccountManager($db);
	$lgEncode = $_GET['lg'] ;
	$lg =  base64_decode($_GET['lg']) ;
	$urlTok = urldecode($_GET['urlTok']) ; 
	
	$login = $loginManager->get($lg);
	//print_r($login); exit;
	if (is_null($login))
	{
		header("Refresh:". REDIRECTION_TIME."; url=".$url.'confirmEmail&lg='.$lgEncode);
		$paragraph = "<p style='font-size: x-large; text-align: center;'>Il a eu un problème au niveau du login. Vous allez être redirigé dans ".REDIRECTION_TIME." secondes.</p>";
		$htmlContent = str_replace('{{contentHtml}}',$paragraph, $html) ;
		$htmlContent = str_replace('{{url}}', $url.'confirmEmail&lg='.$lgEncode, $htmlContent);
		echo $htmlContent ;
		exit ;
	}
	if ($login->state() == 1 || $login->state() ==true)
	{

		$paragraph = "<p style='font-size: x-large; text-align: center;'> Ce compte est déja activé. Vous allez être redirigé dans ".REDIRECTION_TIME." secondes. <br></p>";
		$htmlContent = str_replace('{{contentHtml}}',$paragraph, $html) ;
		$htmlContent = str_replace('{{url}}', $url.'defaultPage', $htmlContent);
		header("Refresh:". REDIRECTION_TIME."; url=".$url.'defaultPage');
		echo $htmlContent ;
		exit ;
	}

	$checkingAccount = $checkingAccountManager->get($login->id()) ;
	if (is_null($checkingAccount))
	{
		$paragraph = "<p style='font-size: x-large; text-align: center;'> Un problème a été rencontré. Vous allez etre redirigé dans ".REDIRECTION_TIME."  secondes. <br>Vous devez demander un nouveau code sur la nouvelle page qui viendra</p>";
		$htmlContent = str_replace('{{contentHtml}}',$paragraph, $html) ;
		$htmlContent = str_replace('{{url}}', $url.'confirmEmail&'.'lg='.$lgEncode, $htmlContent);
		header("Refresh:". REDIRECTION_TIME."; url=".$url.'confirmEmail&'.'lg='.$lgEncode);
		echo $htmlContent ; exit ;
	}
	
	$now = new  \Datetime() ;
	if ($checkingAccount->timeOver()->getTimestamp() < $now->getTimestamp())
	{
		$paragraph = "<p style='font-size: x-large; text-align: center;'> Le code est expiré. Vous allez etre redirigé dans ".REDIRECTION_TIME."  secondes. <br>Vous devez demander un nouveau code sur la nouvelle page qui viendra</p>";
		$htmlContent = str_replace('{{contentHtml}}',$paragraph, $html) ;
		$htmlContent = str_replace('{{url}}', $url.'confirmEmail&'.'lg='.$lgEncode, $htmlContent);
		header("Refresh:". REDIRECTION_TIME."; url=".$url.'confirmEmail&'.'lg='.$lgEncode);
		echo $htmlContent ;	exit;
	}

	try {
		$db->beginTransaction();
		$login->setState(1);
		$loginManager->update($login) ;
		$checkingAccountManager->delete($checkingAccount) ;
		if ($db->commit())
		{
			$paragraph = "<p style='font-size: x-large; text-align: center;'>Le compte a été correctement vérifié. Vous allez être redirigé dans ".REDIRECTION_TIME." secondes.</p>";
			$htmlContent = str_replace('{{contentHtml}}',$paragraph, $html) ;
			$htmlContent = str_replace('{{url}}', $url.'defaultPage' , $htmlContent);
			header("Refresh:". REDIRECTION_TIME."; url=".$url."defaultPage");
			echo $htmlContent ;
			exit;
		}
	} catch(Exception $e)
	{
		$db-> rollBack();
		$paragraph = "<p style='font-size: x-large; text-align: center;'> Erreur".$e->getMessage()." Vous allez etre redirigé dans 10 secondes. <br> Vous devez demander un nouveau code sur la nouvelle page qui viendra</p>";
		$htmlContent = str_replace('{{contentHtml}}',$paragraph, $html) ;
		$htmlContent = str_replace('{{url}}', $url.'defaultPage', $htmlContent);
		echo $htmlContent ;
		exit;
	}
}

//Dans le cas ou on veut activer par le code
if (isset($_POST['lg']) && isset($_POST['code']) && !empty($_POST['lg']) && !empty($_POST['code']))
{
	//Instanciation des managers
	$loginManager = new LoginManager($db);
	$checkingAccountManager = new CheckingAccountManager($db);

	// Recuperation des parametres de de l'url
	$lgEncode = $_POST['lg'];
	$lg =  base64_decode($_POST['lg']) ; // Signifie l'email du candidate
	$code = (string) ($_POST['code']) ;

	$login = $loginManager->get($lg);
	// Si le login est null
	if (is_null($login))
	{
		echo FormMask::error(array("state"=>false, "description"=>"Il a eu un problème au niveau du mail"));
		exit ;
	}
	if ($login->state() == 1 || $login->state() ==true)
	{
		echo FormMask::error(array("state"=>false, "redirect"=> $url."defaultPage","description" => "Ce compte a été déja vérifié. Vous allez etre redirigé.")) ;	exit ;
	}

	$checkingAccount = $checkingAccountManager->get($login->id()) ;
	//S'il y'a un problème avec ce objet
	if (is_null($checkingAccount) || !$checkingAccount->isValid())
	{
		echo FormMask::error(array("state"=>false, "description"=>"Il a eu un problème lors de l'obtention des informations de validation. Veuillez redemander un nouveau code."));
		exit ;
	}

	//On verifie si la date limite n'est pas expirée
	$now = new  \Datetime() ;
	if ($checkingAccount->timeOver()->getTimestamp() < $now->getTimestamp())
	{
		echo FormMask::error(array("state"=>false, "description"=>"Le code est expiré. Veuillez redemander un nouveau code"));
		exit ;
	}
	// A ce niveau on peut ecrire dans la base de donnée
	try {
		$db->beginTransaction();
		$login->setState(1);
		$loginManager->update($login) ;
		$checkingAccountManager->delete($checkingAccount) ;
		if ($db->commit())
		{
			echo FormMask::error(array("state"=>true, "redirect" =>$url."defaultPage" , "description"=>"Ce compte a été bien vérifié. Vous allez être redirigé."));	exit ;
		}
	} catch(Exception $e)
	{
		$db-> rollBack();
		echo FormMask::error(array("state"=>false, "description"=>"Erreur".$e->getMessage()." Veuillez réessayer ou demander un nouveau code")); exit;
	}
}
?>
<?php require 'view/confirmEmailView.html' ; ?>