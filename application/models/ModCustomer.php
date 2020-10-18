<?php
class ModCustomer extends CI_model {
	public function selectAll() {
		$this->db->order_by('nama_member', "asc");
        return $this->db->get('member')->result();
	}
	public function add() {
		$nama_member = $this->input->post('nama_member');
		$alamat_member = $this->input->post('alamat_member');
		$telp_member = $this->input->post('telp_member');
		
		$data = array('nama_member' => $nama_member, 'alamat_member' => $alamat_member, 'telp_member' => $telp_member);
		$this->db->insert('member', $data);
		$x = $this->db->insert_id();
	}
	public function delete($id){
		$this->db->where('id_member', $id);
		$this->db->delete('member');
	}
	public function edit($id){
		$this->db->where('id_member', $id);
		return $this->db->get('member')->row();
	}
	
	public function update(){
		$id = $this->input->post('id_member');
		$nama_member = $this->input->post('nama_member');
		$alamat_member = $this->input->post('alamat_member');
		$telp_member = $this->input->post('telp_member');
		
		$data = array('nama_member' => $nama_member, 'alamat_member' => $alamat_member, 'telp_member' => $telp_member);
		$this->db->where('id_member', $id);
		$this->db->update('member', $data);
	}
}