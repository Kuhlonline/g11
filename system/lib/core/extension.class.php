<?php

    namespace core;

    class extension {

        public $name;

        protected $extension;
        protected $startArg;

        private $folder;
        private $ready;
        private $path;
        private $exists;

        public function __construct(string $extensionName, $startParam = null) {
            $this->folder   = "./";
            $this->name     = $extensionName;
            $this->startArg = $startParam;

            $fName          = str_replace("\\", "/", $this->name);
            $this->path     = "{$this->folder}/{$fName}.ext.php";

            if ($this->extensionExists() == false) return;

            $this->ready    = $this->loadExtension();
            if ($this->ready == false) return;

            $this->ready    = $this->createExtension();
            return;
        }

        public function __invoke() {
            return ($this->ready) ? $this->extension : false;
        }

        public function __get(string $property) {
            return $this->extension->$property ?? false;
        }

        public function __set(string $property, $value) {
            if (!isset($this->extension->$property)) return;
            $this->extension->$property     = $value;
            return;
        }

        public function __toString() {
            return $this->name;
        }

        public function object() {
            return $this->extension;
        }

        public function getType() {
            return $this->name;
        }

        private function extensionExists() : bool {
            $this->exists = file_exists($this->path);
            return $this->exists;
        }

        protected function loadExtension() : bool {
            global $registery;

            if (!isset($registery['extensions'])) $registery['extensions'] = [];

            if (array_key_exists($this->name, $registery['extensions'])) {
                $loaded     = $registery['extensions'][$this->name];
                if ($loaded != false) return true;
            }

            $registery['extensions'][$this->name] = include($this->path);

            return $registery['extensions'][$this->name];
        }

        protected function createExtension() : bool {
            $extName            = "{$this->name}";

            try {
                $this->extension    = new $extName($this->startArg);
                return true;
            } catch (Exception $e) {
                return false;
            }
        }

        public function call(string $functionName, array $param = array()) {
            if ($this->ready == false) return false;
            return call_user_func_array([$this->extension, $functionName], $param);
        }

    }

?>
