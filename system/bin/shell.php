<?php

    //Run in Shell Namespace to avoid class exposure
    namespace shell;


    //Global Switches
    global $is_api_request;
    global $is_shell_request;
    global $is_server;
    $is_api_request                 = false;
    $is_shell_request               = true;
    $is_server                      = false;


    //Bootstrap the shell
    $shellExt               = initShell();
    raise('shell_loaded');

    //Build Extension Name
    $extName                = "\\extension\\shell\\" . $shellExt['extension'] ?? null;
    
    //Create Extension Factory
    $factory                = new \core\extension($extName);

    //Get Extension Object
    $extension              = $factory->object();
    raise('extension_loaded', array($extName, $extension));



    //Functions
    function initBootstrap() {
        global $is_api_request;
        global $is_shell;

        $is_api_request     = false;
        $is_shell           = true;
        $bootstrap          = include("bin/bootstrap.php");

        if (!$bootstrap) {
            throw new exception("Could not load Bootstrap");
            exit(true);
        }

        raise('bootstrap_loaded');
        return true;
    }

    function initShell() {
        global $config;

        if (!initBootstrap()) exit("Fatal Error: Unknown");

        $version    = $config->application->shellVersion;
        $name       = $config->application->title;

        print "\n{$name}\nversion {$version}\n";
        return initExtension();
    }

    function initExtension() {
        $shellExtension     = $_SERVER['argv'][1] ?? null;

        if (!$shellExtension) {
            exit("Expecting Extension\n");
        } else {
            $param          = $_SERVER['argv'];
            unset($param[0]);
            unset($param[1]);
            $param          = array_values(array_filter($param));
        }

        print "{$shellExtension} Mode\n\n";

        return [
            'extension'     => $shellExtension,
            'param'         => $param
        ];
    }    

?>