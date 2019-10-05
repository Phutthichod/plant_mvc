<?php

class plant_manage_model extends Model
{

    public function __construct()
    {
        parent::__construct();
    }
    function loadData(){
        $sql = "SELECT * FROM plant_1,color_1 
        WHERE plant_1.p_color = color_1.p_color";
        return $this->db->selectAll($sql);
    }
}
