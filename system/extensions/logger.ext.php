<?php

    namespace extension;

    class logger {

        public $name;

        protected $path;

        public function __construct(string $logName) {
            $this->name     = $logName;
            $this->path     = getcwd() . "/log/{$this->name}.log";
            $this->read();
        }

        public function lines(int $lineNumber = -1) {
            $log        = $this->read();
            $lines      = explode("\n", $log);

            return ($lineNumber === -1) ? $lines : ($lines[$lineNumber] ?? '');
        }

        public function record(string $msg) : bool {
            return ($this->writeLine($msg) > 0);
        }

        protected function read() : string {
            if (!file_exists($this->path)) {
                if (!$this->create()) return '';
            }

            return file_get_contents($this->path);
        }

        protected function writeLine(string $msg) {

            $ip         = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
            $item       = [
                date("Y-m-d"),
                date("H:i:s"),
                $_SERVER['HTTP_HOST'],
                $ip,
                implode(";", $_REQUEST),
                $msg
            ];

            return file_put_contents($this->path, $item, FILE_APPEND);
        }

        protected function create() {
            return touch($this->path);
        }


    }

?>