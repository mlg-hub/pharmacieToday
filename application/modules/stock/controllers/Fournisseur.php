<?php

 
class Fournisseur extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // $this->is_Oauth();
        $this->make_bread->add('stock/fournisseur', "fournisseur", 0);
        $this->breadcrumb = $this->make_bread->output();
    }

    // public function is_Oauth()
    // {
    //    if($this->session->userdata('USER_EMAIL') == NULL)
    //     redirect(base_url());
    // }

    public function index()
       {
          $this->make_bread->add('nouveau fournisseur', "fournisseur", 0);
          $data['breadcrumb'] = $this->make_bread->output();
         // $data['type_user'] = $this->Model->getList('admin_service');
          $data['profiles'] = $this->Model->getList('profil');
          $data['title']="fournisseurs";
          $this->load->view('fournisseur_views/Fournisseur_Add_Views',$data);
      }

     public function add() {
        $this->form_validation->set_rules('TYPE_FOURNISSEUR','type de fournisseur', 'trim|required');
        $this->form_validation->set_rules('DESCRIPTION', ' description ', 'trim|required');
        $this->form_validation->set_rules('ADRESSE','adresse','trim|required');
        $this->form_validation->set_rules('LATITUDE','latitude', 'trim|required');
        $this->form_validation->set_rules('LONGITUDE','longitude', 'trim|required');

        if ($this->form_validation->run() == FALSE)
          {  
          $this->make_bread->add('Nouveau fournisseur', "fournisseur", 0);
          $data['breadcrumb'] = $this->make_bread->output();
         // $data['type_user'] = $this->Model->getList('admin_service');
          //$data['profiles'] = $this->Model->getList('profil');
          $data['PROFIL']=$this->input->post('PROFILE');
          $data['ID_PROFIL']=$this->input->post('PROFILE');
          $this->load->view('fournisseur_views/Fournisseur_Add_Views',$data);
             }

        else 
        {

          
          //$pwd=$this->notifications->generate_password(6);

            $data = array(
                'TYPE_FOURNISSEUR' => $this->input->post('TYPE_FOURNISSEUR'),
                'DESCRIPTION' => $this->input->post('DESCRIPTION'),
                'ADRESSE' => $this->input->post('ADRESSE'),
               'LONGITUDE' => $this->input->post('LONGITUDE'),
                'LATITUDE' => $this->input->post('LATITUDE')
                 
            );


    // send mail
   /*  $message = "Monsieur /Madame ".$this->input->post('NOM')." ".$this->input->post('PRENOM')." </br>Vos identifiants sur la plate forme Case hospital sont :<br><br>";
    $message .="<b> Username  :".$this->input->post('EMAIL')." </b><br>
    <b>Mot de passe  :".$pwd." </b><br>
    Vous pouvez vous connecter en cliquant ici ".base_url('Login')."

    Cordialement Merci.";
    $this->notifications->send_mail($this->input->post('EMAIL'),'Identifiants sur le système pharmatie',NULL,$message,NULL);*/


    $table='fournisseur';

    $this->Model->create($table, $data);
    /*print_r($pwd);
    exit();*/
     
    $data['message']='<div class="alert alert-success text-center">'."Création d'un nouveau fournisseur de type".' '.$this->input->post('TYPE_FOURNISSEUR')." ayant l'adresse ".$this->input->post('ADRESSE')." faite avec succès".'</div>';
    $this->session->set_flashdata($data);
    redirect(base_url('stock/Fournisseur/listing'));
 
        }
    }
    public function listing() 
    {
      // $id=$this->session->userdata('USER_ID');

      // $code_soc=$this->Model->getOne('users',array('USER_ID'=>$id));
     
      $result=$this->Model->getList('fournisseur',array());
      $tabledata=array();
     foreach ($result as $key)
      {

        //$profil=$this->Model->getOne('profil',array('PROFIL_ID'=>$key['PROFIL']));
             
              $fournisseur=array();
              $fournisseur[]=$key['TYPE_FOURNISSEUR'];
              $fournisseur[]=$key['DESCRIPTION'];
              $fournisseur[]=$key['ADRESSE'];
              $fournisseur[]=$key['LONGITUDE'];
               $fournisseur[]=$key['LATITUDE'];

              $fournisseur['OPTIONS'] = '<div class="dropdown ">
                    <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Action
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        ';


                   $fournisseur['OPTIONS'] .= "<li><a href='".base_url("stock/Fournisseur/getOne/".$key['ID_FOURNISSEUR'])."'>Modifier</a></li>";

               $fournisseur['OPTIONS'] .= "<li><a hre='#' data-toggle='modal' 
                                  data-target='#mydelete" . $key['ID_FOURNISSEUR'] . "'><font color='red'>Supprimer</font></a></li>";
           

          $fournisseur['OPTIONS'] .= "   </ul>
                  </div>
                                    <div class='modal fade' id='mydelete" . $key['ID_FOURNISSEUR'] . "'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>

                                                <div class='modal-body'>
                                                    <h5> Supprimer  :<b>" . $key['TYPE_FOURNISSEUR'] . "</b>?</h5>
                                                </div>

                                               <div class='modal-footer'>
                                                    <a class='btn btn-danger btn-md' href='" . base_url('stock/Fournisseur/delete/'.$key['ID_FOURNISSEUR']). "'>Delete</a>
                                                    <button class='btn btn-primary btn-md' class='close' data-dismiss='modal'>Exit</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>";




              $tabledata[]=$fournisseur;
             }

                $template = array(
                    'table_open' => '<table id="fournisseur_list" class="table table-bordered table-stripped table-hover table-condensed">',
                    'table_close' => '</table>'
                );
                $this->table->set_template($template);
                $this->table->set_heading(array('type de fournisseur','description','adresse','longitude','latitude','Options'));
                $data['fournisseur']=$tabledata;
                $data['title']="fournisseurs";
                $data['breadcrumb'] = $this->breadcrumb;
                $this->load->view('fournisseur_views/Fournisseur_List_View',$data);
      }



