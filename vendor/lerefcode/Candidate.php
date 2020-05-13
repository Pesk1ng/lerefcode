<?php
namespace lerefcode;
/**
 * Gere les candidats. Représente un candidat
 * @author Picasso Houessou houessoupicasso@yahoo.fr
 * Class Candidate
 * @package lerefcode
 */
class Candidate 
{
    protected $id ;
	protected $loginId;
    protected $lastName ;
    protected $firstName ;
    protected $photoOfProfil;
    protected $bonjour ;
    protected $countryOfResidence ;
    protected $dateOfBirth ;
    protected $gender ;
    protected $aboutCompetence ;
    protected $nationality ;
    protected $cityOfResidence  ;
    protected $validExtension = array('jpg', 'jpeg', 'gif', 'png');
    const MAX_PHOTO_SIZE = 20000 ;
    const MAX_STRING_SIZE = 220 ;
    const LAST_NAME_INVALID =1 ;
    const FIRST_NAME_INVALID =2;
    const PHOTO_OF_PROFIL_INVALID = 3 ;
    const DATE_OF_BIRTH_INVALID = 4 ;
    const GENDER_INVALIDE = 5;

    public  function bonjour()
    {
        return $this->bonjour ;
}

    public function __construct(array $donnees = [])
    {
		if (!empty($donnees))
		{
			$this->hydrate($donnees) ; 			
		}

               
    }
	
	public function id()
	{
		return (int) $this->id ;
	}
	public function loginId()
	{
		return (int) $this->loginId ;
	}
	
	public function  lastName()
	{
		return $this->lastName ;
	}
	public function firstName()
	{
		return $this->firstName ;
	}
	
	public function dateOfBirth()
	{
		return $this->dateOfBirth ;
	}
	
	function gender()
	{
		return $this->gender ;
	}
	
	public function countryOfResidence()
	{
		return $this->countryOfResidence ;
	}
	
	public function cityOfResidence()
	{
		return $this->cityOfResidence;
	}
	
	public function nationality ()
	{
		return $this->nationality ;
	}
	
	public function photoOfProfil()
	{
		return $this->photoOfProfil ;
		
	}
	
	public function aboutCompetence()
	{
		return $this->aboutCompetence ;
	}
	
	
	
    public function setId($id)
    {
        if (is_int($id))
        {
            $this->id = $id ;
        }        
    }
	
	public function setLoginId($loginId)
	{
		if (is_int($loginId))
        {
            $this->loginId = $loginId ;
        }	
	}
	
    public function setLastName($lastName)
    {
        if (is_string($lastName) && strlen($lastName) < self::MAX_STRING_SIZE)
        {
			$allName = explode (" ", $lastName) ;
			foreach($allName as $key=>$value)
			{
				$allName[$key] = ucfirst( strtolower($value) );
			}
			$allName = implode(" ", $allName) ;
            $this->lastName = $allName ;
        }
    }
	
    public function setFirstName($firstName)
    {
        if (is_string($firstName) && strlen( $firstName) <self::MAX_STRING_SIZE)
        {
			$allName = explode (" ", $firstName) ;

			foreach($allName as $key=>$value)
			{
				$allName[$key] = ucfirst( strtolower($value) );
			}
			$allName = implode(" ", $allName ) ;
			/*
			if (is_null($allName))
            {
                $this->firstName = ucfirst($firstName) ; return ;
            } */
            $this->firstName = $allName ;
        }
    }
	
	public function setDateOfBirth(\DateTime $dateOfBirth)
    {       
    	$this->dateOfBirth = $dateOfBirth;        
    }
    
	public function setNationality ($nationality)
    {
        if (is_string($nationality) && $nationality<self::MAX_STRING_SIZE) 
        {
            $this->nationality = $nationality ;
        }
    }
    
    public function setCountryOfResidence($countryOfResidence)
    {
        if (is_string($countryOfResidence) && ( strlen($countryOfResidence) < self::MAX_STRING_SIZE) )
        {
            $this->countryOfResidence = $countryOfResidence ;
        }
    }
	
	public function setCityOfResidence ($cityOfResidence)
    {
        if (is_string($cityOfResidence) && (strlen($cityOfResidence) <self::MAX_STRING_SIZE)  )
        {
            $this->cityOfResidence = $cityOfResidence ;
        }

    }
	
	public function setGender($gender)
    {
        if ( is_bool($gender) || $gender==1 || $gender==0 )
        {
            $this->gender = $gender ;
        }
       
    }
    
	public function setPhotoOfProfil($photoOfProfil)
    {
        if (is_string($photoOfProfil))
        {
            $this->photoOfProfil = $photoOfProfil ;
        }
    }   
   
    public function setAboutCompetence($competence)
    {
        if (is_string($competence) && ( strlen($competence ) >= 300)  && ( strlen($competence) <= 1100) )
        {
            $this->aboutCompetence= $competence ;

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
    /**
    * Verifie si l'instance est valide sans la clé étrangére
    * @return bool Si valide retourne TRUE SINON FALSE
    * @see Login
    */
	public function isValidWithoutForeignKeyAndPhotoOfProfil()
    {
        return  
                !empty($this->lastName) &&
                !empty($this->firstName) &&              
                !empty($this->countryOfResidence) &&
                !empty($this->dateOfBirth)  &&
                ($this->gender==TRUE || $this->gender ==1 || $this->gender ==FALSE || $this->gender==0) &&
                !empty($this->aboutCompetence) && 
                !empty($this->nationality)     && 
                !empty($this->cityOfResidence) ;
    }
    public function isValidWithoutForeignKey()
    {
        return  
                !empty($this->lastName) &&
                !empty($this->firstName) && 
                !empty($this->photoOfProfil) &&
                !empty($this->countryOfResidence) &&
                !empty($this->dateOfBirth)  &&
                ($this->gender==TRUE || $this->gender==1 || $this->gender==FALSE || $this->gender==0) &&
                !empty($this->aboutCompetence) && 
                !empty($this->nationality)     && 
                !empty($this->cityOfResidence) ;
    }
    public function isValid()
    {
        return $this->isValidWithoutForeignKey() && !empty($this->loginId ) ;
    }
	
	public function isNew()
	{
		return empty($this->id) ;
		
	}
}

?>