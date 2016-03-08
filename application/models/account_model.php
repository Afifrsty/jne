<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_model extends CI_Model {
	
	private $table_name = 'user';
	private $pk = 'username';
	
	public function validasi()
	{
		$this->db->where('username', $this->input->post('username'));
		$this->db->where('password', md5($this->input->post('password')));
		$query = $this->db->get($this->table_name);
		
		if($query->num_rows == 1)
		{
			return true;
		}		
	}
}
/* End of file account_model.php */
/* Location: ./application/models/account_model.php */