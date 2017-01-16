<?php

    namespace game\object;

    class tool extends \game\object\prototype {

        protected $dbId     = 0;
        protected $ready    = false;

        public function __construct(int $id) {

            parent::__construct(new \game\object\type('child'), 'tool', []);

            $this->database->setTable('game_items');

            $this->dbId     = $id;
            $this->ready    = $this->init();
        }

        private function init() {
            $results        = $this->database->select("`id` = '{$this->dbId}' LIMIT 1");
            $record         = $results[0] ?? $results;

            if (!$record) return false;
            $this->props    = $this->objectArray($record);
            return true;
        }

        public function actions() : array {

        }

        public function takeAction(string $actionName, array $param = array()) : bool {

        }

    }

?>