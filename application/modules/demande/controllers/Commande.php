<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Commande extends CI_Controller {

  public function __construct() {

        parent::__construct();
         $this->load->model("Model");
    	$this->make_bread->add('Commande', "demande/Commande", 0);
        $this->breadcrumb = $this->make_bread->output();
        $array_url = array('URL_REPORTING'=>base_url('Reporting'));
        $this->session->set_userdata($array_url);
	}

	public function index2($msg=NULL)
    {
    $this->make_bread->add('Commande',"index",1);
    $data['breadcrumb']=$this->make_bread->output();

    	$data['approv_soumission_commande']=$this->Model->getList('approv_soumission_commande',array('STATUT_SOUMISSION'=>0,'IS_SELECTED'=>1));
        $data['info']=$msg;

    	$this->load->view('commande_achat_view',$data);
    }

    function valider(){

    	$options=$this->input->post('options');
    	$donneesun=array('STATUT_SOUMISSION'=>1);

    	if(!empty($options)){

    		foreach ($options as $key) {

    		$approv_soumission_commande=$this->Model->getOne('approv_soumission_commande',array('ID_SOUMMISSION_COMMANDE'=>$key));

            
    		$mis_ajourun=$this->Model->update_table('approv_soumission_commande',array('ID_SOUMMISSION_COMMANDE'=>$key),$donneesun);

            $donneedeux=array('BUDGET_CONTRACTUEL'=>$approv_soumission_commande['MONTANT_FOURNISSEUR']);

    		$mis_ajourdeu=$this->Model->update_table('approv_demande',array('DEMANDE_ID'=>$approv_soumission_commande['DEMANDE_ID']),$donneedeux);

    		if($mis_ajourun && $mis_ajourdeu){
                $msg='<div class="alert alert-success text-center">Success</div>';
    			
    		}else{
    		$msg='<div class="alert alert-danger text-center">Error</div>';;
    
    		}

    	}
        $this->index($msg);

    	}else{
    	$this->index('<div class="alert alert-danger text-center">No value cheched</div>');
    
    	}

    	
    }



    function index($msg=NULL){

       $approv_soumission_commande=$this->Model->getList('approv_soumission_commande',array('STATUT_SOUMISSION'=>0,'IS_SELECTED'=>1));
        $phases_list = array();
        foreach ($approv_soumission_commande as $key) {
            $array = NULL;

             $approv_soummissionaire=$this->Model->getOne('approv_soummissionaire',array('ID_SOUMISSIONAIRE'=>$key['SOUMMISSIONAIRE_ID']));
             $approv_demande=$this->Model->getOne('approv_demande',array('DEMANDE_ID'=>$key['DEMANDE_ID']));
             $array['DEMANDE'] = $approv_demande['DEMANDE_CODE'];

               $array['SOUMMISSIONAIRE'] = $approv_soummissionaire['NOM_SOUMMISSIONAIRE']." ".$approv_soummissionaire['PRENOM_SOUMMISSIONAIRE'];


     $demandes=$this->Model->getOne('approv_demande',array('DEMANDE_ID'=>$key['DEMANDE_ID']));
         $demandes_details=$this->Model->getList('approv_demande_detail',array('DEMANDE_CODE'=>$demandes['DEMANDE_CODE']));
           $liste_des_diligences = " ";
           // print_r($demandes_details);
            foreach ($demandes_details as $diligence) {
                
                $produits = $this->Model->getOne('approv_produit',array('PRODUIT_ID'=>$diligence['PRODUIT_ID']));

              $liste_des_diligences .= "<tr><td>".$produits['PRODUIT_NOM']."</td><td>".$diligence['QUANTITE_BON_COMMANDE']."</td></tr>";  
            }
          //  echo $liste_des_phases;

            $array['produits'] = "<a href='#' data-toggle='modal' 
                                  data-target='#myphase" . $key['DEMANDE_ID'] . "'>".sizeof($demandes_details)."</a>
                                    <div class='modal fade' id='myphase".$key['DEMANDE_ID']."'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>

                                                <div class='modal-body'>
                                                    <table class='table table-bordered'>
                                                    <tr><th>Product (s)</th><th>Quantity</th></tr>" . $liste_des_diligences . "</table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>"; 

            $array['choix']=' <input type="checkbox" name="options[]" value="'.$key['ID_SOUMMISSION_COMMANDE'].'" >';
             
            $phases_list[] =$array;
          
              }

             
       

         $template = array(
            'table_open' => '<table id="id_tabl" class="table table-bordered table-striped table-hover table-condensed table-responsive">',
            'table_c
            lose' => '</table>'
        );

        $this->table->set_heading('Demande','Bidder','Number of product (s)
','To choose');
        $this->table->set_template($template);
         $data['command_list'] = $phases_list;
          $this->make_bread->add('Commande',"index",1);
    $data['breadcrumb']=$this->make_bread->output();

    $data['info']=$msg;
        
        $this->load->view('demande/commande_achat_view',$data);

 }

 function listing($msg=NULL){

       $approv_soumission_commande=$this->Model->getList('approv_soumission_commande',array('STATUT_SOUMISSION'=>1));

       
        
        $phases_list = array();
        foreach ($approv_soumission_commande as $key) {
            $array = NULL;

             $approv_soummissionaire=$this->Model->getOne('approv_soummissionaire',array('ID_SOUMISSIONAIRE'=>$key['SOUMMISSIONAIRE_ID']));
             $approv_demande=$this->Model->getOne('approv_demande',array('DEMANDE_ID'=>$key['DEMANDE_ID']));
             $array['DEMANDE'] = $approv_demande['DEMANDE_CODE'];

               $array['SOUMMISSIONAIRE'] = $approv_soummissionaire['NOM_SOUMMISSIONAIRE']." ".$approv_soummissionaire['PRENOM_SOUMMISSIONAIRE'];


     $demandes=$this->Model->getOne('approv_demande',array('DEMANDE_ID'=>$key['DEMANDE_ID']));
         $demandes_details=$this->Model->getList('approv_demande_detail',array('DEMANDE_CODE'=>$demandes['DEMANDE_CODE']));
           $liste_des_diligences = " ";
           
            foreach ($demandes_details as $diligence) {
                
                $produits = $this->Model->getOne('approv_produit',array('PRODUIT_ID'=>$diligence['PRODUIT_ID']));

              $liste_des_diligences .= "<tr><td>".$produits['PRODUIT_NOM']."</td><td>".$diligence['QUANTITE_BON_COMMANDE']."</td></tr>";  
            }
          //  echo $liste_des_phases;

            $array['produits'] = "<a href='#' data-toggle='modal' 
                                  data-target='#myphase" . $key['SOUMMISSIONAIRE_ID'] . "'>".sizeof($demandes_details)."</a>
                                    <div class='modal fade' id='myphase".$key['SOUMMISSIONAIRE_ID']."'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>

                                                <div class='modal-body'>
                                                    <table class='table table-bordered'>
                                                    <tr><th>Product (s)</th><th>Quantity</th></tr>" . $liste_des_diligences . "</table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>"; 

            // $array['choix']=' <input type="checkbox" name="options[]" value="'.$key['ID_SOUMMISSION_COMMANDE'].'" >';
             
            $phases_list[] =$array;
          
              }

             
       

         $template = array(
            'table_open' => '<table id="id_tabl" class="table table-bordered table-striped table-hover table-condensed table-responsive">',
            'table_c
            lose' => '</table>'
        );

        $this->table->set_heading('Demande','Bidder','Number of product (s)
');
        $this->table->set_template($template);
         $data['command_list'] = $phases_list;
          $this->make_bread->add('Commande',"index",1);
    $data['breadcrumb']=$this->make_bread->output();

    $data['info']=$msg;
        
        $this->load->view('demande/commande_achat_view_new',$data);

 }

    


     }

    