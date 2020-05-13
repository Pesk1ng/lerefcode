<?php
namespace lerefcode;

//namespace model;

/*
* @author Picasso Houessou
* @date April 2020
* @brief Routeur
* @details 
*/
//require "vendor/lerefcode/autoload.php" ;
/*
require "vendor/lerefcode/SplClassLoader.php" ;
$pathCore = __DIR__.'/vendor' ;
$pathCore = str_replace('\\','/', $pathCore );
$pathModel = str_replace('\\','/', __DIR__);
/*$pathCore = 'C:/wamp64/www/lerefcode/vendor' ;
echo $pathCore .'<br>';
//spl_autoload_register('Autoloader::autoload');
echo 'include pathCore '.$loader->getIncludePath();
echo '<br>';
echo 'separator '.$loader->getNamespaceSeparator();
echo '<br>';
*/
/*
$loaderCore= new \SplClassLoader('lerefcode', $pathCore);
$loaderCore->register();

$loaderModel = new \SplClassLoader('model', $pathModel );
$loaderModel->register();
*/
try {
    if (isset($_GET['action']))
    {
        $action = (string) htmlspecialchars($_GET['action'] );
        $pages = scandir('controller/');
        //$action = ucfirst($action);
        if (in_array($action.'.php' , $pages) )
        {
            require 'controller/'.$action.'.php' ;
        } else 
        {
            require 'controller/404.php' ;
        }
        
    } else 
    {
        require 'controller/defaultPage.php' ;
    }

} catch(Exception $e)
{
    echo '<p> Une erreur est survenue .</p><br>';

}
catch (ErrorException $e)
{
    echo '<p> Une erreur est survenue .</p><br>';

}


?>