<?php

class Upload_Model extends Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public function check_table_exit($table_name)
    {

        $result = $this->db->selectAll("SELECT COUNT(*) FROM $table_name limit 1");
        if (count($result) > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function check_data_exit($table_name, $value)
    {
        $con = $this->db;
        $sth = $con->prepare("SELECT id_$table_name FROM $table_name WHERE $table_name = :$table_name");
        $sth->execute([":$table_name" => $value]);
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if ($sth->rowCount()) {
            return $result["id_$table_name"];
        } else {
            return false;
        }
    }
    public function insert_data_in_table($table_name, $value)
    {
        $value_insert = array(
            "id_$table_name" => null,
            "$table_name" => $value
        );
        $result = $this->db->insert("$table_name", $value_insert);
        if ($result) {
            $result = $this->db->selectOne("SELECT id_$table_name FROM $table_name WHERE $table_name = :$table_name", array(":$table_name" => $value));
            return $result["id_$table_name"];
        } else {
            return false;
        }
    }
    public function check_group($table, $array_value, $id_group)
    {
        $result = $this->db->selectOne("SELECT * FROM $table WHERE id_$table = :$table", array(":$table" => $id_group));

        unset($result["id_$table"]);
        //print_r($result);
        $sql = "";
        foreach ($result as $key => $value) {
            $sql = $sql . "$key = :$key AND ";
        }
        $where = substr($sql, 0, -4);
        $sth = $this->db->prepare("SELECT id_$table FROM $table WHERE $where");
        foreach ($array_value as $key => $value) {
            $result["id_$key"] = $value;
        }
        foreach ($result as $key => $value) {
            $sth->bindValue("$key", $value);
        }
        $sth->execute();
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        if ($sth->rowCount()) {
            return $row["id_$table"];
        } else {
            $arr = ["id_$table" => null];
            $temp = $arr + $result;
            $this->db->insert("$table", $temp);

            return $this->db->lastInsertId();
        }
    }
    public function get_id_group($table, $array_value)
    {
        //echo $table;
        $sql = "";
        foreach ($array_value as $key => $value) {
            $sql = $sql . "$key = :$key AND ";
        }
        $where = substr($sql, 0, -4);
        $sth = $this->db->prepare("SELECT id_$table FROM $table WHERE $where");
        //echo "<br/> SELECT id_$table FROM $table WHERE $where <br/>";
        //print_r($array_value);
        foreach ($array_value as $key => $value) {
            $sth->bindValue("$key", $value);
        }
        $sth->execute();
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        //print_r($sth->rowCount());
        if ($sth->rowCount()) {
            return $row["id_$table"];
        } else {
            $arr = ["id_$table" => null];
            $temp = $arr + $array_value;
            $check = $this->db->insert("$table", $temp);
            //echo $check;
            return $this->db->lastInsertId();
        }
    }
    public function update_fact($data, $id_accession, $accession)
    {
        ksort($data);
        $fieldDetails = null;
        foreach ($data as $key => $value) {
            $fieldDetails .= "`$key`=:$key,";
        }
        $fieldDetails = rtrim($fieldDetails, ',');

        $sth = $this->db->prepare("UPDATE fact_tomato SET $fieldDetails WHERE `id_accession_number` = {$id_accession}");

        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", "$value");
        }
        //echo "UPDATE fact_tomato SET $fieldDetails WHERE `id_accession_number` = {$id_accession}";
        if ($sth->execute()) {

            //  echo "row update = ".$sth->rowCount();
            if ($sth->rowCount()) {
                return array("status" => true);
            } else {
                return array("status" => false, "error" => "no row update");
            }
        } else {
            return array("status" => false, "error" => "Update $accession fail.");
        }
    }
    public function insert_fact($data, $accession)
    {
        $check = $this->db->insert("fact_tomato", $data);
        if ($check) {
            $id = $this->db->lastInsertId();
            return array("status" => true, "id_fact_tomato" => $id);
        } else {
            return array("status" => false, "error" => "Add $accession fail.");
        }
    }
    public function insert_data_owner($id_member, $id_fact_tomato, $accession)
    {
        $value = array(
            'id_member' => $id_member,
            'id_fact_tomato' => $id_fact_tomato,
            'accession_number' => $accession,
            'status_ow' => "UnPublic"
        );
        return $this->db->insert('data_owner', $value);
    }
    public function get_id_location($array_value)
    {

        $sql = "";
        foreach ($array_value as $key => $value) {
            if($value)
            $sql = $sql . "$key = :$key AND ";
        }
        $where = substr($sql, 0, -4);
        $sth = $this->db->prepare("SELECT * FROM fact_location WHERE $where");
        foreach ($array_value as $key => $value) {
            if($value)
            $sth->bindValue("$key", $value);
        }
        $sth->execute();
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        if ($sth->rowCount()) {
            return $row["id_fact_location"];
        } else {
            $arr = ["id_fact_location" => null];
            $temp = $arr + $array_value;
            $check = $this->db->insert("fact_location", $temp);
           // echo $check;
            return $this->db->lastInsertId();
        }
    }
    public function update_fact_location($data, $id_fact_passport, $accession)
    {
        ksort($data);
        $fieldDetails = null;
        foreach ($data as $key => $value) {
            $fieldDetails .= "`$key`=:$key,";
        }
        $fieldDetails = rtrim($fieldDetails, ',');

        $sth = $this->db->prepare("UPDATE fact_passport SET $fieldDetails WHERE `id_fact_passport` = {$id_fact_passport}");

        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", "$value");
        }
        if ($sth->execute()) {

            //  echo "row update = ".$sth->rowCount();
            if ($sth->rowCount()) {
                return array("status" => true);
            } else {
                return array("status" => false, "error" => "no row update");
            }
        } else {
            return array("status" => false, "error" => "Update $accession fail.");
        }
    }
    public function insert_fact_location($data, $accession)
    {
        ksort($data);
        $check = $this->db->insert("fact_passport", $data);
        if ($check) {
            $id = $this->db->lastInsertId();
           return array("status" => true, "id_fact_passport" => $id);
        } else {
            return array("status" => false, "error" => "Add $accession fail.");
        }
    }
}
