<?php

    use \core\stdObject as stdObject;

    $apiResponse    = init();

    sendAPIResponse($apiResponse);


    function init() : stdObject {

        global $is_api_request;
        $is_api_request     = true;

        chdir('../../../system');

        if (!include('bin/bootstrap.php')) {
            exit("Error loading API Bootstrap in " . getcwd());
        }

        $code           = 200;
        $errCode        = 0;
        $errors         = [];

        $apiRequest     = getAPIRequest();
        $apiResult      = handleAPIRequest($apiRequest, $code, $errCode, $errors);
        $apiResponse    = setAPIResponse($apiRequest, $apiResult, $code, $errCode, $errors, 'application/json');

        return $apiResponse;
    }

    function getAPIRequest() : stdObject {
        $target         = $_GET['target'] ?? '';
        $version        = $_GET['version'] ?? 0;
        $parts          = array_values(array_filter(explode("/", $target)));
        $upper          = count($parts) - 1;
        
        if ($upper >= 0) {
            $lastPart       = $parts[$upper];
            if ($lastPart)  unset($parts[$upper]);
        } else {
            $lastPart       = null;
        }

        $function       = "api_{$lastPart}";
        if (!$lastPart) $function = "api_" . $_POST['function'] ?? '';

        $class          = "\\" . str_replace("/", "\\", $target);
        if (substr($class, -1) == "\\") $class = substr($class, 0, -1);
        $class          = substr($class, 0, strlen($class) - strlen($lastPart));
        if (!$class)    $class = $_POST['target'] ?? '';

        if ($target)    unset($_REQUEST['target']);
        if ($version)   unset($_REQUEST['version']);

        $param          = $_REQUEST;
        $param          = $param['param'] ?? $param;

        return new stdObject('api_request', [
            'class'     => $class,
            'function'  => $function,
            'param'     => $param,
            'get'       => $_GET,
            'post'      => $_POST,
            'origin'    => $_SERVER['REMOTE_ADDR']
        ]);
    }

    function handleAPIRequest(stdObject $request, int &$returnCode = 200, int &$errorCode = 0, array &$errors = array()) {


        $targetExists   = class_exists($request->class);

        if ($targetExists == false) {
            $returnCode     = 404;
            $errorCode      = 100;
            $errors[]       = "Target does not exist '{$request->class}'";
            return false;
        }

        try {
            $targetClass    = $request->class;
            $targetObject   = new $targetClass();
        } catch (Exception $e) {
            $returnCode     = 405;
            $errorCode      = 200;
            $errors[]       = "Could not create {$targetClass} object";
            $errors[]       = $e->getMessage();
            return false;
        }

        $methodExists       = method_exists($targetObject, $request->function);
        if ($methodExists == false) {
            $returnCode     = 404;
            $errorCode      = 201;
            $errors[]       = "Endpoint does not exist '{$request->function}'";
            return false;
        }

        try {
            $return         = call_user_func_array(
                [$targetObject, $request->function], 
                $request->param
            );
        } catch (Exception $e) {
            $returnCode     = 500;
            $errorCode      = 300;
            $errors[]       = "Could not execute request on endpoint {$request->class}->{$request->function}()";
            $errors[]       = $e->getMessage();
            return false;
        }

        return $return;
    }

    function setAPIResponse(stdObject $request, $result, int $returnCode = 200, int $errorCode = 0, array $errors = array(), string $type = 'application/json') : stdObject {

        $response   = new stdObject('api_response', [
            'code'      => $returnCode,
            'errors'    => $errors,
            'error_no'  => $errorCode,
            'request'   => $request->props(),
            'response'  => $result,
            'type'      => $type,
            'origin'    => $_SERVER['REMOTE_ADDR']
        ]);

        return $response;
    }

    function sendAPIResponse(stdObject $response) {

        $headerType     = strtolower(trim($response->type)) ?? 'application/json';

        switch ($headerType) {

            case 'application/json':
                $returnPayload  = $response->json();
            break;

            default:
                $headerType     = 'text/html';
                $returnPayload  = $response->html();
            break;

        }


        header("Content-type: {$headerType}");
        exit($returnPayload);

        return;
    }

?>