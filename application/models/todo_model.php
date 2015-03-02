<?php
class Todo_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_todo_list()
	{
		$query = $this->db->get('todos', 10);
        return $query->result_array();
	}

	public function get_todos($id = 0)
	{
		if ($id === 0)
		{
			$query = $this->db->get_where('todos',array('completed' => 0));
			return $query->result_array();
		}
		
		$query = $this->db->get_where('todos', array('id' => $id));
		return $query->row_array();
	}
	
	public function set_todos($id = 0)
	{
		$this->load->helper('url');
		
		$data = array(
			'title' => $this->input->post('title'),
			'description' => $this->input->post('description'),
		);
		
		if ($id === 0) {
		
			return $this->db->insert('todos', $data);
		
		}
		else {
		
			$this->db->where('id', $id);
			return $this->db->update('todos', $data);
		
		}
		
		
	}
	
	public function completed($id)
	{
		
		$data = array(
               'completed' => 1
            );

		$this->db->where('id', $id);
		$this->db->update('todos', $data); 
	
	}
	
}