function getOne()
      {
            // $id=$this->session->userdata('USER_ID');

            // $code_soc=$this->Model->getOne('users',array('USER_ID'=>$id));

            $table="fournisseur";
            $criteres['ID_FOURNISSEUR']=$this->uri->segment(4);

            $fournisseur=$this->Model->getOne($table, $criteres);

            //$profil=$this->Model->getOne('profil',array('PROFIL_ID'=>$fournisseur['PROFIL']));


            $data['fournisseur']=$fournisseur;
           // $data['profil']=$profil;
           // $data['profilist']=$this->Model->getList('profil',array());
           // $data['servicelist']=$this->Model->getList('admin_service',array());
            //$data['societelist']=$this->Model->getList('societe');
            $this->make_bread->add('Modifier le fournisseur', "getOne/".$criteres['ID_FOURNISSEUR'], 1);
            $data['breadcrumb'] = $this->make_bread->output();
             $data['title']="fournisseurs";
            $this->load->view('fournisseur_views/Fournisseur_Update_View',$data);
            
          }


function update(){

       $this->form_validation->set_rules('TYPE_FOURNISSEUR','type de fournisseur', 'trim|required');
        $this->form_validation->set_rules('DESCRIPTION', ' description ', 'trim|required');
        $this->form_validation->set_rules('ADRESSE','adresse','trim|required');
        $this->form_validation->set_rules('LATITUDE','latitude', 'trim|required');
        $this->form_validation->set_rules('LONGITUDE','longitude', 'trim|required');


    if($this->form_validation->run()==FALSE)
    {
            $table="fournisseur";
            $criteres['ID_FOURNISSEUR']=$this->input->post('id_fournisseur');
            $fournisseur=$this->Model->getOne($table, $criteres);

           /* $profil=$this->Model->getOne('profil',array('ID_FOURNISSEUR'=>$fournisseur['ID_FOURNISSEUR']));*/

            $data['fournisseur']=$fournisseur;
           // $data['profil']=$profil;
            //$data['profilist']=$this->Model->getList('profil',array());
            //$data['servicelist']=$this->Model->getList('admin_service',array());
            //$data['societelist']=$this->Model->getList('societe');
            $this->make_bread->add('Modifier fournisseur', "getOne/".$criteres['ID_FOURNISSEUR'], 1);
            $data['breadcrumb'] = $this->make_bread->output();
             $data['title']="fournisseurs";
              $data['ID_FOURNISSEUR']=$this->input->post('ID_FOURNISSEUR');
         // $data['PROFIL']=$this->input->post('PROFILE');
            $this->load->view('fournisseur_views/Fournisseur_Update_View',$data);

        }

    else{

            $criteres['ID_FOURNISSEUR']=$this->input->post('id_fournisseur');
            $fournisseurone=$this->Model->getOne('fournisseur',array('ID_FOURNISSEUR'=>$this->input->post('id_fournisseur')));
            if($fournisseurone['TYPE_FOURNISSEUR']==$this->input->post('TYPE_FOURNISSEUR'))
            {


                 $data = array(

                'TYPE_FOURNISSEUR' => $this->input->post('TYPE_FOURNISSEUR'),
                'DESCRIPTION' => $this->input->post('DESCRIPTION'),
                'ADRESSE' => $this->input->post('ADRESSE'),
                'LONGITUDE' => $this->input->post('LONGITUDE'),
                'LATITUDE' => $this->input->post('LATITUDE')
                   
            );
        
      $table='fournisseur';
      $this->Model->update($table,$criteres,$data);

      $data['message']='<div class="alert alert-success text-center">'."Modification du fournisseur de type".' '.$this->input->post('TYPE_FOURNISSEUR').'  '."faite avec succès".'</div>';
      $this->session->set_flashdata($data);


       /*$data['message']='<div class="alert alert-success text-center">'."Suppression d'un utilisateur".' '.$data['rows']['EMAIL'].'  '."faite avec succès".'</div>';
      $this->session->set_flashdata($data);*/

      redirect(base_url('stock/Fournisseur/listing'));

        }

            else
            {


          //  $pwd=$this->notifications->generate_password(6);

            $data = array(

              'TYPE_FOURNISSEUR' => $this->input->post('TYPE_FOURNISSEUR'),
                'DESCRIPTION' => $this->input->post('DESCRIPTION'),
                'ADRESSE' => $this->input->post('ADRESSE'),
                'LONGITUDE' => $this->input->post('LONGITUDE'),
                'LATITUDE' => $this->input->post('LATITUDE'),
             );

        // send mail
  /*    $message = "Monsieur /Madame ".$this->input->post('NOM')." ".$this->input->post('PRENOM')." </br>Vos identifiants sur la plate forme case hospital sont :<br><br>";
    $message .="<b> Username  :".$this->input->post('EMAIL')." </b><br>
    <b>Mot de passe  :".$pwd." </b><br>
    Vous pouvez vous connecter en cliquant ici ".base_url('Login')."

    Cordialement Merci.";
   $this->notifications->send_mail($this->input->post('EMAIL'),'Identifiants sur le système case hospital',NULL,$message,NULL);
  */

     $table='fournisseur';
     $criteres['ID_FOURNISSEUR']=$this->input->post('id_fournisseur');
     $post=$this->Model->update($table,$criteres,$data);

     if ($post) {
      $data['message']='<div class="alert alert-success text-center">'."Modification d'un fournisseur de type".' '.$this->input->post('TYPE_FOURNISSEUR').'  '."faite avec succès".'</div>';
      $this->session->set_flashdata($data);
      redirect(base_url('stock/Fournisseur/listing'));
     }


    }
       
  }
   
}

     
function delete()
{
      $table="fournisseur";
      $criteres['ID_FOURNISSEUR']=$this->uri->segment(4);
      $data['rows']= $this->Model->getOne( $table,$criteres);
      $this->Model->delete($table,$criteres);
      $data['message']='<div class="alert alert-success text-center">'."Suppression d'un fournisseur".' '.$data['rows']['TYPE_FOURNISSEUR'].'  '."faite avec succès".'</div>';
      $this->session->set_flashdata($data);
      
      redirect(base_url('stock/Fournisseur/listing'));
  
}
    
}
