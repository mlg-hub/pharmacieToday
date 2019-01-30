<?php


class Clients extends CI_Controller {

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
        $data['test'] = 'bonjour';
        $this->load->view('Client_Add_Views',$data);
    }

    public function add() {

        $this->form_validation->set_rules('CLIENT_NOM','nom', 'trim');
        $this->form_validation->set_rules('CLIENT_PRENOM', ' prénom ', 'trim');
        $this->form_validation->set_rules('CLIENT_EMAIL', 'email', 'trim|valid_email|is_unique[user.EMAIL]');
        $this->form_validation->set_rules('CLIENT_TELEPHONE','telephone','trim');
        $this->form_validation->set_rules('CLIENT_SOCIETE','societes', 'trim');

        if ($this->form_validation->run() == FALSE)
        {
            $this->make_bread->add('Nouveau client', "clients/clients", 0);
            $data['breadcrumb'] = $this->make_bread->output();

            $this->load->view('Client_Add_Views',$data);
        }

        else
        {

            $data = array(
                'CLIENT_NOM' => $this->input->post('CLIENT_NOM'),
                'CLIENT_PRENOM' => $this->input->post('CLIENT_PRENOM'),
                'CLIENT_EMAIL' => $this->input->post('CLIENT_EMAIL'),
                'CLIENT_TELEPHONE' => $this->input->post('CLIENT_TELEPHONE'),
            );

            $table='clients';

            $this->Model->create($table, $data);
            /*print_r($pwd);
            exit();*/
//
            $data['message']='<div class="alert alert-success text-center">'."Création d'un nouvel utilisateur".' '.$this->input->post('CLIENT_NOM')." ".$this->input->post('CLIENT_PRENOM')." faite avec succès".'</div>';
            $this->session->set_flashdata($data);
            redirect(base_url('clients/clients/listing'));

        }
    }
    public function listing()
    {
        // $id=$this->session->userdata('CLIENT_ID');

        // $code_soc=$this->Model->getOne('users',array('CLIENT_ID'=>$id));

        $result=$this->Model->getList('clients',array());
        $tabledata=array();
        foreach ($result as $key)
        {

            $profil=$this->Model->getOne('clients',array('CLIENT_ID'=>$key['CLIENT_ID']));

            $user=array();
            $user[]=$key['CLIENT_NOM']." ".$key['CLIENT_PRENOM'];
            $user[]=$key['CLIENT_EMAIL'];
            $user[]=$key['CLIENT_TELEPHONE'];

            $user['OPTIONS'] = '<div class="dropdown ">
                    <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Action
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        ';


            $user['OPTIONS'] .= "<li><a href='".base_url("clients/clients/getOne/".$key['CLIENT_ID'])."'>Modifier</a></li>";

            $user['OPTIONS'] .= "<li><a hre='#' data-toggle='modal' 
                                  data-target='#mydelete" . $key['CLIENT_ID'] . "'><font color='red'>Supprimer</font></a></li>";


            $user['OPTIONS'] .= "   </ul>
                  </div>
                                    <div class='modal fade' id='mydelete" . $key['CLIENT_ID'] . "'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>

                                                <div class='modal-body'>
                                                    <h5>Delete  :<b>" . $key['CLIENT_EMAIL'] . "</b>?</h5>
                                                </div>

                                               <div class='modal-footer'>
                                                    <a class='btn btn-danger btn-md' href='" . base_url('clients/clients/delete/'.$key['CLIENT_ID']). "'>Delete</a>
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
        $this->table->set_heading(array('Nom & Prénom','Email','Téléphone','Options'));
        $data['user']=$tabledata;
        $data['title']="users";
        $data['breadcrumb'] = $this->breadcrumb;
        $this->load->view('Client_List_View',$data);
    }



    function getOne()
    {
        $table="clients";
        $criteres['CLIENT_ID']=$this->uri->segment(4);

        $user=$this->Model->getOne($table, $criteres);

        $data['user']=$user;

//        print_r($data);
        $this->make_bread->add('Modifier le client', "getOne/".$criteres['CLIENT_ID'], 1);
        $data['breadcrumb'] = $this->make_bread->output();
        $data['title']="clients";
        $this->load->view('Client_Update_View',$data);

    }


    function update(){
        $this->form_validation->set_rules('CLIENT_NOM','nom', 'trim');
        $this->form_validation->set_rules('CLIENT_PRENOM', ' prénom ', 'trim');
        $this->form_validation->set_rules('CLIENT_EMAIL', 'email', 'trim|valid_email');
        $this->form_validation->set_rules('CLIENT_TELEPHONE','telephone','trim');
        $this->form_validation->set_rules('CLIENT_SOCIETE','societes', 'trim');

        if($this->form_validation->run()==FALSE)
        {
            $table="clients";
            $criteres['CLIENT_ID']=$this->input->post('CLIENT_ID');
            $user=$this->Model->getOne($table, $criteres);
            $data['user']=$user;
//            $data['profilist']=$this->Model->getList('profil',array());
            //$data['servicelist']=$this->Model->getList('admin_service',array());
            //$data['societelist']=$this->Model->getList('societe');
            $this->make_bread->add('Modifier utilisateur', "getOne/".$criteres['CLIENT_ID'], 1);
            $data['breadcrumb'] = $this->make_bread->output();
            $data['title']="users";
            $data['PROFIL']=$this->input->post('PROFILE');
            $data['PROFIL']=$this->input->post('PROFILE');
            $this->load->view('Client_Update_View',$data);

        }

        else

            {

            $criteres['CLIENT_ID']=$this->input->post('CLIENT_ID');
            $userone=$this->Model->getOne('clients',array('CLIENT_ID'=>$this->input->post('CLIENT_ID')));

                $data = array(
                    'CLIENT_NOM' => $this->input->post('CLIENT_NOM'),
                    'CLIENT_PRENOM' => $this->input->post('CLIENT_PRENOM'),
                    'CLIENT_EMAIL' => $this->input->post('CLIENT_EMAIL'),
                    'CLIENT_TELEPHONE' => $this->input->post('CLIENT_TELEPHONE'),
                );
                $table='clients';
                $criteres['CLIENT_ID'] = $this->input->post('CLIENT_ID');

                $post=$this->Model->update($table,$criteres,$data);

                if ($post) {
                    print_r($data);
                    $data['message']='<div class="alert alert-success text-center">'."Modification d'un utilisateur".' '.$this->input->post('EMAIL').'  '."faite avec succès".'</div>';
                    $this->session->set_flashdata($data);
                    redirect(base_url('clients/clients/listing'));
                }
        }

    }


    function delete()
    {
        $table="clients";
        $criteres['CLIENT_ID']=$this->uri->segment(4);
        $data['rows']= $this->Model->getOne( $table,$criteres);
        $this->Model->delete($table,$criteres);
        $data['message']='<div class="alert alert-success text-center">'."Suppression d'un utilisateur".' '.$data['rows']['CLIENT_EMAIL'].'  '."faite avec succès".'</div>';
        $this->session->set_flashdata($data);

        redirect(base_url('clients/clients/listing'));

    }

}
