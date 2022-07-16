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
					//redirect(current_url());
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

	public function edit(){
		if($this->input->is_ajax_request()){
			if($post = $this->PracticeM->single_entry()){
				$data = array('response'=>'success', 'post'=>$post);
			}else{
				$data = array('response'=>'error', 'message'=>'failed');
			}
		}
		echo json_encode($data);
	}

	public function update(){
		if($this->input->is_ajax_request()){
			$this->form_validation->set_rules('edit_name','Name','required');
			$this->form_validation->set_rules('edit_email','Email','required|valid_email');

			if($this->form_validation->run()){
				if($this->PracticeM->update_record()){
					$data = array('response'=>'success','message'=>'Updated successfully');
				}
			}else{
				$data = array('response'=>'error', 'message'=>$this->form_validation->error_array());
			}
			echo json_encode($data);
		}
		
	}

	public function delete(){
		if($this->input->is_ajax_request()){
			if($this->PracticeM->delete_record()){
				$data = array('response'=>"success", 'message'=>"Record successfully deleted");
			}else{
				$data = array('response'=>'error', 'message'=>'failed');
			}
			echo json_encode($data);
		}
	}
}