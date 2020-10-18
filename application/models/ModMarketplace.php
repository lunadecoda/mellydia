<?php
class ModMarketplace extends CI_model {
	public function selectAll() {
		$this->db->order_by('nama_market', "asc");
        return $this->db->get('sumber_market')->result();
	}
	public function add() {
		$nama_market = $this->input->post('nama_market');
		
		$data = array('nama_market' => $nama_market);
		$this->db->insert('sumber_market', $data);
		$x = $this->db->insert_id();
	}
	public function delete($id){
		$this->db->where('id_sumber', $id);
		$this->db->delete('sumber_market');
	}
	public function edit($id){
		$this->db->where('id_sumber', $id);
		return $this->db->get('sumber_market')->row();
	}
	
	public function update(){
		$id = $this->input->post('id_');
		$nama_market = $this->input->post('nama_market');
		
		$data = array('nama_market' => $nama_market);
		$this->db->where('id_sumber', $id);
		$this->db->update('sumber_market', $data);
	}
}