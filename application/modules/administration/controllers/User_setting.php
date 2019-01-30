<?php
class User_setting extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // $this->is_Oauth();
        $this->make_bread->add('User_setting', "administration/User_setting", 0);
        $this->breadcrumb = $this->make_bread->output();
    }

    // public function is_Oauth()
    // {
    //    if($this->session->userdata('USER_EMAIL') == NULL)
    //     redirect(base_url());
    // }
 public function is_Oauth()
    {
       // if($this->session->userdata('USER_EMAIL') == NULL)
       //  redirect(base_url());
    }
    
    public function index()
       {
             $this->make_bread->add('change pass word ', "administration/User_setting", 1);
    $datas['title'] = "update";
    $datas['breadcrumb'] = $this->make_bread->output();
   //print_r( $resultat);
    $this->load->view('users_profil/Update_pwd',$datas);
       }

    public function update(){
        $oldPwd=$_POST['old_pwd'];
        $newPwd=$_POST['new_pwd'];
        $confirmPwd=$_POST['confirm_pwd'];
        if($newPwd== $confirmPwd){
            $email= $this->session->userdata('CASEHOSP_USER_EMAIL');
            $info=$this->Model->getOne('admin_utilisateurs',array('UTILISATEUR_EMAIL'=>$email));

        if($info['UTILISATEUR_PASSWORD']==md5($oldPwd)){


        $this->Model->update('admin_utilisateurs',array('UTILISATEUR_EMAIL'=>$email),array('UTILISATEUR_PASSWORD'=>md5($newPwd)));
redirect(base_url('administration/User_setting/do_logout'));
         }else{
            $data['message']='<div class="alert alert-danger text-center"> failure! old password is not correct.</div>';
                  $this->session->set_flashdata($data);
                  redirect(base_url('administration/User_setting'));
              }


        }else{
            $data['message']='<div class="alert alert-danger text-center"> failure! new password and Confirm password are differents.</div>';
                  $this->session->set_flashdata($data);
                  redirect(base_url('administration/User_setting'));
              }
    }

     public function do_logout()

             {
             
                    $session = array(
                        'CASEHOSP_UTILISATEUR_ID' => NULL,
                        'CASEHOSP_USER_EMAIL' => NULL,
                        'CASEHOSP_SERVICE_CODE'=>NULL
                          
                        );
                    $message= "<div class='alert alert-success'> Password updated succefully</div>";
                    $data['message']='<div class="alert alert-success text-center"> Password updated succefully.</div>';
                  $this->session->set_flashdata($data);
                $this->session->set_userdata($session);
                redirect(base_url('Login/index'));
            }

}

?>