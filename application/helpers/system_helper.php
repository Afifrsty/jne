<?php
function tanggal_sekarang($time=FALSE)
{
	date_default_timezone_set('Asia/Jakarta');
	$str_format='';
	if($time==FALSE)
	{
		$str_format= date("Y-m-d");
	}else{
		$str_format= date("Y-m-d H:i:s");
	}
	return $str_format;
}

function jam_sekarang()
{
	date_default_timezone_set('Asia/Jakarta');
	$str_format='';
	$str_format= date("H:i:s");
	
	return $str_format;
}

function konversi_datetime($datetime='',$withTime=FALSE)
{
	$str_original_format=$datetime;
	$str_convert_format='';
	date_default_timezone_set('Asia/Jakarta');
	if(!empty($datetime) && $withTime==TRUE)
	{
		$str_convert_format=date('d M Y H:i:s',strtotime($datetime));
	}elseif(!empty($datetime) && $withTime==FALSE)
	{
		$str_convert_format=date('d M Y',strtotime($datetime));
	}else{
		$str_convert_format=date('d M Y H:i:s',strtotime(date("Y-m-d H:i:s")));
	}
	return $str_convert_format;
}

function rupiah($str)
{
	return number_format($str);
}

function create_session($key,$value)
{
	$CI=& get_instance();
	$CI->session->set_userdata($key,$value);
}

function read_session($key)
{
	$CI=& get_instance();
	$isSession=$CI->session->userdata($key);
	if(!empty($isSession))
	{
		return $isSession;
	}
}

function unset_session($key)
{
	$CI=& get_instance();
	$isSession=$CI->session->userdata($key);
	if(!empty($isSession))
	{
		$CI->session->unset_userdata($key);
	}
}

function getOption($key)
{
	$CI=& get_instance();
	$CI->load->library('iksdb_library');	
	$skey=array(
		'option_key'=>$key,
		);
	$data=$CI->iksdb_library->FieldRow('options',$skey,'option_value');	
	return $data;
}

function unik_id()
{
	$CI=& get_instance();
	$CI->load->helper('date');
	date_default_timezone_set('Asia/Jakarta');
	$datestring = "%Y-%m-%d %H:%i:%s";

	$id = md5( base64_encode( uniqid() ) );
	$idformat=substr(md5($id), 0, 6);
	return $idformat;
}


function contenturl($str='')
{
	return base_url().'public/'.$str;
}

function copyright()
{
	return 'Copyright ';
}


function generateRecaptcha()
{
	$CI=& get_instance();
	$CI->load->library('recaptcha');
	$data=$CI->recaptcha->recaptcha_get_html();
	return $data;
}

function create_session_after_login($user,$role)
{
	$CI=& get_instance();
	$CI->session->set_userdata('apptoken_session_user',$user);
	$CI->session->set_userdata('apptoken_session_user_session',$role);
	$CI->session->set_userdata('apptoken_session_hashing',md5(sha1(md5($user))));	
}

function genToken()
{	
	$CI=& get_instance();
	return $CI->security->get_csrf_hash();
}

function verToken($str)
{
	$CI=& get_instance();
	if($CI->security->get_csrf_hash()==$str)
	{
		return true;
	}else{
		return false;
	}
}

function getRoleUser()
{
	$CI=& get_instance();
	$pl=$CI->session->userdata('apptoken_session_user');
	if(empty($pl))
	{
		doLogout();	
	}else{		
		$role=$CI->session->userdata('apptoken_session_user_session');
		if($role =='dokter')
		{
			
				return "dokter";
		}elseif($role =='perawat')
		{
			
				return "perawat";
		}elseif($role =='admin')
		{
			
				return "admin";
		}elseif($role =='kasir')
		{
			
				return "kasir";
		}
	}
}

function infouser($field)
{
	$CI=& get_instance();
	$pl=$CI->session->userdata('apptoken_session_user');
	if(empty($pl))
	{
		doLogout();	
	}else{		
		$CI->load->library('iksdb_library');
		$w=array(
			'username'=>$pl,
			);
		$f=$CI->iksdb_library->FieldRow('userlogin',$w,$field);
		return $f;
	}
}

