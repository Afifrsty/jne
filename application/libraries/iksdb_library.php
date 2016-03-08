<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
Author		: Heru Rahmat Akhnuari
Email		: eyubalzary@gmail.com
Copyright	: PT Indra Karya Sejahtera
Codename	: iksdb_library
*/

class Iksdb_library
{
	
	function __construct()
	{
		/* 
		Hapus construct jika inisial database pada autoload
		*/
		/*
		*/
		$CI=& get_instance();
		$CI->load->database();
	}
	
	private function error_table()
	{
		/*
		Hanya menampilkan error jika table tidak dipilih
		*/
		$CI=& get_instance();
		die("Table not use first !!!");
		$CI->db->close();
	}
	
	function GetData($table,$searchQuery='',$orderBy='',$groupBy='',$limit='')
	{
		/*
		Mendapatkan data 
		Example : 
		$searchQuery=array(
			'table_field'=>'value',
			);
		$limit='0,30';
		$orderBy='field asc';
		$groupBy='field_group';
		GetData('table_name',$searchQuery,$orderBy,$groupBy,$limit);
		GetData('table_name',$searchQuery,$orderBy,'',$limit);
		GetData('table_name');
		
		output hasil data
		*/
		$CI=& get_instance();
		if(!empty($table))
		{
			if(!empty($searchQuery))
			{
				$CI->db->where($searchQuery);
			}
			if(!empty($limit))
			{
				$CI->db->limit($limit);
			}
			
			if(!empty($orderBy))
			{
				$CI->db->order_by($orderBy);
			}
			
			if(!empty($groupBy))
			{
				$CI->db->group_by($groupBy);
			}
			
			$result=$CI->db->get($table);
			if($result->num_rows()>0)
			{
				foreach($result->result() as $row)
				{
					$data[]=$row;
				}
				return $data;
			}else{
				return "Data kosong";
			}
		}else{
			error_table();
		}
	}
	
	function InsertData($table,$data)
	{
		/*
		Example : 
		$data=array(
			'field_first'=>'first_value',
			'field_second'=>'second_value',
			);
		InsertData('table_name',$data);
		
		output true/false
		*/
		$CI=& get_instance();
		if(!empty($table))
		{
			$CI->db->insert($table,$data);
			if($CI->db->affected_rows() > 0){
				return true;
			}else{
				return false;
			}
		}else{
			error_table();
		}
	}
	
	function InsertBatchData($table,$data)
	{
		/*
		Tambahkan banyak data pada suatu query
		Example : 
		$data=array(
				array(
					'field_first'=>'first_value',
					'field_second'=>'second_value',
				),
				array(
					'field_third'=>'third_value',
					'field_fourth'=>'fourth_value',
				),
			);
		InsertData('table_name',$data);
		
		output true/false
		*/
		$CI=& get_instance();
		if(!empty($table))
		{
			$CI->db->insert($table,$data);
			if($CI->db->affected_rows() > 0){
				return true;
			}else{
				return false;
			}
		}else{
			error_table();
		}
	}
	
	function UpdateData($table,$data,$searchQuery)
	{
		/*
		Example : 
		$data=array(
			'field_first'=>'first_value',
			'field_second'=>'second_value',
			);
		$searchQuery=array(
			'search_field'=>'search_value',
			);			
		InsertData('table_name',$data,$searchQuery);
		
		output true/false
		*/
		$CI=& get_instance();
		if(!empty($table))
		{
			$CI->db->where($searchQuery);			
			$CI->db->update($table, $data);
			if($CI->db->affected_rows() > 0){
				return true;
			}else{
				return false;
			}
		}else{
			error_table();
		}
	}
	
	function DeleteData($table,$searchQuery)
	{
		/*
		Example :
		$searchQuery=array(
			'search_field'=>'search_value',
			);		
		DeleteData('table_name',$searchQuery);
		
		output true/false
		*/
		$CI=& get_instance();
		if(!empty($table))
		{
			$CI->db->where($searchQuery);
			$CI->db->delete($table);
			if($CI->db->affected_rows() > 0){
				return true;
			}
			else{
				return false;
			}	  
		}else{
			error_table();
		}
	}
	
