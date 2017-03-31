<?php
use MVC\App;

spl_autoload_register(function($clsName){
    include_once 'MVC/Helpers/Path.php';
    $clsFile = MVC\Helpers\Path::getAbsolutePath() . str_replace('\\','/',$clsName).".php";
    if (file_exists($clsFile)) {
        require_once $clsFile;
    } else {
        throw new Exception("Not file found");
    }
});

$app = new App();
$controller = $app->createController();
$controller->executeAction();

