<?php
require_once "../../core/util_pr4.php";
require_once "../../core/database.php";

class Product {

    public $id;
    public $name;
    public $price;
    public $matID;

    private $db;
    private $table = "products";

    function __construct() {
        $this->db = DatabaseSQL::getConnection();
    }

    public function create() {
        $sql = "INSERT INTO {$this->table} (name, price, matID) VALUES ('{$this->name}', {$this->price}, {$this->matID})";
        return tryCatchCreate($this->db, $sql);
    }

    public function readOne() {
        $sql = "SELECT * FROM {$this->table} WHERE ID = {$this->id}";
        $res = $this->db->query($sql)->fetch_assoc();

        $this->name = $res['name'];
        $this->price = $res['price'];
        $this->matID = $res['matID'];
    }

    public function readAll() {
        $sql = "SELECT * FROM {$this->table}";
        return $this->db->query($sql);
    }

    public function update() {
        $sql = "UPDATE {$this->table}
                SET name = '{$this->name}',
                    price = '{$this->price}',
                    matID = {$this->matID}
                WHERE ID = {$this->id}";
        $this->db->query($sql);
        if ($this->db->affected_rows) return true;
        return false;
    }

    public function delete() {
        $sql = "DELETE FROM {$this->table} WHERE ID = {$this->id}";
        $this->db->query($sql);
        if ($this->db->affected_rows) return true;
        return false;
    }

    public function getArr() {
        return array(
            "ID" => $this->id,
            "name" => $this->name,
            "price" => $this->price,
            "matID" => $this->matID
        );
    }

    public static function createArr($row) {
        return array(
            "ID" => $row['ID'],
            "name" => $row['name'],
            "price" => $row['price'],
            "matID" => $row['matID']
        );
    }
}
?>