<?php
class Todos extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('todo_model');
	}

	public function index()
	{
		$data['title'] = 'To-Dos List';
		$data['todos'] = $this->todo_model->get_todo_list();
		$this->layout->view('/todos/index',$data);
	}
	
	public function view()
	{
	
		$id = $this->uri->segment(3);
	
		if (empty($id))
		{
			show_404();
		}
		
		$data['title'] = 'View a To-do item';
		$data['todo'] = $this->todo_model->get_todos($id);
	
		/*$this->load->view('templates/header', $data);
		$this->load->view('todos/view', $data);
		$this->load->view('templates/footer');*/
		$this->layout->view('/todos/view',$data);

	}
	
	public function create()
	{
		
		$data['title'] = 'Create a To-do item';
		
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			/*$this->load->view('templates/header', $data);	
			$this->load->view('todos/create');
			$this->load->view('templates/footer');*/

			$this->layout->view('/todos/create',$data);
			
		}
		else
		{
			$this->todo_model->set_todos();
			//$this->load->view('todos/success');
			
			$this->layout->view('/todos/success',$data);
		}
	}
	
	public function edit()
	{
		$id = $this->uri->segment(3);
	
		if (empty($id))
		{
			show_404();
		}
		
		$data['title'] = 'Edit a To-do item';
		$data['todo'] = $this->todo_model->get_todos($id);
		//print_r($data['todo']); die();
		
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			/*$this->load->view('templates/header', $data);	
			$this->load->view('todos/edit', $data);
			$this->load->view('templates/footer', $data);*/
			//print_r($data['todo']); die();
			$this->layout->view('/todos/edit',$data);
			
		}
		else
		{
			$this->todo_model->set_todos($id);
			redirect( base_url() . 'todos');
			
		}
		
	}
	
	public function completed()
	{
		$id = $this->uri->segment(3);
	
		if (empty($id))
		{
			show_404();
		}
	
		$this->todo_model->completed($id);
		
		redirect( base_url() . 'todos');
		
	}
	
}