	function DeleteBatchData($table,$field,$arrayID)
	{
		/*
		Example :
		$searchQuery=array(
			'search_field'=>'search_value',
			);		
		DeleteData('table_name',$searchQuery);
		
		output true/false
		*/
		$CI=& get_instance();
		if(!empty($table))
		{
			$CI->db->where_in($field,$arrayID);
			$CI->db->delete($table);
			if($CI->db->affected_rows() > 0){
				return true;
			}
			else{
				return false;
			}	  
		}else{
			error_table();
		}
	}
	
	function IsBOF($table,$searchQuery)
	{
		/*
		Cek Data kosong
		Example :
		$searchQuery=array(
			'search_field'=>'search_value',
			);		
		IsBOF('table_name',$searchQuery);
		
		output true/false
		*/		
		$CI=& get_instance();
		if(!empty($table))
		{
			$CI->db->where($searchQuery);
			$sql = $CI->db->get($table);
			if($sql->num_rows() > 0){			
				return false;
			} else {
				return true;
			}
		}else{
			error_table();
		}
	}
	
	function RecordCount($table,$searchQuery='')
	{
		/*
		Mencari jumlah/total data
		Example :
		$searchQuery=array(
			'search_field'=>'search_value',
			);		
		DeleteData('table_name',$searchQuery);
		
		output jumlah data
		*/
		$CI=& get_instance();
		if(!empty($table))
		{
			if(!empty($searchQuery))
			{
				$CI->db->where($searchQuery);
			}
			
			$sql = $CI->db->get($table);
			$count=$sql->num_rows();
			return $count;
			$sql->free_result();
		}else{
			error_table();
		}
	}
	
	function FieldRow($table,$searchQuery,$output)
	{
		/*
		Mengambil satu data field
		Example :
		$searchQuery=array(
			'search_field'=>'search_value',
			);		
		DeleteData('table_name',$searchQuery);
		
		output field variable $output
		*/
		$CI=& get_instance();
		
		if(!empty($table))
		{	
			$CI->db->where($searchQuery);
			$sql = $CI->db->get($table);
			if($sql->num_rows() > 0){							
				return $sql->row()->$output;
			} else {
				return null;
			}
		}else{
			error_table();
		}
	}
	
	function GetSum($table,$searchQuery,$field)
	{
		/*
		Menjumlahkan field
		
		Example :
		$searchQuery=array(
			'search_field'=>'search_value',
			);	
		GetSum('table_name',$searchQuery,'field_name');
		
		output sum(field_name)
		*/
		$CI=& get_instance();
		
		if(!empty($table))
		{	
			$CI->db->select_sum($field);
			$CI->db->where($searchQuery);
			$sql = $CI->db->get($table);
			if($sql->num_rows() > 0){							
				return $sql->row()->$field;
			} else {
				return null;
			}
		}else{
			error_table();
		}
	}
	
	function GetAverage($table,$searchQuery,$field)
	{
		/*
		Mencari rata-rata field
		
		Example :
		$searchQuery=array(
			'search_field'=>'search_value',
			);	
		GetSum('table_name',$searchQuery,'field_name');
		
		output avg(field)
		*/
		$CI=& get_instance();
		
		if(!empty($table))
		{	
			$CI->db->select_avg($field);
			$CI->db->where($searchQuery);
			$sql = $CI->db->get($table);
			if($sql->num_rows() > 0){							
				return $sql->row()->$field;
			} else {
				return null;
			}
		}else{
			error_table();
		}
	}
	function GetMaxOrMin($table,$searchQuery='',$field,$type)
	{
		/*
		Menjumlahkan field
		
		Example :
		$searchQuery=array(
			'search_field'=>'search_value',
			);	
		GetSum('table_name',$searchQuery,'field_name','Max');
		GetSum('table_name',$searchQuery,'field_name','Min');
		
		*/
		$CI=& get_instance();
		if(!empty($table))
		{
			switch($type)
			{
				case "Max":
					$CI->db->select_max($field);
					break;
				case "Min":
					$CI->db->select_min($field);
					break;				
			}
			if(!empty($searchQuery))
			{
				$CI->db->where($searchQuery);
			}
			
			$sql = $CI->db->get($table);
			if($sql->num_rows() > 0){							
				return $sql->row()->$field;
			} else {
				return null;
			}
		}else{
			error_table();
		}
		
	}
	
	
	//QUERY TOOLS
	
