<?php
class Login_model extends CI_Model
{
	function login($u_,$p_,$data)
	{
		$w=array(
				'username'=>$u_,
				);
			if($this->iksdb_library->IsBOF('user',$w)==FALSE)
			{
					$jabatan=$this->iksdb_library->FieldRow('user',$w,"jabatan");
					if($jabatan=="admin")
					{
						$this->session->set_userdata($data);
						redirect(base_url('admin/home'));
					}elseif($jabatan=="pegawai"){
						$this->session->set_userdata($data);
						redirect(base_url('pegawai/home'));
					}elseif($jabatan=="kurir"){
						$this->session->set_userdata($data);
						redirect(base_url('kurir/home'));
					}else{
						
						redirect(base_url(login));
					}
				}
				
			else{
				$this->session->set_flashdata('msg', 'Username atau password salah');
				redirect(base_url(),303);
			}
	}
}
?>