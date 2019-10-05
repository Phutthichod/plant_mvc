<?php

class plant_manage extends Controller {

	function __construct() {
        parent::__construct();	
        Session::set("sidebar","plant_manage");
	}
	
	function index() 
	{	
		$this->view->render('plant_manage/plant_manage');
	}
	function loadData(){
		$data = $this->model->loadData();
        echo json_encode($data);
        // echo "ssss";
	}


}