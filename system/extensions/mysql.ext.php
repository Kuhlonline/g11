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

        public function insert(array $record) : int {

            $keys       = array_keys($record);
            $values     = array_values($record);
            $clean      = array();

            foreach ($values as $index => $value) {
                $newVal         = $this->connection->escape_string($value);
                $clean[$index]  = $newVal;
            }

            $keyStr     = "`" . implode("`,`", $keys) ."`";
            $valStr     = "'" . implode("', '", $clean) ."'";
            $sql        = "INSERT INTO `{$this->name}` ($keyStr) VALUES ($valStr);";

            $eng        = $this->connection;
            $result     = $eng->query($sql);

            $this->lastSql = $sql;
            
            if ($result === false or !$result) return 0;
            return $eng->insert_id;            
        }

        public function update($id, array $record = array()) {

            $setBuffer  = '';
            $fields     = array_keys($record);
            $lastField  = $fields[count($fields)-1];

            foreach ($record as $field => $value) {
                $setBuffer .= "`{$field}` = '$value'";
                $setBuffer .= ($lastField == $field) ? '' : ', ';
            }

            $sql        = "UPDATE `{$this->name}` SET {$setBuffer} WHERE `id` = '$id';";
            $eng        = $this->connection;
            $result     = $eng->query($sql);

            $this->lastSql = $sql;
            
            if ($result === false or !$result) return 0;
            return true;
        }

        public function remove($id) {
            $sql    = "DELETE FROM `{$this->name}` WHERE `id` = '$id';";
            $eng    = $this->connection;
            $result = $eng->query($sql);

            $this->lastSql  = $sql;
            
            return $sql;
        }

        public function commit(array $record = array()) {
            if (isset($record['id'])) {
                $id     = $record['id'];
                unset($record['id']);
                return $this->update($id, $record);
            } else {
                return $this->insert($record);
            }
        }

        public function select(string $where = '') {
            if ($where) $where = "WHERE {$where}";

            $sql        = "SELECT * FROM `{$this->name}` $where;";
            $eng        = $this->connection;
            $result     = $eng->query($sql);

            $this->lastSql = $sql;

            if ($result === false or !$result) return false;

            $records    = [];
            while ($row = $result->fetch_object()) {
                $records[]  = $row;
            }

            return $records;
        }

        public function query(string $sql, $skipResult = false) {
            $eng        = $this->connection;
            $result     = $eng->query($sql);

            $this->lastSql = $sql;

            if ($result === false or !$result) return false;

            if ($skipResult) return true;
            $records    = [];
            while ($row = $result->fetch_object()) {
                $records[]  = $row;
            }

            return $records;
        }

        public function record($recordId = 0, $fieldName = 'id') {
            $sql        = "SELECT * FROM `{$this->name}` WHERE `{$fieldName}` = '{$recordId}' LIMIT 1;";
            $eng        = $this->connection;
            $result     = $eng->query($sql);

            $this->lastSql = $sql;

            if ($result === false or !$result) return false;

            $record = $result->fetch_object();
            $result->close();

            if (!$record) return false;
            return $record;
        }

    }

?>