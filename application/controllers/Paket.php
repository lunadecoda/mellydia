<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paket extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('ModPaket');
		$this->load->model('ModProduk');
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
		$data['paket'] = $this->ModPaket->selectAll();
		$data['produk'] = $this->ModPaket->produk();
		$this->load->view('template/header');
		$this->load->view('template/menu',$menu);
		$this->load->view('paket',$data);
		$this->load->view('template/footer');
	}
	public function modal() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['cek'] = 0;
		$data['produk'] = $this->ModProduk->selectAll();
		$this->load->view('modal/paket', $data);
	}
	public function add() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$this->ModPaket->add();
		echo json_encode(array("status" => TRUE));
	}
	public function edit($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['cek'] = 1;
		$data['paket'] = $this->ModPaket->edit($id);
		$data['produk'] = $this->ModProduk->selectAll();
		$data['paket_produk'] = $this->ModPaket->paket_produk($id);
		$this->load->view('modal/paket', $data);
	}
	public function delete($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$this->ModPaket->delete($id);
		echo json_encode(array("status" => TRUE));
	}
	public function update() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$this->ModPaket->update();
		echo json_encode(array("status" => TRUE));
	}
}
