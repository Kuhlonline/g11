<?php

    //Run in Shell Namespace to avoid class exposure
    namespace shell;

    //Bootstrap the shell
    $shellExt               = initShell();

    //Build Extension Name
    $extName                = "\\extension\shell\\" . $shellExt['extension'] ?? null;

    //Exit if no valid extension passed
    if (!$extName) exit("Unknown Extension: {$extName}\n");
    
    //Create Extension Factory
    $factory                = new \core\extension('shell\\server');

    //Get Extension Object
    $extension              = $factory->object();


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

        return true;
    }

    function initShell() {
        global $config;

        if (!initBootstrap()) exit("Fatal Error: Unknown");

        $version    = $config->application->shellVersion;
        $name       = $config->application->title;

        print "\n{$name}\nversion {$version}\n\n";
        return initExtension();
    }

    function initExtension() {
        $shellExtension     = $_SERVER['argv'][1] ?? null;

        if (!$shellExtension) {
            exit(help());
        } else {
            $param          = $_SERVER['argv'];
            unset($param[0]);
            unset($param[1]);
            $param          = array_values(array_filter($param));
        }

        return [
            'extension'     => $shellExtension,
            'param'         => $param
        ];
    }    

?>