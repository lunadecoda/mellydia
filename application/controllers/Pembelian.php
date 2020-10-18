<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('ModProduk');
		$this->load->model('ModPembelian');
		$this->load->model('ModUser');
	}
	public function index()
	{
		$q = $this->session->userdata('status');
		if($q != "login") {
			redirect('login','refresh');
		}
		
		$start = $this->input->post('start');
		$end = $this->input->post('end');
		if($start == NULL) {
			$start = date("Y-m-01");
		}
		if($end == NULL) {
			$end = date("Y-m-t");
		}
		$data['awal'] = $start;
		$data['akhir'] = $end;
		
		$menu['modul'] = $this->ModUser->modul();
		$menu['akses'] = $this->ModUser->akses_admin($this->session->userdata('admin_id'));
		$menu['login'] = $this->ModUser->edit($this->session->userdata('admin_id'));
		$data['pembelian'] = $this->ModPembelian->selectAll();
		$this->load->view('template/header');
		$this->load->view('template/menu',$menu);
		$this->load->view('pembelian',$data);
		$this->load->view('template/footer');
	}
	public function modal() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['cek'] = 0;
		$data['produk'] = $this->ModProduk->selectAll();
		$this->load->view('modal/pembelian', $data);
	}
	public function add() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$this->ModPembelian->add();
		echo json_encode(array("status" => TRUE));
	}
	public function edit($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['cek'] = 1;
		$data['pembelian'] = $this->ModPembelian->edit($id);
		$data['produk'] = $this->ModProduk->selectAll();
		$this->load->view('modal/pembelian', $data);
	}
	public function delete($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$this->ModPembelian->delete($id);
		echo json_encode(array("status" => TRUE));
	}
	public function update() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$this->ModPembelian->update();
		echo json_encode(array("status" => TRUE));
	}
}
