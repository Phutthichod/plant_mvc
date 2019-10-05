<?php

class Char_data_Model extends Model {

	public function __construct() {
		parent::__construct();
    }
    public static function update_data()
    {
        $result = new Char_data_Model;
        $result = $result->db->selectAll("SELECT * FROM accession_number");
        foreach($result as $key=>$value)
        {
            //$data3 =str_replace("$","",$value['accession_number']);
            //$data = array("accession_number" => $data3);
            //print_r($value['accession_number']);
            //$data2 = $value['id_accession_number'];
            //$con = new Char_data_Model;
            //$con->db->update('accession_number',$data,"`id_accession_number` = {$data2}");
        }
    }
    public static function getAllFact()
    {           
                $sql = 'SELECT * FROM cha_data_tomato';               
                $result = new Char_data_Model;
                $result = $result->db->selectAll("SELECT * FROM cha_data_tomato");
               
                if(is_array($result))
                {
                    return $result;
                }
                else
                {
                    return false;
                }
                
    }
    public static function get_by_id_accession($id_accession_number)
    {            
        $result = new Char_data_Model;
        $result = $result->db->selectOne("SELECT * FROM cha_data_tomato  WHERE id_accession_number = :id_accession_number",array(':id_accession_number' => $id_accession_number));
        if(is_array($result))
        {
            return $result;
        }
        else
        {
            return false;
        }
    }
    public static function get_by_accession($accession_number)
    {            
        $result = new Char_data_Model;
        $result = $result->db->selectOne("SELECT * FROM cha_data_tomato  WHERE accession_number = :accession_number",array(':accession_number' => $accession_number));
        if(is_array($result))
        {
            return $result;
        }
        else
        {
            return false;
        }
    }
    public static function get_all_table_value()
    {
        $head =["hypocotyl_colour","hypocotyl_colour_intensity","hypocotyl_pubescence","plant_growth_type","plant_size","stem_pubescence_density","stem_internode_length","foliage_density","number_of_leaves_under_1st_inflorescence"
        ,"leaf_attitude","leaf_type","degree_of_leaf_dissection","anthocyanin_colouration_of_leaf_veins","inflorescence_type","corolla_colour","corolla_blossom_type","flower_sterility_type"
        ,"style_position","style_shape","style_hairiness","dehiscence","exterior_colour_of_immature_fruit","presence_of_green_shoulder_trips_on_the_fruit","intensity_of_greenback"
        ,"fruit_pubescence","predominant_fruit_shape","fruit_size","fruit_size_homogeneity","exterior_colour_of_mature_fruit","intensity_of_exterior_colour","ribbing_at_calyx_end","easiness_of_fruit_to_detach_from_pedicel","fruit_shoulder_shape"
        ,"presence_absence_of_jiontless_pedicel","easiness_of_fruit_wall_skin_to_be_peeled","skin_colour_of_ripe_fruit"
        ,"flesh_colour_of_peiricarp_interior","flesh_colour_intensity","colour_intensity_of_core","fruit_cross_sectional_shape","shape_of_pistil_scar","fruit_blossom_end_shape","blossom_end_scar_condition","fruit_firmness_after_storage","seed_shape","seed_colour"];
        $table_value =array();
        $con = new Char_data_Model;
        foreach ($head as $key)
        {
            $result = $con->db->query("SELECT * FROM $key ORDER BY $key")->fetchAll(PDO::FETCH_KEY_PAIR);
            $table_value[$key]=$result;
        }
        return $table_value;
       
    }
	

}