<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produits extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Model_Demande");
        $this->make_bread->add('Produits', "demande/Produits", 0);
        $this->breadcrumb = $this->make_bread->output();
    }

    public function index()
    {
    	$data['title'] = "The produits";
    	$data['breadcrumb'] = $this->make_bread->output();
    	$this->load->view('Produit_Liste_View',$data);
    }

  public function get_produits()
  {     

     	$var_search = $_POST['search']['value'];

  	    $table = "approv_produit";
  	    $critere_txt = isset($_POST['search']['value'])?("PRODUIT_NOM LIKE '%$var_search%'"):NULL;
  	    $critere_array = array();
  	    $order_column = array('PRODUIT_CODE','PRODUIT_NOM');
  	    $order_by = isset($_POST['order'])?array($order_column[$_POST['order']['0']['column']]=>$_POST['order']['0']['dir']):array('PRODUIT_ID'=>'DESC');
  	    $select_column =array('PRODUIT_ID','PRODUIT_CODE','PRODUIT_NOM');

  	    $fetch_demandes = $this->Model_Demande->make_datatables($table,$select_column,$critere_txt,$critere_array,$order_by);
        
    	$data = array();
    	foreach ($fetch_demandes as $row) {
    	     $sub_array = array();
    	     
           $sub_array[] = $row->PRODUIT_NOM;
    	     $sub_array[] = "<form action='".base_url().'demande/Produits/add_produit/'.$row->PRODUIT_ID."' method='POST'><input type='number' name='qty_dispo' value='1' class='form-control' size ='20'><input type='submit' value='add' class='btn btn-primary'></form>";

    	     $data[] = $sub_array; 	     
    	 } 

    	 $output = array(
    	 	"draw"=>intval($_POST['draw']),
    	 	"recordsTotal"=>$this->Model_Demande->count_all_data($table,$critere_array),
    	 	"recordsFiltered"=>$this->Model_Demande->get_filtered_data($table,$select_column,$critere_txt,$critere_array,$order_by),
    	 	"data"=>$data
    	 	);
    	 echo json_encode($output); 
  	
  }
  public function get_produit_edit()
  {     

      $var_search = $_POST['search']['value'];

        $table = "approv_produit";
        $critere_txt = isset($_POST['search']['value'])?("PRODUIT_NOM LIKE '%$var_search%'"):NULL;
        $critere_array = array();
        $order_column = array('PRODUIT_CODE','PRODUIT_NOM','QUANTITE_DISPONIBLE');
        $order_by = isset($_POST['order'])?array($order_column[$_POST['order']['0']['column']]=>$_POST['order']['0']['dir']):array('PRODUIT_ID'=>'DESC');
        $select_column =array('PRODUIT_ID','PRODUIT_CODE','PRODUIT_NOM','QUANTITE_DISPONIBLE');

        $fetch_demandes = $this->Model_Demande->make_datatables($table,$select_column,$critere_txt,$critere_array,$order_by);
        
      $data = array();
      foreach ($fetch_demandes as $row) {
           $sub_array = array();
           
           $sub_array[] = $row->PRODUIT_NOM;
           $sub_array[] = $row->QUANTITE_DISPONIBLE;
           $sub_array[] = "<form action='".base_url().'demande/Produits/add_produit_edit/'.$row->PRODUIT_ID."' method='POST'><input type='number' name='qty_disponible' value='1' class='form-control'><input type='submit' value='add' class='btn btn-primary'></form>";

           $data[] = $sub_array;       
       } 

       $output = array(
        "draw"=>intval($_POST['draw']),
        "recordsTotal"=>$this->Model_Demande->count_all_data($table,$critere_array),
        "recordsFiltered"=>$this->Model_Demande->get_filtered_data($table,$select_column,$critere_txt,$critere_array,$order_by),
        "data"=>$data
        );
       echo json_encode($output); 
    
  }

  public function add_produit()
  {
    $qty = $this->input->post('qty_dispo');
    $produit_id = $this->uri->segment(4);

    $produit = $this->Model->getOne('approv_produit',array('PRODUIT_ID'=>$produit_id));

    $array = array('id'=>$produit_id,
                    'qty'=>$qty,
                    'price'=>1,
                    'name'=>$produit['PRODUIT_NOM']);
    $this->cart->insert($array);

    redirect(base_url('demande/Demande/new'));
  }
  public function add_produit_edit()
  {
    $qty = $this->input->post('qty_disponible');
    $produit_id = $this->uri->segment(4);

    $produit = $this->Model->getOne('approv_produit',array('PRODUIT_ID'=>$produit_id));

    $array = array('id'=>$produit_id,
                    'qty'=>$qty,
                    'price'=>1,
                    'name'=>$produit['PRODUIT_NOM']);
    $this->cart->insert($array);

    redirect(base_url('demande/Demande/Modifier_reload/'.$produit_id));
  }
  public function remove()
  {
    $array = array('rowid'=>$this->uri->segment(4),
                    'qty'=>0);
    $this->cart->update($array);
    redirect(base_url('demande/Demande/new'));
  }
  public function remove_edit()
  {
    $array = array('rowid'=>$this->uri->segment(5),
                    'qty'=>0);
    $this->cart->update($array);
    redirect(base_url('demande/Demande/Modifier_reload/'.$this->uri->segment(4)));
  }

  public function Modifier()
  {
  	$demande_id = $this->uri->segment(4);
  	
  }

    public function new()
    {
        $data['title'] = "Make the request";
    	$data['breadcrumb'] = $this->make_bread->output();
    	$this->load->view('Demande_Nouvelle_View',$data);
    }

}