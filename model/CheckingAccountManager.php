<?php
namespace model;
use \lerefcode\CheckingAccount ;

/**
 * Class CheckingAccountManager
 * @package model
 * @author Picassso Houessou
 * @package lerefcode
 */

class CheckingAccountManager {
    protected $db ;    

    public function __construct(\PDO $db)
    {
        $this->db = $db ;        
    }
    /**
    * @brief Pour ajouter ou enregistrer un nouveau candidat
    *
    */
    public function add (\lerefcode\CheckingAccount $checkingAccount)
    {
        if ($checkingAccount->isValid() && $checkingAccount->isNew() )
        {
            $requete = $this->db->prepare ('INSERT INTO `checkingAccount` (`code`, `login_id` , `urlToken`, `timeOver` ) VALUES(:code, :loginId , :urlToken , :timeOver)') ; 
            $requete->bindValue (':code' , $checkingAccount->code());
            $requete->bindValue (':loginId' , (int) $checkingAccount->loginId(), \PDO::PARAM_INT) ;
            $requete->bindValue(':urlToken' , $checkingAccount->urlToken()) ;
			$requete->bindValue(':timeOver' , $checkingAccount->timeOver()->format('Y-m-d H:i:s')) ;
            $requete->execute() ;            
            $loginId = (int ) $this->db->lastInsertId() ;
            $checkingAccount->setLoginId($loginId);
			$requete->closeCursor();  
        }
	
    }
	public function update(\lerefcode\CheckingAccount $checkingAccount)
	{
		if ( $checkingAccount->isValid() && !$checkingAccount->isNew())
		{
			$requete = $this->db->prepare ('UPDATE `checkingAccount` SET `code` =:code, `login_id`=:loginId  , `urlToken` =:urlToken, `numberOfTrials` =:numberOfTrials , `timeOver` =:timeOver WHERE `id`=:id ') ;
		
			$requete->bindValue (':code' , $checkingAccount->code());
            $requete->bindValue (':loginId' , (int) $checkingAccount->loginId(), \PDO::PARAM_INT ) ;
            $requete->bindValue(':urlToken' , $checkingAccount->urlToken()) ;
			$requete->bindValue(':numberOfTrials' , (int) $checkingAccount->numberOfTrials(), \PDO::PARAM_INT) ;
			$requete->bindValue(':id' , (int)  $checkingAccount->id(), \PDO::PARAM_INT) ;
			$requete->bindValue(':timeOver' , $checkingAccount->timeOver()->format('Y-m-d H:i:s')) ;
			$requete->execute() ;
            $requete->closeCursor();   
   
		}
			
	}
	public function reset(\lerefcode\CheckingAccount $checkingAccount)
	{
		if ( !$checkingAccount->isNew())
		{
			$requete = $this->db->prepare ('UPDATE `checkingAccount` SET `code` =:code , `login_id`=:loginId , `urlToken` =:urlToken, `numberOfTrials` =:numberOfTrials , `timeOver` =:timeOver WHERE `id` =:id ') ;
		
			$requete->bindValue (':code' , null , \PDO::PARAM_NULL);
            $requete->bindValue (':loginId' , (int) $checkingAccount->loginId(), \PDO::PARAM_INT ) ;
            $requete->bindValue(':urlToken' , null , \PDO::PARAM_NULL) ;
			$requete->bindValue(':numberOfTrials' , null , \PDO::PARAM_NULL) ;
			$requete->bindValue(':id' , (int)  $checkingAccount->id(), \PDO::PARAM_INT) ;
			$requete->bindValue(':timeOver' , null , \PDO::PARAM_NULL ) ;
			$requete->execute();
			$requete->closeCursor();
		}
	}
	public function get($param)
	{
		if (is_int($param))
		{
			$requete = $this->db->prepare ('SELECT `id`, `code`, `login_id` AS `loginId`, `urlToken` , `timeOver`, `numberOfTrials` FROM `checkingAccount` WHERE `login_id` = :loginId') ;
			$requete->bindValue(':loginId' , (int) $param, \PDO::PARAM_INT ) ;
			$requete->execute() ;
			$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\lerefcode\CheckingAccount');
			$checkingAccount = $requete->fetch() ;
            if (!$checkingAccount) return ;
            $checkingAccount->setTimeOver(new \DateTime($checkingAccount->timeOver()) ) ;
			$requete->closeCursor();
    		return $checkingAccount ;			
		}
		
	}
	public function delete(\lerefcode\CheckingAccount $checkingAccount)
    {
        /*
        $this->db->exec("DELETE FROM `checkingAccount` WHERE `id` =". (int) $checkingAccount->id() ) ;
        */
        if ( $checkingAccount->isValid() )
        {
            $this->db->exec("DELETE FROM `checkingAccount` WHERE `id` =". (int) $checkingAccount->id() ) ;

            /*
            $requete = $this->db->prepare(" DELETE FROM `checkingAccount` WHERE `id` =:id");
            $requete->bindValue(':id', (int)$checkingAccount->id() , \PDO::PARAM_INT);
            $requete->execute() ;
            $requete->closeCursor();
            */

        }

    }
	

}

?>