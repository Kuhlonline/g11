<?php

    global $is_api_request;
    global $is_shell_request;

    global $version;
    global $config;
    global $dataController;
    

    //Library Auto Registration
    spl_autoload_register(function($className) {
        global $is_api_request;

        $libFolder  = 'lib';
        $classFile  = str_replace("\\", "/", $className);
        $classPath  = realpath("./{$libFolder}/{$classFile}.class.php");

        if (!$classPath or !include_once($classPath)) return false;

        return true;
    });


    //Require Events bin
    $included       = include_once("./bin/events.php");
    if (!$included) exit("Event Registration Failure");


    //Get Global Configuration
    $config         = new \data\json('./config/core.json');
    $version        = $config->application->version;


    //Create a global database Connection
    if ($is_api_request or $is_shell_request) {

        //Create a default Data Controller
        $dataController = new \data\controller(
            $config->database->host,
            $config->database->schema,
            $config->database->port,
            $config->database->username,
            $config->database->password
        );
    }


    //Evaluate API Request
    if ($is_api_request) {
        //Include API Authentication
        $apiAuth        = require_once('./bin/apiAuth.php');
        if (!$apiAuth)  return false;
    }

?>