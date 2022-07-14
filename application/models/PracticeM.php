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
}