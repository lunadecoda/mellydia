<?php
class ModProduk extends CI_model {
	public function selectAll() {
		$this->db->order_by('nama_produk', "asc");
        return $this->db->get('produk')->result();
	}
	public function habis() {
		$this->db->order_by('nama_produk', "asc");
		$this->db->where('stok < ',100);
        return $this->db->get('produk')->result();
	}
	public function add() {
		$nama_produk = $this->input->post('nama_produk');
		$harga_jual = $this->input->post('harga_jual');
		$stok = $this->input->post('stok');
		$berat = $this->input->post('berat');
		$kategori_id = $this->input->post('kategori_id');
		$harga_beli = $this->input->post('harga_beli');
		$kode_produk = $this->input->post('kode_produk');
		$data = array('nama_produk' => $nama_produk,'harga_jual' => $harga_jual, 'harga_beli' => $harga_beli, 'berat' => $berat, 'stok' => $stok, 'kode_produk' => $kode_produk);
		$this->db->insert('produk', $data);
		$x = $this->db->insert_id();
		foreach ($kategori_id as $k => $v) {
			$data = array('produk_id' => $x, 'kategori_id' => $v);
			$this->db->insert('produk_kategori', $data);
			$this->db->insert_id();
		}
	}
	public function delete($id){
		$this->db->where('id_produk', $id);
		$this->db->delete('produk');
		
		$this->db->where('produk_id', $id);
		$this->db->delete('produk_kategori');
	}
	public function edit($id){
		$this->db->where('id_produk', $id);
		return $this->db->get('produk')->row();
	}
	
	public function produk_kategori($id){
		$this->db->where('produk_id', $id);
		return $this->db->get('produk_kategori')->result();
	}
	
	public function update(){
		$id = $this->input->post('id_produk');
		$nama_produk = $this->input->post('nama_produk');
		$harga_jual = $this->input->post('harga_jual');
		$stok = $this->input->post('stok');
		$berat = $this->input->post('berat');
		$kategori_id = $this->input->post('kategori_id');
		$harga_beli = $this->input->post('harga_beli');
		$kode_produk = $this->input->post('kode_produk');
		$data = array('nama_produk' => $nama_produk,'harga_jual' => $harga_jual, 'harga_beli' => $harga_beli, 'berat' => $berat, 'stok' => $stok, 'kode_produk' => $kode_produk);
		$this->db->where('id_produk', $id);
		$this->db->update('produk', $data);
		
		
		$this->db->where('produk_id', $id);
		$this->db->delete('produk_kategori');
		
		foreach ($kategori_id as $k => $v) {
			$data = array('produk_id' => $id, 'kategori_id' => $v);
			$this->db->insert('produk_kategori', $data);
			$this->db->insert_id();
		}
	}
}
