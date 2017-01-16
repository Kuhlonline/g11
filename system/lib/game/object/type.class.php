<?php

    namespace game\object;

    abstract class type {

        public $name;
        public $value;

        public function __construct($typeName = 0) {
            return $this->validate_type_name($typeName);
        }

        public function value() {
            return $this->value;
        }

        public function name() {
            return $this->name;
        }

        public function __invoke() {
            return $this->value;
        }

        public function __toString() {
            return $this->name;
        }

        private function validate_type_name($typeName = 0) {

            if (is_numeric($typeName)) {

                switch ((int) $typeName) {
                    case 1:
                        $this->name     = 'World';
                        $this->value    = 1;
                    break;

                    case 3:
                        $this->name     = 'Child';
                        $this->value    = 3;
                    break;

                    default:
                    case 0:
                    case 2:
                        $this->name     = 'Instance';
                        $this->value    = 2;
                    break;
                }

            } else {

                switch (strtolower(trim())) {

                    case 'world':
                        $this->name     = 'World';
                        $this->value    = 1;
                    break;

                    case 'child':
                        $this->name     = 'Child';
                        $this->value    = 3;
                    break;

                    default:
                    case 'instance':
                        $this->name     = 'Instance';
                        $this->value    = 2;
                    break;
                }

            }

        }

    }

?>