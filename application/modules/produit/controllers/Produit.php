<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produit extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Model_Produit");
        $this->make_bread->add('Produit', "produit/Produit", 0);
        $this->breadcrumb = $this->make_bread->output();
    }

    public function index()
    {
    	
    	$data['breadcrumb'] = $this->make_bread->output();
        $info = $this->Model->getlist("approv_produit",array());
        
        $resultat = array();
        foreach($info as $val)
        {
        	$typ_product=$this->Model->getOne('approv_produit_type',array('PRODUIT_TYPE_ID'=>$val['PRODUIT_TYPE_ID']));
          

        $data=Null;
        $data[]=$val['PRODUIT_CODE'];
        $data[]=$val['PRODUIT_NOM'];
        $data[]=$val['QUANTITE_DISPONIBLE'];
        $data[]=$val['MESURE_PRODUCT'];
        $data[]=$val['PRODUIT_DESCRIPTION'];
        $data[]=$typ_product['PRODUIT_TYPE_NOM'];
        $data['OPTIONS'] = '<div class="dropdown ">
                    <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Action
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        ';

          
            $data['OPTIONS'] .= "<li><a href='".base_url("produit/Produit/modifier/".$val['PRODUIT_ID'])."'>Modify</a></li>";

            $data['OPTIONS'] .= "<li><a href='" . base_url('produit/Produit/delete/' . $val['PRODUIT_ID']) . "'>Delete</a></li>";
        

        $resultat[]=$data;
        }

        $template=array(
        'table_open'=>'<table id="mytable" class="table table-bordered table-stripped table-hover table-condensed table-responsive">',
        '<table_close'=>'</table>'
        );
      
        $this->table->set_heading('PRODUCT CODE','PRODUCT NAME','AVAILABLE QUANTITY','MESURE','PRODUCT DESCRIPTION','TYPE','OPTIONS');
        $this->table->set_template($template);
    	
    
        $datas['table']=$resultat;
        $this->make_bread->add('Produit', "produit/Produit", 0);
        $datas['breadcrumb'] = $this->make_bread->output();
       $datas['title'] = "Products";
        $this->load->view('Produit_Liste_View',$datas);
    }

  public function get_produits()
  {     

     	$var_search = $_POST['search']['value'];

  	    $table = "approv_produit";
  	    $critere_txt = isset($_POST['search']['value'])?("PRODUIT_NOM LIKE '%$var_search%'"):NULL;
  	    $critere_array = array();
  	    $order_column = array('PRODUIT_CODE','PRODUIT_NOM','QUANTITE_DISPONIBLE','MESURE_PRODUCT');
  	    $order_by = isset($_POST['order'])?array($order_column[$_POST['order']['0']['column']]=>$_POST['order']['0']['dir']):array('PRODUIT_ID'=>'DESC');
  	    $select_column =array('PRODUIT_ID','PRODUIT_CODE','PRODUIT_NOM','QUANTITE_DISPONIBLE','MESURE_PRODUCT');

  	    $fetch_demandes = $this->Model_Produit->make_datatables($table,$select_column,$critere_txt,$critere_array,$order_by);
        
    	$data = array();
    	foreach ($fetch_demandes as $row) {
    	     $sub_array = array();
    	     
             $sub_array[] = $row->PRODUIT_NOM;
             $sub_array[] = $row->QUANTITE_DISPONIBLE;
             $sub_array[] = $row->MESURE_PRODUCT;
    	     $sub_array[] = "<form action='".base_url().'produit/Produit/add_produit/'.$row->PRODUIT_ID."' method='POST'><input type='numeric' name='qty_dispo' value='1' class='form-control' size ='20'><input type='submit' value='add' class='btn btn-primary'></form>";

    	     $data[] = $sub_array; 	     
    	 } 

    	 $output = array(
    	 	"draw"=>intval($_POST['draw']),
    	 	"recordsTotal"=>$this->Model_Produit->count_all_data($table,$critere_array),
    	 	"recordsFiltered"=>$this->Model_Produit->get_filtered_data($table,$select_column,$critere_txt,$critere_array,$order_by),
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
        $order_column = array('PRODUIT_CODE','PRODUIT_NOM','QUANTITE_DISPONIBLE','MESURE_PRODUCT');
        $order_by = isset($_POST['order'])?array($order_column[$_POST['order']['0']['column']]=>$_POST['order']['0']['dir']):array('PRODUIT_ID'=>'DESC');
        $select_column =array('PRODUIT_ID','PRODUIT_CODE','PRODUIT_NOM','QUANTITE_DISPONIBLE','MESURE_PRODUCT');

        $fetch_demandes = $this->Model_Produit->make_datatables($table,$select_column,$critere_txt,$critere_array,$order_by);
        
      $data = array();
      foreach ($fetch_demandes as $row) {
           $sub_array = array();
           
           $sub_array[] = $row->PRODUIT_NOM;
           $sub_array[] = $row->QUANTITE_DISPONIBLE;
           $sub_array[] = $row->MESURE_PRODUCT;
           $sub_array[] = "<form action='".base_url().'produit/Produit/add_produit_edit/'.$row->PRODUIT_ID."' method='POST'><input type='numeric' name='qty_disponible' value='1' class='form-control'><input type='submit' value='add' class='btn btn-primary'></form>";

           $data[] = $sub_array;       
       } 

       $output = array(
        "draw"=>intval($_POST['draw']),
        "recordsTotal"=>$this->Model_Produit->count_all_data($table,$critere_array),
        "recordsFiltered"=>$this->Model_Produit->get_filtered_data($table,$select_column,$critere_txt,$critere_array,$order_by),
        "data"=>$data
        );
       echo json_encode($output); 
    
  }



 function delete(){
  $table="approv_produit";
  $criteres['PRODUIT_ID']=$this->uri->segment(4);
  $data['rows']= $this->Model->getOne( $table,$criteres);
  $this->Model->delete($table,$criteres);
  
    $data['message']='<div class="alert alert-success text-center">'."Suppression d'un pproduit".' '.$data['rows']['PRODUIT_NOM'].'  '."faite avec succès".'</div>';
     $this->session->set_flashdata($data);
  redirect(base_url('produit/Produit'));
  

  }


  public function add_produit()
  {

  
  	$codeproduit=uniqid();
  	$data=array(

    'PRODUIT_CODE'=>$codeproduit,
    'PRODUIT_NOM'=>$this->input->post('PRODUIT_NOM'),
    'QUANTITE_DISPONIBLE'=>$this->input->post('QUANTITE_DISPONIBLE'),
    'MESURE_PRODUCT'=>$this->input->post('MESURE_PRODUCT'),
    'PRODUIT_DESCRIPTION'=>$this->input->post('PRODUIT_DESCRIPTION'),
    'PRODUIT_TYPE_ID'=>$this->input->post('PRODUIT_TYPE_ID'),
  	);

  	$this->Model->insert_last_id('approv_produit',$data);
  	redirect(base_url('produit/Produit'));
 
    
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

    redirect(base_url('produit/Produit/Modifier_reload/'.$produit_id));
  }
  public function remove()
  {
    $array = array('rowid'=>$this->uri->segment(4),
                    'qty'=>0);
    $this->cart->update($array);
    redirect(base_url('produit/Produit/new'));
  }
  public function remove_edit()
  {
    $array = array('rowid'=>$this->uri->segment(5),
                    'qty'=>0);
    $this->cart->update($array);
    redirect(base_url('produit/Produit/Modifier_reload/'.$this->uri->segment(4)));
  }

  public function Modifier()
  {
  	//$produit_id = $this->uri->segment(4);
  	$produit_id = $this->uri->segment(4);
        $data = array();
        $data = $this->Model->getOne('approv_produit', array('PRODUIT_ID' => $produit_id));
        $data['produits'] =$this->Model->getList('approv_produit',array());
        $data['type_produit'] =$this->Model->getList('approv_produit_type',array());
        $this->make_bread->add('Modifier un produit', "Modifier/".$produit_id, 1);
        $data['breadcrumb'] = $this->make_bread->output();

        $this->load->view('Produit_Modifier_View', $data);
  }

    public function modifier_produit()
    {
       $this->form_validation->set_rules('PRODUIT_CODE', 'Product code', 'trim');
        $this->form_validation->set_rules('PRODUIT_NOM', 'Product name','trim|required');
        $this->form_validation->set_rules('QUANTITE_DISPONIBLE', 'Quantity','required');
        $this->form_validation->set_rules('PRODUIT_DESCRIPTION', 'Description product', 'trim|required');
        $this->form_validation->set_rules('MESURE_PRODUCT', 'Mesure product', 'trim|required');
        $this->form_validation->set_rules('PRODUIT_TYPE_ID', 'Type of the product', 'trim|required');

        $produit_id = $this->input->post('PRODUIT_ID');
        $this->make_bread->add('Modifier un produit', "Modifier/".$produit_id, 1);
        $data['breadcrumb'] = $this->make_bread->output();

        if ($this->form_validation->run() == FALSE) {
            $data['PRODUIT_ID'] = $this->input->post('PRODUIT_ID');
            $data['PRODUIT_CODE'] = $this->input->post('PRODUIT_CODE');
            $data['PRODUIT_NOM'] = $this->input->post('PRODUIT_NOM');
            $data['QUANTITE_DISPONIBLE'] = $this->input->post('QUANTITE_DISPONIBLE');
            $data['MESURE_PRODUCT'] = $this->input->post('MESURE_PRODUCT');
            $data['PRODUIT_DESCRIPTION'] = $this->input->post('PRODUIT_DESCRIPTION');
            $data['PRODUIT_TYPE_ID'] = $this->input->post('PRODUIT_TYPE_ID');
            $data['type_produit'] =$this->Model->getList('approv_produit_type');

               $this->load->view('Produit_Modifier_View', $data);
        }else{
            $donnee = array(
                'PRODUIT_NOM' => $this->input->post('PRODUIT_NOM'),
                'QUANTITE_DISPONIBLE' => $this->input->post('QUANTITE_DISPONIBLE'),
                'MESURE_PRODUCT' => $this->input->post('MESURE_PRODUCT'),
                'PRODUIT_DESCRIPTION' => $this->input->post('PRODUIT_DESCRIPTION'),
                'PRODUIT_TYPE_ID'=>$this->input->post('PRODUIT_TYPE_ID')
            );
          // print_r($donnee);
 if ($this->Model->update('approv_produit', array('PRODUIT_ID' => $this->input->post('PRODUIT_ID')), $donnee)) {
                $data['message'] = "<div class='alert alert-success'>Modification of the product <b>" . $this->input->post('PRODUIT_NOM') . "</b> done successfuly</div>";
            } else {
                $data['message'] = "<div class='alert alert-danger'>Modification of the product <b>".$this->input->post('PRODUIT_NOM') ."</b> failed</div>";
            }
           // $data['retour'] = base_url('produit/Produit');
            // $this->load->view('Message_View', $data);
             $this->session->set_flashdata($data);
    redirect(base_url('produit/Produit'));
        }
    }
    public function new()
    {
      $data['title'] = "Products";
    	$data['breadcrumb'] = $this->make_bread->output();
    	$data['type_produit']=$this->Model->getList('approv_produit_type',array());
    	$this->load->view('Produit_Nouvelle_View',$data);
    }



}