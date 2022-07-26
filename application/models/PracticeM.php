<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PracticeM extends CI_Model
{

	public function insert()
	{

		
		$name = $this->input->post('name');
		$email = $this->input->post('email');

		$data = array(
			'name' => $name,
			'email' => $email
		);
		
		return $this->db->insert('crud',$data);
		
	}

	public function get_data($limit,$offset,$search,$data,$count)
	{
		
		$this->db->select('id,name,email');
			$this->db->from('crud');
			
		if($data['sort_by'] == 'sort_username_asc'){
			
			$this->db->order_by('name', 'ASC');
			
		}
			if($data['sort_by'] == 'sort_username_desc'){
				$this->db->order_by('name', 'DESC');
			}  
				if($data['sort_by'] == 'sort_email_asc'){
					$this->db->order_by('email', 'ASC');
			}
				if($data['sort_by'] == 'sort_email_desc'){
					$this->db->order_by('email', 'DESC');
			}
			
      $this->db->order_by('id', 'DESC');
		
		
		
		

		if($search){
			$keyword = $search['search_key'];
			if($keyword){
				$this->db->where("name LIKE '%$keyword%'");
				
			}
		}
		
		
		
		

		if($count){
			return $this->db->count_all_results();
		}else{
			$this->db->limit($limit,$offset);
			
			$query = $this->db->get();

			if($query->num_rows()>0){
				return $query->result();
			}
		}

	
		

		return array();
		
	}

		

	public function single_entry($id){
		
		$this->db->select('id,name,email');
		$this->db->from('crud');
		$this->db->where('id',$id);
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

	
	}

	

	public function delete_record(){
		$del_id = $this->input->post('del_id');
		$this->db->select('id,name,email');
		$this->db->where('id',$del_id);
		return $this->db->delete('crud');
	}

}