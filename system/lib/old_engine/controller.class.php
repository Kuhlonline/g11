<?php

    namespace engine;

    class controller {

        public $world;

        protected $server;

        public function __construct() {

        }

        public function init_serve_world(\extension\shell\server $server) {
            global $config;

            $this->server   = $server;

            $worldTitle     = $config->application->title;
            $worldName      = strtolower($worldTitle);

            $this->world    = new \engine\world\instance($worldName);

            $this->server->console("World {$worldTitle} Started");

            print_r($this->world);
        }

        public function tick_serve_world() {
            $this->world->checkRegions();
        }

    }

?>