<?php

    namespace core;

    class stdObject {

        protected $props    = [];
        protected $name     = '';

        public function __construct(string $objectName = '', array $props = array()) {
            $this->name     = $objectName;
            $this->props    = ($props) ? $props : [];
        }

        public function __get($prop) {
            return $this->props[$prop] ?? null;
        }

        public function __set($prop, $value) {
            $this->props[$prop] = $value;
        }

        public function __toString() {
            return json_encode($this);
        }

        public function __invoke() {
            return $this->props();
        }

        public function props() {
            return $this->props;
        }

        public function name() {
            return $this->name;
        }

        public function json() {
            return json_encode($this->props());
        }

        public function html() {
            return print_r($this, true);
        }

        public function objectArray($object) : array {
            $json   = json_encode($object);
            $arr    = json_decode($json, true);
            return ($arr and is_array($arr)) ? $arr : [];
        }

    }

?>