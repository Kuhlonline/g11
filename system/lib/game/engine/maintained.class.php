<?php

    namespace game\engine;

    abstract class maintained extends \core\stdObject {

        protected $database;
        protected $config;

        public function __construct(string $name, $options = null) {

            //Ref Global Objects
            global $dataController;


            //set database reference
            $this->database     = $dataController->extension->object();


            //set config reference
            $this->config       = new \data\json("./server/config/argon.json");


            //Construct Parent
            parent::__construct($name, $this->transform($options));
        }

        protected function transform($object) {
            $encoded    = json_encode($object);
            $decoded    = json_decode($encoded, true);
            return $decoded;
        }


    }

?>