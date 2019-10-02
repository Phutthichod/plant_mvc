<?php

class user_plant extends Controller {
	private  $user_id ;

	function __construct() {
		parent::__construct();	
		// Session::set("user_id",4);
		
		$this->user_id = Session::get("member")['id_member'];
		// Session::destroy();
	}
	
	function index() 
	{	
		$this->view->render('user_plant/user_plant_manage');
	}
	function loadData(){
		// echo $user_id;
		$data = $this->model->loadData($this->user_id);
		echo json_encode($data);
	}
	function setPlant_id(){
		$p_id = $_POST['p_id'];
		Session::set("plant_id",$p_id);
		echo Session::get("plant_id");
	}
	function setPlant_type(){
		$p_type = $_POST['p_type'];
		Session::set("plant_type",$p_type);
		echo Session::get("plant_type");
	}

	
	
	

	

}