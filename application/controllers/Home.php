<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('ModUser');
		$this->load->model('ModProduk');
		$this->load->model('ModPenjualan');
	}
	
	public function index()
	{
		$q = $this->session->userdata('status');
		if($q != "login") {
			redirect('login','refresh');
		}
		$menu['modul'] = $this->ModUser->modul();
		$menu['akses'] = $this->ModUser->akses_admin($this->session->userdata('admin_id'));
		$menu['login'] = $this->ModUser->edit($this->session->userdata('admin_id'));
		$data['habis'] = $this->ModProduk->habis();
		$data['penjualan'] = $this->ModPenjualan->bulan_ini();
		$this->load->view('template/header');
		$this->load->view('template/menu',$menu);
		$this->load->view('home',$data);
		$this->load->view('template/footer');
	}
	public function logout() {
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}
