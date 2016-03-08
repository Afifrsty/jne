<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Database_library {

	private $table_name;

		

	function pake_table($table)

	{			

			$CI=& get_instance();

			

			$CI->table_name=$table;

			return true;

		

	}

	

	function tambah_data($data)

	{

		$CI=& get_instance();

		

		if($this->pake_table($CI->table_name)==true)

		{

			$CI->db->insert($CI->table_name, $data);

			if($CI->db->affected_rows() > 0){

				return true;

			} else{

				return false;

			}

		}

	}

	

	function ubah_data_where($field,$kode,$data) 

	{

		$CI=& get_instance();

		

		if($this->pake_table($CI->table_name)==true)

		{

			$CI->db->where($field, $kode);

			$CI->db->update($CI->table_name, $data);

			if($CI->db->affected_rows() > 0){

				return true;

			}

			else{

				return false;

			}

		}

	}

	

	function ubah_data($arraysearch,$data) 

	{

		$CI=& get_instance();

		

		if($this->pake_table($CI->table_name)==true)

		{

			$CI->db->where($arraysearch);			

			$CI->db->update($CI->table_name, $data);

			if($CI->db->affected_rows() > 0){

				return true;

			}

			else{

				return false;

			}

		}

	}
	
	
		

	function hapus_data($arraysearch) 

	{

		$CI=& get_instance();

		

		if($this->pake_table($CI->table_name)==true)

		{

			$CI->db->where($arraysearch);

			$CI->db->delete($CI->table_name);

			if($CI->db->affected_rows() > 0){

				return true;

			}

			else{

				return false;

			}	  

		}

	}

	

	function ambil_data()

	{

		$CI=& get_instance();

		

		if($this->pake_table($CI->table_name)==true)

		{

			$sql = $CI->db->get($CI->table_name);

			if($sql->num_rows() > 0){			

				foreach($sql->result() as $row){

					$data[] = $row;

				}			

				return $data;

			} else {

				return null;

			}

		}

	}

	

	function ambil_data_array($arraysearch,$fieldorder='',$ordervalue='')

	{

		$CI=& get_instance();

		$CI->db->where($arraysearch);
		if(!empty($fieldorder) && !empty($ordervalue))
		{
		$CI->db->order_by($fieldorder, $ordervalue); 
		}
		if($this->pake_table($CI->table_name)==true)

		{

			$sql = $CI->db->get($CI->table_name);

			if($sql->num_rows() > 0){			

				foreach($sql->result() as $row){

					$data[] = $row;

				}			

				return $data;

			} else {

				return null;

			}

		}

	}

	

	function jika_ada($arraysearch)

	{

		$CI=& get_instance();

		$CI->db->where($arraysearch);

		if($this->pake_table($CI->table_name)==true)

		{

			$sql = $CI->db->get($CI->table_name);

			if($sql->num_rows() > 0){			

				return true;

			} else {

				return false;

			}

		}

	}

	

	function ambil_data_array_custom($arraysearch,$fieldorder,$ordervalue,$limit,$start)

	{

		$CI=& get_instance();

		$CI->db->where($arraysearch);

		$CI->db->order_by($fieldorder, $ordervalue); 

		$CI->db->limit($limit,$start);

		if($this->pake_table($CI->table_name)==true)

		{

			$sql = $CI->db->get($CI->table_name);

			if($sql->num_rows() > 0){			

				foreach($sql->result() as $row){

					$data[] = $row;

				}			

				return $data;

			} else {

				return null;

			}

		}

	}
	
	function ambil_data_where_paging($selectQuery,$fromQuery,$arraywhere,$fieldorder,$ordervalue,$limit,$start)

	{

		$CI=& get_instance();

		

		$CI->db->select($selectQuery);

		$CI->db->from($fromQuery);

		$CI->db->where($arraywhere);
		$CI->db->order_by($fieldorder, $ordervalue); 

		$CI->db->limit($limit,$start);

		

			$sql = $CI->db->get();

			if($sql->num_rows() > 0){			

				foreach($sql->result() as $row){

					$data[] = $row;

				}

				

				return $data;

			}else{

				return null;

			}

		

	}

	

	function ambil_data_where($field,$Kode,$f2='',$k2='')

	{

		$CI=& get_instance();

		$CI->db->where($field,$Kode);

		if(!empty($f2) && !empty($k2))

		{

			$CI->db->where($f2,$k2);

		}

		if($this->pake_table($CI->table_name)==true)

		{

			$sql = $CI->db->get($CI->table_name);

			if($sql->num_rows() > 0){			

				foreach($sql->result() as $row){

					$data[] = $row;

				}			

				return $data;

			} else {

				return null;

			}

		}

	}

	

	

	

	function ambil_data_where_custom($selectQuery,$fromQuery,$arraywhere)

	{

		$CI=& get_instance();

		

		$CI->db->select($selectQuery);

		$CI->db->from($fromQuery);

		$CI->db->where($arraywhere);

		

			$sql = $CI->db->get();

			if($sql->num_rows() > 0){			

				foreach($sql->result() as $row){

					$data[] = $row;

				}

				

				return $data;

			}else{

				return null;

			}

		

	}

	

	function ambil_satu_data($field,$kode,$output)

	{

		$CI=& get_instance();

		

		$CI->db->where($field, $kode);



		if($this->pake_table($CI->table_name)==true)

		{	

			$sql = $CI->db->get($CI->table_name);

			if($sql->num_rows() > 0){							

				return $sql->row()->$output;

			} else {

				return null;

			}

		}

	}

	

	function ambil_satu_custom($arraysearch,$output)

	{

		$CI=& get_instance();

		

		$CI->db->where($arraysearch);



		if($this->pake_table($CI->table_name)==true)

		{	

			$sql = $CI->db->get($CI->table_name);

			if($sql->num_rows() > 0){							

				return $sql->row()->$output;

			} else {

				return null;

			}

		}

	}

	

	function ambil_satu_data_array($arraysearch)

	{

		$CI=& get_instance();

		

		$CI->db->where($arraysearch);



		if($this->pake_table($CI->table_name)==true)

		{	

			$sql = $CI->db->get($CI->table_name);

			if($sql->num_rows() > 0){							

				foreach($sql->result() as $row){

					$data[] = $row;

				}

				

				return $data;

				

			} else {

				return null;

			}

		}

	}

	

	function ambil_satu_data_custom($table,$field,$kode,$output)

	{

		$CI=& get_instance();

		$CI->load->library('database');

		$CI->db->where($field, $kode);

			

			$sql = $CI->db->get($table);

			if($sql->num_rows() > 0){							

				return $sql->row()->$output;

			} else {

				return null;

			}



	}

	

	function jumlah_data()

	{

		$CI=& get_instance();

		

		if($this->pake_table($CI->table_name)==true)

		{

			return $CI->db->count_all($CI->table_name);

		}

	}

	

	function jumlah_data_where($arraysearch)

	{

		$CI=& get_instance();

		

		if($this->pake_table($CI->table_name)==true)

		{

			$CI->db->where($arraysearch);

					

			$sql = $CI->db->get($CI->table_name);

			return $sql->num_rows();

		}

	}

	

	function jumlah_data_where_custom($selectQuery,$fromQuery,$arraySearc)

	{



		$CI=& get_instance();

		

		$CI->db->select($selectQuery);

		$CI->db->from($fromQuery);

		$CI->db->where($arraySearc);

		

			$sql = $CI->db->get();

			if($sql->num_rows() > 0){							

				return $sql->num_rows();

			}else{

				return null;

			}

		

	}

	

	function buat_paging($url,$totalrow,$perpage,$segment_output,$data_pag)

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

	function nomor_urut($table,$fieldname,$kodeawal)
	{
		$CI=& get_instance();
		
			$CI->db->select($fieldname);
			$CI->db->from($table);
			$CI->db->order_by($fieldname, "DESC"); 
			$CI->db->limit(1);
			$sql = $CI->db->get();

			if($sql->num_rows() > 0){							

				$kodeterakhir=$sql->row()->$fieldname;
				$awalQ=substr($kodeterakhir,0-8);
				 $next=$awalQ+1;
				 $jid=strlen($next);
				 if($jid==1)
				 { $no='0000000'; }
					elseif($jid==2)
					{ $no='000000'; }
					elseif($jid==3)
					{ $no='00000'; }
					elseif($jid=4)
					{ $no='0000'; }
				 $br=$kodeawal.$no.$next;
				 return $br;

			} else {

				return $kodeawal."00000001";

			}

	}
	
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
	

}