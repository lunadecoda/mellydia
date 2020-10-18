<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('ModUser');
	}
	
	public function index()
	{
		$q = $this->session->userdata('status');
		if($q != "login") {
			redirect('login','refresh');
		}
		$menu['modul'] = $this->ModUser->modul();
		$menu['akses'] = $this->ModUser->akses();
		$menu['login'] = $this->ModUser->edit($this->session->userdata('admin_id'));
		$this->load->view('template/header');
		$this->load->view('template/menu',$menu);
		$this->load->view('home');
		$this->load->view('template/footer');
	}
	public function logout() {
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}
