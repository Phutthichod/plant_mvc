<?php
class Upload extends Controller
{
	private $user_id;
	private $plant_id;
	private $plant_type;
	public function __construct()
	{
		Auth::handleLogin();
		parent::__construct();
		$this->user_id = Session::get('member')['id_member'];
		$this->plant_type = Session::get('plant_type');
		$this->plant_id = Session::get('plant_id');
	}

	public function index()
	{
		
		//Session:init();
		//Session::get([key]);
		//$check =Char_data_Model::update_data();
		//print_r($check);
		$this->view->user_id = $this->user_id;
		$this->view->plant_type = $this->plant_type;
		$this->view->plant_id = $this->plant_id;
		$this->view->render('upload/index');
	}
	
	
}
