<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Traitement_Demande extends CI_Controller {

	 public function __construct() {
           parent::__construct();
           //$this->is_Oauth();
           $this->make_bread->add('Usage', "traitement_demande/Traitement_Demande/listing", 0);
           $this->breadcrumb = $this->make_bread->output();
        
        //$this->have_autorisation();     
    }
    // public function is_Oauth()
    // {
    //    if($this->session->userdata('RH_PERSONNEL_LOGIN') == NULL)
    //     redirect(base_url());
    // }
    public function listing()
    {
    $data['title'] = "The requests";
    $id_produit=$this->uri->segment(4);
    $detail=$this->Model->getList('approv_demande_detail', array('PRODUIT_ID'=>$id_produit));
    
    $list=array(); 
    
    $data["table"]='';
    
    $data["table"] ="<table id='mytable' class='table table-hover table-bordered table-condensed table-striped'><thead><tr><th>Product</th><th>Statute</th><th>Service</th><th>Is command?</th><th>Date</th><th>Action</th></tr></thead><tbody>";
    foreach ($detail as $key) {
      $list_detail=$this->Model->getList('approv_demande',array('DEMANDE_CODE'=>$key['DEMANDE_CODE']));
      //$detail=$this->Model->getList('approv_demande_detail', array('PRODUIT_ID'=>$id_produit));
    
      
       foreach ($list_detail as $b) {
        $a=$this->Model->getOne('statut_approb', array('STATUT_APPROB_CODE'=>$b['STATUT_APPROB_ID']));
        $produit=$this->Model->getOne('approv_produit',array('PRODUIT_ID'=>$key['PRODUIT_ID']));
        $service=$this->Model->getOne('admin_service',array('SERVICE_CODE'=>$b['SERVICE_CODE']));
        if($b['IS_COMMANDE']==1)
        {
          $comm='YES';
        }else{
          $comm='NONE';
        }

        $data["table"] .= '<tr><td>'.$produit['PRODUIT_NOM'].'</td><td>'.$a['STATUT_APPROB_NOM'].'</td><td>'.$service['SERVICE_NOM'].'</td><td>'.$comm.'</td><td>'.$b['DATE_INSERTION'].'</td>
              <td>
                  <div class="dropdown ">
                    <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Action
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-left">
                    ';
      
          $data["table"] .= '<li><a href='.base_url("traitement_demande/Traitement_Demande/details/").$b["DEMANDE_ID"].'>Details</li>';
         //  $x=$this->Model->checkvalue('approv_demande',array('DEMANDE_CODE'=>$b["DEMANDE_CODE"]));
         // if($x['IS_COMMANDE']!=1){
        $data["table"] .= '<li><a href='.base_url("traitement_demande/Traitement_Demande/commande/").$b["DEMANDE_ID"].'>Command</li>
          ';
          //}
        } 
              
                       
                           $data["table"] .=  '


                    </ul>
                  </div>
              </td>
          </div>
          </div>
          </td></tr>

          ';        
     }      
    
     $data["table"] .= "</tbody></table>";
     $this->make_bread->add('Active', "traitement_demande/Traitement_Demande/listing", 0);
    $data['breadcrumb'] = $this->make_bread->output();
    $this->load->view('traitement_demande_view',$data); 
  }
  public function details(){
    $id=$this->uri->segment(4);
    $approv=$this->Model->getOne('approv_demande',array('DEMANDE_ID'=>$id));
    $datas['demande']=$approv;

    $this->make_bread->add('Detail ', "Traitement_Demande/details/".$id, 0);
    $datas['breadcrumb'] = $this->make_bread->output();
    $datas['title'] = "The treatment";
    $this->load->view('traitement_demande/traitement_demande_detail_view',$datas);

  }
  public function approuve(){

          $criteres=$this->uri->segment(4);
          $data=array('STATUT_APPROB_ID'=>1);
          $critere=array('DEMANDE_ID'=>$criteres);
                  
          $table='approv_demande';
          $resultat=$this->Model->update_table($table,$critere,$data);

          if($resultat)
          {  
          $data['message']='<div class="alert alert-success text-center">Approve status</div>';
          $this->session->set_flashdata($data);
          $this->index();
            }else{
            $data['message']='<div class="alert alert-danger text-center">Failure</div>';
            $this->session->set_flashdata($data);
            $data['breadcrumb'] = $this->make_bread->output(); 
            $this->index();
        }
  }
  public function rejette(){

          $criteres=$this->uri->segment(4);
          $data=array('STATUT_APPROB_ID'=>2);
          $critere=array('DEMANDE_ID'=>$criteres);
                  
          $table='approv_demande';
          $resultat=$this->Model->update_table($table,$critere,$data);

          if($resultat)
          {  
          $data['message']='<div class="alert alert-success text-center">Reject status</div>';
          $this->session->set_flashdata($data);
          $this->index();
            }else{
            $data['message']='<div class="alert alert-danger text-center">Failure</div>';
            $this->session->set_flashdata($data);
            $data['breadcrumb'] = $this->make_bread->output(); 
            $this->index();
        }
      }
      public function commande()
     {
        
        // $id['DEMANDE_ID']=$this->uri->segment(4);
        // $data['quantite']=$this->Model->getOne('approv_demande',$id);
        // $this->make_bread->add('Command', "traitement_demande/Traitement_Demande/commande/".$id['DEMANDE_ID'], 0);
        // $data['breadcrumb'] = $this->make_bread->output();
        // $this->load->view('traitement_demande/traitement_demande_command_view',$data);
     // $this->cart->destroy();
     $demande_id = $this->uri->segment(4);

      $approv_commande=$this->Model->getOne('approv_demande',array('DEMANDE_ID'=>$demande_id));
 $demandes_details=$this->Model->getList('approv_demande_detail',array('DEMANDE_CODE'=>$approv_commande['DEMANDE_CODE']));



     
     //$array['CODE']=$key['DEMANDE_CODE'];
      //exit();
          // $liste_des_diligences = " ";
           
            foreach ($demandes_details as $diligence) {
                
                $produits = $this->Model->getOne('approv_produit',array('PRODUIT_ID'=>$diligence['PRODUIT_ID']));

                //$liste_des_diligences .= $diligence['DEMANDE_CODE'];
            //print_r($diligence); exit();
          
     $details = $this->Model->getOne('approv_demande',array('DEMANDE_ID'=>$demande_id));//print_r($details);
     //$demande_detail=$this->Model->getOne('approv_demande_detail', array('DEMANDE_CODE'=>$details['DEMANDE_CODE']));
    ;
   }
    $array_details =array();
    //$liste_des_diligences = " ";
    //if(!empty($details)){
            //$detail_info = $this->Model->getOne('approv_produit',array('PRODUIT_ID'=>$demande_detail['PRODUIT_ID']));
     // }
       // $liste_des_diligences .= "<tr><td>".$produits['PRODUIT_NOM']."</td><td>".$diligence['QUANTITE_COMMANDE']."</td></tr>"; 
    //$data['prod']=$diligence;
    $data['row'] = $demandes_details;
    $data['breadcrumb'] = $this->make_bread->output();
    $data['title'] = "Edit a request";
    $this->load->view('traitement_demande/traitement_demande_command_view',$data);

     }
      public function is_command()
      {
        $id=$this->uri->segment(4);
        // $qty=$this->input->post('quantite');
        $demande_code=$this->input->post('demande_code');
        $demande=$this->Model->getOne('approv_demande_detail',array('DEMANDE_CODE'));
        $data=array(
                    'IS_COMMANDE'=>1
                  );
        $critere=array('DEMANDE_ID'=>$id);
        $table='approv_demande';
        $result=$this->Model->update_table($table,$critere,$data);
        $datasel= $this->Model->getOne('approv_demande',$critere);

         // if($result)
         // {

           // $data=array('QUANTITE_COMMANDE'=>$qty);
         //   $criteres=array('DEMANDE_CODE'=>$demande_code);
          $contr=$this->Model->getList('approv_demande_detail',array('DEMANDE_CODE'=>$datasel['DEMANDE_CODE']));
          foreach ($contr as $keys) {
            # code...
            /*$donnee = array('QUANTITE_COMMANDE'=>$keys['QUANTITE_COMMANDE']);
            $this->Model->update_table('approv_demande_detail',array('DEMANDE_CODE'=>$datasel['DEMANDE_CODE']), $donnee);*/
            // $this->Model->update_table('approv_demande', array('DEMANDE_ID' => $demande_id), $donnee);
          echo $datasel['DEMANDE_CODE'];
          echo '</br>';
          echo $keys['QUANTITE_COMMANDE'];
          }

         //  if($contr['QUANTITE_DEMMANDE']>=$qty and $qty>0)
         //  {
         //   $table='approv_demande_detail';
         //   $resultat=$this->Model->update_table($table,$criteres,$data);
         //   if($resultat==true)
         //   {
          // $data['message']='<div class="alert alert-success text-center">Successful order</div>';
          // $this->session->set_flashdata($data);
          // $this->index();
         //    }else{
         //    $data['message']='<div class="alert alert-danger text-center">Failure</div>';
         //    $this->session->set_flashdata($data);
         //    $data['breadcrumb'] = $this->make_bread->output(); 
         //    $this->index();
         //   }

         // }else{
         //    $data['message']='<div class="alert alert-danger text-center">Please insert the valid lower quantity</div>';
         //  $this->session->set_flashdata($data);
         //  $this->index();
         // }
         // }
        //print_r($data);
      }

      function index(){


       $approv_soumission_commande=$this->Model->getList('approv_demande',array('STATUT_APPROB_ID'=>0));

        
        $phases_list = array();
        foreach ($approv_soumission_commande as $key) {
            $array = NULL;

         $array['CODE']=$key['DEMANDE_CODE'];
         $demandes_details=$this->Model->getList('approv_demande_detail',array('DEMANDE_CODE'=>$key['DEMANDE_CODE']));
           $liste_des_diligences = " ";
           
            foreach ($demandes_details as $diligence) {
                
                $produits = $this->Model->getOne('approv_produit',array('PRODUIT_ID'=>$diligence['PRODUIT_ID']));

              $liste_des_diligences .= "<tr><td>".$produits['PRODUIT_NOM']."</td><td>".$diligence['QUANTITE_DEMMANDE']."</td></tr>";  
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

            //$array['choix']=' <input type="checkbox" name="options[]" value="'.$key['DEMANDE_ID'].'" >';
                $array['choix']='
                  <div class="dropdown ">
                    <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Action
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-left">
                    ';
      
          $array["choix"] .= '<li><a href='.base_url("traitement_demande/Traitement_Demande/details/").$key["DEMANDE_ID"].'>Treat</li>';
         //  $x=$this->Model->checkvalue('approv_demande',array('DEMANDE_CODE'=>$b["DEMANDE_CODE"]));
         // if($x['IS_COMMANDE']!=1){
        // $array["choix"] .= '<li><a href='.base_url("traitement_demande/Traitement_Demande/commande/").$key["DEMANDE_ID"].'>Command</li>
          // ';
             
            $phases_list[] =$array;
          
              }

             
       

         $template = array(
            'table_open' => '<table id="mytable" class="table table-bordered table-striped table-hover table-condensed table-responsive">',
            'table_c
            lose' => '</table>'
        );

        $this->table->set_heading('Bidder','Number of product (s)','');
        $this->table->set_template($template);
         $data['command_list'] = $phases_list;
         
        
       $this->make_bread->add('Active', "traitement_demande/Traitement_Demande/index", 0);
    $data['breadcrumb'] = $this->make_bread->output();
    $data['title'] = "The treatment";
    $this->load->view('traitement_demande_prod_view',$data);     
      }

}