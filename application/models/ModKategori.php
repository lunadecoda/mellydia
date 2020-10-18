 <?php
class ModKategori extends CI_model
  {
    public function selectAll()
      {
        $this->db->order_by('nama_kategori', "asc");
        return $this->db->get('kategori')->result();
      }
    public function add()
      {
        $status  = "1";
        $kategori   = $this->input->post('nama_kategori');
        $data    = array(
            'nama_kategori' => $kategori
        );
        $this->db->insert('kategori', $data);
        $this->db->insert_id();
        
      }
    public function delete($id)
      {
        $this->db->where('id_kategori', $id);
		$this->db->delete('kategori');
      }
    public function edit($id)
      {
        $this->db->where('id_kategori', $id);
        return $this->db->get('kategori')->row();
      }
    public function update()
      {
        $id      = $this->input->post('id_kategori');
        $kategori   = $this->input->post('nama_kategori');
        $data    = array(
            'nama_kategori' => $kategori
        );
        $this->db->where('id_kategori', $id);
        $this->db->update('kategori', $data);
        
      }
  } 