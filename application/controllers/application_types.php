<?php
class Application_types extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Application_type');

		//Loading the model. 
		//The first param-> Model Name, 2nd Param: Custom Name, 3rd Param: AutoLoad Database. 
		//If 3rd parameter is not used, you have to load the database manually
		//$this->load->model(array('Employee_designation','Employee_department'),'',TRUE);	
	}

		
	function index()
		{
			$data['title']='Application types';
	        $data['headline']='Application Types for portfolio';
			
			// load pagination class
			$this->load->library('pagination');
			$total = $this->Application_type->row_count();
			
			//Initializing Pagination
			$config['base_url'] = site_url('/application_types/index/');
			$config['total_rows'] = $total;
			$config['per_page'] = ROW_PER_PAGE;
			
			$this->pagination->initialize($config);	
			
			//Loading data by model function call
			$data['apptypes']=$this->Application_type->get_list(ROW_PER_PAGE, (int)$this->uri->segment(3));	
			$data['counter'] = (int)$this->uri->segment(3);
			$this->layout->view('/application_types/index',$data);
		}
	
	function add()
	{
		//die('hi');
		$this->_prepare_validation();
		//If the form is posted, perform the validation. is_posted is a hidden input used to detect if the form is posted
		if($_POST)
		{
			$data=$this->_get_posted_data();
			//Perform the Validation
			if ($this->form_validation->run() == TRUE)
			{
				//The first param->Table Name, 2nd Param: id field
				//$data['id'] = $this->Application_type->get_new_id('employee_designations', 'id');
				//Validation is OK. So, add this data and redirect to the index page
				if($this->Application_type->add($data))
				{
					$this->session->set_flashdata('message',ADD_MESSAGE);
					redirect('/application_types/add/');
				}
			}
		}
		$data = $this->_load_combo_data();
		//If data is not posted or validation fails, the add view is displayed
		$data['title'] = 'Add Application type';
        $data['headline'] = 'Add Application type';
		$this->layout->view('/application_types/add',$data);				
	}

	function edit($app_type_id=null)
	{
		//die($app_type_id);
		//If ID is not provided, redirecting to index page
		if(empty($app_type_id) && !$_POST)
		{
			$this->session->set_flashdata('message','Application type ID is not provided');
			redirect('/application_types/index/');
		}

		$this->_prepare_validation();
		//If the form is posted, perform the validation. is_posted is a hidden input used to detect if the form is posted
		if($_POST)
		{
			$app_type_id=$_POST['app_type_id'];
			//Perform the Validation
			if ($this->form_validation->run() === TRUE)
			{				
				$data=$this->_get_posted_data();
				$data['id']=$this->input->post('app_type_id');
				//Validation is OK. So, add this data and redirect to the index page
				if($this->Application_type->edit($data))
				{
					$this->session->set_flashdata('message',EDIT_MESSAGE);
					redirect('/application_types/index/', 'refresh');
				}
			}
		}
		//die($app_type_id);
		$data = $this->_load_combo_data();
		//Load data from database
		$data['row']=$this->Application_type->read($app_type_id);
		//print_r($data['row']);die();
		$data['title']='Edit Application';
        $data['headline']='Edit Application';
		//If data is not posted or validation fails, the add view is displayed
		$this->layout->view('/application_types/edit',$data);		
	}
	
    
    function delete($app_type_id=null)
	{
        if(empty($app_type_id))
		{
			$this->session->set_flashdata('warning','Application type id is not provided');
			redirect('/application_types/index/');
		}
		/*//Check wether the child data exists
        $has_employees_entry = $this->Employee_designation->is_dependency_found('employees',  array('designation_id' => $designation_id));

        if($has_employees_entry)
        {
            $this->session->set_flashdata('warning', DEPENDENT_DATA_FOUND);
			redirect('/employee_designations/index/');
        }
        else
        {
            if($this->Employee_designation->delete($designation_id))
            {
                $this->session->set_flashdata('message',DELETE_MESSAGE);
                redirect('/employee_designations/index/');
            }
        }*/

        if($this->Application_type->delete($app_type_id))
            {
                $this->session->set_flashdata('message',DELETE_MESSAGE);
                redirect('/application_types/index/');
            }
	}

	function _get_posted_data()
	{
		$data=array();
		//$data['id']=$this->input->post('designation_id');
		$data['name']=$this->input->post('txt_name');
		//$data['department_id']=$this->input->post('cbo_department');
		$data['summary']=$this->input->post('txt_summary');
		//$data['short_name']=$this->input->post('txt_short_name');
		//$data['is_manager']=$this->input->post('cbo_is_manage');
		return $data;
	}
	
	function _prepare_validation()
	{
		//Loading Validation Library to Perform Validation
		$this->load->library('form_validation');	
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//Setting Validation Rule				
		//$this->form_validation->set_rules('txt_name','Name','trim|xss_clean|required|max_length[100]|unique[employee_designations.name.id.designation_id]');
		//$this->form_validation->set_rules('cbo_department','Department','trim|xss_clean|required');
		$this->form_validation->set_rules('txt_name','Name','trim|xss_clean|required|max_length[100]');
		$this->form_validation->set_rules('txt_summary','Summary','trim|xss_clean|required');		
	}

	function _load_combo_data()
	{
		//This function is for listing of departments	
		/*$data['departments'] = $this->Employee_department->get_employee_departments();
		return $data;*/
	}
	
		
}