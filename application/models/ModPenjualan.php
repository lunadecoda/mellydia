 <?php
class ModPenjualan extends CI_model
  {
    public function selectAll()
      {
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
		
		$this->db->select('*');
		$this->db->from('penjualan');
		$this->db->join('sumber_market', 'penjualan.sumber_id = sumber_market.id_sumber');
		$this->db->where('penjualan.tgl_penjualan >=', $start);
		$this->db->where('penjualan.tgl_penjualan <=', $end);
		$this->db->where('penjualan.admin_id', $admin_id);
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
		$harga_paket = $this->input->post('harga_paket');
		$sumber_id = $this->input->post('sumber_id');
		$num=0;
		foreach ($paket_id as $k => $v) {
			$exp_id = explode("-",$v);
			$id_paket = $exp_id[0];
			$produk_id = $this->input->post('produk_id_'.$exp_id[1]);
			$harga = $this->input->post('harga_'.$exp_id[1]);
			$qty = $this->input->post('qty_'.$exp_id[1]);
			
			
			$data = array('diskon' => $diskon, 'status' => "sedang dikemas", 'total_harga' => $harga_total, 'admin_id' => $admin_id, 'tgl_penjualan' => $tgl, 'member_id' => $member_id, 'sumber_id' => $sumber_id, 'nama_penerima' => $nama_penerima, 'alamat_penerima' => $alamat_penerima, 'telp_penerima' => $telp_penerima);
			$this->db->insert('penjualan', $data);
			$penjualan_id = $this->db->insert_id();
			
			
			$data = array('paket_id' => $id_paket, 'harga_paket' => $harga_paket[$num], 'penjualan_id' => $penjualan_id);
			$this->db->insert('penjualan_paket', $data);
			$penjualan_paket_id = $this->db->insert_id();
			$exnum = 0;
			foreach ($produk_id as $kp => $vp) {
				$data = array('penjualan_paket_id' => $penjualan_paket_id, 'produk_id' => $vp, 'qty' => $qty[$exnum], 'harga' => $harga[$exnum]);
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
  }