<?php
class Upload_history extends Controller
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

		$this->view->name_type = $this->check_type();
		$this->view->render('upload_history/index');
	}
	public function check_type()
	{
		$check_type = $this->plant_type;
		$name_type="";
		switch ($check_type) {
			case 1:
				$name_type = "Characterization";
				break;
			case 2:
				$name_type = "Location";
				break;
			default:
				$name_type = "Genome";
		}
		return $name_type;
	}
}
