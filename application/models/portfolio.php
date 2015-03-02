<?php
class Portfolio extends CI_Model {

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        //$this->load->database();
    }
    
    function get_list($offset,$limit)
    {       
        $this->db->select('portfolios.*,application_types.name AS app_type_name');
        $this->db->from('portfolios');
        $this->db->join('application_types','application_types.id = portfolios.application_type_id');
		$this->db->limit($offset, $limit);		
        $this->db->order_by('id','ASC');
		$query = $this->db->get(); 
        return $query->result(); 
    }
	
	function row_count()
	{
		return $this->db->count_all_results('portfolios');
	}
	
    function add($data)
    {
        return $this->db->insert('portfolios', $data);
    }

    function edit($data)
    {
        return $this->db->update('portfolios', $data, array('id'=> $data['id']));
    }
	
	function read($portfolio_id)
    {
        $query=$this->db->get_where('portfolios', array('id' => $portfolio_id));
        //print_r($query->row());die();
		return $query->row();
    }
	
	function delete($portfolio_id)
	{
		return $this->db->delete('portfolios', array('id'=> $portfolio_id));
	}
	
	//This function is for listing of designations
	/*function get_employee_designations()
	{		
		$this->db->select('id AS designation_id, name AS designation_name');		
		$this->db->order_by('designation_name','ASC');		
		$department_info = $this->db->get('employee_designations');  
		return $department_info->result();
	}*/

	
}