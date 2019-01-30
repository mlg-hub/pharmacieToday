<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Medicament extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // $this->is_Oauth();
        $this->make_bread->add('stock/Medicament', "stock/Medicament", 0);
        $this->breadcrumb = $this->make_bread->output();
    }

    // public function is_Oauth()
    // {
    //    if($this->session->userdata('USER_EMAIL') == NULL)
    //     redirect(base_url());
    // }

    public function index()
       {
          $this->make_bread->add('Nouveau Médicament', "stock/Medicament", 0);
          $data['breadcrumb'] = $this->make_bread->output();
         // $data['type_user'] = $this->Model->getList('admin_service');
        //  $data['profiles'] = $this->Model->getList('profil');
          $data['title']="Medicament";
          $this->load->view('medicament_views/Medicament_Add_Views',$data);
      }

     public function add() {
        $this->form_validation->set_rules('DESCRIPTION','description', 'trim|required');
        //$this->form_validation->set_rules('PROFILE','type d\'utilisateur', 'trim|required');

        if ($this->form_validation->run() == FALSE)
          {  
          $this->make_bread->add('Nouveau Médicament', "stock/Medicament", 0);
          $data['breadcrumb'] = $this->make_bread->output();
         // $data['type_user'] = $this->Model->getList('admin_service');
          //$data['profiles'] = $this->Model->getList('profil');
         // $data['PROFIL']=$this->input->post('PROFILE');
         // $data['ID_PROFIL']=$this->input->post('PROFILE');
         // $this->load->view('utilisateurs_view/Users_Add_Views',$data);
             }

        else 
        {

          
         // $pwd=$this->notifications->generate_password(6);

            $data = array(
                'DESCRIPTION' => $this->input->post('DESCRIPTION'),

            );





    $table='medicament';

    $this->Model->create($table, $data);
    /*print_r($pwd);
    exit();*/
     
    $data['message']='<div class="alert alert-success text-center">'."Enregistrement d'un nouvel médicament".' '.$this->input->post('DESCRIPTION')."faite avec succès".'</div>';
    $this->session->set_flashdata($data);
    redirect(base_url('stock/Medicament/listing'));
 
        }
    }
    public function listing() 
    {
      // $id=$this->session->userdata('USER_ID');

      // $code_soc=$this->Model->getOne('users',array('USER_ID'=>$id));
     
      $result=$this->Model->getList('medicament',array());
      $tabledata=array();
     foreach ($result as $key)
      {

        //$profil=$this->Model->getOne('profil',array('ID_PROFIL'=>$key['PROFIL']));
             
              $user=array();
              $user[]=$key['DESCRIPTION'];


              $user['OPTIONS'] = '<div class="dropdown ">
                    <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Action
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        ';


                   $user['OPTIONS'] .= "<li><a href='".base_url("stock/Medicament/getOne/".$key['MEDICAMENT_ID'])."'>Modifier</a></li>";

               $user['OPTIONS'] .= "<li><a hre='#' data-toggle='modal' 
                                  data-target='#mydelete" . $key['MEDICAMENT_ID'] . "'><font color='red'>Supprimer</font></a></li>";
           

          $user['OPTIONS'] .= "   </ul>
                  </div>
                                    <div class='modal fade' id='mydelete" . $key['MEDICAMENT_ID'] . "'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>

                                                <div class='modal-body'>
                                                    <h5>Supprimer  :<b>" . $key['DESCRIPTION'] . "</b>?</h5>
                                                </div>

                                               <div class='modal-footer'>
                                                    <a class='btn btn-danger btn-md' href='" . base_url('stock/Medicament/delete/'.$key['MEDICAMENT_ID']). "'>Supprimer</a>
                                                    <button class='btn btn-primary btn-md' class='close' data-dismiss='modal'>Quiter</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>";




              $tabledata[]=$user;
             }

                $template = array(
                    'table_open' => '<table id="user_list" class="table table-bordered table-stripped table-hover table-condensed">',
                    'table_close' => '</table>'
                );
                $this->table->set_template($template);
                $this->table->set_heading(array('Nom du Médicament','Action'));
                $data['user']=$tabledata;
                $data['title']="Médicament";
                $data['breadcrumb'] = $this->breadcrumb;
                $this->load->view('medicament_views/Medicament_List_View',$data);
      }



function getOne()
      {
            // $id=$this->session->userdata('USER_ID');

            // $code_soc=$this->Model->getOne('users',array('USER_ID'=>$id));

            $table="medicament";
            $criteres['MEDICAMENT_ID']=$this->uri->segment(4);

            $user=$this->Model->getOne($table, $criteres);

            //$profil=$this->Model->getOne('profil',array('ID_PROFIL'=>$user['PROFIL']));


            $data['description']=$user;
           // $data['profilist']=$this->Model->getList('profil',array());
           // $data['servicelist']=$this->Model->getList('admin_service',array());
            //$data['societelist']=$this->Model->getList('societe');
            $this->make_bread->add('Modifier Médicament', 'getOne/'.$criteres['MEDICAMENT_ID'], 1);
            $data['breadcrumb'] = $this->make_bread->output();
             $data['title']="Médicament";
          $this->load->view('medicament_views/Medicament_Update_View',$data);

         
          }


function update(){


    $this->form_validation->set_rules('DESCRIPTION', 'Description', 'trim|required');
     if ($this->form_validation->run() == FALSE)
        {

   $criteres=$this->input->post('MEDICAMENT_ID');
    $data['type']=$this->Model->getOne('medicament',array('MEDICAMENT_ID'=>$criteres));
   // $data['title'] = "Type of Products";
    $data['breadcrumb'] = $this->make_bread->output();
    //$this->load->view('Type_Produit_update_View',$data);


        }

        else
        {

    
    $data=array(

    'DESCRIPTION'=>$this->input->post('DESCRIPTION'),
   
    );
   
    $criteres=$this->input->post('MEDICAMENT_ID');
    $this->Model->update('medicament',array('MEDICAMENT_ID'=>$criteres),$data);
     $data['message']='<div class="alert alert-success text-center">'."Modification du médicament".' '.$this->input->post('DESCRIPTION').'  '."est fait avec succès".'</div>';
     $this->session->set_flashdata($data);
    redirect(base_url('stock/Medicament/listing'));


}


  

}

     
function delete()
{
      $table="medicament";
      $criteres['MEDICAMENT_ID']=$this->uri->segment(4);
      $data['rows']= $this->Model->getOne( $table,$criteres);
      $this->Model->delete($table,$criteres);
      $data['message']='<div class="alert alert-success text-center">'."Suppression du médicament".' '.$data['rows']['DESCRIPTION'].'  '."faite avec succès".'</div>';
      $this->session->set_flashdata($data);
      
      redirect(base_url('stock/Medicament/listing'));
  
}
    

}