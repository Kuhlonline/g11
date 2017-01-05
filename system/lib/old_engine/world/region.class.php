<?php

    namespace engine\world;

    class region {

        public $name;

        protected $settings;

        public function __construct(string $name, $config) {
            $this->name     = $name;
            $this->settings = $config;
        }

        public function create_location() {


        }

    }

?>