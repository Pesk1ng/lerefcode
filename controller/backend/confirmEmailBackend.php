<?php
use \model\CandidateManager ;
use \model\LoginManager;
use \model\CheckingAccountManager;
use \lerefcode\Candidate;
use \lerefcode\Login;
use \lerefcode\Database ;
use \lerefcode\CheckingAccount;
use \lerefcode\FormMask;

require ('autoload.php') ;
/*
use lerefcode\Candidate;
use lerefcode\FormMask;
use \lerefcode\LoginManager ;
use \lerefocde\CheckingaccountManager ;
use \lerefcode\Database ;
use \lerefcode\CheckingAccount;
use \lerefcode\Login ;
if (
    isset ($_POST['code']) &&
    isset($_POST['email'] )
)
{
    $database = null ;
    try {
        $db = Database::getMysqlConnectWithPDO();
    } catch (Exception $e)
    {
        echo FormMask::error( array("state"=> false , "description" => 'Probleme '.$e->getMessage()  )) ;
        exit ;
    }

    $email  = (string) $_POST['email'] ;

    //Instanciation des classes managers
    $loginManager = new \model\LoginManager ($database) ;
    $candidateManager = new \model\CandidateManager($database);
    $checkingAccountManager = new \model\CheckingAccountManager($database) ;

    //Instanciation des classes login et candidate
    $login = $loginManager->get($email) ;
    $checkingAccount = checkingAccountManager->get($login->id());

}
*/

if (isset($_POST['lg']) && isset($_POST['code']) && !empty($_POST['lg']) && !empty($_POST['code']))
{
    $db =null;
    try {
        $db = Database::getMysqlConnectWithPDO ();
    } catch (Exception $e)
    {
        die ($e->getMessage()) ; exit ;
    }
    $url =null ;
    if (isset ($_SERVER['HTTPS']))
    {
        $url = $url= 'https://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/?action=' ;

    } else {
        $url= 'http://'. $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/?action=' ;
    }
    echo  "eee"; exit;

    $html = "<!DOCTYPE html> <html'><head><meta charset='utf-8'> <title> Erreur de Validation de compte</title></head><body style='font-size: x-large;text-align: center;' >{{contentHtml}}<p>Si la redirection ne marche pas cliquez <a href=\"{{url}}\" style='text-decoration: none;'> ici.</a><p/></body></html>"   ;
    //Instanciation des managers
    $loginManager = new LoginManager($db);
    $checkingAccountManager = new CheckingAccountManager($db);

    $lgEncode = $_POST['lg'];
    $lg =  base64_decode($_POST['lg']) ;
    $code = (string) ($_POST['code']) ;

    $login = $loginManager->get($lg);
    //print_r($login); exit;
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
        $checkingAccountManager->reset($checkingAccount) ;
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