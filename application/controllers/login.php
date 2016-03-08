<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	/* Login Controller
	 * This class handles login and register process, 
	 * validate login and logout process.
	 *
	 * @author	Aditya Nursyahbani
	 * @link	http://aditya-nursyahbani.com/
	*/
		
	public function __construct(){
		parent::__construct();
		$this->load->model('account_model');
	}
	
	public function index()
	{
		$data['content'] = 'login';
		$this->load->view('loginview', $data);		
	}
	
	public function cek_login()
	{
		$this->load->library('iksdb_library');
		$this->load->library('ikssecure_library');
		$this->ikssecure_library->filter_post('username','required|xss_clean');
		$this->ikssecure_library->filter_post('password','required|xss_clean');
		if($this->ikssecure_library->start_post()==TRUE)
		{
			$u_=$this->input->post('username',TRUE);
			$p_=$this->input->post('password',TRUE);
			$username = $this->input->post('username');
			$jabatan = $this->input->post('jabatan');
			$this->load->model('Login_model');
			$query = $this->account_model->validasi();
			if($query)
			{
				$data = array(
					'username' => $username,
					'jabatan' => $jabatan,
					'is_logged_in' => true
				);
			$this->Login_model->login($u_,$p_,$data);
			}
			else
			{
				$this->session->set_flashdata('msg', '<div class="validasi-font animate11 bounceIn">Maaf, Username atau password yang anda inputkan tidak valid</div>');
				redirect(base_url('login'));
			}	
		}else{
			$this->session->set_flashdata('msg', '<div class="validasi-font animate11 bounceIn">Username atau password tidak boleh kosong</div>');
			redirect(base_url('login'));
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->index();
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */