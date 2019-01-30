<?php

 
class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // $this->is_Oauth();
        $this->make_bread->add('administration/Users', "administration/Users", 0);
        $this->breadcrumb = $this->make_bread->output();
    }

    // public function is_Oauth()
    // {
    //    if($this->session->userdata('USER_EMAIL') == NULL)
    //     redirect(base_url());
    // }

    public function index()
       {
          $this->make_bread->add('New user', "administration/Users", 0);
          $data['breadcrumb'] = $this->make_bread->output();
         // $data['type_user'] = $this->Model->getList('admin_service');
          $data['profiles'] = $this->Model->getList('profil');
          $data['title']="users";
          $this->load->view('utilisateurs_view/Users_Add_Views',$data);
      }

     public function add() {
        $this->form_validation->set_rules('NOM','nom', 'trim|required');
        $this->form_validation->set_rules('PRENOM', ' prénom ', 'trim|required');
        $this->form_validation->set_rules('EMAIL', ' email ', 'trim|required|valid_email|is_unique[user.EMAIL]');
        $this->form_validation->set_rules('TELEPHONE','telephone','trim|required');
        $this->form_validation->set_rules('PROFILE','type d\'utilisateur', 'trim|required');

        if ($this->form_validation->run() == FALSE)
          {  
          $this->make_bread->add('Nouveau utilisateur', "administration/Users", 0);
          $data['breadcrumb'] = $this->make_bread->output();
         // $data['type_user'] = $this->Model->getList('admin_service');
          $data['profiles'] = $this->Model->getList('profil');
          $data['PROFIL']=$this->input->post('PROFILE');
          $data['ID_PROFIL']=$this->input->post('PROFILE');
          $this->load->view('utilisateurs_view/Users_Add_Views',$data);
             }

        else 
        {

          
          $pwd=$this->notifications->generate_password(6);

            $data = array(
                'NOM' => $this->input->post('NOM'),
                'PRENOM' => $this->input->post('PRENOM'),
                'EMAIL' => $this->input->post('EMAIL'),
               'TELEPHONE' => $this->input->post('TELEPHONE'),
                'PASSWORD' => md5($pwd), 
                 'PROFIL' => $this->input->post('PROFILE'),
                 'PASSWORD_VISIBLE'=>$pwd
            );

            print_r($data); die();
    // send mail
     $message = "Monsieur /Madame ".$this->input->post('NOM')." ".$this->input->post('PRENOM')." </br>Vos identifiants sur la plate forme Case hospital sont :<br><br>";
    $message .="<b> Username  :".$this->input->post('EMAIL')." </b><br>
    <b>Mot de passe  :".$pwd." </b><br>
    Vous pouvez vous connecter en cliquant ici ".base_url('Login')."

    Cordialement Merci.";
   /* $this->notifications->send_mail($this->input->post('EMAIL'),'Identifiants sur le système pharmatie',NULL,$message,NULL);*/


    $table='user';

    $this->Model->create($table, $data);
    /*print_r($pwd);
    exit();*/
     
    $data['message']='<div class="alert alert-success text-center">'."Création d'un nouvel utilisateur".' '.$this->input->post('NOM')." ".$this->input->post('PRENOM')." faite avec succès".'</div>';
    $this->session->set_flashdata($data);
    redirect(base_url('administration/Users/listing'));
 
        }
    }
    public function listing() 
    {
      // $id=$this->session->userdata('USER_ID');

      // $code_soc=$this->Model->getOne('users',array('USER_ID'=>$id));
     
      $result=$this->Model->getList('user',array());
      $tabledata=array();
     foreach ($result as $key)
      {

        $profil=$this->Model->getOne('profil',array('PROFIL_ID'=>$key['PROFIL']));
             
              $user=array();
              $user[]=$key['NOM']." ".$key['PRENOM'];
              $user[]=$key['EMAIL'];
              $user[]=$key['TELEPHONE'];
              $user[]=$profil['DESCRIPTION'];

              $user['OPTIONS'] = '<div class="dropdown ">
                    <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Action
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        ';


                   $user['OPTIONS'] .= "<li><a href='".base_url("administration/Users/getOne/".$key['USER_ID'])."'>Modifier</a></li>";

               $user['OPTIONS'] .= "<li><a hre='#' data-toggle='modal' 
                                  data-target='#mydelete" . $key['USER_ID'] . "'><font color='red'>Supprimer</font></a></li>";
           

          $user['OPTIONS'] .= "   </ul>
                  </div>
                                    <div class='modal fade' id='mydelete" . $key['USER_ID'] . "'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>

                                                <div class='modal-body'>
                                                    <h5>Delete  :<b>" . $key['EMAIL'] . "</b>?</h5>
                                                </div>

                                               <div class='modal-footer'>
                                                    <a class='btn btn-danger btn-md' href='" . base_url('administration/Users/delete/'.$key['USER_ID']). "'>Delete</a>
                                                    <button class='btn btn-primary btn-md' class='close' data-dismiss='modal'>Exit</button>
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
                $this->table->set_heading(array('Nom & Prénom','Email','Téléphone','Profil','Options'));
                $data['user']=$tabledata;
                $data['title']="users";
                $data['breadcrumb'] = $this->breadcrumb;
                $this->load->view('utilisateurs_view/Users_List_View',$data);
      }



function getOne()
      {
            // $id=$this->session->userdata('USER_ID');

            // $code_soc=$this->Model->getOne('users',array('USER_ID'=>$id));

            $table="user";
            $criteres['USER_ID']=$this->uri->segment(4);

            $user=$this->Model->getOne($table, $criteres);

            $profil=$this->Model->getOne('profil',array('PROFIL_ID'=>$user['PROFIL']));


            $data['user']=$user;
            $data['profil']=$profil;
            $data['profilist']=$this->Model->getList('profil',array());
           // $data['servicelist']=$this->Model->getList('admin_service',array());
            //$data['societelist']=$this->Model->getList('societe');
            $this->make_bread->add('Modifier utilisateur', "getOne/".$criteres['USER_ID'], 1);
            $data['breadcrumb'] = $this->make_bread->output();
             $data['title']="users";
            $this->load->view('utilisateurs_view/User_Update_View',$data);
            
          }


function update(){

        $this->form_validation->set_rules('NOM','nom', 'trim|required');
        $this->form_validation->set_rules('PRENOM', ' prénom ', 'trim|required');
        $this->form_validation->set_rules('EMAIL', ' email ', 'trim|required');
        $this->form_validation->set_rules('TELEPHONE', ' telephone ', 'trim|required');
        $this->form_validation->set_rules('PROFILE','profil', 'trim|required');
       

    if($this->form_validation->run()==FALSE)
    {
            $table="user";
            $criteres['USER_ID']=$this->input->post('id_user');
            $user=$this->Model->getOne($table, $criteres);

            $profil=$this->Model->getOne('profil',array('PROFIL_ID'=>$user['PROFIL']));

            $data['user']=$user;
            $data['profil']=$profil;
            $data['profilist']=$this->Model->getList('profil',array());
            //$data['servicelist']=$this->Model->getList('admin_service',array());
            //$data['societelist']=$this->Model->getList('societe');
            $this->make_bread->add('Modifier utilisateur', "getOne/".$criteres['USER_ID'], 1);
            $data['breadcrumb'] = $this->make_bread->output();
             $data['title']="users";
              $data['PROFIL']=$this->input->post('PROFILE');
          $data['PROFIL']=$this->input->post('PROFILE');
            $this->load->view('utilisateurs_view/User_Update_View',$data);

        }

    else{

            $criteres['USER_ID']=$this->input->post('id_user');
            $userone=$this->Model->getOne('user',array('USER_ID'=>$this->input->post('id_user')));
            if($userone['EMAIL']==$this->input->post('EMAIL'))
            {


                 $data = array(
                'NOM' => $this->input->post('NOM'),
                'PRENOM' => $this->input->post('PRENOM'),
                'EMAIL' => $this->input->post('EMAIL'),
                'TELEPHONE' => $this->input->post('TELEPHONE'),
                'PASSWORD' => $this->input->post('PASSWORD'),
                'PROFIL' => $this->input->post('PROFILE'),
             
                    
            );
        
      $table='user';
      $this->Model->update($table,$criteres,$data);

      $data['message']='<div class="alert alert-success text-center">'."Modification d'un utilisateur".' '.$this->input->post('EMAIL').'  '."faite avec succès".'</div>';
      $this->session->set_flashdata($data);


       /*$data['message']='<div class="alert alert-success text-center">'."Suppression d'un utilisateur".' '.$data['rows']['EMAIL'].'  '."faite avec succès".'</div>';
      $this->session->set_flashdata($data);*/

      redirect(base_url('administration/Users/listing'));

        }

            else
            {


            $pwd=$this->notifications->generate_password(6);

            $data = array(

                'NOM' => $this->input->post('NOM'),
                'PRENOM' => $this->input->post('PRENOM'),
                'EMAIL' => $this->input->post('EMAIL'),
               'TELEPHONE' => $this->input->post('TELEPHONE'),
                'PASSWORD' => md5($pwd),     
                'PROFIL' => $this->input->post('PROFILE'),
             );

        // send mail
     $message = "Monsieur /Madame ".$this->input->post('NOM')." ".$this->input->post('PRENOM')." </br>Vos identifiants sur la plate forme case hospital sont :<br><br>";
    $message .="<b> Username  :".$this->input->post('EMAIL')." </b><br>
    <b>Mot de passe  :".$pwd." </b><br>
    Vous pouvez vous connecter en cliquant ici ".base_url('Login')."

    Cordialement Merci.";
   /* $this->notifications->send_mail($this->input->post('EMAIL'),'Identifiants sur le système case hospital',NULL,$message,NULL);
  */

     $table='user';
     $criteres['USER_ID']=$this->input->post('id_user');
     $post=$this->Model->update($table,$criteres,$data);

     if ($post) {
      $data['message']='<div class="alert alert-success text-center">'."Modification d'un utilisateur".' '.$this->input->post('EMAIL').'  '."faite avec succès".'</div>';
      $this->session->set_flashdata($data);
      redirect(base_url('administration/Users/listing'));
     }


    }
       
  }
   
}

     
function delete()
{
      $table="user";
      $criteres['USER_ID']=$this->uri->segment(4);
      $data['rows']= $this->Model->getOne( $table,$criteres);
      $this->Model->delete($table,$criteres);
      $data['message']='<div class="alert alert-success text-center">'."Suppression d'un utilisateur".' '.$data['rows']['EMAIL'].'  '."faite avec succès".'</div>';
      $this->session->set_flashdata($data);
      
      redirect(base_url('administration/Users/listing'));
  
}
    
}
