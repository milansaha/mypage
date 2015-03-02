<?php
class Portfolios extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model(array('Portfolio','Application_type'));

		//Loading the model. 
		//The first param-> Model Name, 2nd Param: Custom Name, 3rd Param: AutoLoad Database. 
		//If 3rd parameter is not used, you have to load the database manually
		//$this->load->model(array('Employee_designation','Employee_department'),'',TRUE);	
	}

		
	function index()
		{
			$data['title']='Portfolios';
	        $data['headline']='Portfolio';
			
			// load pagination class
			$this->load->library('pagination');
			$total = $this->Portfolio->row_count();
			
			//Initializing Pagination
			$config['base_url'] = site_url('/portfolios/index/');
			$config['total_rows'] = $total;
			$config['per_page'] = ROW_PER_PAGE;
			
			$this->pagination->initialize($config);	
			
			//Loading data by model function call
			$data['portfolios']=$this->Portfolio->get_list(ROW_PER_PAGE, (int)$this->uri->segment(3));	
			$data['counter'] = (int)$this->uri->segment(3);
			$this->layout->view('/portfolios/index',$data);
		}
	
	function add()
	{
		$this->_prepare_validation();
		//If the form is posted, perform the validation. is_posted is a hidden input used to detect if the form is posted
		if($_POST)
		{
			$data=$this->_get_posted_data();
			//Perform the Validation
			if ($this->form_validation->run() == TRUE)
			{
				
				if($this->Portfolio->add($data))
				{
					$this->session->set_flashdata('message',ADD_MESSAGE);
					redirect('/portfolios/add/');
				}
			}
		}
		$data = $this->_load_combo_data();
		//If data is not posted or validation fails, the add view is displayed
		$data['title'] = 'Add Portfolio';
        $data['headline'] = 'Add Portfolio';
		$this->layout->view('/portfolios/add',$data);				
	}

	function edit($portfolio_id=null)
	{
		//die($portfolio_id);
		//If ID is not provided, redirecting to index page
		if(empty($portfolio_id) && !$_POST)
		{
			$this->session->set_flashdata('message','Portfolio ID is not provided');
			redirect('/portfolios/index/');
		}

		$this->_prepare_validation();
		//If the form is posted, perform the validation. is_posted is a hidden input used to detect if the form is posted
		if($_POST)
		{
			$portfolio_id=$_POST['portfolio_id'];
			//Perform the Validation
			if ($this->form_validation->run() === TRUE)
			{				
				$data=$this->_get_posted_data();
				$data['id']=$this->input->post('portfolio_id');
				//Validation is OK. So, add this data and redirect to the index page
				if($this->Portfolio->edit($data))
				{
					$this->session->set_flashdata('message',EDIT_MESSAGE);
					redirect('/portfolios/index/', 'refresh');
				}
			}
		}
		//die($app_type_id);
		$data = $this->_load_combo_data();
		//Load data from database
		$data['row']=$this->Portfolio->read($portfolio_id);
		//print_r($data['row']);die();
		$data['title']='Edit Portfolio';
        $data['headline']='Edit Portfolio';
		//If data is not posted or validation fails, the add view is displayed
		$this->layout->view('/portfolios/edit',$data);		
	}
	
    
    function delete($portfolio_id=null)
	{
        if(empty($portfolio_id))
		{
			$this->session->set_flashdata('warning','Portfolio id is not provided');
			redirect('/portfolios/index/');
		}
		
        if($this->Portfolio->delete($portfolio_id))
            {
                $this->session->set_flashdata('message',DELETE_MESSAGE);
                redirect('/portfolios/index/');
            }
	}

	function _get_posted_data()
	{
		$data=array();
		//$data['id']=$this->input->post('designation_id');
		$data['name']=$this->input->post('txt_name');
		$data['application_type_id']=$this->input->post('app_type');
		$data['url']=$this->input->post('txt_url');
		$data['summary']=$this->input->post('txt_summary');
		$data['description']=$this->input->post('txt_description');
		//$data['is_manager']=$this->input->post('cbo_is_manage');
		return $data;
	}
	
	function _prepare_validation()
	{
		//Loading Validation Library to Perform Validation
		$this->load->library('form_validation');	
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('app_type','Application Type','trim|xss_clean|required');
		$this->form_validation->set_rules('txt_name','Name','trim|xss_clean|required|max_length[100]');
		$this->form_validation->set_rules('txt_url','URL','trim|xss_clean|required|max_length[100]');
		$this->form_validation->set_rules('txt_summary','Summary','trim|xss_clean|required');		
	}

	function _load_combo_data()
	{
		//This function is for listing of app types	
		$data['app_types'] = $this->Application_type->get_app_types();
		return $data;
	}

	function ajaxlist(){
		if($_POST)
		{
			 $app_type_id=$_POST['app_type_id'];
			 $data['app_list'] = $this->Portfolio->get_portfolio_by_type($app_type_id);
			 $this->load->view('/portfolios/showlist',$data);
		}

	}
	
		
}