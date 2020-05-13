<?php

namespace lerefcode ;
use \model\LoginManager ;
use \model\CandidateManager ;
use \model\CheckingAccountManager ;

session_start();

require ('autoload.php') ;
// Verification que les inputs des formulaires sont bien recues

if (
	FormMask::getInputFormIsEnterAndNotEmpty($_POST['lastName']) &&
	FormMask::getInputFormIsEnterAndNotEmpty($_POST['firstName']) &&
	FormMask::getInputFormIsEnterAndNotEmpty($_POST['email']) &&
	FormMask::getInputFormIsEnterAndNotEmpty($_POST['dateOfBirth']) &&
	FormMask::getInputFormIsEnterAndNotEmpty($_POST['nationality']) &&

	FormMask::getInputFormIsEnterAndNotEmpty($_POST['countryOfResidence']) &&
	FormMask::getInputFormIsEnterAndNotEmpty($_POST['cityOfResidence']) &&
	FormMask::getInputFormIsEnter($_POST['gender']) &&

	FormMask::getInputFormIsEnterAndNotEmpty ($_FILES['photoOfProfil']) &&
	FormMask::getInputFormIsEnterAndNotEmpty($_POST['aboutCompetence']) &&
	FormMask::getInputFormIsEnterAndNotEmpty($_POST['password']) &&
	FormMask::getInputFormIsEnterAndNotEmpty($_POST['samePassword']) 
)
{
	
	//Si la photo est invalide
	if (!FormMask::verifyFile('photoOfProfil'))
	{
		echo FormMask::error( array("state"=> false , "description" => "Le fichier que vous avez envoyé est invalide ou la taille trop grande." )) ;
		exit ;
	}
	// Si les mots de passes sont différent
	if ($_POST['password'] !== $_POST['samePassword'])
	{
		echo FormMask::error( array("state"=> false , "description" => "Les mots de passes ne correspondent pas." )) ;
		exit ;
	}	
	// Tablueau pour initaliser les objets login et candidate
	$candidateLoginArray= array(
		'email'				=> FormMask::parseInputForm($_POST['email'])  ,
		'type'				=> Login::TYPE_CANDIDATE ,
		'password'			=> FormMask::parseInputForm($_POST['password']) ,
		'isDelete'			=> 0,
		'state'				=> 0, 
		'dateOfCreation'	=> new \Datetime("now") 
	) ;
	$candidateInfoArray = array(
		'lastName'				=> FormMask::parseInputForm($_POST['lastName']) ,
		'firstName'				=> FormMask::parseInputForm($_POST['firstName']) ,
		'dateOfBirth'			=> new \Datetime ( $_POST['dateOfBirth'] )  ,
		'nationality'			=> FormMask::parseInputForm($_POST['nationality']) ,
		'countryOfResidence'	=> FormMask::parseInputForm($_POST['countryOfResidence']) ,
		'cityOfResidence'		=> FormMask::parseInputForm($_POST['cityOfResidence']) ,
		'gender'				=> FormMask::parseInputForm($_POST['gender']) ,
		'aboutCompetence'		=> FormMask::parseInputForm($_POST['aboutCompetence']) ,
		'password'				=> FormMask::parseInputForm($_POST['password'])  
	) ;

	//Instanciation de la base de donnée grace au design FACTORY
	$database = null ;
	try {
		$database = \lerefcode\Database::getMysqlConnectWithPDO() ;

	} catch (Exception $e)
	{
		echo FormMask::error( array("state"=> false , "description" => 'Probleme '.$e->getMessage()  )) ;		
		exit ;
	}
	
	//Instanciation des classes managers 
	$loginManager = new \model\LoginManager ($database) ;
	$candidateManager = new \model\CandidateManager($database);
	$checkingAccountManager = new \model\CheckingAccountManager($database) ;

	//Instanciation des classes login et candidate
	$login = new Login($candidateLoginArray) ;
	$candidate = new Candidate($candidateInfoArray);
	
	//Verification de la validité du login
 	if (!$login->isValid())
	{
		echo FormMask::error( array("state"=> false , "description" => 'Probleme  au niveau de l\'email ou du mot de passe ' )) ; exit ;
	}	
	
	// Vérification de la validité du candidat sans la clé etrangere et la photo de profil
	if (!$candidate->isValidWithoutForeignKeyAndPhotoOfProfil() )
	{
		echo FormMask::error( array("state"=> false , "description" => 'Probleme  au niveau des informations du clients' )) ;
		exit ;
	}
	
	//On verifie que ce mail n'est pas utilisé 
	$loginCopy = $loginManager->get( FormMask::parseInputForm($_POST['email']) ) ;

	// Si l'utilisateur existe déja
	if ( !is_null($loginCopy) && $loginCopy->email() == FormMask::parseInputForm($_POST['email'])  )
	{
		if ($loginCopy->state()==false || $loginCopy->state()==0)
		{
			//$tokenInfoPartial = $checkingAccountManager->get($loginCopy->id()) ;
			
			$url=  null ; 
			if (isset ($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) )
			{
				$url = 'https://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'] .'/?action=confirmEmail&lg='.base64_encode($loginCopy->email()) ;
			} else 
			{
				$url = $url = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'] .'/?action=confirmEmail&lg='.base64_encode($loginCopy->email())  ;
			}
			echo FormMask::error( array("state"=> false , "redirect"=> $url , "description" => 'Ce compte email est déja inscrit. Activer le compte')) ;
			exit ;
		}
		echo FormMask::error( array("state"=> false , "description" => 'Ce compte email est déja inscrit' )) ;
		exit ;
	}
	
	// On enregistre les valeurs du login
	if ($login->isValid())
	{
		try {
			$loginManager->add($login) ;
			$candidate->setLoginId($login->id()) ;			
		} catch (Exception $e)
		{
			echo FormMask::error( array("state"=> false , "description" => 'Il a eu une erreur lors de l\'ajout des informations '  )) ;		
			exit ;
		}		
	}
	
	//On enregistre les informations du candidats
	if ($candidate->isValidWithoutForeignKeyAndPhotoOfProfil())
	{
		try {
			$candidateManager->add($candidate) ;	
		}
		catch (Exception $e)
		{
			echo FormMask::error( array("state"=> false , "description" => 'Il a eu une erreur lors de l\'ajout des informations '  )) ;		
			exit ;
		}		
	}
	
	
	$userFolder = $_SERVER['DOCUMENT_ROOT'].'/users/'.$candidate->id().'/photoOfProfil/photoOfProfil.' . FormMask::getExtensionFile('photoOfProfil') ;
	$userFolderBase = $_SERVER['DOCUMENT_ROOT'].'/users/'.$candidate->id().'/photoOfProfil/' ;
	$userFolderBase = str_replace('\\', '/', $userFolderBase);
	$userFolder = str_replace('\\', '/', $userFolder);
	
	// On crée le dossier personnel de chaque utilisateur s'il n'existe pas 
	if (!is_dir($userFolderBase))
	{
		mkdir($userFolderBase, 0750, TRUE) ;
	}
	
	// On enregistre la photo de profil dans le bon dossier
	move_uploaded_file($_FILES['photoOfProfil']['tmp_name'], $userFolder ) ;
	//Il faut actualiser alors les informations du candidat
	$candidate->setPhotoOfProfil($userFolder) ;
	
	//Il faut mettre à jour les données de $candidate dans la base de données
	try{
		$candidateManager->update($candidate) ;
	} catch (Exception $e)
	{
		echo FormMask::error( array("state"=> false , "description" => 'Il a eu une erreur lors de l\'ajout des informations.'));	
		exit ;
	}
	//On récupere le code et urlToken
	$code = \lerefcode\Security::getSimpleToken() ;
	$urlToken =	\lerefcode\Security::urlToken();
	
	$checkingAccount = new \lerefcode\CheckingAccount(array (
		'code'			=> $code,
		'loginId' 		=> $login->id() ,
		'urlToken'		=> $urlToken, 
		'timeOver' 		=> new \Datetime("+3 hour"))
	) ;
	
	//Enregistrement des informations de validation de compte 
	if ( $checkingAccount->isNew() )
	{
		try {
			$checkingAccountManager->add($checkingAccount) ; 			
		}
		catch (Exception $e)
		{
			echo FormMask::error( array("state"=> false , "description" => 'Il a eu une erreur lors de l\'ajout des informations '  )) ;		
			exit ;
		}
	}
	
	// Envoie du mail 
	$mailSend = false ;
	$mailSend = Mail::sendWelcomeMailToCandidate($login->email() ,$candidate, $checkingAccount , $headers = null) ;		
	if ($mailSend)
	{
		$url=  null ; 
		if (isset ($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) )
		{
			$url = 'https://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'] .'/?action=confirmEmail&lg='.base64_encode($login->email())  ;
		} else 
		{
			$url = $url = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'] .'/?action=confirmEmail&lg='.base64_encode($login->email())  ;
		}
		echo FormMask::error( array("state"=> true , "redirect"=> $url , "description" => "Votre compte a été créé. Un mail de validation vous a été envoyé"  )) ;
		exit ;
	} else 
	{
		echo FormMask::error( array("state"=> false ,  "description" => "Le compte est créé mais nous ne pouvons pas envoyé un mail de validation"  )) ;
		exit ;
	}
	/*
	try {
		$mailSend = Mail::sendWelcomeMailToCandidate($login->email() ,$candidate, $checkingAccount , $headers = null) ;		
	} catch (Exception $e)
	{
		echo FormMask::error( array("state"=> false , "description" => "Il a eu une erreur lors de l'envoi du mail de validation"  )) ;
		exit ;
	} 
	if ($mailSend)
	{
		echo FormMask::error( array("state"=> true , "description" => "Un mail de validation vous a été envoyé"  )) ;
		exit ;
	} else 
	{
		echo FormMask::error( array("state"=> false , "description" => "Le compte est créé mais nous ne pouvons pas envoyé un mail de validation"  )) ;
		exit ;
	}
	*/
	/*
	$misterOrMadame =  ($candidate->gender() === TRUE || $candidate->gender()===1) ? "Monsieur"  : "Madame" ; 
	$message = "Bonjour ".$misterOrMadame." ".$candidate->lastName()." ".strtoupper($candidate->lastName())."<br> Votre code est d'activation est <strong>".$acountStep->code()."<strong><br> Vous pouvez aussi utilisez le lien suivant en cliquant <a href=".$acountStep->urlToken()."> ici</a>. Si le lien ne redirige pas, vous pouvez cliquer ou copier ce lien dans un navigateur ".$acountStep->urlToken() ."Ceci est un mail automatique. Ne répondez pas.<br> L'équipe technique Lerefcode." ;
	
	if ($candidate->isValid())
	{
		$candidate->setLogin_id($login->id()) ;
		$candidateManager->add ($candidate);
		if (Mail::sendWelcomeMessage($login->email(), $message )== true)
		{
			echo "Mail envoyé avec success" ;
		}
	}
	*/
}
?> 