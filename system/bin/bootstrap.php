<?php

    global $is_api_request;
    global $version;
    global $config;
    global $dataController;
    
    spl_autoload_register(function($className) {
        global $is_api_request;

        $libFolder  = 'lib';
        $classFile  = str_replace("\\", "/", $className);
        $classPath  = realpath("./{$libFolder}/{$classFile}.class.php");

        if (!$classPath or !include_once($classPath)) return false;

        return true;
    });


    $config         = new \data\json('./config/core.json');
    $version        = $config->application->version;


    if ($is_api_request) {

        //Create a default Data Controller
        $dataController = new \data\controller(
            $config->database->host,
            $config->database->schema,
            $config->database->port,
            $config->database->username,
            $config->database->password
        );

        //Include API Authentication
        $apiAuth        = require_once('./bin/apiAuth.php');
        if (!$apiAuth)  return false;
    }

?>