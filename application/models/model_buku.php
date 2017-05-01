<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_buku extends CI_Model{
	public function showAll(){
		$this->db->order_by('kode_buku', 'asc');
		$query = $this->db->get('tb_buku');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	public function bukuAdd(){
		$field = array(
			'kode_buku'=>$this->input->post('id_buku'),
			'judul_buku'=>$this->input->post('judul_buku'),
			'nama_pengarang'=>$this->input->post('nama_pengarang'),
			'tahun_terbit'=>$this->input->post('tahun_terbit'),
			'penerbit'=>$this->input->post('penerbit'),
			'stok'=>$this->input->post('stok')
			);
		$this->db->insert('tb_buku', $field);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function editBuku(){
		$kode_buku = $this->input->get('kode_buku');
		$this->db->where('kode_buku', $kode_buku);
		$query = $this->db->get('tb_buku');
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			return false;
		}
	}

	public function updateBuku(){
		$kode_buku = $this->input->post('kode_buku');
		$field = array(
			'judul_buku'=>$this->input->post('judul_buku'),
			'nama_pengarang'=>$this->input->post('nama_pengarang'),
			'tahun_terbit'=>$this->input->post('tahun_terbit'),
			'penerbit'=>$this->input->post('penerbit'),
			'stok'=>$this->input->post('stok')
			);
		$this->db->where('kode_buku', $kode_buku);
		$this->db->update('tb_buku', $field);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	function deleteBuku(){
		$kode_buku = $this->input->get('kode_buku');
		$this->db->where('kode_buku', $kode_buku);
		$this->db->delete('tb_buku');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else{
			return false;
		}
	}
}
