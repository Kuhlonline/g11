<?php

    namespace data;

    class controller {

        public $extension;
        
        protected $mysql;
        protected $connection;


        public function __construct(string $host, string $schema, int $port = 3306, string $user = '', string $pass = '') {
            $this->extension    = new \core\extension('extension\mysql');
            $this->mysql        = $this->extension->object();
            $this->connection   = $this->mysql->connect($host, $user, $pass, $schema, $port);
        }

        public function connection() {return $this->connection;}

    }

?>