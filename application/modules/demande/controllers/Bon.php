<?php

class Bon extends CI_Controller
{
	public function __construct() {
        parent::__construct();
        $this->load->model("Model_Demande");
        $this->make_bread->add('Demande', "demande/Bon", 0);
        $this->breadcrumb = $this->make_bread->output();
    }

    public function index()
    {
    	//echo $this->session->userdata['CASEHOSP_SERVICE_CODE'];

    	$data['title'] = "The Purchase Orders";
    	$data['breadcrumb'] = $this->make_bread->output();
    	$this->load->view('Bon_Liste_View',$data);
    }

  public function getBon()
  {     

     	$var_search = $_POST['search']['value'];

  	    $table = "approv_demande";
  	    $critere_txt = isset($_POST['search']['value'])?("DEMANDE_CODE LIKE '%$var_search%'"):NULL;
  	    $critere_array = array('SERVICE_CODE'=>$this->session->userdata('CASEHOSP_SERVICE_CODE'),'IS_COMMANDE'=>1);
  	    $order_column = array('DEMANDE_CODE','UTILISATEUR_ID','SERVICE_CODE','DATE_INSERTION','IS_COMMANDE','BUDGET_PROVISOIRE');
  	    $order_by = isset($_POST['order'])?array($order_column[$_POST['order']['0']['column']]=>$_POST['order']['0']['dir']):array('DEMANDE_ID'=>'DESC');
  	    $select_column =array('DEMANDE_ID','DEMANDE_CODE','UTILISATEUR_ID','SERVICE_CODE','DATE_INSERTION','IS_COMMANDE','BUDGET_PROVISOIRE');

  	    $fetch_demandes = $this->Model_Demande->make_datatables($table,$select_column,$critere_txt,$critere_array,$order_by);
        
       // print_r($fetch_demandes);
    	$data = array();
    	foreach ($fetch_demandes as $row) {
    	     $sub_array = array();
    	     $utilisateur = $this->Model->getOne('admin_utilisateurs',array('UTILISATEUR_ID'=>$row->UTILISATEUR_ID));
    	     $service = $this->Model->getOne('admin_service',array('SERVICE_CODE'=>$row->SERVICE_CODE));

    	     $sub_array[] = $row->DEMANDE_CODE;
    	     $sub_array[] = $utilisateur['UTILISATEUR_NOM'].' '.$utilisateur['UTILISATEUR_PRENOM'];
    	     $sub_array[] = $service['SERVICE_NOM'];
    	     $sub_array[] = $row->BUDGET_PROVISOIRE;
    	     $sub_array[] = ($row->IS_COMMANDE==1)?'Oui':'Non';
    	     $sub_array[] = $row->DATE_INSERTION;

    	     $options = '<div class="dropdown ">
		                    <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Options
		                    <span class="caret"></span></a>
		                    <ul class="dropdown-menu dropdown-menu-left">
		                        ';
             
		      $options .= "<li><a href='" . base_url('demande/Demande/Modifier/' . $row->DEMANDE_ID) . "'>
                                        Edit</li>";
              $options .= "<li><a href='" . base_url('demande/Demande/detail/' . $row->DEMANDE_ID) . "'>
                                        Détail</li>";                         
              $options .= "<li><a href='#' data-toggle='modal' 
                                  data-target='#mydelete" . $row->DEMANDE_ID . "'><font color='red'>Delete</font></button></li></ul>
                                   </div>

                                    
                                    <div class='modal fade' id='mydelete" .$row->DEMANDE_ID. "'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>

                                                <div class='modal-body'>
                                                    <h5>Supprimer :<b>" . $row->DEMANDE_CODE . "</b>?</h5>
                                                </div>

                                                <div class='modal-footer'>
                                                    <a class='btn btn-danger btn-md' href='" . base_url('demande/Demande/supprimer/' .$row->DEMANDE_ID) . "'>Delete</a>
                                                    <button class='btn btn-primary btn-md' class='close' data-dismiss='modal'>Cancel</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>";                  

    	     $sub_array[] = $options;

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
}