<?php

class MyClass{
	  var $CI;
  function __construct()
    {
    	$this->CI =& get_instance();
    	$this->CI->load->library('user_agent');  	
      $this->CI->load->library('session');
      $this->CI->load->helper('url');
    	$this->CI->load->model('Model');

            
          
  	}
}
?>