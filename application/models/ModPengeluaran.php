<?php
class ModPengeluaran extends CI_model {
	public function selectAll() {
		$start = $this->input->post('start');
		$end = $this->input->post('end');
		if($start == NULL) {
			$start = date("Y-m-01");
		}
		if($end == NULL) {
			$end = date("Y-m-t");
		}
		$this->db->select('*');
		$this->db->from('pengeluaran');
		$this->db->where('pengeluaran.tanggal_pengeluaran >=', $start);
		$this->db->where('pengeluaran.tanggal_pengeluaran <=', $end);
		$this->db->order_by('tanggal_pengeluaran', "asc");
        return $this->db->get()->result();
	}
	public function add() {
		$jenis_pengeluaran = $this->input->post('jenis_pengeluaran');
		$tanggal_pengeluaran = $this->input->post('tanggal_pengeluaran');
		$qty = $this->input->post('qty');
		$harga_satuan = $this->input->post('harga_satuan');
		$total_pengeluaran = $this->input->post('total_pengeluaran');
		$id_admin = $this->session->userdata('admin_id');
		
		$data = array('jenis_pengeluaran' => $jenis_pengeluaran,'tanggal_pengeluaran' => $tanggal_pengeluaran, 'qty' => $qty, 'harga_satuan' => $harga_satuan, 'total_pengeluaran' => $total_pengeluaran, 'id_admin' => $id_admin);
		$this->db->insert('pengeluaran', $data);
		$x = $this->db->insert_id();
	}
	public function delete($id){
		$this->db->where('id_pengeluaran', $id);
		$this->db->delete('pengeluaran');
	}
	public function edit($id){
		$this->db->where('id_pengeluaran', $id);
		return $this->db->get('pengeluaran')->row();
	}
	
	public function update(){
		$jenis_pengeluaran = $this->input->post('jenis_pengeluaran');
		$tanggal_pengeluaran = $this->input->post('tanggal_pengeluaran');
		$qty = $this->input->post('qty');
		$harga_satuan = $this->input->post('harga_satuan');
		$total_pengeluaran = $this->input->post('total_pengeluaran');
		$id_pengeluaran = $this->input->post('id_pengeluaran');
		$data = array('jenis_pengeluaran' => $jenis_pengeluaran, 'tanggal_pengeluaran' => $tanggal_pengeluaran, 'qty' => $qty, 'harga_satuan' => $harga_satuan, 'total_pengeluaran' => $total_pengeluaran);
		$this->db->where('id_pengeluaran', $id_pengeluaran);
		$this->db->update('pengeluaran', $data);
	}
}