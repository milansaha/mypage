<?php
class Application_type extends CI_Model {

	/*public function __construct()
	{
		$this->load->database();
	}*/

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        //$this->load->database();
    }
    
    function get_list($offset,$limit)
    {       
        /*$this->db->select('employee_designations.*,employee_departments.name AS department_name');
		$this->db->from('employee_designations');
		$this->db->join('employee_departments', 'employee_departments.id = employee_designations.department_id');
		$this->db->limit($offset,$limit);
		$this->db->order_by('name', 'asc');
		$query = $this->db->get();
        return $query->result();*/

        $this->db->select('application_types.id,application_types.name,application_types.summary');
        $this->db->from('application_types');
        //$this->db->join('employees','samities.field_officer_id=employees.id');
		$this->db->limit($offset, $limit);		
        $this->db->order_by('id','ASC');
		$query = $this->db->get(); 
        return $query->result(); 
    }
	
	function row_count()
	{
		return $this->db->count_all_results('application_types');
	}
	
    function add($data)
    {
        return $this->db->insert('application_types', $data);
    }

    function edit($data)
    {
        return $this->db->update('application_types', $data, array('id'=> $data['id']));
    }
	
	function read($app_type_id)
    {
        $query=$this->db->get_where('application_types', array('id' => $app_type_id));
        //print_r($query->row());die();
		return $query->row();
    }
	
	function delete($app_type_id)
	{
		return $this->db->delete('application_types', array('id'=> $app_type_id));
	}
	
	//This function is for listing of designations
	/*function get_employee_designations()
	{		
		$this->db->select('id AS designation_id, name AS designation_name');		
		$this->db->order_by('designation_name','ASC');		
		$department_info = $this->db->get('employee_designations');  
		return $department_info->result();
	}*/

	//This function is for listing of departments
	function get_app_types()
	{		
		$this->db->select('id AS app_type_id, name AS app_type_name');		
		$this->db->order_by('id','ASC');		
		$app_type_info = $this->db->get('application_types');  
		return $app_type_info->result();
	}

	
	
}