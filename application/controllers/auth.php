<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function index(){
		$this->load->view('login');
	}

	public function cek_login(){
		$data = array ('username'=> $this->input->post('username', TRUE), 'password' => md5($this->input->post('password', TRUE))
			);//njikot data dari form
		$this->load->model('model_user'); // load model_user
		$hasil = $this->model_user->cek_user($data);//dar model user ambil function cekuser
		if ($hasil->num_rows() == 1){
			foreach ($hasil->result() as $row) {//ngecek data di database
				$row_data['logged_in'] = 'Sudah Login';
				$row_data['id'] = $row->id;
				$row_data['username'] = $row->username;
				$row_data['level'] = $row->level;
				$this->session->set_userdata($row_data);
			}
			if ($this->session->userdata('level')=='admin'){
				redirect('admin');//otomatis ngeredirect halaman sesuai level
			}
			elseif($this->session->userdata('level')=='member'){
				redirect('member');
			}
		}
		else
		{
			echo "<script>alert('login gagal: cek username dan password');history.go(-1);</script>";
		}
	}
}
?>
