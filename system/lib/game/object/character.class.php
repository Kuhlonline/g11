<?php

    namespace game\object;

    class character extends \game\object\prototype {           

        private $ready  = false;
        private $dbId   = 0;

        public function __construct(int $id) {

            parent::_construct(new \game\object\type('child'), 'character', []);

            $this->dbId             = $id;
            $this->database->setTable('world_characters');
            $this->ready            = $this->init();
        }

        private function init() : bool {
            $results    = $this->database->select("`id` = '{$this->dbId}' LIMIT 1");
            $record     = $results[0] ?? $results;

            if (!$record) return false;

            $this->props    = $this->objectArray($record);
            return true;
        }

    }

?>