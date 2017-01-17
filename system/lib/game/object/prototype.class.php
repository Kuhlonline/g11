<?php

    namespace game\object;

    abstract class prototype extends \core\stdObject {

        protected $type;
        protected $config;
        protected $database;

        public function __construct(\game\object\type $type, string $className, array $properties = array()) {
            //Set the object type
            $this->type     = $type;

            //Ref Global Objects
            global $dataController;


            //set database reference
            $this->database     = $dataController->extension->object();


            //set config reference
            $this->config       = new \data\json("./server/config/argon.json");


            parent::__construct($className, $properties);
        }

    }

?>