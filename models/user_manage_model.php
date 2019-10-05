<?php

class user_manage_model extends Model
{

    public function __construct()
    {
        parent::__construct();
    }
    function loadData(){
        $sql = "SELECT member_1.user_id,member_1.firstname ,
         member_1.permission,member_1.status,member_1.lastname, member_1.email , 
         count(user_plant_1.user_id) AS 'number' from member_1 LEFT JOIN user_plant_1 
         on (member_1.user_id = user_plant_1.user_id)  group by  member_1.user_id";
        return $this->db->selectAll($sql);
        // return "pin";
    }
    function blockUser($table,$data,$id){
        $this->db->update($table,$data,$id);
    }
    function loadDataListPlant_1($id){
        $sql = "select p_icon,p_id,p_alias from plant_1 join user_plant_1 
        on (plant_1.p_id = user_plant_1.plant_id) 
        where user_plant_1.user_id = $id";
        return $this->db->selectAll($sql);
	}
	function loadDataListPlant_2($id){
        $sql = "select DISTINCT  p_icon,p_id,p_alias from plant_1 where p_id 
        NOT IN (select p_id from plant_1 join user_plant_1 
        on (plant_1.p_id = user_plant_1.plant_id) 
        where user_plant_1.user_id = $id)";
        return $this->db->selectAll($sql);
    }
    function addList($table,$data){
        $this->db->insert($table,$data);
    }
    function deleteList($table,$where){
        $this->db->delete($table,$where);
    }
}
