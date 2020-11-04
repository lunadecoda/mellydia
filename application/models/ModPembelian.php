 <?php
class ModPembelian extends CI_model
  {
    public function selectAll()
      {
		$start = $this->input->post('start');
		$end = $this->input->post('end');
		$produk_id = $this->input->post('produk_id');
		if($start == NULL) {
			$start = date("Y-m-01");
		}
		if($end == NULL) {
			$end = date("Y-m-t");
		}
		
		$this->db->select('*');
		$this->db->from('pembelian');
		$this->db->join('produk', 'pembelian.produk_id = produk.id_produk');
		$this->db->where('pembelian.tgl >=', $start);
		$this->db->where('pembelian.tgl <=', $end);
		if($produk_id > 0) {
			$this->db->where('pembelian.produk_id', $produk_id);
		}
        $this->db->order_by('pembelian.id_pembelian', "desc");
		return $this->db->get()->result();
      }
    public function add()
      {
        $produk_id   = $this->input->post('produk_id');
		$total_harga   = $this->input->post('total_harga');
		$harga_satuan   = $this->input->post('harga_satuan');
		$qty   = $this->input->post('qty');
		$tgl   = $this->input->post('tgl');
        $data    = array('produk_id' => $produk_id, 'total_harga' => $total_harga, 'harga_satuan' => $harga_satuan, 'qty' => $qty, 'tgl' => $tgl);
        $this->db->insert('pembelian', $data);
        $this->db->insert_id();
		
		$this->db->where('id_produk',$produk_id);
		$produk = $this->db->get('produk')->row();
		$stok = $produk->stok + $qty;
        $data    = array('stok' => $stok, 'harga_beli' => $harga_satuan);
        $this->db->where('id_produk', $produk_id);
        $this->db->update('produk', $data);
      }
    public function delete($id)
      {
		$this->db->where('id_pembelian',$id);
		$pembelian = $this->db->get('pembelian')->row();
		
		$produk_id = $pembelian->produk_id;
		
		$this->db->where('id_produk',$produk_id);
		$produk = $this->db->get('produk')->row();
		$stok = $produk->stok - $pembelian->qty;
				
        $this->db->where('id_pembelian', $id);
		$this->db->delete('pembelian');
		
		$this->db->where('produk_id', $id);
		$this->db->limit('1');
		$pembelian = $this->db->get('pembelian')->row();
		if(isset($pembelian->harga_satuan)) {
			$harga_beli = $pembelian->harga_satuan;
		} else {
			$harga_beli = 0;
		}
		
		$data    = array('stok' => $stok, 'harga_beli' => $harga_beli);
		$this->db->where('id_produk', $produk_id);
		$this->db->update('produk', $data);
      }
    public function edit($id)
      {
        $this->db->where('id_pembelian', $id);
        return $this->db->get('pembelian')->row();
      }
    public function update()
      {
        $id      = $this->input->post('id_pembelian');
        $produk_id   = $this->input->post('produk_id');
		$total_harga   = $this->input->post('total_harga');
		$harga_satuan   = $this->input->post('harga_satuan');
		$qty   = $this->input->post('qty');
		$qty_lama   = $this->input->post('qty_lama');
		$tgl   = $this->input->post('tgl');
        $data    = array('produk_id' => $produk_id, 'total_harga' => $total_harga, 'harga_satuan' => $harga_satuan, 'qty' => $qty, 'tgl' => $tgl);
        $this->db->where('id_pembelian', $id);
        $this->db->update('pembelian', $data);
        
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