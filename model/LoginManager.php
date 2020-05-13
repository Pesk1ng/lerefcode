<?php
namespace model ;
use \lerefcode\Login;
class LoginManager
{
	private $db ;
	function __construct(\PDO $db)
	{
		$this->db = $db ;
	}

    /**
     * Enregistre un nouvel élément dans la base de donnée
     * @param Login $login
     * @throws \Exception
     */
	function add( \lerefcode\Login $login)
	{
		if ($login->isNew())
		{
			$requete  = $this->db->prepare ('INSERT INTO login (`email`,`password`, `type`, `state`, `isDelete`, `dateOfCreation`) VALUES (:email, :password, :type , :state, :isDelete, :dateOfCreation)') ;
			$requete->bindValue(':email' ,$login->email() , \PDO::PARAM_STR) ;
			$requete->bindValue(':password' ,$login->password() , \PDO::PARAM_STR) ;			
			$requete->bindValue(':type' , $login->type() , \PDO::PARAM_INT) ;
			$requete->bindValue(':state' , $login->state() , \PDO::PARAM_BOOL) ;
			$requete->bindValue(':isDelete' , $login->isDelete() , \PDO::PARAM_BOOL) ;
			$requete->bindValue(':dateOfCreation' , $login->dateOfCreation()->format('Y-m-d H:i:s') ) ;
			$requete->execute() ;
			$login->setId( (int) $this->db->lastInsertId()) ;
			$requete->closeCursor() ;			
		}		
	}

    /**
     * Met à jour un objet existant
     * @param Login $login
     * @throws \Exception
     */
	function update (\lerefcode\Login $login)
	{
		if (!$login->isNew())
		{
			$requete  = $this->db->prepare ('UPDATE `login` SET `email` =:email ,`type` =:type , `state` =:state, `isDelete` =:isDelete WHERE `id` =:id') ;
			$requete->bindValue(':email' , $login->email() , \PDO::PARAM_STR) ;
			$requete->bindValue(':type' , $login->type() , \PDO::PARAM_INT) ;
			$requete->bindValue(':state' ,  (bool) $login->state() ,  \PDO::PARAM_BOOL ) ;
			$requete->bindValue(':isDelete' , (bool) $login->isDelete() , \PDO::PARAM_BOOL) ;
			$requete->bindValue(':id', (int) $login->id() , \PDO::PARAM_INT) ;
			$requete->execute() ;
			$login->setId($this->db->lastInsertId()) ;
			$requete->closeCursor() ;	
			
		}

	}

    /**
     * Enregistre un élément \lerefcode\Login dans la base de donnée.
     * Il gère l'insertion d'un nouveau élément ainsi que sa mise à jour
     * @param Login $login
     * @see LoginManager::get()
     * @see LoginManager::update()
     */
	function save (\lerefcode\Login $login)
	{
		$this->add($login);
		$this->update($login);
	}

    /**
     * Retourne un objet Login
     * @param $param: Soit un entier qui représente l'identifianrt dans la base de donnée ou un email $email
     * @return \lerefcode\Login|void
     * @throws \Exception
     */
	function get($param)
	{
		if (filter_var($param, FILTER_VALIDATE_EMAIL))
		{
			$requete = $this->db->prepare ('SELECT `id` , `email`,  `type`, `state`, `isDelete`, `password`, `dateOfCreation` FROM `login` WHERE `email` = :email') ;
			$requete->bindValue(':email' , $param, \PDO::PARAM_STR ) ;
			$requete->execute() ;
			$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE , '\lerefcode\Login');
			$login = $requete->fetch() ;			
			if (!$login) return ;				
			$login->setDateOfCreation( new \DateTime($login->dateOfCreation())) ;
			$requete->closeCursor() ;
			return  $login ;
		} else if (is_int (param))
		{
			$requete = $this->db->prepare ('SELECT `id` , `email`, `type`, `state`, `isDelete` , `password`, `dateOfCreation` FROM `login` WHERE `id` = :id') ;
			$requete->bindValue(':id' , $param , \PDO::PARAM_INT) ;
			$requete->execute() ;
			$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\lerefcode\Login');
			$login = $requete->fetch() ;
			$requete-> closeCursor() ;
			if (!$login) return ;			
			$login->setDateOfCreation( new \DateTime( $login->dateOfCreation() ) ) ;
			return  $login ;
		}
		
	}
}