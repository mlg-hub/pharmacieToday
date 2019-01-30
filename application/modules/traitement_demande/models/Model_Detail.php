<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Detail extends CI_Model{

  function __construct() {
  parent::__construct();
  
    }
    function checkvalue($table, $criteres) {
        $this->db->where($criteres);
        $query = $this->db->get($table);
        if($query->num_rows() > 0)
        {
           return true ;
        }
        else{
    return false;
    }
    }


}