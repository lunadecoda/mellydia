<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('ModProduk');
		$this->load->model('ModPembelian');
		$this->load->model('ModUser');
		$this->load->model('ModPenjualan');
		$this->load->model('ModPaket');
		$this->load->model('ModCustomer');
	}
	public function index()
	{
		$q = $this->session->userdata('status');
		if($q != "login") {
			redirect('login','refresh');
		}
		
		$start = $this->input->post('start');
		$end = $this->input->post('end');
		$produk_id = $this->input->post('produk_id');
		if($start == NULL) {
			$start = date("Y-m-01");
		}
		if($end == NULL) {
			$end = date("Y-m-t");
		}
		if($produk_id == NULL) {
			$produk_id = 0;
		}
		$data['awal'] = $start;
		$data['akhir'] = $end;
		$data['produk_id'] = $produk_id;
		
		$menu['modul'] = $this->ModUser->modul();
		$menu['akses'] = $this->ModUser->akses_admin($this->session->userdata('admin_id'));
		$menu['login'] = $this->ModUser->edit($this->session->userdata('admin_id'));
		$data['pembelian'] = $this->ModPembelian->selectAll();
		$data['produk'] = $this->ModProduk->selectAll();
		$arr_qty = array();
		$arr_harga = array();
		foreach($data['pembelian'] as $k) {
			$arr_qty[$k->nama_produk][] = $k->qty;
			$arr_harga[$k->nama_produk][] = $k->harga_satuan;
		}
		$data['grafik_qty'] = $arr_qty;
		$data['grafik_harga'] = $arr_harga;
		$this->load->view('template/header');
		$this->load->view('template/menu',$menu);
		$this->load->view('laporan-pembelian',$data);
		$this->load->view('template/footer');
	}
	public function penjualan() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			redirect('login','refresh');
		}
		
		$start = $this->input->post('start');
		$end = $this->input->post('end');
		$admin_id = $this->input->post('admin_id');
		if($start == NULL) {
			$now = date("Y-m-d");
			$start = date('Y-m-01',(strtotime ('-1 month' , strtotime($now))));
		}
		if($end == NULL) {
			$end = date("Y-m-t");
		}
		if($admin_id == NULL) {
			$admin_id = 0;
		}
		$produk_id = $this->input->post('produk_id');
		$jenis = "";
		if($produk_id == "go" || $produk_id == NULL) {
			$produk_id = "go";
		} else {
			$exp_pro = explode("-",$produk_id);
			if($exp_pro[0] == "a") {
				$jenis = "paket";
			} else {
				$jenis = "produk";
			}
		}
		$member_id = $this->input->post('member_id');
		if($member_id == NULL) {
			$member_id = 0;
		}
		$ket = $this->input->post('ket');
		if($ket == NULL) {
			$ket = "go";
		}
		$data['ket'] = $ket;
		$data['awal'] = $start;
		$data['akhir'] = $end;
		$data['admin_id'] = $admin_id;
		$data['produk_id'] = $produk_id;
		$data['member_id'] = $member_id;
		
		$menu['modul'] = $this->ModUser->modul();
		$menu['akses'] = $this->ModUser->akses_admin($this->session->userdata('admin_id'));
		$menu['login'] = $this->ModUser->edit($this->session->userdata('admin_id'));
		$menu['user'] = $this->ModUser->selectAll();
		$data['produk'] = $this->ModProduk->selectAll();
		$data['paket'] = $this->ModPaket->selectAll();
		$data['member'] = $this->ModCustomer->selectAll();
		if($jenis == "paket") {
			$data['penjualan_paket'] = $this->ModPenjualan->laporan_paket();
		} elseif($jenis == "produk") {
			$data['penjualan'] = $this->ModPenjualan->laporan();
		} else {
			$data['penjualan'] = $this->ModPenjualan->laporan();
			$data['penjualan_paket'] = $this->ModPenjualan->laporan_paket();
		}
		
		//print_r($data['penjualan_paket']);
		$this->load->view('template/header');
		$this->load->view('template/menu',$menu);
		$this->load->view('laporan-penjualan',$data);
		$this->load->view('template/footer');
	}
}
