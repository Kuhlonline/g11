<?php

    namespace data;

    class table {

        public $name;
        
        protected $connection;

        public function __construct(string $tableName, $connection = null) {
            global $dataController;

            $this->name         = $tableName;
            $this->connection   = $connection ?? $dataController->connection();

            return;
        }

    }