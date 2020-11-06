 <?php
class ModPenjualan extends CI_model
  {
    public function selectAll($status = 0,$laporan=0)
      {
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
			$admin_id = $this->session->userdata('admin_id');
		}
		
		if($status == 0) {
			$status = "sedang dikemas";
		} elseif($status == 1) {
			$status = "sedang dikirim";
		} elseif($status == 2) {
			$status = "selesai";
		} elseif($status == 3) {
			$status = "batal";
		}
		
		$this->db->select('*');
		$this->db->from('penjualan');
		$this->db->join('sumber_market', 'penjualan.sumber_id = sumber_market.id_sumber');
		$this->db->where('penjualan.tgl_penjualan >=', $start);
		$this->db->where('penjualan.tgl_penjualan <=', $end);
		if($admin_id != 0 && $laporan == 0) {
			$this->db->where('penjualan.admin_id', $admin_id);
		}
		$this->db->where('penjualan.status', $status);
        $this->db->order_by('penjualan.id_penjualan', "desc");
		return $this->db->get()->result();
      }
    public function add()
      {
		$member_id = $this->input->post('member_id');
		$nama_penerima = $this->input->post('nama_penerima');
		$alamat_penerima = $this->input->post('alamat_penerima');
		$telp_penerima = $this->input->post('telp_penerima');
		if($member_id == 0) {
			$data = array('nama_member' => $nama_penerima, 'alamat_member' => $alamat_penerima, 'telp_member' => $telp_penerima);
			$this->db->insert('member', $data);
			$member_id = $this->db->insert_id();
		}
		
		$tgl = $this->input->post('tgl');
		$admin_id   = $this->input->post('admin_id');
        $paket_id   = $this->input->post('paket_id');
		$diskon   = $this->input->post('diskon');
		$harga_total   = $this->input->post('harga_total');
		$total_berat   = $this->input->post('total_berat');
		$harga_paket = $this->input->post('harga_paket');
		$berat_paket = $this->input->post('berat_paket');
		$sumber_id = $this->input->post('sumber_id');
		$num=0;
		foreach ($paket_id as $k => $v) {
			$exp_id = explode("-",$v);
			$id_paket = $exp_id[0];
			$produk_id = $this->input->post('produk_id_'.$exp_id[1]);
			$harga = $this->input->post('harga_'.$exp_id[1]);
			$qty = $this->input->post('qty_'.$exp_id[1]);
			
			
			$data = array('diskon' => $diskon, 'status' => "sedang dikemas", 'total_berat'=> $total_berat, 'total_harga' => $harga_total, 'admin_id' => $admin_id, 'tgl_penjualan' => $tgl, 'member_id' => $member_id, 'sumber_id' => $sumber_id, 'nama_penerima' => $nama_penerima, 'alamat_penerima' => $alamat_penerima, 'telp_penerima' => $telp_penerima);
			$this->db->insert('penjualan', $data);
			$penjualan_id = $this->db->insert_id();
			
			
			$data = array('paket_id' => $id_paket, 'berat_paket' => $berat_paket[$num], 'harga_paket' => $harga_paket[$num], 'penjualan_id' => $penjualan_id);
			$this->db->insert('penjualan_paket', $data);
			$penjualan_paket_id = $this->db->insert_id();
			$exnum = 0;
			foreach ($produk_id as $kp => $vp) {
				$data = array('penjualan_paket_id' => $penjualan_paket_id, 'produk_id' => $vp, 'qty' => $qty[$exnum], 'harga' => $harga[$exnum], 'penjualan_id' => $penjualan_id);
				$this->db->insert('penjualan_produk', $data);
				$penjualan_produk_id = $this->db->insert_id();
				
				$this->db->where('id_produk',$vp);
				$pro = $this->db->get('produk')->row();
				$minstok = $pro->stok - $qty[$exnum];
				
				$data = array('stok' => $minstok);
				$this->db->where('id_produk', $vp);
				$this->db->update('produk', $data);
				
			$exnum++; }
		$num++;}
      }
    public function delete($id)
      {
		$this->db->where('id_penjualan',$id);
		$penjualan = $this->db->get('penjualan')->row();
		
		$produk_id = $penjualan->produk_id;
		
		$this->db->where('id_produk',$produk_id);
		$produk = $this->db->get('produk')->row();
		$stok = $produk->stok - $penjualan->qty;
				
        $this->db->where('id_penjualan', $id);
		$this->db->delete('penjualan');
		
		$this->db->where('produk_id', $id);
		$this->db->limit('1');
		$penjualan = $this->db->get('penjualan')->row();
		if(isset($penjualan->harga_satuan)) {
			$harga_beli = $penjualan->harga_satuan;
		} else {
			$harga_beli = 0;
		}
		
		$data    = array('stok' => $stok, 'harga_beli' => $harga_beli);
		$this->db->where('id_produk', $produk_id);
		$this->db->update('produk', $data);
      }
    public function edit($id)
      {
        $this->db->where('id_penjualan', $id);
        return $this->db->get('penjualan')->row();
      }
	public function penjualan_paket($status = 0,$laporan=0) {
		$xpaket = $this->selectAll($status,$laporan);
		$newin = array();
		foreach ($xpaket as $key) {
			$newin[] = $key->id_penjualan;
		}
		$this->db->where_in('penjualan_id',$newin);
		return $this->db->get('penjualan_paket')->result();
	}
	public function penjualan_paket_edit($id) {
		$this->db->where_in('penjualan_id',$id);
		return $this->db->get('penjualan_paket')->result();
	}
	public function paket_produk($status = 0,$laporan=0) {
		$xpaket = $this->penjualan_paket($status,$laporan);
		$newin = array();
		foreach ($xpaket as $key) {
			$newin[] = $key->id_penjualan_paket;
		}
		
		$this->db->select('*');
		$this->db->from('penjualan_produk');
		$this->db->join('produk', 'penjualan_produk.produk_id = produk.id_produk');
		$this->db->where_in('penjualan_produk.penjualan_paket_id',$newin);
		return $this->db->get()->result();
	}
	public function paket_produk_edit($id) {
		$this->db->select('*');
		$this->db->from('penjualan_produk');
		$this->db->join('produk', 'penjualan_produk.produk_id = produk.id_produk');
		$this->db->where('penjualan_produk.penjualan_id',$id);
		return $this->db->get()->result();
	}
	public function update_ongkir() {
		$id = $this->input->post('id_penjualan');
		$nama_penerima = $this->input->post('nama_penerima');
		$alamat_penerima = $this->input->post('alamat_penerima');
		$telp_penerima = $this->input->post('telp_penerima');
		$ongkir = $this->input->post('ongkir');
		$resi = $this->input->post('resi');
		$kurir = $this->input->post('kurir');
		if($kurir != NULL && $ongkir != NULL) {
			$status = "sedang dikirim";
		} else {
			$status = "sedang dikemas";
		}
		$data = array('nama_penerima' => $nama_penerima, 'alamat_penerima' => $alamat_penerima, 'telp_penerima' => $telp_penerima, 'ongkir' => $ongkir, 'resi' => $resi, 'kurir' => $kurir, 'status' => $status, 'tgl_proses' => date("Y-m-d"));
		$this->db->where('id_penjualan', $id);
		$this->db->update('penjualan', $data);
	}
	public function selesai($id) {
		$data = array('status' => "selesai", 'tgl_selesai' => date("Y-m-d"));
		$this->db->where('id_penjualan', $id);
		$this->db->update('penjualan', $data);
	}
	public function batal() {
		$id = $this->input->post('id_penjualan');
		$ket = $this->input->post('ket');
		$data = array('status' => "batal", 'tgl_proses' => date("Y-m-d"), 'ket' => $ket);
		$this->db->where('id_penjualan', $id);
		$this->db->update('penjualan', $data);
		
		$this->db->where('penjualan_id', $id);
		$x = $this->db->get('penjualan_produk')->result();
		foreach ($x as $k) {
			$this->db->where('id_produk',$k->produk_id);
			$pro = $this->db->get('produk')->row();
			$minstok = $pro->stok + $k->qty;
				
			$data = array('stok' => $minstok);
			$this->db->where('id_produk', $k->produk_id);
			$this->db->update('produk', $data);
		}
	}
    public function update()
      {
        $id      = $this->input->post('id_penjualan');
        $produk_id   = $this->input->post('produk_id');
		$total_harga   = $this->input->post('total_harga');
		$harga_satuan   = $this->input->post('harga_satuan');
		$qty   = $this->input->post('qty');
		$qty_lama   = $this->input->post('qty_lama');
		$tgl   = $this->input->post('tgl');
        $data    = array('produk_id' => $produk_id, 'total_harga' => $total_harga, 'harga_satuan' => $harga_satuan, 'qty' => $qty, 'tgl' => $tgl);
        $this->db->where('id_penjualan', $id);
        $this->db->update('penjualan', $data);
        
		if($qty_lama != $qty) {
			$this->db->where('id_produk',$produk_id);
			$produk = $this->db->get('produk')->row();
			$stok = $produk->stok - $qty_lama + $qty;
			$data    = array('stok' => $stok, 'harga_beli' => $harga_satuan);
			$this->db->where('id_produk', $produk_id);
			$this->db->update('produk', $data);
		}
      }
	public function laporan() {
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
		if($produk_id == NULL) {
			$produk_id = 0;
		} else {
			$exp_pro = explode("-",$produk_id);
			$produk_id = $exp_pro[1];
		}
		$member_id = $this->input->post('member_id');
		if($member_id == NULL) {
			$member_id = 0;
		}
		
		$this->db->select('*');
		$this->db->from('penjualan_produk');
		$this->db->join('penjualan', 'penjualan.id_penjualan = penjualan_produk.penjualan_id');
		$this->db->where('penjualan.tgl_penjualan >=', $start);
		$this->db->where('penjualan.tgl_penjualan <=', $end);
		if($admin_id != 0) {
			$this->db->where('penjualan.admin_id', $admin_id);
		}
		if($member_id != 0) {
			$this->db->where('penjualan.member_id', $member_id);
		}
		$this->db->where('penjualan.status', "selesai");
		$xdb = $this->db->get()->result();
		
		if($produk_id > 0) {
			$this->db->where('id_produk',$produk_id);
		}
		$produk = $this->db->get('produk')->result();
		
		$new_arr = array();
		$arr_tgl = array();
		
		foreach($produk as $p) {
			$arr_pro = array();
			$xstart = $start;
			while (strtotime($xstart) <= strtotime($end)) {
				$new_pro = array();
				foreach($xdb as $k) {
					if($p->id_produk == $k->produk_id && $k->tgl_penjualan == $xstart) {
						$new_pro[] = $k->qty;
					}
				}
				$arr_pro[] = array_sum($new_pro);
				$xstart = date ("Y-m-d", strtotime("+1 day", strtotime($xstart))); 
			}
			$new_arr[$p->nama_produk] = $arr_pro;
		}
		while (strtotime($start) <= strtotime($end)) {
			$arr_tgl[] = $start;
			$start = date ("Y-m-d", strtotime("+1 day", strtotime($start)));
		}
		$bundle = array($arr_tgl,$new_arr);
		return $bundle;
	}
	public function laporan_paket() {
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
		if($produk_id == NULL) {
			$produk_id = 0;
		} else {
			$exp_pro = explode("-",$produk_id);
			$produk_id = $exp_pro[1];
		}
		$member_id = $this->input->post('member_id');
		if($member_id == NULL) {
			$member_id = 0;
		}
		
		$this->db->select('*');
		$this->db->from('penjualan_paket');
		$this->db->join('penjualan', 'penjualan.id_penjualan = penjualan_paket.penjualan_id');
		$this->db->where('penjualan.tgl_penjualan >=', $start);
		$this->db->where('penjualan.tgl_penjualan <=', $end);
		if($admin_id != 0) {
			$this->db->where('penjualan.admin_id', $admin_id);
		}
		if($member_id != 0) {
			$this->db->where('penjualan.member_id', $member_id);
		}
		$this->db->where('penjualan.status', "selesai");
		$xdb = $this->db->get()->result();
		
		if($produk_id > 0) {
			$this->db->where('id_paket',$produk_id);
		}
		$paket = $this->db->get('paket')->result();
		
		$new_arr = array();
		$arr_tgl = array();
		
		foreach($paket as $p) {
			$arr_pro = array();
			$xstart = $start;
			while (strtotime($xstart) <= strtotime($end)) {
				$new_pro = array();
				foreach($xdb as $k) {
					if($p->id_paket == $k->paket_id && $k->tgl_penjualan == $xstart) {
						$new_pro[] = 1;
					}
				}
				$arr_pro[] = array_sum($new_pro);
				$xstart = date ("Y-m-d", strtotime("+1 day", strtotime($xstart))); 
			}
			$new_arr[$p->nama_paket] = $arr_pro;
		}
		if($produk_id == 0) {
		$arr_pro = array();
		$xstart = $start;
		while (strtotime($xstart) <= strtotime($end)) {
			$new_pro = array();
			foreach($xdb as $k) {
				if(0 == $k->paket_id && $k->tgl_penjualan == $xstart) {
					$new_pro[] = 1;
				}
			}
			$arr_pro[] = array_sum($new_pro);
			$xstart = date ("Y-m-d", strtotime("+1 day", strtotime($xstart))); 
		}
		$new_arr["Ecer"] = $arr_pro;
		}
		
		while (strtotime($start) <= strtotime($end)) {
			$arr_tgl[] = $start;
			$start = date ("Y-m-d", strtotime("+1 day", strtotime($start)));
		}
		$bundle = array($arr_tgl,$new_arr);
		return $bundle;
	}
	public function bulan_ini() {
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
			$admin_id = $this->session->userdata('admin_id');
		}
		$produk_id = $this->input->post('produk_id');
		if($produk_id == NULL) {
			$produk_id = 0;
		} else {
			$exp_pro = explode("-",$produk_id);
			$produk_id = $exp_pro[1];
		}
		$member_id = $this->input->post('member_id');
		if($member_id == NULL) {
			$member_id = 0;
		}
		
		$this->db->select('*');
		$this->db->from('penjualan_produk');
		$this->db->join('penjualan', 'penjualan.id_penjualan = penjualan_produk.penjualan_id');
		$this->db->where('penjualan.tgl_penjualan >=', $start);
		$this->db->where('penjualan.tgl_penjualan <=', $end);
		if($admin_id != 0) {
			$this->db->where('penjualan.admin_id', $admin_id);
		}
		if($member_id != 0) {
			$this->db->where('penjualan.member_id', $member_id);
		}
		$this->db->where('penjualan.status', "selesai");
		$xdb = $this->db->get()->result();
		
		if($produk_id > 0) {
			$this->db->where('id_produk',$produk_id);
		}
		$produk = $this->db->get('produk')->result();
		
		$new_arr = array();
		$arr_tgl = array();
		
		foreach($produk as $p) {
			$arr_pro = array();
			$xstart = $start;
			while (strtotime($xstart) <= strtotime($end)) {
				$new_pro = array();
				foreach($xdb as $k) {
					if($p->id_produk == $k->produk_id && $k->tgl_penjualan == $xstart) {
						$new_pro[] = $k->qty;
					}
				}
				$arr_pro[] = array_sum($new_pro);
				$xstart = date ("Y-m-d", strtotime("+1 day", strtotime($xstart))); 
			}
			$new_arr[$p->kode_produk] = $arr_pro;
		}
		while (strtotime($start) <= strtotime($end)) {
			$arr_tgl[] = $start;
			$start = date ("Y-m-d", strtotime("+1 day", strtotime($start)));
		}
		$bundle = array($arr_tgl,$new_arr);
		return $bundle;
	}
  }