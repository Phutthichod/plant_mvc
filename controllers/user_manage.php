<?php

class user_manage extends Controller {

	function __construct() {
		parent::__construct();	
	}
	
	function index() 
	{	
		$this->view->render('user_manage/user_manage');
	}
	function loadData(){
		$data = $this->model->loadData();
		echo json_encode($data);
	}
	function blockUser(){
		$user = "user_id =".$_POST['id'];
		$status = $_POST['status'];
		$data = ['status'=>$status];
		$data = $this->model->blockUser('member_1',$data,$user);
	}
	function loadDataListPlant_1(){
		$id = $_POST['id'];
		$data = $this->model->loadDataListPlant_1($id);
		echo json_encode($data);
	}
	function loadDataListPlant_2(){
		$id = $_POST['id'];
		$data = $this->model->loadDataListPlant_2($id);
		echo json_encode($data);
	}
	function listPlant(){
		$this->view->render('user_manage/list_plant');
	}
	function deleteList(){
		$item = $_POST["item"]; 
		$id = $_POST["id"];
		$table = "user_plant_1";
		$where = "plant_id=$item and user_id=$id";
		$this->model->deleteList($table,$where);
	}
	function addList(){
		$item = $_POST["item"]; 
		$id = $_POST["id"];
		$data = ["user_id" => $id , "plant_id" => $item];
		$table = "user_plant_1";
		$this->model->addList($table,$data);
	}
	
	
	

	

}