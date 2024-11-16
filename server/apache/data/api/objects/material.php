<?php
require_once "../../core/util_pr4.php";
require_once "../../core/database.php";

class Material {

    public $id;
    public $name;

    private $db;
    private $table = "materials";

    function __construct() {
        $this->db = DatabaseSQL::getConnection();
    }

    public function create() {
        $sql = "INSERT INTO {$this->table} (name) VALUES ('{$this->name}')";
        if ($this->db->query($sql)) return true;
        return false;
    }

    public function readOne() {
        $sql = "SELECT * FROM {$this->table} WHERE ID={$this->id}";
        $row = $this->db->query($sql)->fetch_assoc();
        
        $this->name = $row['name'];
}

    public function readAll() {
        $sql = "SELECT * FROM {$this->table}";
        return $this->db->query($sql);
    }

    public function update() {
        $sql = "UPDATE {$this->table} 
                SET name = '{$this->name}' 
                WHERE ID={$this->id}";
        $this->db->query($sql);
        if ($this->db->affected_rows) return true;
        return false;
    }

    public function delete() {
        $sql = "DELETE FROM {$this->table} WHERE ID = {$this->id}";
        return tryCatchDelete($this->db, $sql);
    }

    public function getArr() {
        return array(
            "ID" => $this->id,
            "name" => $this->name
        );
    }

    public static function createArr($row) {
        return array(
            "ID" => $row['ID'],
            "name" => $row['name']
        );
    }

}
?>