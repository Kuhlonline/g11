<?php

    namespace game\engine;

    abstract class maintained extends \core\stdObject {

        protected $database;
        protected $config;

        public function __construct(string $name, $options = null, bool $register = false) {

            //Ref Global Objects
            global $dataController;
            global $gameObjects;


            //set database reference
            $this->database     = $dataController->extension->object();


            //set config reference
            $this->config       = new \data\json("./server/argon.json");


            //Make Sure gameObjects is readys to hold objects
            //if (!is_array($gameObjects)) $gameObjects = [];
            //if (!isset($gameObjects[$name])) $gameObjects[$name] = [];


            //Construct Parent
            parent::__construct($name, $this->transform($options));


            //Add to global catalog
            //diabled due to memory issues with locations
            //where each location is represented instead
            //of a single object for all locations
            //if ($register) $gameObjects[$name][] = $this;
        }

        protected function transform($object) {
            $encoded    = json_encode($object);
            $decoded    = json_decode($encoded, true);
            return $decoded;
        }


    }

?>