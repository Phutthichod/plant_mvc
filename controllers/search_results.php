<?php

class Search_results extends Controller {

	function __construct() {
		parent::__construct();
	}
	
	function index() {
		
		$this->view->search = $this->model->search();
		$member = Session::get('member');
		$this->view->id_member = $member['id_member'];
		$this->view->ShareWithMe = $this->model->get_share();

		$this->view->image_result = $this->model->image_result();
		
		$this->view->render('search_results/index');
	}	
}