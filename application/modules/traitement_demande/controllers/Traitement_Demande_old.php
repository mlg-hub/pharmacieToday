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
    public function index()
    {
      //echo $this->session->userdata['CASEHOSP_SERVICE_CODE'];

    $data['title'] = "The requests";
  
    $list_detail=$this->Model->getList('approv_demande');
    $list=array(); 
    
    $data["table"]='';
    
    $data["table"] ="<table id='mytable' class='table table-hover table-bordered table-condensed table-striped'><thead><tr><th>Product</th><th>Statute</th><th>Service</th><th>Level</th><th>Date</th><th>Action</th></tr></thead><tbody>";
    foreach ($list_detail as $key) {
      
      $detail=$this->Model->getList('approv_demande_detail', array('DEMANDE_CODE'=>$key['DEMANDE_CODE']));
    
      $a=$this->Model->getOne('statut_approb', array('STATUT_APPROB_CODE'=>$key['STATUT_APPROB_ID']));
       foreach ($detail as $b) {

        $produit=$this->Model->getOne('approv_produit',array('PRODUIT_ID'=>$b['PRODUIT_ID']));
        $service=$this->Model->getOne('admin_service',array('SERVICE_CODE'=>$key['SERVICE_CODE']));
        //$produit['PRODUIT_ID']!=$b['PRODUIT_ID'])

        $data["table"] .= '<tr><td>'.$produit['PRODUIT_NOM'].'</td><td>'.$a['STATUT_APPROB_NOM'].'</td><td>'.$service['SERVICE_NOM'].'</td><td>'.$key['NIVEAU_VALIDATION'].'</td><td>'.$key['DATE_INSERTION'].'</td>
              <td>
                  <div class="dropdown ">
                    <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Action
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-left">
                    ';
      
          $data["table"] .= '<li><a href='.base_url("traitement_demande/Traitement_Demande/details/").$key["DEMANDE_ID"].'>Details</li>
            <li><a href='.base_url("traitement_demande/Traitement_Demande/commande/").$key["DEMANDE_ID"].'>Command</li>
          ';
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

    $this->make_bread->add('Détail ', "Traitement_Demande/details/".$id, 0);
    $datas['breadcrumb'] = $this->make_bread->output();
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
            $data['message']='<div class="alert alert-danger text-center">Echec</div>';
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
            $data['message']='<div class="alert alert-danger text-center">Echec</div>';
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
      $this->cart->destroy();
     $demande_id = $this->uri->segment(4);
     $details = $this->Model->getOne('approv_demande',array('DEMANDE_ID'=>$demande_id));
     $demande_detail=$this->Model->getOne('approv_demande_detail', array('DEMANDE_CODE'=>$details['DEMANDE_CODE']));

    $array_details =array();
    if(!empty($details)){
        $undetail = NULL;
            $detail_info = $this->Model->getOne('approv_produit',array('PRODUIT_ID'=>$demande_detail['PRODUIT_ID']));

        $undetail['name'] = $detail_info['PRODUIT_NOM'];
        $undetail['qty'] = $demande_detail['QUANTITE_DEMMANDE'];
        $undetail['qty1'] = $demande_detail['QUANTITE_COMMANDE'];
        $undetail['price'] = 1;
        $undetail['id'] = $demande_id;
        $undetail['demande_code'] = $demande_detail['DEMANDE_CODE'];

        $this->cart->insert($undetail);
      }
    $data['demande_id'] = $demande_id;
    $data['breadcrumb'] = $this->make_bread->output();
    $data['title'] = "Edit a request";
    $this->load->view('traitement_demande/traitement_demande_command_view',$data);

     }
      public function is_command()
      {
        $id=$this->uri->segment(4);
        $qty=$this->input->post('quantite');
        $demande_code=$this->input->post('demande_code');
        $demande=$this->Model->getOne('approv_demande_detail',array('DEMANDE_CODE'));
        $data=array('DEMANDE_ID'=>$id,
                    'DEMANDE_CODE'=>$demande_code,
                    'IS_COMMANDE'=>1
                  );
        $criteres=$id;
        $table='approv_demande';
        $result=$this->Model->update($table,$criteres,$data);
         if($result)
         {
           $data=array('QUANTITE_COMMANDE'=>$qty);
           $criteres=$demande_code;
           $table='approv_demande_detail';
           $resultat=$this->Model->update($table,$criteres,$data);
           if($resultat==true)
           {
          $data['message']='<div class="alert alert-success text-center">Command</div>';
          $this->session->set_flashdata($data);
          $this->index();
            }else{
            $data['message']='<div class="alert alert-danger text-center">Echec</div>';
            $this->session->set_flashdata($data);
            $data['breadcrumb'] = $this->make_bread->output(); 
            $this->index();
           }
         }
        // print_r($data);
      }

}