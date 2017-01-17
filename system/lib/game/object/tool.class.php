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

        public function actions() : array {

        }

        private function init() {
            $results        = $this->database->select("`id` = '{$this->dbId}' LIMIT 1");
            $record         = $results[0] ?? $results;

            if (!$record) return false;
            $this->props    = $this->objectArray($record);
            return true;
        }

        public function takeAction(string $actionName, array $param = array()) : bool {

        }

        private function create_target(string $targetClass, array $props) : int {

        }

        private function modify_target(string $targetClass, int $targetId) : bool {

        }

        private function clone_target(string $targetClass, int $targetId) {

        }

        private function delete_target(string $targetClass, int $targetId) : bool {

        }

        private function attach_target(string $targetClass, int $targetId, string $parentClass, int $parentId) {

        }

        private function detach_target(string $targetClass, int $targetId) {
            
        }

    }

?>