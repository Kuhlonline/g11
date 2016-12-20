<?php

    namespace data;

    class table {

        public $name;
        
        protected $connection;

        public function __construct(string $tableName, $connection) {
            $this->name         = $tableName;
            $this->connection   = $connection;

            return;
        }

    }