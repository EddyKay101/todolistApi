<?php
    class Todolist {
        // Properties for database connection and table name
        private $conn;
        private $tableName = 'todoList';

        // Object properties
        public $id;
        public $name;

        // Constructor with $db as database conn
        public function __construct($db) {
            $this->conn = $db;
        }

        // Read list
        function read() {
            $query = "SELECT id, name FROM " . $this->tableName;

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }

        // Insert List
        function insert() {
            $query = "INSERT INTO " . $this->tableName . " SET name=:name";

            $stmt = $this->conn->prepare($query);

            // Sanitize
            $this->name=htmlspecialchars(strip_tags($this->name));

            //Bind values
            $stmt->bindParam(':name', $this->name);

            if($stmt->execute()) {
                return true;
            }

            return false;
        }

        function update() {
            $query = "UPDATE " . $this->tableName . " SET name=:name WHERE id = :id";

            $stmt = $this->conn->prepare($query);

            // Sanitize
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->id=htmlspecialchars(strip_tags($this->id));
            

            //Bind values
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':id', $this->id);

            if($stmt->execute()) {
                return true;
            }

            return false;
        }

        function delete() {
            $query = "DELETE FROM " . $this->tableName . " WHERE id = ?";

            $stmt = $this->conn->prepare($query);

            // Sanitize
            $this->id=htmlspecialchars(strip_tags($this->id));

            // Bind id of row to delete
            $stmt->bindParam(1, $this->id);

            // Execute

            if($stmt->execute()) {
                return true;
            }

            return false;
        }
    }
?>