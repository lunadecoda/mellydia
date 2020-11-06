<?php
class ModLimit extends CI_model {
	public function selectAll() {
        return $this->db->get('notif_limit')->result();
	}
	public function add() {
		$batas = $this->input->post('batas');
		$data = array('batas' => $batas);
		$this->db->insert('notif_limit', $data);
		$x = $this->db->insert_id();
	}
	public function edit($id){
		$this->db->where('id', $id);
		return $this->db->get('notif_limit')->row();
	}
	public function update(){
		$id = $this->input->post('id');
		$batas = $this->input->post('batas');
		$data = array('batas' => $batas);
		$this->db->where('id', $id);
		$this->db->update('notif_limit', $data);
	}
}