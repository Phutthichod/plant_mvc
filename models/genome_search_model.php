<?php
error_reporting(0);
class genome_search_model extends Model
{
	public function __construct() {
		parent::__construct();
	}
   	// public function index()
	// {
    //     	return $this->db->selectAll('SELECT DISTINCT view_genom.chrom  FROM `view_genom`');
	// }
	public function atcg()
	{
        	return $this->db->selectAll('SELECT DISTINCT view_genom.ATCG FROM `view_genom` ORDER BY view_genom.ATCG');
	}
	public function strand()
	{
        	return $this->db->selectAll('SELECT DISTINCT view_genom.strand FROM `view_genom`');
	}
	public function chromosome()
	{
        	return $this->db->selectAll('SELECT DISTINCT view_genom.chrom FROM `view_genom`');
	}

	public function accession_number()
    {
    	return $this->db->selectAll("SELECT accession_number FROM accession_number_genome WHERE id_accession_number >= 1 ORDER BY id_accession_number ASC") ;
    }
	// public function showresult()
	// {
	// 		//return $this->db->selectAll('SELECT * FROM `view_genom` WHERE view_genom.ATCG ='.$data['atcg'].'');
	// 		$showsearch['view_genom'] = $this->db->selectAll('SELECT view_genom.id_bs,view_genom.allele_rs,view_genom.ATCG,view_genom.chrom,view_genom.position,view_genom.strand,view_genom.quality,view_genom.depth FROM `view_genom`');
	// 		// return $this->db->selectAll('SELECT view_genom.id_bs,view_genom.allele_rs,view_genom.ATCG,view_genom.chrom,view_genom.position,view_genom.quality,view_genom.depth FROM `view_genom`');
	// 		$showsearch['dna'] = $this->db->selectAll('SELECT * FROM `accession_number_genome`');
	// 		return $showsearch;
	// }

	public function search($data)
	{
		//$search['chrom']=$data['chrom'][0].' - '.$data['chrom'][1];
		// $search['quality']=$data['quality'][0].' - '.$data['quality'][1];
		// $search['depth']=$data['depth'][0].' - '.$data['depth'][1];
		// $search['position_1']=number_format($data['pos1']);
		// $search['position_2']=number_format($data['pos2']);
		// $search['position_1']=$data['pos1'];
		// $search['position_2']=$data['pos2'];
		
		$search['view_genom'] = $this->db->selectAll("SELECT id_genomfact,view_genom.id_bs,view_genom.allele_rs,
		view_genom.ATCG,view_genom.chrom,view_genom.position,view_genom.strand 
		FROM `view_genom` WHERE ".$data["position"]." ".$data["chrom"]." ");
		
		$search['dna'] = $this->db->selectAll('SELECT * FROM `accession_number_genome`  ');
		//$search['test'] = $this->db->selectAll("SELECT view_genom.ATCG FROM `view_genom` WHERE view_genom.ATCG = '".$data['atcg'][0]."'");
		// $search['test']=$data['atcgWH'];

		//ใข้ในการ print ค่าออกมาดูว่า select แล้วได้อะไรบ้าง
		$search['test2'] =("SELECT view_genom.id_bs,view_genom.allele_rs,
		view_genom.ATCG,view_genom.chrom,view_genom.position,view_genom.strand,view_genom.quality,view_genom.depth 
		FROM `view_genom` WHERE ".$data["atcgWH"]."  ".$data["position"]." (view_genom.chrom BETWEEN ".$data['chrom'][0]." 
		AND ".$data['chrom'][1].") AND (".$data['strand'].") AND (view_genom.quality BETWEEN ".$data['quality'][0]." AND ".$data['quality'][1].")
		AND (view_genom.depth BETWEEN ".$data['depth'][0]." AND ".$data['depth'][1].") ");

		$search['test3'] = ("SELECT id_genomfact,view_genom.id_bs,view_genom.allele_rs,
		view_genom.ATCG,view_genom.chrom,view_genom.position,view_genom.strand,view_genom.quality,view_genom.depth 
		FROM `view_genom` WHERE ".$data["position"]." ".$data["chrom"]." ");
		return $search;
	}



}?>
