<?php
class ModUser extends CI_model {
	public function selectAll() {
		$this->db->order_by('nama_admin', "asc");
        return $this->db->get('admin')->result();
	}
	public function add() {
		$nama_admin = $this->input->post('nama_admin');
		$password = $this->input->post('password');
		$akses_id = $this->input->post('akses_id');
		$email_admin = $this->input->post('email_admin');
		
		$data = array('nama_admin' => $nama_admin,'password_admin' => md5($password), 'nama_admin' => $nama_admin, 'email_admin' => $email_admin);
		$this->db->insert('admin', $data);
		$x = $this->db->insert_id();
		foreach ($akses_id as $k => $v) {
			$data = array('admin_id' => $x, 'akses_id' => $v);
			$this->db->insert('admin_akses', $data);
			$this->db->insert_id();
		}
	}
	public function delete($id){
		$this->db->where('id_admin', $id);
		$this->db->delete('admin');
		
		$this->db->where('admin_id', $id);
		$this->db->delete('admin_akses');
	}
	public function edit($id){
		$this->db->where('id_admin', $id);
		return $this->db->get('admin')->row();
	}
	
	public function akses(){
		$this->db->select('*');
		$this->db->from('akses');
		$this->db->join('modul', 'akses.modul_id = modul.id_modul');
		return $this->db->get()->result();
	}
	
	public function modul() {
		$this->db->order_by('id_modul', "asc");
        return $this->db->get('modul')->result();
	}
	
	public function akses_admin($id){
		$this->db->select('*');
		$this->db->from('admin_akses');
		$this->db->join('akses', 'admin_akses.akses_id = akses.id_akses');
		$this->db->where('admin_akses.admin_id', $id);
		return $this->db->get()->result();
	}
	
	public function update(){
		$id = $this->input->post('id_admin');
		$nama_admin = $this->input->post('nama_admin');
		$password = $this->input->post('password');
		$akses_id = $this->input->post('akses_id');
		$email_admin = $this->input->post('email_admin');
		
		if ($password == NULL) {
			$data = array('nama_admin' => $nama_admin, 'nama_admin' => $nama_admin, 'email_admin' => $email_admin);
			$this->db->where('id_admin', $id);
			$this->db->update('admin', $data);
		} else {
			$data = array('nama_admin' => $nama_admin,'password_admin' => md5($password), 'nama_admin' => $nama_admin, 'email_admin' => $email_admin);
			$this->db->where('id_admin', $id);
			$this->db->update('admin', $data);
		}
		
		$this->db->where('admin_id', $id);
		$this->db->delete('admin_akses');
		
		foreach ($akses_id as $k => $v) {
			$data = array('admin_id' => $id, 'akses_id' => $v);
			$this->db->insert('admin_akses', $data);
			$this->db->insert_id();
		}
	}
}