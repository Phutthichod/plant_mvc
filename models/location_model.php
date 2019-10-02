<?php
class Location extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public static function location_all()
    {
        $result = new Location;
        return $result->db->selectAll("SELECT * FROM `view_fact_passport`");
    }
    public static function get_by_accession($accession_number)
    {
        $result = new Location;
        return $result->db->selectAll("SELECT * FROM `view_fact_passport` WHERE accession_number = :accession_number", array(":accession_number" => $accession_number));
    }
    public static function check_accession($accession_number)
    {
        $result = new Location;
        $result = $result->db->selectOne("SELECT * FROM `accession_number` WHERE accession_number = :accession_number", array(":accession_number" => $accession_number));
        if (is_array($result)) {
            return $result;
        } else {
            return $result;
        }
    }
    public static function get_by_id_accession($id_accession_number)
    {
        $result = new Location;
        $result = $result->db->selectOne("SELECT fact_passport.id_fact_passport,fact_location.id_fact_location,fact_passport.accession_number, fact_location.sub_district,fact_location.district,fact_location.province,fact_location.country FROM `fact_passport` INNER JOIN fact_location ON fact_passport.fact_location = fact_location.id_fact_location WHERE accession_number = :accession_number", array(':accession_number' => $id_accession_number));
        if (is_array($result)) {
            return $result;
        } else {
            return false;
        }
    }
    public static function get_location($id_accession_number)
    {
        $result = new Location;
        $result = $result->db->selectOne("SELECT fact_passport.id_fact_passport,fact_location.id_fact_location,fact_passport.accession_number, fact_location.sub_district,fact_location.district,fact_location.province,fact_location.country FROM `fact_passport` INNER JOIN fact_location ON fact_passport.fact_location = fact_location.id_fact_location WHERE accession_number = :accession_number", array(':accession_number' => $id_accession_number));
        if (is_array($result)) {
            return $result;
        } else {
            return false;
        }
    }
    public static function get_all_table_value()
    {
        $head = ["tm_group", "temporary_number", "other_number", "collector_number", "collector", "crop_collection", "variety", "genus", "species", "grower_name", "donor_name","sub_district","district","province","country", "institute", "tb_usage", "collection_source", "genetict_status", "sample_type", "material", "photograpy", "topography", "soil_texure", "remark"];
        $table_value = array();
        $con = new Location;
        foreach ($head as $key) {
            if($key =="sub_district" ||$key =="district" ||$key =="province")
            {
                $result = $con->db->query("SELECT $key FROM $key ORDER BY $key")->fetchAll(PDO::FETCH_NUM);
            }
            else
            {
                $result = $con->db->query("SELECT $key FROM $key ORDER BY $key")->fetchAll(PDO::FETCH_NUM);
            }
          
            $table_value[$key] = $result;
        }
        return $table_value;
    }
}
