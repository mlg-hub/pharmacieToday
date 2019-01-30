<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Soumission extends CI_Controller
{
	
	function __construct()
	{
		 parent::__construct();
        $this->is_Oauth();
 //           $email_User=$this->session->userdata('USER_EMAIL');
 // if($email_User!="admin@expertis.bi"){ 
        $this->make_bread->add('soumission', "comptabilite/Soumission", 0);
      // }else{$this->make_bread->add('CrReunion', "comptabilite/Soumission/listing", 0);}
        $this->breadcrumb = $this->make_bread->output();
      
	}

  public function is_Oauth()
    {
       // if($this->session->userdata('USER_EMAIL') == NULL)
       //  redirect(base_url());
    }
    
	public function index(){
			$datas['title'] = "The submissions";
    $is_commande=$this->Model->getList('approv_demande',array('IS_COMMANDE'=>1,'IS_APPLIED'=>0));

    $resultat=array();
    foreach ($is_commande as $value) {

      $demande_detail=$this->Model->getList('approv_demande_detail',array('DEMANDE_CODE'=>$value['DEMANDE_CODE'],'IS_LIVRE'=>0));
      // $xt=$this->Model->getOne('approv_produit',array('PRODUIT_ID'=>$demande_detail['PRODUIT_ID']));
      // echo	$demande_detail['PRODUIT_ID'];exit();
     $data=Null;
        $data[]=$value['DATE_INSERTION'];
        $data[]=$value['DEMANDE_CODE'];
$prdt="";

       foreach ($demande_detail as $key) {
          $xt=$this->Model->getOne('approv_produit',array('PRODUIT_ID'=>$key['PRODUIT_ID']));
          

        $prdt.="<tr><td>".$xt['PRODUIT_NOM']."</td><td>".$key['QUANTITE_BON_COMMANDE']."</td><td>".$xt['QUANTITE_DISPONIBLE']."</td></tr>";
       }

        
          $data[]="<a href='#' data-toggle='modal' 
                                  data-target='#sos". $value['DEMANDE_ID'] . "'>".sizeof($demande_detail)."</a>
                                    <div class='modal fade' id='sos".$value['DEMANDE_ID'] ."'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>

                                                <div class='modal-body'>
                                                    <table class='table table-bordered'>
                                                    <tr><th>PRODUCT NAME</th><th>REQUIRED QUANTITY</th><th>AVAILABLE STOCK</th></tr>" .$prdt. "</table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>";
        // $data[]=$demande_detail['QUANTITE_BON_COMMANDE'];

        $smsionaire_rel=$this->Model->getList('approv_soumission_commande',array('DEMANDE_ID'=>$value['DEMANDE_ID']));
        $sct='';
        foreach ($smsionaire_rel as $val) {
        	 $smsionaire=$this->Model->getOne('approv_soummissionaire',array('ID_SOUMISSIONAIRE'=>$val['SOUMMISSIONAIRE_ID']));
			$sct.="<tr><td>".$smsionaire['NOM_SOUMMISSIONAIRE']."</td><td>".$smsionaire['PRENOM_SOUMMISSIONAIRE']."</td><td>".$smsionaire['TEL_SOUMMISSIONAIRE']."</td><td>".$smsionaire['ADRESSE_SOUMMISSIONAIRE']."</td><td>".$val['MONTANT_FOURNISSEUR']."</td><td>".$val['DATE_LIVRAISON']."</td></tr>";
        }
        

        $data[]="<a href='#' data-toggle='modal' 
                                  data-target='#so". $value['DEMANDE_ID'] . "'>".sizeof($smsionaire_rel)."</a>
                                    <div class='modal fade' id='so".$value['DEMANDE_ID'] ."'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>

                                                <div class='modal-body'>
                                                    <table class='table table-bordered'>
                                                    <tr><th>NAME</th><th>LAST NAME</th><th>TELEPHONE</th><th>ADRESSE</th><th>AMOUNT REQUIRED</th><th>DEADLINE</th></tr>" .$sct. "</table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>";
     //$data[]=$part;
   
   $selected=$this->Model->getOne('approv_soumission_commande',array('DEMANDE_ID'=>$value["DEMANDE_ID"],'IS_SELECTED'=>1));

   if( $selected){
    $is_selected=$this->Model->getOne('approv_soummissionaire',array('ID_SOUMISSIONAIRE'=>$selected['SOUMMISSIONAIRE_ID']));
    $data[]=$is_selected['NOM_SOUMMISSIONAIRE']." ".$is_selected['PRENOM_SOUMMISSIONAIRE']." ".$is_selected['TEL_SOUMMISSIONAIRE'];
   }else{ $data[]="NOT YET SELECTED"; }

if($value["IS_APPLIED"]==1){
                             $data['option']="-";
                      }else{
$data['option']='<div class="dropdown ">
                    <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Action
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-left">';
         $data['option'].='<li><a href='.base_url("comptabilite/Soumission/get_soummission/").$value["DEMANDE_ID"].'>submission</a></li>';
        $data['option'].='<li><a href='.base_url("comptabilite/Soumission/get_selection/").$value["DEMANDE_ID"].'>selection</a></li></ul></div>';  
         // $data['option'].='<li><a href='.base_url("CrReunion/CrReunion/update/").$reunion["idReunion"].'>Modifier</li>';
        }
    $resultat[]=$data;
    }
  
    $template=array(
        'table_open'=>'<table id="mytable" class="table table-bordered table-stripped table-hover table-condensed table-responsive">',
        '<table_close'=>'</table>'
        );
      
        $this->table->set_heading('DATE','COMMANDE CODE','PRODUCTS','BIDDERS SUBMIT','SUCCESSFUL BIDDER','Action');
        $this->table->set_template($template);
        
    $datas['table']=$resultat;
    $this->make_bread->add('commande listing ', "comptabilite/Soumission", 1);
    $datas['breadcrumb'] = $this->make_bread->output();
   //print_r( $resultat);
    $this->load->view('soumission_view/Soumission_view',$datas);
  }



//alexis
public function deja_lance(){
        $datas['title'] = "The submissions";
    $is_commande=$this->Model->getList('approv_demande',array('IS_COMMANDE'=>1,'IS_APPLIED'=>1));

    $resultat=array();
    foreach ($is_commande as $value) {

      $demande_detail=$this->Model->getList('approv_demande_detail',array('DEMANDE_CODE'=>$value['DEMANDE_CODE']));
      // $xt=$this->Model->getOne('approv_produit',array('PRODUIT_ID'=>$demande_detail['PRODUIT_ID']));
      // echo $demande_detail['PRODUIT_ID'];exit();
     $data=Null;
        $data[]=$value['DATE_INSERTION'];
        $data[]=$value['DEMANDE_CODE'];
$prdt="";

       foreach ($demande_detail as $key) {
          $xt=$this->Model->getOne('approv_produit',array('PRODUIT_ID'=>$key['PRODUIT_ID']));

        $prdt.="<tr><td>".$xt['PRODUIT_NOM']."</td><td>".$key['QUANTITE_BON_COMMANDE']."</td></tr>";
       }

        
          $data[]="<a href='#' data-toggle='modal' 
                                  data-target='#sos". $value['DEMANDE_ID'] . "'>".sizeof($demande_detail)."</a>
                                    <div class='modal fade' id='sos".$value['DEMANDE_ID'] ."'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>

                                                <div class='modal-body'>
                                                    <table class='table table-bordered'>
                                                    <tr><th>PRODUCT NAME</th><th>QUANTITY</th></tr>" .$prdt. "</table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>";
        // $data[]=$demande_detail['QUANTITE_BON_COMMANDE'];

        $smsionaire_rel=$this->Model->getList('approv_soumission_commande',array('DEMANDE_ID'=>$value['DEMANDE_ID']));
        $sct='';
        foreach ($smsionaire_rel as $val) {
           $smsionaire=$this->Model->getOne('approv_soummissionaire',array('ID_SOUMISSIONAIRE'=>$val['SOUMMISSIONAIRE_ID']));
      $sct.="<tr><td>".$smsionaire['NOM_SOUMMISSIONAIRE']."</td><td>".$smsionaire['PRENOM_SOUMMISSIONAIRE']."</td><td>".$smsionaire['TEL_SOUMMISSIONAIRE']."</td><td>".$smsionaire['ADRESSE_SOUMMISSIONAIRE']."</td><td>".$val['MONTANT_FOURNISSEUR']."</td><td>".$val['DATE_LIVRAISON']."</td></tr>";
        }
        

        $data[]="<a href='#' data-toggle='modal' 
                                  data-target='#so". $value['DEMANDE_ID'] . "'>".sizeof($smsionaire_rel)."</a>
                                    <div class='modal fade' id='so".$value['DEMANDE_ID'] ."'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>

                                                <div class='modal-body'>
                                                    <table class='table table-bordered'>
                                                    <tr><th>NAME</th><th>LAST NAME</th><th>TELEPHONE</th><th>ADRESSE</th><th>AMOUNT REQUIRED</th><th>DEADLINE</th></tr>" .$sct. "</table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>";
     //$data[]=$part;
   
   $selected=$this->Model->getOne('approv_soumission_commande',array('DEMANDE_ID'=>$value["DEMANDE_ID"],'IS_SELECTED'=>1));

   if( $selected){
    $is_selected=$this->Model->getOne('approv_soummissionaire',array('ID_SOUMISSIONAIRE'=>$selected['SOUMMISSIONAIRE_ID']));
    $data[]=$is_selected['NOM_SOUMMISSIONAIRE']." ".$is_selected['PRENOM_SOUMMISSIONAIRE']." ".$is_selected['TEL_SOUMMISSIONAIRE'];
   }else{ $data[]="NOT YET SELECTED"; }

// if($value["IS_APPLIED"]==1){
//                              $data['option']="-";
//                       }else{
// $data['option']='<div class="dropdown ">
//                     <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Action
//                     <span class="caret"></span></a>
//                     <ul class="dropdown-menu dropdown-menu-left">';
//          $data['option'].='<li><a href='.base_url("comptabilite/Soumission/get_soummission/").$value["DEMANDE_ID"].'>submission</a></li>';
//         $data['option'].='<li><a href='.base_url("comptabilite/Soumission/get_selection/").$value["DEMANDE_ID"].'>selection</a></li></ul></div>';  
//          // $data['option'].='<li><a href='.base_url("CrReunion/CrReunion/update/").$reunion["idReunion"].'>Modifier</li>';
//         }
    $resultat[]=$data;
    }
  
    $template=array(
        'table_open'=>'<table id="mytable" class="table table-bordered table-stripped table-hover table-condensed table-responsive">',
        '<table_close'=>'</table>'
        );
      
        $this->table->set_heading('DATE','COMMANDE CODE','PRODUCTS','BIDDERS SUBMIT','SUCCESSFUL BIDDER');
        $this->table->set_template($template);
        
    $datas['table']=$resultat;
    $this->make_bread->add('commande listing ', "comptabilite/Soumission", 1);
    $datas['breadcrumb'] = $this->make_bread->output();
   //print_r( $resultat);
    $this->load->view('soumission_view/Soumission_view1',$datas);
}

  public function get_soummission()
  { 
        
        $demande_id=$this->uri->segment(4);
        $data['soumissio']=$this->Model->getListOrder('approv_soummissionaire','NOM_SOUMMISSIONAIRE');
       
        $datelivraiso=new DateTime();
        $data['DATE_LIVRAISON']=$datelivraiso->format('d/m/Y');

        $data['demande'] = $this->Model->getOne('approv_demande', array('DEMANDE_ID' => $demande_id));
        $data['utilisateur'] = $this->Model->getOne('admin_utilisateurs', array('UTILISATEUR_ID' => $data['demande']['UTILISATEUR_ID']));
        $data['service'] = $this->Model->getOne('admin_service', array('SERVICE_CODE' => $data['demande']['SERVICE_CODE']));
        $details = $this->Model->getList('approv_demande_detail', array('DEMANDE_CODE' => 'DM_' . $demande_id));

        $array_details = array();
        if (!empty($details)) {
            foreach ($details as $detail) {
                $undetail = NULL;
                $detail_info = $this->Model->getOne('approv_produit', array('PRODUIT_ID' => $detail['PRODUIT_ID']));
                $idcommande= $this->Model->getOne('approv_demande', array('DEMANDE_CODE' => $detail['DEMANDE_CODE']));

                $undetail['produit_non'] = $detail_info['PRODUIT_NOM'];
                $undetail['qty_demande'] = $detail['QUANTITE_DEMMANDE'];
                $undetail['qty_commande'] = $detail['QUANTITE_BON_COMMANDE'];
             

                $array_details[] = $undetail;
            }
        }

        $data['array_details'] = $array_details;
        $data['title'] = "Items of a request";
        $data['breadcrumb'] = $this->make_bread->output();
        $this->load->view('soumission_view/Soummission_add_view',$data);

  }

  public function addnew()
   {

        $data=array(
         'NOM_SOUMMISSIONAIRE'=>$this->input->post('NOM'),
         'PRENOM_SOUMMISSIONAIRE'=>$this->input->post('PRENOM'),
         'TEL_SOUMMISSIONAIRE'=>$this->input->post('TEL'),
         'ADRESSE_SOUMMISSIONAIRE'=>$this->input->post('ADDRESSE'),

        );
        $this->Model->create('approv_soummissionaire',$data);
        $datas['message']='<div class="alert alert-success text-center">'."Addition of a new submitter ".$this->input->post('NOM')." ".$this->input->post('PRENOM')." done successfully".'</div>';
        $this->session->set_flashdata($datas);
        
        $demande_id=$this->input->post('DEMANDE_ID');
       $data['soumissio']=$this->Model->getListOrder('approv_soummissionaire','NOM_SOUMMISSIONAIRE');
       
        $datelivraiso=new DateTime();
        $data['DATE_LIVRAISON']=$datelivraiso->format('d/m/Y');

        $data['demande'] = $this->Model->getOne('approv_demande', array('DEMANDE_ID' => $demande_id));
        $data['utilisateur'] = $this->Model->getOne('admin_utilisateurs', array('UTILISATEUR_ID' => $data['demande']['UTILISATEUR_ID']));
        $data['service'] = $this->Model->getOne('admin_service', array('SERVICE_CODE' => $data['demande']['SERVICE_CODE']));
        $details = $this->Model->getList('approv_demande_detail', array('DEMANDE_CODE' => 'DM_' . $demande_id));

        $array_details = array();
        if (!empty($details)) {
            foreach ($details as $detail) {
                $undetail = NULL;
                $detail_info = $this->Model->getOne('approv_produit', array('PRODUIT_ID' => $detail['PRODUIT_ID']));

                $undetail['produit_non'] = $detail_info['PRODUIT_NOM'];
                $undetail['qty_demande'] = $detail['QUANTITE_DEMMANDE'];
                $undetail['qty_commande'] = $detail['QUANTITE_BON_COMMANDE'];
             

                $array_details[] = $undetail;
            }
        }

        $data['array_details'] = $array_details;
        $data['title'] = "Items of a request";
	     $data['DATE_LIVRAISON']=$datelivraiso->format('d/m/Y');
       $data['breadcrumb'] = $this->make_bread->output();

        $this->load->view('soumission_view/Soummission_add_view',$data);
       
        
   }


  public function soummissioner()
      {

          $this->form_validation->set_rules('ID_SOUMMISSIONAIRE','submitter','required');

          if($this->form_validation->run()==TRUE)
              {
                 
                  $demande_id=$this->input->post('DEMANDE_ID');
                      $data=array(
                   'SOUMMISSIONAIRE_ID'=>$this->input->post('ID_SOUMMISSIONAIRE'),
                   'DEMANDE_ID'=>$this->input->post('DEMANDE_ID'),
                   'MONTANT_FOURNISSEUR'=>$this->input->post('MONTANT_FOURNISSEUR'),
                   'DATE_LIVRAISON'=>$this->input->post('DATE_LIVRAISON'),
                  );
                     
                  $this->Model->create('approv_soumission_commande',$data);
                  $data['message']='<div class="alert alert-success text-center"> Submission done successfully</div>';
                  $this->session->set_flashdata($data);
                  redirect(base_url('comptabilite/Soumission'));

      

            }
            else
            {

        $demande_id=$this->input->post('DEMANDE_ID');
        $data['soumissio']=$this->Model->getListOrder('approv_soummissionaire','NOM_SOUMMISSIONAIRE');
       
        $datelivraiso=new DateTime();
        $data['DATE_LIVRAISON']=$datelivraiso->format('d/m/Y');

        $data['demande'] = $this->Model->getOne('approv_demande', array('DEMANDE_ID' => $demande_id));
        $data['utilisateur'] = $this->Model->getOne('admin_utilisateurs', array('UTILISATEUR_ID' => $data['demande']['UTILISATEUR_ID']));
        $data['service'] = $this->Model->getOne('admin_service', array('SERVICE_CODE' => $data['demande']['SERVICE_CODE']));
        $details = $this->Model->getList('approv_demande_detail', array('DEMANDE_CODE' => 'DM_' . $demande_id));

        $array_details = array();
        if (!empty($details)) {
            foreach ($details as $detail) {
                $undetail = NULL;
                $detail_info = $this->Model->getOne('approv_produit', array('PRODUIT_ID' => $detail['PRODUIT_ID']));

                $undetail['produit_non'] = $detail_info['PRODUIT_NOM'];
                $undetail['qty_demande'] = $detail['QUANTITE_DEMMANDE'];
                $undetail['qty_commande'] = $detail['QUANTITE_BON_COMMANDE'];
             

                $array_details[] = $undetail;
            }
        }

        $data['array_details'] = $array_details;
        $data['title'] = "Items of a request";
       $data['DATE_LIVRAISON']=$datelivraiso->format('d/m/Y');
       $data['breadcrumb'] = $this->make_bread->output();

        $this->load->view('soumission_view/Soummission_add_view',$data);

            }
     



      }

      public function add_produit()
      {
    $qty=$this->input->post('qty_commande');
    $DEMANDE_CODE=$this->uri->segment(4);
    $demande = $this->Model->getOne('approv_demande',array('DEMANDE_ID'=>$DEMANDE_CODE));

    $produitdetail = $this->Model->getOne('approv_demande_detail',array('DEMANDE_CODE'=>$demande['DEMANDE_CODE']));
    $produit=$this->Model->getOne('approv_produit',array('PRODUIT_ID'=>$DEMANDE_CODE));

    $array = array('id'=>$produit['PRODUIT_ID'],
                    'qty'=>$qty,
                    'price'=>1,
                    'id_commande'=>$demande['DEMANDE_ID'],
                    'name'=>$produit['PRODUIT_NOM']);
    $this->cart->insert($array);



//redirect

    if($this->cart->insert($array))
    {

        $demande_id=$this->input->post('DEMANDE_ID');
      
        $data['soumissio']=$this->Model->getList('approv_soummissionaire',array());
       
        $datelivraiso=new DateTime();
        $data['DATE_LIVRAISON']=$datelivraiso->format('d/m/Y');

        $data['demande'] = $this->Model->getOne('approv_demande', array('DEMANDE_ID' => $demande_id));
        $data['utilisateur'] = $this->Model->getOne('admin_utilisateurs', array('UTILISATEUR_ID' => $data['demande']['UTILISATEUR_ID']));
        $data['service'] = $this->Model->getOne('admin_service', array('SERVICE_CODE' => $data['demande']['SERVICE_CODE']));
        $details = $this->Model->getList('approv_demande_detail', array('DEMANDE_CODE' => 'DM_' . $demande_id));

        $array_details = array();
        if (!empty($details)) {
            foreach ($details as $detail) {
                $undetail = NULL;
                $detail_info = $this->Model->getOne('approv_produit', array('PRODUIT_ID' => $detail['PRODUIT_ID']));
                $idcommande= $this->Model->getOne('approv_demande', array('DEMANDE_CODE' => $detail['DEMANDE_CODE']));

                $undetail['produit_non'] = $detail_info['PRODUIT_NOM'];
                $undetail['qty_demande'] = $detail['QUANTITE_DEMMANDE'];
                $undetail['qty_commande'] = $detail['QUANTITE_BON_COMMANDE'];
                $undetail['id_produit'] = $detail_info['PRODUIT_ID'];
                $undetail['qty_livre'] = $detail['QUANTITE_LIVRE'];
                $undetail['id_commande'] = $idcommande['DEMANDE_ID'];

                $array_details[] = $undetail;
            }
        }

        $data['array_details'] = $array_details;
        $data['title'] = "Items of a request";
        $data['breadcrumb'] = $this->make_bread->output();
        $this->load->view('soumission_view/Soummission_add_view',$data);


    }


     
      }


    public function remove()
  {
    $array = array('id'=>$this->uri->segment(4),
                    'qty'=>0);
    

   if($this->cart->update($array))
   {

        $demande_id=$this->uri->segment(4);
      
        $data['soumissio']=$this->Model->getList('approv_soummissionaire',array());
       
        $datelivraiso=new DateTime();
        $data['DATE_LIVRAISON']=$datelivraiso->format('d/m/Y');

        $data['demande'] = $this->Model->getOne('approv_demande', array('DEMANDE_ID' => $demande_id));
        $data['utilisateur'] = $this->Model->getOne('admin_utilisateurs', array('UTILISATEUR_ID' => $data['demande']['UTILISATEUR_ID']));
        $data['service'] = $this->Model->getOne('admin_service', array('SERVICE_CODE' => $data['demande']['SERVICE_CODE']));
        $details = $this->Model->getList('approv_demande_detail', array('DEMANDE_CODE' => 'DM_' . $demande_id));

        $array_details = array();
        if (!empty($details)) {
            foreach ($details as $detail) {
                $undetail = NULL;
                $detail_info = $this->Model->getOne('approv_produit', array('PRODUIT_ID' => $detail['PRODUIT_ID']));
                $idcommande= $this->Model->getOne('approv_demande', array('DEMANDE_CODE' => $detail['DEMANDE_CODE']));

                $undetail['produit_non'] = $detail_info['PRODUIT_NOM'];
                $undetail['qty_demande'] = $detail['QUANTITE_DEMMANDE'];
                $undetail['qty_commande'] = $detail['QUANTITE_BON_COMMANDE'];
                $undetail['id_produit'] = $detail_info['PRODUIT_ID'];
                $undetail['qty_livre'] = $detail['QUANTITE_LIVRE'];
                $undetail['id_commande'] = $idcommande['DEMANDE_ID'];

                $array_details[] = $undetail;
            }
        }

        $data['array_details'] = $array_details;
        $data['title'] = "Items of a request";
        $data['breadcrumb'] = $this->make_bread->output();
        $this->load->view('soumission_view/Soummission_add_view',$data);

   }

  
  
  }

public function get_selection($id){
  $datas['title'] = "The selection";
    $demande_id=$id;
    $soumissionaire=$this->Model->getList('approv_soumission_commande',array('DEMANDE_ID'=>$demande_id));
    $demande=$this->Model->getOne('approv_demande',array('DEMANDE_ID'=>$demande_id));
    $resultat=array();

    
    foreach ($soumissionaire as $valu) {
      $soumis=$this->Model->getOne('approv_soummissionaire',array('ID_SOUMISSIONAIRE'=>$valu['SOUMMISSIONAIRE_ID']));

      $data=Null;
      $data[]=$soumis['NOM_SOUMMISSIONAIRE']." ".$soumis['PRENOM_SOUMMISSIONAIRE']." ".$soumis['TEL_SOUMMISSIONAIRE'];
      $data[]=$valu['MONTANT_FOURNISSEUR'];
      $data[]=$valu['DATE_LIVRAISON'];
      $data[]="<input type='radio' class='select' id='select".$soumis['ID_SOUMISSIONAIRE']."' name='select' value='".$soumis['ID_SOUMISSIONAIRE']."'>";

       $resultat[]=$data;
    }
     
  
    $template=array(
        'table_open'=>'<table id="mytable" class="table table-bordered table-stripped table-hover table-condensed table-responsive">',
        '<table_close'=>'</table>'
        );
      
        $this->table->set_heading('BIDDERS SUBMIT','Amount','Deadline','check');
        $this->table->set_template($template);
        
    $datas['table']=$resultat;
    $datas['demande_id']=$demande_id;
    $datas['budget_provisoire']=$demande['BUDGET_PROVISOIRE'];
    $this->make_bread->add('commande listing ', "comptabilite/Soumission", 1);
    $datas['breadcrumb'] = $this->make_bread->output();
   //print_r( $resultat);
    $this->load->view('soumission_view/Selection_view',$datas);
  }

  public function soumissionaire(){
    $id=$_POST['id'];
    $soumissionaire=$this->Model->getOne('approv_soummissionaire',array('ID_SOUMISSIONAIRE'=>$id));
    echo $soumissionaire['NOM_SOUMMISSIONAIRE']." ".$soumissionaire['PRENOM_SOUMMISSIONAIRE'];
  }

  public function is_applied(){
    $id=$_POST['id'];
    $demande_id=$_POST['demande_id'];

    $this->Model->update('approv_demande',array('DEMANDE_ID'=>$demande_id),array('IS_APPLIED'=>1));
    $this->Model->update('approv_soumission_commande',array('SOUMMISSIONAIRE_ID'=>$id),array('IS_SELECTED'=>1));
  }

  public function take_in_stock($produit_id,$qte_commander,$qte_disponible,$demande_code,$service_id){
  $datas['title'] = "Take in stock";
    // $xt=$this->Model->getOne('approv_produit',array('PRODUIT_ID'=>$key['PRODUIT_ID']));
    if($qte_disponible<$qte_commander){
      $data['msg']='<div class="alert alert-danger text-center">Echec! stock is not available</div>';
        $this->session->set_flashdata($data);
        redirect(base_url('demande/Order'));
    }else{
       $xt=$this->Model->getOne('approv_produit',array('PRODUIT_ID'=>$produit_id));
       $datas['produit_id'] = $produit_id;
       $datas['produit_nom'] = $xt["PRODUIT_NOM"];
       $datas['qte_commander'] = $qte_commander;
       $datas['qte_disponible'] = $qte_disponible;
    //    $this->make_bread->add('Take in stock ', "take_in_stock/".$produit_id."/".$qte_commander."/".$qte_disponible, 1);
    // $datas['breadcrumb'] = $this->make_bread->output();
    //    $this->load->view('soumission_view/Take_in_stock',$datas);

       $this->Model->update('approv_demande_detail',array('PRODUIT_ID'=>$produit_id,'DEMANDE_CODE'=>$demande_code),array('QUANTITE_LIVRE'=>$qte_commander,'IS_LIVRE'=>1));
$reste=$qte_disponible-$qte_commander;

$this->Model->update('approv_produit',array('PRODUIT_ID'=>$produit_id),array('QUANTITE_DISPONIBLE'=>$reste));
$this->Model->create('stock_historique',array('PRODUIT_ID'=>$produit_id,'SORTANT_ENTRANT'=>'SORTIE','DATE_TIME'=>date('Y-d-m H:i:s'),'QUANTITE'=>$qte_commander,'SERVICE_ID'=>$service_id));

 $details= $this->Model->getList('approv_demande_detail', array('DEMANDE_CODE' => $demande_code,'IS_LIVRE'=>0));
if(sizeof($details)==0){
  $this->Model->update('approv_demande',array('DEMANDE_CODE' => $demande_code),array('IS_COMMANDE'=>1,'IS_COMMANDE_DATE'=>date('Y-d-m H:i:s'),'IS_DELIVERED'=>1,'DELIVERY_DATE'=>date('Y-d-m H:i:s')));
}
  
       $data['msg']='<div class="alert alert-success text-center">'.$qte_commander.' '.$xt["PRODUIT_NOM"].' taken in stock </div>';
       $this->session->set_flashdata($data);
        redirect(base_url('demande/Order')); 
    }
  }
  public function take_in_stock1(){

  }
}