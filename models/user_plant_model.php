<?php

class user_plant_model extends Model
{

    public function __construct()
    {
        parent::__construct();
    }
    function loadData($user_id){
        $sql = "SELECT p_id,p_alias,p_species,p_icon,color_1.code_color from  plant_1 
        join user_plant_1 on (plant_1.p_id = user_plant_1.plant_id) 
        join color_1 on (plant_1.p_color = color_1.p_color) where user_plant_1.user_id = $user_id";
        return $this->db->selectAll($sql);
        // return "pin";
    }
}
