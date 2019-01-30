<?php

 
class Stock extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // $this->is_Oauth();
        $this->make_bread->add('stock/Stock', "Stock", 0);
        $this->breadcrumb = $this->make_bread->output();
    }

    // public function is_Oauth()
    // {
    //    if($this->session->userdata('USER_EMAIL') == NULL)
    //     redirect(base_url());
    // }

    public function index()
       {

     $data['fournisseur']=$this->Model->getListOrder('fournisseur',array());
     $data['medicament']=$this->Model->getListOrder('medicament', array());
     $data['type_medicament']=$this->Model->getListOrder('type_medicament', array());
      $data['breadcrumb'] = $this->make_bread->output();
      $this->load->view('stock_views/stock_add_view',$data);
       }
       public function add()
       {
      $this->form_validation->set_rules('NOMBR_CARTON', 'Carton', 'required');
      $this->form_validation->set_rules('TYPE_NOMBR', 'Type', 'trim|required');
      $this->form_validation->set_rules('PRIX_VENTE', 'Price', 'trim|required');
      $this->form_validation->set_rules('PRIX_ACHAT', 'Price', 'trim|required');
      $this->form_validation->set_rules('EXP_DATE', 'Expir date', 'trim|required');
    

    if ($this->form_validation->run() == FALSE)
        { 
          $data['breadcrumb'] = $this->make_bread->output();
          $data['error']="";
          $data['fournisseur']=$this->Model->getListOrder('fournisseur',array());
          $data['medicament']=$this->Model->getListOrder('medicament', array());
          $data['type_medicament']=$this->Model->getListOrder('type_medicament', array());
          $this->load->view('stock_views/stock_add_view',$data);
   }
   else
        {

        $TYPE_STOCK = $this->input->post('TYPE_STOCK');
        $NOMBR_CARTON = $this->input->post('NOMBR_CARTON');
        $FOURNISSEUR = $this->input->post('FOURNISSEUR');
        $MEDOC = $this->input->post('MEDOC');
        $TYPE_MEDOC = $this->input->post('TYPE_MEDOC');
        $TYPE_NOMBR = $this->input->post('TYPE_NOMBR');
        $PRIX_VENTE = $this->input->post('PRIX_VENTE');
        $PRIX_ACHAT = $this->input->post('PRIX_ACHAT');
        $EXP_DATE = $this->input->post('EXP_DATE');
        
    $data = array(
          'TYPE_STOCKAGE' => $TYPE_STOCK,
          'NOMBRE_INITIAL' => $NOMBR_CARTON,
          'NOMBRE_FINAL' => $NOMBR_CARTON,
          'ID_FOURNISSEUR' => $FOURNISSEUR,
          'MEDICAMENT_ID' => $MEDOC,
          'TYPE_ID'=> $TYPE_MEDOC,
          'QUANTIT_INITIAL'=> $TYPE_NOMBR,
          'QUANTIT_FINAL' => $TYPE_NOMBR,
          'PRIX_VENTE'=> $PRIX_VENTE,
          'PRIX_ACHAT'=> $PRIX_ACHAT,
          'DATE_EXPIRATION'=> $EXP_DATE,

          
    ); 
    $table = 'stock';
    print_r($data); 
      $result = $this->Model->create($table, $data );
      if ($result) 
       {
        // $data['message']='<div class="alert alert-success text-center">Enregistrement reussi</div>';
        // $this->session->set_flashdata($data);
        // $data['breadcrumb'] = $this->make_bread->output(); 
        // $this->listing();
    }else{
        // $data['message']='<div class="alert alert-danger text-center">Echec</div>';
        // $this->session->set_flashdata($data);
        // $data['breadcrumb'] = $this->make_bread->output(); 
        // $this->listing();
    }
   }
 }


   }
   ?>