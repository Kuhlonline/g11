<?php


    function hook(string $eventName, callable $function) {
        global $eventHooks;

        if (!is_array($eventHooks)) $eventHooks                         = [];
        if (!isset($eventHooks[$eventName])) $eventHooks[$eventName]    = [];

        $eventHooks[$eventName][]   = $function;
    }

    function raise(string $eventName, array $param = array()) {
        global $eventHooks;

        $callbacks      = $eventHooks[$eventName] ?? [];
        $returnBuffer   = [];

        foreach ($callbacks as $index => $function) {
            $returnBuffer[$index]   = $function($param);
        }

        return $returnBuffer;
    }


?>