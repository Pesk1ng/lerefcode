<?php
$requireFile= $_SERVER['DOCUMENT_ROOT'].'/vendor/lerefcode/SplClassLoader.php' ;
$requireFile = str_replace('\\','/', $requireFile) ;
require($requireFile) ;
//require __DIR__."/../../vendor/lerefcode/SplClassLoader.php" ;
//$pathCore = __DIR__.'/../../vendor' ;
$pathCore = $_SERVER['DOCUMENT_ROOT'].'/vendor' ;
$pathCore = str_replace('\\','/', $pathCore );
$pathModel = str_replace('\\','/', $_SERVER['DOCUMENT_ROOT']) ;
$loaderCore= new \SplClassLoader('lerefcode', $pathCore);
$loaderCore->register();

$loaderModel = new \SplClassLoader('model', $pathModel );
$loaderModel->register();


?>