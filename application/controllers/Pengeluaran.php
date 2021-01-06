<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller {
	public function __construct() {
		parent::__construct();
        $this->load->model('ModPengeluaran');
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
		$data['session'] = $this->session->userdata('admin_id');
		$data['pengeluaran'] = $this->ModPengeluaran->selectAll();
		$this->load->view('template/header');
		$this->load->view('template/menu',$menu);
		$this->load->view('pengeluaran',$data);
		$this->load->view('template/footer');
	}
	public function modal() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['cek'] = 0;
		$data['pengeluaran'] = $this->ModPengeluaran->selectAll();
		$this->load->view('modal/pengeluaran', $data);
	}
	public function add() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$this->ModPengeluaran->add();
		echo json_encode(array("status" => TRUE));
	}
	public function edit($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['cek'] = 1;
		$data['pengeluaran'] = $this->ModPengeluaran->edit($id);
		$this->load->view('modal/pengeluaran', $data);
	}
	public function delete($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$this->ModPengeluaran->delete($id);
		echo json_encode(array("status" => TRUE));
	}
	public function update() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$this->ModPengeluaran->update();
		echo json_encode(array("status" => TRUE));
	}
}
