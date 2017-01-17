<?php

    return initSession();

    function initSession() : bool {
        global $version;

        @session_start();

        $apiToken           = $_POST['api_token']       ?? false;
        $valid              = false;
        $errMsg             = '';
        $errNo              = 0;

        if (validateOrigin() == false) {
            $valid          = false;
            $errNo          = 1000;
            $errMsg         = 'Invalid Origin';
        } elseif ($apiToken) {
            $valid          = initToken($apiToken);
            $errNo          = 1001;
            $errMsg         = 'Invalid API Token';
        } /*else {
            $errNo          = 1002;
            $errMsg         = 'No Request';
        }*/

        if (!$valid) {
            $removed        = removeAuthToken($apiToken);

            $response       = new \core\stdObject('api_response', [
                'code'      => 403,
                'errors'    => ['Unauthorized', $errMsg],
                'error_no'  => $errNo,
                'request'   => [],
                'response'  => false,
                'type'      => 'error',
                'origin'    => $_SERVER['REMOTE_ADDR']
            ]);

            header("Content-type: application/json");
            exit($response->json());
        } 

        return true;
    }

    function validateOrigin() : bool {

        return true;

        //Config
        $file                       = "./config/token.json";
        $tokens                     = new \data\json($file);

        //Remote Address
        $remote     = $_SERVER['REMOTE_ADDR'];
        $allowed    = $tokens->api->allowed_hosts;
        $valid      = in_array($remote, $allowed);

        return $valid;
    }

    function validateAuthToken(string $authToken, string &$emailAddress = '') : bool {

        //Config
        $file                       = "./config/token.json";
        $tokens                     = new \data\json($file);

        //Valid Auth Token
        $authComp                   = $tokens->auth_tokens->$authToken;
        if (!$authComp) return false;

        //Auth Components
        $token      = $authComp[0] ?? false;
        $apiToken   = $authComp[1] ?? false;
        $time       = $authComp[2] ?? false;
        $addr       = $authComp[3] ?? false;
        
        //Validate Components
        if (!$apiToken or !$token or !$time or !$addr) return false;

        //Expired?
        $expTime    = $time + (int) $tokens->settings->timeout;
        if (time() >= $expTime) return false;

        //Location Changed?
        if ($_SERVER['REMOTE_ADDR'] != $addr) return false;

        //Matches?
        if ($authToken !== $token) return false;

        //Exists?
        $emailAddress   = $tokens->api_tokens->$apiToken; 
        if (!$emailAddress) return false;

        return true;
    }

    function removeAuthToken(string $authToken = '') : bool {
        //Config
        $file                       = "./config/token.json";
        $tokens                     = new \data\json($file);

        //Remove from session
        if (isset($_SESSION['auth_token'])) unset($_SESSION['auth_token']);
        if (!$authToken)            return true;

        $tokens->readonly(false);
        $tokens->autosave(true);

        //Remove from cache
        unset($tokens->auth_tokens->$authToken);

        return true;
    }

    function createAuthToken(string $apiToken) : string {
        $file                       = "./config/token.json";
        $tokens                     = new \data\json($file);
        $addr                       = $_SERVER['REMOTE_ADDR'];
        $newAuthToken               = hash('md5', $addr . uniqid($apiToken));
        $_SESSION['auth_token']     = $newAuthToken;

        $tokens->readonly(false);
        $tokens->autosave(true);

        $tokens->auth_tokens->$newAuthToken     = [$newAuthToken, $apiToken, time(), $addr];

        return $newAuthToken;
    }

    function initToken(string $apiToken) : bool {
        $file       = "./config/token.json";
        $tokens     = new \data\json($file);

        $token      = $tokens->api_tokens->$apiToken;
        if (!$token) return false;

        return true;
    }


?>