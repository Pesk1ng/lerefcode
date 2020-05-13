<?php
namespace lerefcode ;
/**
 * Classe qui sert à retourner un objet PDO représentant la base de donnée.
 * C'est une application du patter Factory
 * Class Database
 * @package lerefcode
 * @author Picasso Houessou
 */
class Database
{
	public static function getMysqlConnectWithPDO ()
	{
		$db = new \PDO('mysql:host=localhost;dbname=lerefcode;charset=utf8', 'root', '');
		$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);    
    	return $db;
	}	
}
?>