<?php

class Genome_data_Model extends Model {

	public function __construct() {
		parent::__construct();
	}
    public static function getAllFact()
    {           
                $sql = '';               
                $result = new Genome_data_Model;
                $result = $result->db->selectAll("SELECT accession_number_genome.id_accession_number,accession_number_genome.accession_number FROM `accession_number_genome`");
               
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
        $sql = 'SELECT * FROM cha_data_tomato';               
        $result = new Genome_data_Model;
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
        $sql = 'SELECT * FROM cha_data_tomato';               
        $result = new Genome_data_Model;
        $result = $result->db->selectOne("SELECT * FROM accession_number_genome  WHERE accession_number = :accession_number",array(':accession_number' => $accession_number));
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
        // $head =["view_genom"];
        // $table_value =array();
        $con = new Genome_data_Model;
        // foreach ($head as $key)
        // {
            $result = $con->db->query("SELECT id_atcg,ATCG FROM `view_genom`")->fetchAll(PDO::FETCH_KEY_PAIR);
        //     $table_value[$key]=$result;
        // }
        return $result;
       

    }

    
    //Asree Add
    public static function check_accession_genome($accession_number)
    {
        
        $result = new Genome_data_Model;
        $result = $result->db->selectOne("SELECT * FROM `accession_number_genome` WHERE accession_number ='".$accession_number."'"); 
        return $result;
    }

    public static function update_accession_genome($id,$accession_number){
        $result = new Genome_data_Model;
        $postData = array(
			'dna_accession' => $accession_number
		);
        $result->db->update('accession_number_genome', $postData, "`id_accession_number` = {$id}");
    }

    public static function insert_accession_genome($acc,$data){
        $result = new Genome_data_Model;
        $result->db->insert('accession_number_genome', array(
			'accession_number' => $acc,
			'dna_accession' => $data
		));
    }

    public static function CheckAcc($accAcc){
        $result = new Genome_data_Model;
        $result = $result->db->selectOne("SELECT * FROM `accession_number_genome` WHERE accession_number ='".$accAcc."'"); 
        return $result;
    }

    public static function import_genome($acc,$data){
        $result = new Genome_data_Model;
        $checkFun = $result->db->selectOne("SELECT * FROM `accession_number_genome` WHERE accession_number ='".$acc."'");
        if($checkFun != ''){
           $id = $checkFun['id_accession_number'];
            $postData = array(
                'dna_accession' => $data
            );
            $result->db->update('accession_number_genome', $postData, "`id_accession_number` = {$id}");
        }
        else {
            $result->db->insert('accession_number_genome', array(
                'accession_number' => $acc,
                'dna_accession' => $data
            ));
        }
        
       
    }

    public static function dataPosition(){
        $result = new Genome_data_Model;
        return $result->db->selectAll("SELECT 	id_genomfact,position,ATCG,allele_rs FROM `view_genom`");
    }



	

}