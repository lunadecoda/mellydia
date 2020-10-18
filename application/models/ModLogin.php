<?php
class ModLogin extends CI_model {
	function log() {
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$data = array('email_admin'=>$email, 'password_admin'=>md5($password));
		$cek1 = $this->db->get_where('admin', $data)->num_rows();
		if($cek1 > 0) {
			$cek = $this->db->get_where('admin', $data)->row();
			$data_session = array(
						'admin_id' => $cek->id_admin,
						'admin_email' => $cek->email_admin,
						'admin_nama' => $cek->nama_admin,
						'status' => "login" );
			$this->session->set_userdata($data_session);
		}
	}
}