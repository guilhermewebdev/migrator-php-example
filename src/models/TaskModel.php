<?php

class TaskModel {
    protected PDO $db;

    function __construct($db) {
        $this->db = $db;
    }

    public function create($data) {
        $transaction = $this->db->prepare("INSERT INTO 
            tasks (title, description, due_date) 
            VALUES(:title, :description, :due_date)
        ");
        foreach ($data as $property => $value) {
            if ($value == "") {
                $data[$property] = null;
            }
        }
        $transaction->bindParam(':title', $data['title']);
        $transaction->bindParam(':description', $data['description']);
        $transaction->bindParam(':due_date', $data['due_date']);
        $transaction->execute();
    }

    public function list() {
        return $this->db->query("SELECT * FROM tasks;");
    }

    public function update($id, $data) {
        $query = "UPDATE tasks SET";
        foreach ($data as $property => $value) {
            if ($value == "") {
                $data[$property] = null;
            }
            $query = $query." $property = :$property ";
        }
        $query = $query."WHERE id = :id;";
        $transaction = $this->db->prepare($query);
        foreach ($data as $property => $value) {
            $transaction->bindParam(':'.$property, $value);
        }
        $transaction->bindParam(':id', $id);
        $transaction->execute();
    }

    public function delete($id) {
        $transaction = $this->db->prepare("DELETE FROM tasks WHERE id = :id;");
        $transaction->bindParam(':id', $id);
        $transaction->execute();
    }
}