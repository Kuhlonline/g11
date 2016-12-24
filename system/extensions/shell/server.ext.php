<?php

    namespace extension\shell;

    class server {

        protected $log;

        public function __construct() {
            $ext        = new \core\extension('logger', 'server');
            $this->log  = $ext->object();

            exit("Server Not Implemented\n");
        }

        protected function logItem(string $msg) : bool {
            return $this->log->record($msg);
        }

    }

?>