	function QueryData($query)
	{
		/*
		Mengambil data dari custom Query
		
		output data
		*/
		$CI=& get_instance();
		$sql=$CI->db->query($query);
		if($sql->num_rows()>0)
		{
			$data=$sql->result();
			return $data;
		}else{
			return null;			
		}	
		$sql->free_result();
	}
	
	function QueryTrans($query)
	{
		/*
		Eksekusi sebuah query
		
		output jika gagal, eksekusi dibatalkan
		*/
		$CI=& get_instance();
		$CI->db->trans_start();
		$sql=$CI->db->query($query);
		$CI->db->trans_complete();
		if($CI->db->trans_status()==FALSE)
		{
			$CI->db->trans_rollback();
		}else{
			 $CI->db->trans_commit();
		}
		
	}
	
	function QueryOneRow($query,$output)
	{
		/*
		Mengambil satu data field
		
		output data field
		*/
		$CI=& get_instance();
		$CI->db->trans_start();
		$running=$CI->db->query($query);
		$CI->db->trans_complete();
		if($CI->db->trans_status()==FALSE)
		{
			$CI->db->trans_rollback();
		}else{
			 $row=$running->row();
			 return $row->$output;
		}
		$running->free_result();
	}
	
	function QueryNumRow($query)
	{
		/*
		Mengambil jumlah data
		*/
		$CI=& get_instance();
		$CI->db->trans_start();
		$running=$CI->db->query($query);
		$CI->db->trans_complete();
		if($CI->db->trans_status()==FALSE)
		{
			$CI->db->trans_rollback();
		}else{
			$nr=$running->num_rows();
			return $nr;
		}
		$running->free_result();
	}
	
	
	//TOOLS DATABASE
	
	function dbBackup($filename,$typeFile)
	{
		/*
		Backup database dan langsung download / tidak menyimpan file
		*/
		$CI=& get_instance();
		$CI->load->dbutil();
		$backup =& $CI->dbutil->backup(); 
		$CI->load->helper('download');
		force_download($filename.'.'.$typeFile,$backup);
		
	}
	
	function tableBackup($table,$filename)
	{
		/*
		Backup table tertentu saja
		tableBackup(array('table1','table3','table10'));
		*/
		$CI=& get_instance();
		$prefs = array(
                'tables'      => array($table),
                'ignore'      => array(),          
                'format'      => 'txt',             
                'filename'    => $filename,
                'add_drop'    => TRUE,
                'add_insert'  => TRUE,
                'newline'     => "\n"
              );

		$backup =$CI->dbutil->backup($prefs);
		$CI->load->helper('download');
		force_download($filename,$backup);
	}
	
	function repairTable($table)
	{
		/*
		Memperbaiki table
		*/
		$CI=& get_instance();
		if(!empty($table))
		{
			if ($CI->dbutil->repair_table($table))
			{
			    return true;
			}else{
				return false;			
			}
		}
		
	}
	
	function optimizeTable($table)
	{
		/*
		Compact database agar lebih fresh datanya
		*/
		$CI=& get_instance();
		if(!empty($table))
		{
			$result = $CI->dbutil->optimize_database();
			if ($result !== FALSE)
			{
			    return true;
			}else{
				return false;
			}
		}
		
	}
	
	function create_paging($url,$totalrow,$perpage,$segment_output,$data_pag)

	{

		$CI=& get_instance();
		$CI->load->library('pagination');
		$config = array();
        $config["base_url"] = $url;
		$config['uri_segment'] = $segment_output;
        $config["total_rows"] = $totalrow;
        $config["per_page"] = $perpage;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul><!--pagination-->';
		$config['first_link'] = '&laquo; First';
		$config['first_url'] = $url;
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last &raquo;';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = 'Next &rarr;';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&larr; Previous';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>'; 
		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>'; 
		$config['display_pages'] = TRUE;
		$config['page_query_string'] = TRUE;
		$config['use_page_numbers'] = TRUE;
		$config['query_string_segment'] = 'page';
		$CI->pagination->initialize($config);
		$data["results"] =$data_pag;
		$data["links"] = $CI->pagination->create_links();
		return $data;

	}
}