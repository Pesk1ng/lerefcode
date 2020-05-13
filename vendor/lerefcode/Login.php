<?php
namespace lerefcode ;
/**
 * Entité qui represente une connexion.
 * Class Login
 * @package lerefcode
 * @author Picasso Houessou houessoupicasso@yahoo.fr
 */
class Login 
{
	const TYPE_CANDIDATE= 1 ;
	const TYPE_REFERENT=2 ;
	protected $id ;
	protected $email;
	protected $type ;
	protected $password ;
	protected $state ;
	protected $isDelete ;
	protected $dateOfCreation ;
	
	function __construct(array $data = [])
	{
		if (!empty($data))
		{
			$this->hydrate($data) ;			
		}
		
	}

	public function hydrate (array $donnees)
    {
        foreach ($donnees as $key=>$value)
        {
            $method = 'set'.ucFirst($key);
            if (method_exists($this, $method))
            {
                $this->$method($value) ;
            }
        }
    }
	public function id()
	{
		return (int) $this->id ;		
	}
	
	function email()
	{
		return $this->email ;
	}
	function type()
	{
		return $this->type ;
	}
	
	function password()
	{
		return $this->password ;
	}
	function state()
	{
		return $this-> state ;
	}
	function isDelete()
	{
		return $this->isDelete ;
	}
	
	function dateOfCreation()
	{
		return $this->dateOfCreation ;
	}
	
	public function setId($id) 
	{
		if (is_int($id))
		{
			$this->id = $id ;
		}

	}
	public function setEmail($email)
	{
		if (filter_var($email , FILTER_VALIDATE_EMAIL ))
		{
			$this->email = $email ;
		}
	}
	public function setType ($type)
	{
		switch ($type)
		{
			case self::TYPE_CANDIDATE : 
				$this->type = $type ;
				break ;
			case self::TYPE_REFERENT :
				$this->type = $type ;
				break ;
			default : break ;
		}
	}
	public function setPassword($password)
	{
		$password = (string ) $password ;
		$passwordInfos = password_get_info($password);
		if ($passwordInfos["algo"] == NULL)
		{
			$this->password = password_hash($password, PASSWORD_DEFAULT) ;
		} else 
		{
			$this->password = $password ;
		}

	}

	public function setIsDelete($isDelete)
	{
		if (is_bool($isDelete) || $isDelete===0 || $isDelete===1)
		$this->isDelete = $isDelete ;
	}

	public function setDateOfCreation(\DateTime $date)
	{
		$this->dateOfCreation = $date ;
	}
	
	function setState ($state) 
	{
		if ( is_bool($state ) || $state ==1 || $state ==0)
		{
			$this->state = $state ;
		}
	}

    /**
     * Change l'état d'un compte en son contraire.
     * Si actif change en inactif ou désactivé
     * Si désactivé change en actif ou activé
     * @return void
     */
	public function toggleState ()
	{
		$this->state= 1 - $this->state;
	}

    /**
     * Semblable à \lerefcode\Login::toggleState() sauf qu'il agit sur le paramètre isDelete
     * @see Login::toggleState()
     */
	public function toggleIsDelete ()
	{
		$this->isDelete = 1 - $this->isDelete ;
	}

    /**
     * Determine si le compte est nouveau.
     * @return bool true si nouveau sinon false
     */
	function isNew()
	{
		return empty( $this->id ) ;
	}

	function isValid()
	{
		return 
			!empty ($this->type) && 
			!empty ($this->password) && 
			($this->state==TRUE || $this->state==1  || $this->state==FALSE || $this->state==0 ) &&
			($this->isDelete==TRUE || $this->isDelete ==1 || $this->isDelete == FALSE  || $this->isDelete == 0 ) &&
			!empty($this->dateOfCreation) ;
	}

    /**
     * Verifie si actif. C'est à dire si le compte est déja activé
     * @return bool true si actif sinon false
     * @see Login::isValid()
     */

	function isActive()
	{
		return $this->isValid() && ( $this->state==TRUE || $this->state==1 ) ;
	}

}


?>