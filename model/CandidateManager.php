<?php
namespace model;
use \lerefcode\Candidate ;

/**
 * Class CandidateManager
 * @package model
 * @author Picasso Houessou houessoupicasso@yahoo.fr
 *
 */
class CandidateManager {
    protected $db ;
	
	public function __construct(\PDO $db)
    {
        $this->db =$db;        
    }
    /**
    * @brief Pour ajouter ou enregistrer un nouveau candidat
    *
    */
    public function add (Candidate $candidate)
    {
        if ($candidate->isValidWithoutForeignKeyAndPhotoOfProfil() && $candidate->isNew())
        {
            $requete = $this->db->prepare('INSERT INTO `candidate` (`lastName`, `firstName` , `countryOfResidence` , `dateOfBirth` , `gender`, `aboutCompetence` , `login_id`, `nationality` , `cityOfResidence` ) VALUES(:lastName, :firstName , :countryOfResidence , :dateOfBirth , :gender , :aboutCompetence , :loginId, :nationality , :cityOfResidence)') ; 
            $requete->bindValue (':lastName' , $candidate->lastName(),\PDO::PARAM_STR);
            $requete->bindValue (':firstName' , $candidate->firstName(), \PDO::PARAM_STR) ;
            //$requete->bindValue(':photoOfProfil' , null) ;
			$requete->bindValue(':countryOfResidence' , $candidate->countryOfResidence(), \PDO::PARAM_STR ) ;
            $requete->bindValue(':dateOfBirth' , $candidate->dateOfBirth()->format('Y-m-d H:i:s'), \PDO::PARAM_STR) ;				
            $requete->bindValue(':gender', $candidate->gender() , \PDO::PARAM_BOOL) ;
            $requete->bindValue(':aboutCompetence', $candidate->aboutCompetence(), \PDO::PARAM_STR) ;
            $requete->bindValue(':loginId', (int) $candidate->loginId() , \PDO::PARAM_INT) ;
            $requete->bindValue(':nationality', $candidate->nationality(), \PDO::PARAM_STR) ;
            $requete->bindValue(':cityOfResidence', $candidate->cityOfResidence(), \PDO::PARAM_STR) ;
            $requete->execute() ;            
            $candidate->setId( (int) $this->db->lastInsertId() ) ;   
			$requete->closeCursor();   
        }
    }
	public function update(Candidate $candidate)
	{
		$requete = $this->db->prepare ('UPDATE `candidate` SET `lastName` = :lastName, `firstName`=:firstName  , `photoOfProfil` =:photoOfProfil, `countryOfResidence` =:countryOfResidence, `dateOfBirth` =:dateOfBirth , `gender` =:gender, `aboutCompetence` =:aboutCompetence , `login_id` =:loginId, `nationality` = :nationality, `cityOfResidence`= :cityOfResidence WHERE `id`=:id ') ;
            $requete->bindValue (':lastName' , $candidate->lastName());
            $requete->bindValue (':firstName' , $candidate->firstName()) ;
            $requete->bindValue(':photoOfProfil' , $candidate->photoOfProfil()) ;
			$requete->bindValue(':countryOfResidence' , $candidate->countryOfResidence() ) ;
            $requete->bindValue(':dateOfBirth' , $candidate->dateOfBirth()->format('Y-m-d H:i:s')) ;
            $requete->bindValue(':gender', $candidate->gender(), \PDO::PARAM_BOOL) ;
            $requete->bindValue(':aboutCompetence', $candidate->aboutCompetence()) ;
            $requete->bindValue(':loginId', (int) $candidate->loginId() , \PDO::PARAM_INT) ;
            $requete->bindValue(':nationality', $candidate->nationality()) ;
            $requete->bindValue(':cityOfResidence', $candidate->cityOfResidence()) ;
			$requete->bindValue(':id', (int) $candidate->id() , \PDO::PARAM_INT) ;
            $requete->execute() ;            
            $loginId = (int ) $this->db->lastInsertId() ;
			$requete->closeCursor();   
            $candidate->setLoginId($loginId);		
	}
	function get($param)
	{
		if (is_int($param))
		{
			$requete = $this->db->prepare ('SELECT `id`,`login_id` AS `loginId`, `lastName`, `firstName` , `photoOfProfil` , `countryOfResidence` , `dateOfBirth` , `gender` , `aboutCompetence`, `nationality` , `cityOfResidence`  FROM `candidate` WHERE `login_id` =:id ') ;
			$requete->bindValue(':id' ,(int) $param, \PDO::PARAM_INT ) ;
			$requete->execute() ;
			$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\lerefcode\Candidate');
			$candidate = $requete->fetch() ;
            if (!$candidate) return ;
            $candidate->setDateOfBirth(new \DateTime($candidate->dateOfBirth()));
			$requete->closeCursor();
    		return $candidate ;			
		}
		
	}
	

}

?>