<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_Model{

  function __construct() {
  parent::__construct();
  
    }


  function create($table, $data) {

        $query = $this->db->insert($table, $data);
        return ($query) ? true : false;

    }


  function update_table($table, $criteres, $data) {
        foreach ($data as $key => $value) {
          $this->db->set($key,$value);
        }
        $this->db->where($criteres);
        $query = $this->db->update($table);
        return ($query) ? true : false;
    }  

    function insert_last_id($table, $data) {

        $query = $this->db->insert($table, $data);
       
       if ($query) {
            return $this->db->insert_id();
        }

    }

    public function getOneOrder($table,$array= array(),$order_champ=NULL,$order_value = 'DESC')
       {
         $this->db->where($array);
         $this->db->order_by($order_champ,$order_value);

         $query = $this->db->get($table);

         if($query){
          return $query->row_array();
         }
       }   


    function getList($table,$criteres = array()) {
        $this->db->where($criteres);
        $query = $this->db->get($table);
        return $query->result_array();
    }


    function getOne($table, $criteres,$time = NULL) {

        $this->db->where($criteres);
        if($time != NULL)
          $this->db->where($time);
        $query = $this->db->get($table);
        if($query)
        return $query->row_array();
    }

   function delete($table,$criteres){
        $this->db->where($criteres);
        $query = $this->db->delete($table);
        return ($query) ? true : false;
    }


      function update($table, $criteres, $data) {
        $this->db->where($criteres);
        $query = $this->db->update($table, $data);
        return ($query) ? true : false;
    }



    function record_count($table,$critere = array())
    {
       $this->db->where($critere);
       $query= $this->db->get($table);
       if($query)
       {
           return $query->num_rows();
       }
       
    }

    public function permissions($url,$serive_code)
    {
       $this->db->select('p.*');
       $this->db->from('permission_service ps');
       $this->db->join('permissions p','p.PERMISSION_ID =ps.PERMISSION_ID');
       $this->db->where('p.PERMISSION_URL',$url);
       $this->db->where('ps.SERVICE_CODE',$serive_code);

       $permi = $this->db->get();
       if($permi){
        return $permi->row_array();
       }
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


          function getListOrder($table,$criteres)
    {
        $this->db->order_by($criteres);
      $query= $this->db->get($table);
      if($query)
      {
          return $query->result_array();
      }
    }

    function getList_cond($table,$criteres = array(),$criteres2 = array(),$criteres3 = array()) {
        $this->db->where($criteres);
        $this->db->where($criteres2);
        $this->db->where($criteres3);
        $query = $this->db->get($table);
        return $query->result_array();
    }

    function record_count_cond($table,$critere = array(),$critere2 = array(),$critere3 = array())
    {
       $this->db->where($critere);
       $this->db->where($critere2);
       $this->db->where($critere3);
       $query= $this->db->get($table);
       if($query)
       {
           return $query->num_rows();
       }
       
    }
  }

