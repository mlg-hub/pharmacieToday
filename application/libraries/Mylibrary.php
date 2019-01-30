<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mylibrary
{
	protected $CI;
    
    public function __construct()
	{
	  $this->CI = & get_instance();
      $this->CI->load->library('session');
      $this->CI->load->model('Model');
	}

	public function permissions($url)
	{
	  	$verify_droit = $this->CI->Model->permissions($url,$this->CI->session->userdata('CASEHOSP_SERVICE_CODE'));
        $return =0;
	  	if(!empty($verify_droit)){
	  		$return =1;
	  	}

	  	return $return;
	}
}
