<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index($params = NULL) {
       //print_r($this->session->userdata());

        if (!empty($this->session->userdata('PHARMACIE_USER_EMAIL'))) {
        redirect(base_url()."demande/Demande");
        } else {
            $datas['message'] = $params;
            $this->load->view('Login_Views', $datas);
         }
    }

    public function do_login() {
        $login = $this->input->post('USERNAME');
        $password = $this->input->post('PASSWORD');
        
        $critere['EMAIL']=$login;
        $critere['PASSWORD']=md5($password);
        $user= $this->Model->getOne('user',$critere);  
     
        
        if (!empty($user)) {
            
            if ($user['PASSWORD'] == md5($password))

             {     
                
                    $session = array(
                        'USER_ID' => $user['USER_ID'],
                        'EMAIL' => $user['EMAIL'], 
                        

                    );

                   $this->session->set_userdata($session);
                   redirect(base_url('demande/Demande'));
            }

             else
                $message = "<div class='alert alert-danger'> Le nom d'utilisateur ou/et mot de passe incorect(s) !</div>";
        }
         else
            $message = "<div class='alert alert-danger'> L'utilisateur n'existe pas/plus dans notre système informatique !</div>";
       $this->index($message);

    }

    public function do_logout()

             {
             
                    $session = array(
                        'USER_ID' => NULL,
                        'EMAIL' => NULL,
                        
                          
                        );

                $this->session->set_userdata($session);
                redirect(base_url('Login'));
            }


         

}
