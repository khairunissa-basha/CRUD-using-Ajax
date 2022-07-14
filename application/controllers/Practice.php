<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Practice extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('PracticeM');
	}

	public function index()
	{
		$this->load->view('practice');
	}

	public function insert()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

			if ($this->form_validation->run()) {
				$ajax_data = $this->input->post();
				if ($this->PracticeM->insert($ajax_data)) {
					$data = array('response' => 'success', 'message' => 'User added successfully');
				}
			} else {
				$data = array('response' => 'error', 'message' => $this->form_validation->error_array());
				//$data = array('response' => 'error', 'message' => validation_errors());
				//$data = array('response' => 'error', 'message' => form_error('name'));
				//$data = array('response' => 'error', 'message' => form_error('email'));
			}
		} else {
			echo "No direct script access allowed";
		}

		echo json_encode($data);
	}

	public function fetch()
	{
		if ($this->input->is_ajax_request()) {
			$data = $this->PracticeM->get_data();
			echo json_encode($data);
		}
	}
}