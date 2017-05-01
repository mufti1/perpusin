<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if ($this->session->userdata('username')=="") {
			redirect('auth');
		}
		$this->load->helper('text');
		$this->load->model('model_buku');
	}
	public function index()
	{
		$data['username'] = $this->session->userdata('username');
		$this->load->view('layout/header', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('layout/footer');
	}
	public function logout(){
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('level');
		session_destroy();
		redirect('auth');
	}
	public function showAll(){
		$result = $this->model_buku->showAll();
		echo json_encode($result);
	}
	public function bukuAdd(){
		$result = $this->model_buku->bukuAdd();
		$msg['success'] = false;
		$msg['type'] = 'add';
		if ($result) {
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}
	public function editBuku(){
		$result = $this->model_buku->editBuku();
		echo json_encode($result);
	}
	public function updateBuku(){
		$result = $this->model_buku->updateBuku();
		$msg['success'] = false;
		$msg['type'] = 'update';
		if ($result) {
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}
	public function deleteBuku(){
		$result = $this->model_buku->deleteBuku();
		$msg['success'] = false;
		if ($result) {
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */
?>