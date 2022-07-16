<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PracticeM extends CI_Model
{

	public function insert($data)
	{

		return $this->db->insert('crud', $data);
		
	}

	public function get_data()
	{
		$query = $this->db->get('crud');
		if (count($query->result()) > 0) {
			return $query->result();
		}
	}

	public function single_entry(){
		$id = $this->input->post('edit_id');
		$this->db->select('id,name,email');
		$this->db->from('crud');
		$this->db->where('id',$id);
		//$query = $this->db->get('crud');
		$query = $this->db->get();
		if(count($query->result())>0){
			return $query->row();
		}
	}

	public function update_record(){

		$data['id'] = $this->input->post('edit_id');
		$data['name'] = $this->input->post('edit_name');
		$data['email'] = $this->input->post('edit_email');

		 $this->db->set($data);
		 $this->db->where('id',$data['id']);
		 return $this->db->update('crud');

		//return $this->db->update('crud', $data, array('id'=>$data['id']))->row_array();
	}

	public function delete_record(){
		$del_id = $this->input->post('del_id');
		$this->db->select('id,name,email');
		$this->db->where('id',$del_id);
		return $this->db->delete('crud');
	}
}