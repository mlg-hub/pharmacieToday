<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Soumis extends CI_Controller
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
    $demande_id=5;
    $soumissionaire=$this->Model->getList('approv_soumission_commande',array('DEMANDE_ID'=>$demande_id));

    $resultat=array();

    
    foreach ($soumissionaire as $valu) {
      $soumis=$this->Model->getOne('approv_soummissionaire',array('ID_SOUMISSIONAIRE'=>$valu['SOUMMISSIONAIRE_ID']));

      $data=Null;
      $data[]=$soumis['NOM_SOUMMISSIONAIRE']." ".$soumis['PRENOM_SOUMMISSIONAIRE']." ".$soumis['TEL_SOUMMISSIONAIRE'];
      $data[]="<input type='radio' class='select' id='select".$soumis['ID_SOUMISSIONAIRE']."' name='select' value='".$soumis['ID_SOUMISSIONAIRE']."'>";

       $resultat[]=$data;
    }
     
  
    $template=array(
        'table_open'=>'<table id="mytable" class="table table-bordered table-stripped table-hover table-condensed table-responsive">',
        '<table_close'=>'</table>'
        );
      
        $this->table->set_heading('BIDDERS SUBMIT','check');
        $this->table->set_template($template);
        
    $datas['table']=$resultat;
    $datas['demande_id']=$demande_id;
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
}
?>