<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('ModProduk');
		$this->load->model('ModKategori');
		$this->load->model('ModUser');
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
		$data['produk'] = $this->ModProduk->selectAll();
		$this->load->view('template/header');
		$this->load->view('template/menu',$menu);
		$this->load->view('produk',$data);
		$this->load->view('template/footer');
	}
	public function modal() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['cek'] = 0;
		$data['kategori'] = $this->ModKategori->selectAll();
		$this->load->view('modal/produk', $data);
	}
	public function add() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$this->ModProduk->add();
		echo json_encode(array("status" => TRUE));
	}
	public function edit($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['cek'] = 1;
		$data['produk'] = $this->ModProduk->edit($id);
		$data['kategori'] = $this->ModKategori->selectAll();
		$data['produk_kategori'] = $this->ModProduk->produk_kategori($id);
		$this->load->view('modal/produk', $data);
	}
	public function delete($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$this->ModProduk->delete($id);
		echo json_encode(array("status" => TRUE));
	}
	public function update() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$this->ModProduk->update();
		echo json_encode(array("status" => TRUE));
	}
}
