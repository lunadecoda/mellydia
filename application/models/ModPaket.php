<?php
class ModPaket extends CI_model {
	public function selectAll() {
		$this->db->order_by('nama_paket', "asc");
        return $this->db->get('paket')->result();
	}
	public function add() {
		$nama_paket = $this->input->post('nama_paket');
		$kode_paket = $this->input->post('kode_paket');
		$produk_id = $this->input->post('produk_id');
		$total_harga_paket = $this->input->post('total_harga_paket');
		
		$data = array('nama_paket' => $nama_paket, 'total_harga_paket'=> $total_harga_paket, 'kode_paket' => $kode_paket);
		$this->db->insert('paket', $data);
		$x = $this->db->insert_id();
		foreach ($produk_id as $k => $v) {
			$vx = explode("-",$v);
			$data = array('paket_id' => $x, 'produk_id' => $vx[0]);
			$this->db->insert('paket_produk', $data);
			$this->db->insert_id();
		}
	}
	public function delete($id){
		$this->db->where('id_paket', $id);
		$this->db->delete('paket');
		
		$this->db->where('paket_id', $id);
		$this->db->delete('paket_produk');
	}
	public function edit($id){
		$this->db->where('id_paket', $id);
		return $this->db->get('paket')->row();
	}
	
	public function produk(){
		$this->db->select('*');
		$this->db->from('paket_produk');
		$this->db->join('produk', 'paket_produk.produk_id = produk.id_produk');
		return $this->db->get()->result();
	}
	
	public function paket_produk($id){
		$this->db->select('*');
		$this->db->from('paket_produk');
		$this->db->join('produk', 'paket_produk.produk_id = produk.id_produk');
		$this->db->where('paket_produk.paket_id', $id);
		return $this->db->get()->result();
	}
	
	public function update(){
		$id = $this->input->post('id_paket');
		$nama_paket = $this->input->post('nama_paket');
		$produk_id = $this->input->post('produk_id');
		$kode_paket = $this->input->post('kode_paket');
		$total_harga_paket = $this->input->post('total_harga_paket');
		
		$data = array('nama_paket' => $nama_paket, 'total_harga_paket'=>$total_harga_paket, 'kode_paket' => $kode_paket);
		$this->db->where('id_paket', $id);
		$this->db->update('paket', $data);
		
		$this->db->where('paket_id', $id);
		$this->db->delete('paket_produk');
		
		foreach ($produk_id as $k => $v) {
			$vx = explode("-",$v);
			$data = array('paket_id' => $id, 'produk_id' => $vx[0]);
			$this->db->insert('paket_produk', $data);
			$this->db->insert_id();
		}
	}
}