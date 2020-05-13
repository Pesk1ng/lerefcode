<?php
namespace lerefcode ;
/**
 * Génere des codes et des tokens cryptographiquement sécurisé
 * Class Security
 * @package lerefcode
 * Picasso Houessou houessoupicasso@yahoo.fr
 */
class Security 
{
	const RANDOM_DEFAULT = 1 ;
	const RANDOM_OPENSSL = 2 ;

    /**
     * Génère un code qui represente le code de validation par url
     * Ne contient pas le lien url, juste le code.
     * @return string|void
     * @throws \Exception
     */
	public static function urlToken()
	{		
		$token = null ;
		$aleatoire = random_int(1,2);
		// key=1111
		switch ($aleatoire)
		{
			case self::RANDOM_DEFAULT :
				$token = bin2hex(random_bytes(60)) ;
				break ;
			case self::RANDOM_OPENSSL :
				$token = bin2hex(openssl_random_pseudo_bytes (60)) ;
				break ;
			default :
				$token = bin2hex(random_bytes(60)) ;
				break ;
		}
		if (is_null($token) || $token ==FALSE)
			return ;
		return $token ;
	}

    /**
     * Génère un code simple pour les vérifications
     * @return string
     * @throws \Exception
     */
    public static function getSimpleToken()
    {
		$token = null ;
		$aleatoire = random_int(1,2);
		// key=1111
		switch ($aleatoire)
		{
			case self::RANDOM_DEFAULT :
				$token = strtoupper(bin2hex(random_bytes(5)))  ;
				break ;
			case self::RANDOM_OPENSSL :
				$token = strtoupper( bin2hex(openssl_random_pseudo_bytes(5)) ) ;
				break ;
			default :
				$token = strtoupper( bin2hex(random_bytes(5)) ) ;
				break ;
		}
		return $token ;
	}
}
?>