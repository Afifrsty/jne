<?php 
class Home extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->is_logged_in();
	}

	public function index() 
	{
		$data['content']='user_area';
		$this->load->view('admin/homeview', $data);
	}
	
	public function is_logged_in(){
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logeed_in) || $is_logged_in != true){
				$this->session->set_flashdata('msg','<div class="validasi-font">Mohon untuk login terlebih dahulu');
				redirect('login'); 
		}

		$this->load->model('login_model');
		$username = $this->session->userdata('username');
		$role=$this->login_model->get("where username = '$username'");
		$res = $role[0]['jabatan'];
		if($res != "admin"){
				$this->session->set_flashdata('msg','<div class="validasi-font">anda tidak berhak untuk masuk akun ini');
				redirect('login');

		}
	}
}
?>