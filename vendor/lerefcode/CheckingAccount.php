<?php
namespace lerefcode ;
/**
 * Class CheckingAccount
 * @package lerefcode
 */
class CheckingAccount
{
	protected $id ;
	protected $code ;
	protected $loginId ;
	protected $timeOver ;
	protected $urlToken ;
	protected $numberOfTrials; 
	const MAX_CODE_SIZE = 220 ;
	

	public function __construct(array $data = [])
    {
		if (!empty($data))
		{
			$this->hydrate($data) ; 			
		}               
    }
	
	function id()
	{
		return (int) $this->id ;
	}
	function code()
	{
		return $this->code ;
	}
	function loginId()
	{
		return (int) $this->loginId ;
	}
	function timeOver() 
	{
		return $this->timeOver ;
	}
	function urlToken()
	{
		return $this->urlToken ;
	}
	function numberOfTrials ()
	{
		return $this->numberOfTrials ;
	}
	
	function setId($id)
	{
		if (is_int($id))
		{
			$this->id = $id ;
		}
	}
	
	function setLoginId($loginId)
	{
		if (is_int($loginId))
		{
			$this->loginId = $loginId ;
		}
	}
	
	function setCode($code)
	{
		if (strlen($code) <= self::MAX_CODE_SIZE)
		{
			$this->code = $code ;
		}	
	}
	function setTimeOver(\DateTime $timeOver =null)
	{
		$this->timeOver = $timeOver ;
		
	}
	function setUrlToken( $urlToken)
	{
		$this->urlToken = $urlToken ;
		
	}
	function setNumberOfTrials($number)
	{
		if (is_int($number) && $number<=100)
		{
			$this->numberOfTrials = $number;
		}		
	}
	
	function isValid()
	{
		return 
			!empty($this->code) &&
			!empty($this->loginId ) &&
			!empty($this->timeOver ) &&
			!empty($this->urlToken )  ;
		//&&
		//	!empty($numberOfTrials) ;
	}
	function isNew()
	{
		return empty ($this->id);
	}
	/**
	* Verifie si le code est expiré  
	* @return bool : retourne true si ce n'est pas expiré sinon retourne false
	*/	
	public function isExpire()
	{
		$now = new  \DateTime() ;		
		if ($now->getTimestamp()  > $this->timeOver->getTimestamp() )
		{
			return true ;
		} 
		else 
		{
			return false ;
		}
	}
	
	function hydrate (array $donnees)
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
}


?>