<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('ModProduk');
		$this->load->model('ModPaket');
		$this->load->model('ModPenjualan');
		$this->load->model('ModUser');
		$this->load->model('ModCustomer');
		$this->load->model('ModMarketplace');
	}
	public function index()
	{
		$q = $this->session->userdata('status');
		if($q != "login") {
			redirect('login','refresh');
		}
		
		$start = $this->input->post('start');
		$end = $this->input->post('end');
		$admin_id = $this->input->post('admin_id');
		if($start == NULL) {
			$start = date("Y-m-01");
		}
		if($end == NULL) {
			$end = date("Y-m-t");
		}
		if($admin_id == NULL) {
			$admin_id = $this->session->userdata('admin_id');
		}
		$data['awal'] = $start;
		$data['akhir'] = $end;
		$data['admin_id'] = $admin_id;
		
		$menu['modul'] = $this->ModUser->modul();
		$menu['akses'] = $this->ModUser->akses_admin($this->session->userdata('admin_id'));
		$menu['login'] = $this->ModUser->edit($this->session->userdata('admin_id'));
		$data['penjualan'] = $this->ModPenjualan->selectAll();
		$menu['user'] = $this->ModUser->selectAll();
		$this->load->view('template/header');
		$this->load->view('template/menu',$menu);
		$this->load->view('penjualan',$data);
		$this->load->view('template/footer');
	}
	public function modal() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['cek'] = 0;
		$data['produk'] = $this->ModProduk->selectAll();
		$data['paket'] = $this->ModPaket->selectAll();
		$data['member'] = $this->ModCustomer->selectAll();
		$data['user'] = $this->ModUser->selectAll();
		$data['market'] = $this->ModMarketplace->selectAll();
		$data['user_id'] = $this->session->userdata('admin_id');
		$this->load->view('modal/penjualan', $data);
	}
	public function set_produk($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$exp_id = explode("-",$id);
		$data['produk'] = $this->ModProduk->selectAll();
		if($exp_id[0] == "p") {
			$data['paket_isi'] = $this->ModPaket->paket_produk($exp_id[1]);
			$data['paket'] = $this->ModPaket->edit($exp_id[1]);
		} elseif($exp_id[0] == "b") {
			$data['produk_isi'] = $this->ModProduk->edit($exp_id[1]);
		}
		$this->load->view('modal/set-produk', $data);
	}
	public function set_customer($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['member'] = $this->ModCustomer->edit($id);
		$this->load->view('modal/set-customer', $data);
	}
	public function add() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$this->ModPenjualan->add();
		echo json_encode(array("status" => TRUE));
	}
	public function edit($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['cek'] = 1;
		$data['penjualan'] = $this->ModPenjualan->edit($id);
		$data['produk'] = $this->ModProduk->selectAll();
		$this->load->view('modal/penjualan', $data);
	}
	public function delete($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$this->ModPenjualan->delete($id);
		echo json_encode(array("status" => TRUE));
	}
	public function update() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$this->ModPenjualan->update();
		echo json_encode(array("status" => TRUE));
	}
}