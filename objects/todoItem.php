<?php
    class Todoitem {
        // Properties for database connection and table name
        private $conn;
        private $tableName = 'todoItem';

        // Object properties
        public $id;
        public $description;
        public $dueDate;
        public $isCompleted;
        public $listId;

        // Constructor with $db as database conn
        public function __construct($db) {
            $this->conn = $db;
        }

        // Read list
        function read() {
            $query = "SELECT l.name as name, i.id, i.description, i.dueDate, i.isCompleted, i.listId FROM " . $this->tableName . " i LEFT JOIN 
                        todoList l ON i.listId = l.id";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }

        // Insert Item
        function insert() {
            $query = "INSERT INTO " . $this->tableName . " SET description=:description, dueDate=:dueDate, isCompleted=:isCompleted, listId=:listId";

            $stmt = $this->conn->prepare($query);

            // Sanitize
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->dueDate=htmlspecialchars(strip_tags($this->dueDate));
            $this->isCompleted=htmlspecialchars(strip_tags($this->isCompleted));
            $this->listId=htmlspecialchars(strip_tags($this->listId));

            //Bind values
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':dueDate', $this->dueDate);
            $stmt->bindParam(':isCompleted', $this->isCompleted);
            $stmt->bindParam(':listId', $this->listId);

            if($stmt->execute()) {
                return true;
            }

            return false;
        }

        function update() {
            $query = "UPDATE " . $this->tableName . " SET description=:description, dueDate=:dueDate, isCompleted=:isCompleted, listId=:listId WHERE id = :id";

            $stmt = $this->conn->prepare($query);

            // Sanitize
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->dueDate=htmlspecialchars(strip_tags($this->dueDate));
            $this->isCompleted=htmlspecialchars(strip_tags($this->isCompleted));
            $this->listId=htmlspecialchars(strip_tags($this->listId));
            $this->id=htmlspecialchars(strip_tags($this->id));
            

            // Bind values
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':dueDate', $this->dueDate);
            $stmt->bindParam(':isCompleted', $this->isCompleted);
            $stmt->bindParam(':listId', $this->listId);
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