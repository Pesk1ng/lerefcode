<?php
/**
 * enregistre automatiquement nos autoloads 
 */
$requireFile= $_SERVER['DOCUMENT_ROOT'].'/vendor/lerefcode/SplClassLoader.php' ;
$requireFile = str_replace('\\','/', $requireFile) ;
require($requireFile) ;
$pathCore = $_SERVER['DOCUMENT_ROOT'].'/vendor' ;
$pathCore = str_replace('\\','/', $pathCore );
$pathModel = str_replace('\\','/', $_SERVER['DOCUMENT_ROOT']) ;
$loaderCore= new \SplClassLoader('lerefcode', $pathCore);
$loaderCore->register();

$loaderModel = new \SplClassLoader('model', $pathModel );
$loaderModel->register();


?>