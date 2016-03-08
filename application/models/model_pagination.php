<?php 
/**
* Autor : Dani Ahmad J. ? XI-Rpl 1 SMK N 1 Surabaya
*/
class Model_Pagination extends CI_Model
{
	
	function getUser()
	{
		$this->load->library('database_library');
		
		$search="";
		$url='';
		$id =isset($_GET['id']) ? mysql_real_escape_string($_GET['id']) : '';		
		
		
		$where=" WHERE user.id LIKE '%$id%'";		
		$page = isset($_GET['page']) ? mysql_real_escape_string($_GET['page']) : '1';		
		$url=base_url('admin/lihat_user')."?paging=true&id=$id&";
		$limit=5;
		$offset = ($page - 1) * $limit;
		$sql="SELECT * FROM
		user 
		$where AND user.id !='' 
		limit $offset,$limit";
		$sql2="SELECT * FROM
		user 
		$where AND user.id !=''";
		$datas=$this->database_library->QueryData($sql);;
		$TR=$this->database_library->QueryNumRow($sql2);
		
		
		$tpage=ceil($TR/$limit);
		$this->load->library('pagination_library');
		$data['links']=$this->pagination_library->paginate_anchor($url,$page,$TR,$limit);
		$data['results']=$datas;
		
		return $data;
	}
?>