function ifLogin()
{
	$CI=& get_instance();
	$pl=$CI->session->userdata('apptoken_session_user');
	if(empty($pl))
	{
		doLogout();	
	}else{
		$role=$CI->session->userdata('apptoken_session_user_session');
		if(!empty($role))
		{
			
			if($role =='dokter')
			{
				
					redirect(site_url('dokter/dashboard'),'refresh');
			}elseif($role =='perawat')
			{
				
					redirect(site_url('perawat/dashboard'),'refresh');
			}elseif($role =='admin')
			{
				
					redirect(site_url('admin/dashboard'),'refresh');
			}elseif($role =='operator')
			{
				
					redirect(site_url('operator/dashboard'),'refresh');
			}
		}
		
	}
}

function cekLogin()
{
	$CI=& get_instance();
	$pl=$CI->session->userdata('apptoken_session_user');
	if(empty($pl))
	{
		return false;
	}else{
		return true;
	}
}

function doLogout()
{
	$CI=& get_instance();
	$CI->session->unset_userdata('apptoken_session_user');
	$CI->session->unset_userdata('apptoken_session_user_session');
	$CI->session->unset_userdata('apptoken_session_hashing');
	$CI->session->sess_destroy();
	
}

function EmbedEditor($hackStyle='')
{
	$str='';
	$opsieditor="basic";
	if(!empty($hackStyle))
	{
		$str.=embedJS(contenturl().'/plugins/ckeditor/'.$hackStyle.'/ckeditor');
	}else{
		$str.=embedJS(contenturl().'/plugins/ckeditor/'.$opsieditor.'/ckeditor');
	}
		
	return $str;
}
function SetEditor($strs='',$name='')
{
	$str='';
		
	if(!empty($name))
	{
		$str.='<textarea id="'.$name.'" name="'.$name.'">'.$strs.'</textarea>';
		$str.= "<script>            
			CKEDITOR.replace( '".$name."');
			
			</script>";
	}else{
		$str.='<textarea id="content" name="content">'.$strs.'</textarea>';
		$str.= "<script>            
			CKEDITOR.replace( 'content');
			
			</script>";
	}
	
	
	
	
	return $str;
}

function embedCSS($cssfile)
{
	
	$str='<link rel="stylesheet" type="text/css" href="'.$cssfile.'.css">';
	return $str;
}

function embedJS($jsfile)
{
	$str='<script type="text/javascript" src="'.$jsfile.'.js"></script>';
	return $str;
}

function create_slug($text)
{ 

  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
  $text = trim($text, '-');
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  $text = strtolower($text);
  $text = preg_replace('~[^-\w]+~', '', $text);
  if (empty($text))
  {
	return 'n-a';
  }
  return $text;
}

function classActive($strSlug2,$strSlug3)
{
	$CI=& get_instance();
	$slug=$CI->uri->segment(2);
	$slug2=$CI->uri->segment(3);
	if($slug==$strSlug2 && $slug2==$strSlug3)
	{
		echo 'class="active"';
	}else{
		echo '';
	}
	
}

function kirimemail($from,$fromname,$to,$subject,$message)
{
	$CI=& get_instance();
	$CI->load->library('email');
	$config['protocol']    = 'smtp';
	$config['smtp_host']    = 'mail.pesta.us';
	$config['smtp_port']    = '25';
	$config['smtp_timeout'] = '7';
	$config['smtp_user']    = 'noreply@pesta.us';
	$config['smtp_pass']    = '3rU12z';
	$config['charset']    = 'utf-8';
	$config['newline']    = "\r\n";
	$config['mailtype'] = 'html'; 
	$config['validation'] = TRUE;
	$CI->email->initialize($config);
	$CI->email->from($from, $fromname);
	$CI->email->to($to);	

	$CI->email->subject($subject);
	$CI->email->message($message);

	if(!$CI->email->send())
	{
		return false;
	}else{
		return true;
	}
	
}

function difftgl($date_1 , $date_2 , $differenceFormat = '%a')
        {
          $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);
   
    $interval = date_diff($datetime1, $datetime2);
   
    return $interval->format($differenceFormat);
        }
function namaBulan($mons)
{
	$mons = array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");

$date = getdate();
$month = $date['mon'];

$month_name = $mons[$month];

return $month_name; 
}

function biayakamar()
{
	return 100000;
}
?>
