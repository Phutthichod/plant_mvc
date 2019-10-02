<?php

class plant_db
{
    private $db_name;
    private $db_username;
    private $db_password;
    private $db_server;
    private $conn;
    public function __construct()
    {
        $this->db_name = 'plant_user';
        $this->db_username = 'root';
        $this->db_password = '';
        $this->db_server = 'localhost';
        $this->connect();
    }
    public function connect()
    {
        $this->conn = new PDO("mysql:host=$this->db_server;dbname=$this->db_name", $this->db_username, $this->db_password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function select($sql)
    {
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return   $data;
    }
    public function select2($sql)
    {
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return   json_encode($data);
    }
    public function insert($sql)
    {
        $this->conn->exec($sql);
    }
    public function delete($sql)
    {
        $this->insert($sql);
    }
}
?>