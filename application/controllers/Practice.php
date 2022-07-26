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
		//echo json_encode($data);
	}

	public function insert()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('name', 'Name', 'required',array('required'=>'Please Enter Name'));
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[crud.email]',array('required'=>'Please Enter E-Mail','valid_email'=>'Please Enter E-mail In Valid E-Mail Format','is_unique[crud.email]'=>'This Email Already Exists'));
		

			if ($this->form_validation->run()) {
				//$ajax_data = $this->input->post();
				//if ($this->PracticeM->insert($ajax_data)) {
					if ($this->PracticeM->insert()) {
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
		
		$search['search_key'] = $this->input->post('search_key');
		
		$data['sort_by'] = $this->input->post('sort_by');
		$limit = 5;
		$offset = ($this->uri->segment(3))?$this->uri->segment(3):0;

		$config['base_url'] = site_url('practice/fetch');
		$config['total_rows'] = $this->PracticeM->get_data($limit,$offset,$search,$data,$count=true);
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['num_links'] = 3;
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a href="" class="current_page">';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
        
		$this->pagination->initialize($config);

		$data['users'] = $this->PracticeM->get_data($limit,$offset,$search,$data,$count=false);
		$data['pagelinks'] = $this->pagination->create_links();
		$this->load->view('practice_ajax',$data);
	}

	public function edit($id){
		if($this->input->is_ajax_request()){
			if($post = $this->PracticeM->single_entry($id)){
				$data = array('response'=>'success', 'post'=>$post);
			}else{
				$data = array('response'=>'error', 'message'=>'failed');
			}

			echo json_encode($data);
		}
		
	}

	public function update(){
		if($this->input->is_ajax_request()){
			//$id = $this->input->post('edit_id');
			$original_email = $this->input->post('original_email');
			
			if($this->input->post('edit_email') != $original_email){
				$is_unique = '|is_unique[crud.email]';
			}else{
				$is_unique = '';
			}
			$this->form_validation->set_rules('edit_name','Name','required');
			$this->form_validation->set_rules('edit_email','Email','required|valid_email'.$is_unique,array('required'=>'Please Enter E-Mail','valid_email'=>'Please Enter E-mail In Valid E-Mail Format'));
			//$this->form_validation->set_rules('edit_email','Email','required|valid_email',array('required'=>'Please Enter E-Mail','valid_email'=>'Please Enter E-mail In Valid E-Mail Format'));
			if($this->form_validation->run()){
				if($this->PracticeM->update_record()){
					$data = array('response'=>'success','message'=>'Updated successfully');
				}
			}else{
				$data = array('response'=>'error', 'message' => $this->form_validation->error_array());
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

	public function sort_username_asc(){
		
		$data['users'] = $this->PracticeM->get_sort_username();
		$data['pagelinks'] = $this->pagination->create_links();
		$this->load->view('practice_ajax',$data);

	}

	/*public function is_unique($id){
		if(isset($_post['edit_email'])){
			if($this->PracticeM->unique_email($id)){
				$this->form_validation->set_message('is_unique','updated')
			}
		}
	}*/
}