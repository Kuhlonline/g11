<?php

    namespace data;

    class json {

        protected $structure    = [];
        protected $filename     = '';
        protected $autosave     = false;
        protected $readonly     = true;

        public $ready           = false;


        public function __construct(string $filename) {
            $this->filename     = realpath($filename);
            $this->ready        = ($this->file !== false);

            if ($this->ready) $this->ready = $this->read();
        }

        public function __invoke($key = null, $value = null) {

            if ($key and $value) {
                $this->$key     = $value;
                return $this->$key;
            } elseif ($key and !$value) {
                return $this->$key;
            }

            return $this->data();
        }

        public function __get($key) {
            return $this->structure->$key ?? null;
        }

        public function __set($key, $value) {
            $this->structure->$key  = $value;

            if ($this->autosave) $this->write();
        }

        public function __isset($key) {
            if ($this->structure->$key) return true;
            return false;
        }

        public function __unset($key) {
            unset($this->structure->$key);
            if ($this->autosave) $this->write();
        }

        public function __toString() {
            return $this->json();
        }

        public function readonly($set = null) : bool {
            if (is_null($set) == false) $this->readonly = (bool) $set;

            return $this->readonly;
        }

        public function autosave($set = null) : bool {
            if (is_null($set) == false) $this->autosave = (bool) $set;
            
            return $this->autosave;
        }

        public function json() : string {
            return json_encode($this->structure, JSON_PRETTY_PRINT);
        }

        public function data() {
            return $this->structure;
        }

        public function array() {
            $encoded    = json_encode($this->structure);
            $decoded    = json_decode($encoded, true);
            return $decoded;
        }

        private function read() : bool {
            if (!$this->ready) return false;

            $json       = file_get_contents($this->filename);
            $data       = json_decode($json);

            if (!$data) return false;

            $this->structure    = $data;

            return true;
        }

        private function write() : int {
            if (!$this->ready)      return false;
            if ($this->readonly)    return false;

            $json   = json_encode($this->structure, JSON_PRETTY_PRINT);
            if (!$json) return false;

            $size   = file_put_contents($this->filename);
            if (!$size or $size == 0) return false;

            return true;
        }

    }

?>