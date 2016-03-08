<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
Author		: Heru Rahmat Akhnuari
Email		: eyubalzary@gmail.com
Copyright	: PT Indra Karya Sejahtera
Codename	: ikssecure_library
*/


class Ikssecure_library
{
	
	function filter_post($var,$filter)
	{
		$CI=& get_instance();
		$CI->load->helper(array('form', 'url'));
		$CI->load->library('form_validation');
		return $CI->form_validation->set_rules($var, ucfirst($var), $filter);		
	}
	
	function start_post()
	{
		$CI=& get_instance();
		$CI->load->helper(array('form', 'url'));
		$CI->load->library('form_validation');
		if ($CI->form_validation->run() == FALSE)
		{
			return false;
		}else{
			return true;
		}
	}
	
	function filter_segment($id)
	{
		$CI=& get_instance();		
		$CI->load->helper('security');
		$is_kode=$CI->security->xss_clean($CI->uri->segment($id));
		if($is_kode)
		{
			return $is_kode;
		}else{
			return false;
		}
	}
	
	function filter_xss($data)
	{
		$CI=& get_instance();
		$CI->load->helper('security');
		if ($CI->security->xss_clean($data, TRUE) === FALSE)
		{
			return false;		
		}else{
			return true;
		}
	}
		
	
	
	function create_password($str)
	{
		/*
		Membuat password
		
		Example :
		create_password('1231');
		
		output :sha256:1000:v9fczjjpvJaMG0pI8K/s8Bfr5oFJtfFo:3FLEons7YI+Gtruld2Juyl/Egt7aeqqO
		*/
		return create_hash($str);		
	}

	function validation_password($str,$hash)
	{
		/*
		Validasi password
		
		validation_password('1231','sha256:1000:v9fczjjpvJaMG0pI8K/s8Bfr5oFJtfFo:3FLEons7YI+Gtruld2Juyl/Egt7aeqqO');
		
		output true/false
		*/
		if(validate_password($str,$hash)==true)
		{
			return true;
		}else{
			return false;
		}
	}
	
	
}

































//PASSWORD HELL
define("PBKDF2_HASH_ALGORITHM", "sha256");
define("PBKDF2_ITERATIONS", 1000);
define("PBKDF2_SALT_BYTE_SIZE", 24);
define("PBKDF2_HASH_BYTE_SIZE", 24);
define("HASH_SECTIONS", 4);
define("HASH_ALGORITHM_INDEX", 0);
define("HASH_ITERATION_INDEX", 1);
define("HASH_SALT_INDEX", 2);
define("HASH_PBKDF2_INDEX", 3);

function create_hash($password)
{
   
    $salt = base64_encode(mcrypt_create_iv(PBKDF2_SALT_BYTE_SIZE, MCRYPT_DEV_URANDOM));
    return PBKDF2_HASH_ALGORITHM . ":" . PBKDF2_ITERATIONS . ":" .  $salt . ":" .
        base64_encode(pbkdf2(
            PBKDF2_HASH_ALGORITHM,
            $password,
            $salt,
            PBKDF2_ITERATIONS,
            PBKDF2_HASH_BYTE_SIZE,
            true
        ));
}

function validate_password($password, $correct_hash)
{
    $params = explode(":", $correct_hash);
    if(count($params) < HASH_SECTIONS)
       return false;
    $pbkdf2 = base64_decode($params[HASH_PBKDF2_INDEX]);
    return slow_equals(
        $pbkdf2,
        pbkdf2(
            $params[HASH_ALGORITHM_INDEX],
            $password,
            $params[HASH_SALT_INDEX],
            (int)$params[HASH_ITERATION_INDEX],
            strlen($pbkdf2),
            true
        )
    );
}

function slow_equals($a, $b)
{
    $diff = strlen($a) ^ strlen($b);
    for($i = 0; $i < strlen($a) && $i < strlen($b); $i++)
    {
        $diff |= ord($a[$i]) ^ ord($b[$i]);
    }
    return $diff === 0;
}


function pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output = false)
{
    $algorithm = strtolower($algorithm);
    if(!in_array($algorithm, hash_algos(), true))
        trigger_error('PBKDF2 ERROR: Invalid hash algorithm.', E_USER_ERROR);
    if($count <= 0 || $key_length <= 0)
        trigger_error('PBKDF2 ERROR: Invalid parameters.', E_USER_ERROR);

    if (function_exists("hash_pbkdf2")) {
        
        if (!$raw_output) {
            $key_length = $key_length * 2;
        }
        return hash_pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output);
    }

    $hash_length = strlen(hash($algorithm, "", true));
    $block_count = ceil($key_length / $hash_length);

    $output = "";
    for($i = 1; $i <= $block_count; $i++) {
       
        $last = $salt . pack("N", $i);
       
        $last = $xorsum = hash_hmac($algorithm, $last, $password, true);
        
        for ($j = 1; $j < $count; $j++) {
            $xorsum ^= ($last = hash_hmac($algorithm, $last, $password, true));
        }
        $output .= $xorsum;
    }

    if($raw_output)
        return substr($output, 0, $key_length);
    else
        return bin2hex(substr($output, 0, $key_length));
}

