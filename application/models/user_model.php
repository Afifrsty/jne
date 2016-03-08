<?php 
/**
* Autor : Dani Ahmad J.
*/
class User_model extends CI_Model
{
	
	function dataUser()
	{
		$data = $this->db->query('select * from user ');
		return $data->result_array();
	}

	public function hapusData($tabelName, $where)
	{
		$res = $this->db->delete($tabelName, $where);
		return $res;
	}

	public function editView($where="")
	{
		$data = $this->db->query('select * from user '.$where);
		return $data->result_array();
	}

	public function edit($id)
	{
		$nama = $_POST['nama'];
		$username = $_POST['username'];
		$data_insert = array(
			'nama' => $nama , 
			'username' => $username , 
			);
     	$this->db->where('id',$id);
     	$this->db->update('user',$data_insert);
	}

	public function editParkir($res)
	{
		$keluar = $_POST['keluar'];
		$petugas_keluar = $_POST['petugas_keluar'];
		$data_insert = array(
			'keluar' => $keluar , 
			'petugas_keluar' => $petugas_keluar , 
			);
     	$this->db->where('id',$res);
     	$this->db->update('karcis',$data_insert);
	}

}
?>