<?php

    namespace extension;
    use \mysqli as mysqli;

    class mysql {

        protected $connection;
        protected $connected        = false;

        public function __construct() {

        }

        public function connect(string $host, string $schema, string $username = '', string $password = '', $port = 3306) {

            $this->connection   = new mysqli($host, $username, $password, $schema, $port);
            $this->connected    = true;

            return $this->connected;
        }

        public function disconnect() {
            return $this->connection->close();
        }

        public function connection() {
            return $this->connection;
        }

        public function connected() : bool {
            return $this->connected;
        }

    }

?>