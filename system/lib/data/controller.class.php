<?php

    namespace data;

    class controller {

        protected $mysql;
        protected $connection;

        public function __construct(string $host, string $schema, int $port = 3306, string $user = '', string $pass = '') {
            $ext                = new \core\extension('mysql');
            $this->mysql        = $ext->object();
            $this->connection   = $this->mysql->connect($host, $user, $pass, $schema, $port);
        }

    }

?>