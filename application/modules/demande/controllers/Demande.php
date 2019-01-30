<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Demande extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Model_Demande");
        $this->make_bread->add('Demande', "demande/Demande", 0);
        $this->load->library('Mylibrary');
        $this->breadcrumb = $this->make_bread->output();
    }

    public function index()
    {
        $data['title'] = "The requests";
        $data['breadcrumb'] = $this->make_bread->output();
        $this->load->view('Demande_Liste_View', $data);
    }

    public function get_demandes()
    {

        $var_search = $_POST['search']['value'];

        $table = "approv_demande";
        $critere_txt = isset($_POST['search']['value']) ? ("DEMANDE_CODE LIKE '%$var_search%'") : NULL;
        $critere_array = array('SERVICE_CODE' => $this->session->userdata('CASEHOSP_SERVICE_CODE'), 'IS_COMMANDE' => 0,'STATUT_APPROB_ID' => 0);
        $order_column = array('DEMANDE_CODE', 'UTILISATEUR_ID', 'SERVICE_CODE', 'DATE_INSERTION', 'IS_COMMANDE', 'BUDGET_PROVISOIRE');
        $order_by = isset($_POST['order']) ? array($order_column[$_POST['order']['0']['column']] => $_POST['order']['0']['dir']) : array('DEMANDE_ID' => 'DESC');
        $select_column = array('DEMANDE_ID', 'DEMANDE_CODE', 'UTILISATEUR_ID', 'SERVICE_CODE', 'DATE_INSERTION', 'IS_COMMANDE', 'BUDGET_PROVISOIRE');

        $fetch_demandes = $this->Model_Demande->make_datatables($table, $select_column, $critere_txt, $critere_array, $order_by);

        // print_r($fetch_demandes);
        $data = array();
        foreach ($fetch_demandes as $row) {
            $sub_array = array();
            $utilisateur = $this->Model->getOne('admin_utilisateurs', array('UTILISATEUR_ID' => $row->UTILISATEUR_ID));
            $service = $this->Model->getOne('admin_service', array('SERVICE_CODE' => $row->SERVICE_CODE));
            $details = $this->Model->getList('approv_demande_detail', array('DEMANDE_CODE' => $row->DEMANDE_CODE));


            $sub_array[] = $row->DEMANDE_CODE;
            $sub_array[] = $utilisateur['UTILISATEUR_NOM'] . ' ' . $utilisateur['UTILISATEUR_PRENOM'];
            $sub_array[] = $service['SERVICE_NOM'];
            $sub_array[] = $row->BUDGET_PROVISOIRE;
            $sub_array[] = ($row->IS_COMMANDE == 1) ? 'Oui' : 'Non';
            $sub_array[] = $row->DATE_INSERTION;

            $options = '<div class="dropdown ">
                        <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Options
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-left">
                            ';
            // $options .= "";
            $options .= "<li><a href='" . base_url('demande/Demande/Modifier/' . $row->DEMANDE_ID) . "'>
                                        Edit</li>";
            // if($this->mylibrary->permissions($this->uri->segment(2).'/'.$this->uri->segment(3)) ==1){                          
            $options .= "<li><a href='" . base_url('demande/Demande/detail/' . $row->DEMANDE_ID) . "'>
                                        Détail</li>";
            //}
            $field = "";

            foreach($details as $detail):
                $detail_info = $this->Model->getOne('approv_produit', array('PRODUIT_ID' => $detail['PRODUIT_ID']));
                $field .= "<tr><div class='form-group'>
                        <td><label class='col-md-4 col-sm-12 col-xs-12 control-label'>".$detail_info['PRODUIT_NOM']."</label></td>
                        <td><div class='col-md-5 col-sm-12 col-xs-12 col-md-push-1'>
                            <input type='number' name='".$detail['PRODUIT_ID']."' min='1'  value='".$detail['QUANTITE_BON_COMMANDE']."' class='form-control'>
                        </div></td>
                    </div></tr>";
            endforeach;

            $options .= "<li><a href='#' data-toggle='modal' 
                                  data-target='#mydelete" . $row->DEMANDE_ID . "'><font color='red'>Delete</font></button></li></ul>
                                   </div>
                                    <div class='modal fade' id='mydelete" . $row->DEMANDE_ID . "'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>

                                                <div class='modal-body'>
                                                    <h5>Supprimer :<b>" . $row->DEMANDE_CODE . "</b>?</h5>
                                                </div>

                                                <div class='modal-footer'>
                                                    <a class='btn btn-danger btn-md' href='" . base_url('demande/Demande/supprimer/' . $row->DEMANDE_ID) . "'>Delete</a>
                                                    <button class='btn btn-primary btn-md' class='close' data-dismiss='modal'>Cancel</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class='modal fade' id='myorder" . $row->DEMANDE_ID . "'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>

                                                
                                                <form name='myform' method='post' class='form-horizontal' action=" . base_url('demande/Demande/sendOrder/' . $row->DEMANDE_ID) . ">
                                                <div class='modal-body'>
                                                    <h5>Please, fill out the Purchase Order for request : <b>" . $row->DEMANDE_CODE . "</b>?</h5>
                                                    <table class='table'><tbody>".$field."</tbody><table>

                                                </div>

                                                <div class='modal-footer'>
                                                    <button type='submit' class='btn btn-primary btn-md' >Send</button>
                                                    <button class='btn btn-primary btn-md' class='close' data-dismiss='modal'>Cancel</button>
                                                </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    ";

            $sub_array[] = $options;

            $data[] = $sub_array;
        }

        $output = array(
            "draw" => intval($_POST['draw']),
            "recordsTotal" => $this->Model_Demande->count_all_data($table, $critere_array),
            "recordsFiltered" => $this->Model_Demande->get_filtered_data($table, $select_column, $critere_txt, $critere_array, $order_by),
            "data" => $data
        );
        echo json_encode($output);

    }

    public function detail()
    {
        /* if($this->mylibrary->permissions($this->uri->segment(2).'/'.$this->uri->segment(3)) ==0){
                 redirect(base_url('demande/Demande/index'));
            } */

        $demande_id = $this->uri->segment(4);

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
                $undetail['qty_livre'] = $detail['QUANTITE_LIVRE'];

                $array_details[] = $undetail;
            }
        }

        $data['array_details'] = $array_details;
        $data['title'] = "Items of a request";
        $data['breadcrumb'] = $this->make_bread->output();
        $this->load->view('Demande_Detail_View', $data);
    }

    public function Modifier()
    {
        $this->cart->destroy();
        $demande_id = $this->uri->segment(4);
        $details = $this->Model->getList('approv_demande_detail', array('DEMANDE_CODE' => 'DM_' . $demande_id));

        $array_details = array();
        if (!empty($details)) {
            foreach ($details as $detail) {
                $undetail = NULL;
                $detail_info = $this->Model->getOne('approv_produit', array('PRODUIT_ID' => $detail['PRODUIT_ID']));

                $undetail['name'] = $detail_info['PRODUIT_NOM'];
                $undetail['qty'] = $detail['QUANTITE_DEMMANDE'];
                $undetail['price'] = 1;
                $undetail['id'] = $detail['PRODUIT_ID'];

                $this->cart->insert($undetail);
            }
        }
        $data['demande_id'] = $demande_id;
        $data['breadcrumb'] = $this->make_bread->output();
        $data['title'] = "Edit a request";
        $this->load->view('Demande_Modifier_View', $data);
    }

    public function Modifier_reload()
    {
        $demande_id = $this->uri->segment(4);

        $data['demande_id'] = $demande_id;
        $data['breadcrumb'] = $this->make_bread->output();
        $data['title'] = "Edit a request";
        $this->load->view('Demande_Modifier_View', $data);
    }

    public function validerMofication()
    {
        $demande_id = $this->uri->segment(4);
        $demandes = $this->cart->contents();

        $this->Model->delete('approv_demande_detail', array('DEMANDE_CODE' => 'DM_' . $demande_id));
        foreach ($demandes as $demande) {
            $array_detail = array(
                'DEMANDE_CODE' => 'DM_' . $demande_id,
                'PRODUIT_ID' => $demande['id'],
                'QUANTITE_DEMMANDE' => $demande['qty']);
            $this->Model->insert_last_id('approv_demande_detail', $array_detail);
        }
        $msg = "The request has been sent";
        $this->cart->destroy();

        $data['msg'] = $msg;
        $this->session->set_flashdata($data);
        $this->cart->destroy();
        redirect(base_url('demande/Demande'));
    }

    public function new()
    {
        $data['title'] = "Make the request";
        $data['breadcrumb'] = $this->make_bread->output();
        $this->load->view('Demande_Nouvelle_View', $data);
    }

    public function validerDemande()
    {
        $demandes = $this->cart->contents();
        $msg = '';
        if (empty($demandes)) {
            $msg = "The cart of produits is empty";
        } else {
            $array_request = array(
                'DEMANDE_CODE' => 'DM_',
                'UTILISATEUR_ID' => $this->session->userdata('CASEHOSP_UTILISATEUR_ID'),
                'SERVICE_CODE' => $this->session->userdata('CASEHOSP_SERVICE_CODE'),
                'NIVEAU_VALIDATION' => 1
            );
// echo $this->session->userdata('CASEHOSP_UTILISATEUR_ID');exit();
            $request_id = $this->Model->insert_last_id('approv_demande', $array_request);
            $this->Model->update_table('approv_demande', array('DEMANDE_ID' => $request_id), array('DEMANDE_CODE' => 'DM_' . $request_id));

            foreach ($demandes as $demande) {
                $array_detail = array(
                    'DEMANDE_CODE' => 'DM_' . $request_id,
                    'PRODUIT_ID' => $demande['id'],
                    'QUANTITE_DEMMANDE' => $demande['qty']);
                $this->Model->insert_last_id('approv_demande_detail', $array_detail);
            }
           
            //NOTIFICATION

            $demandeur=$this->Model->getOne('admin_utilisateurs',array('UTILISATEUR_ID'=>$this->session->userdata('CASEHOSP_UTILISATEUR_ID')));
            $stock_manage=$this->Model->getList('admin_user_profil',array('STOCK'=>1));

            foreach ($stock_manage as  $value) {

                $stock_manage1=$this->Model->getList('admin_utilisateurs',array('UTILISATEUR_TYPE'=>$value['ID_PROFIL']));

                foreach ($stock_manage1 as $value1) {
                 $message="Require of :<p>"  ; 
                    // $message=$demandeur['UTILISATEUR_NOM']." ".$demandeur['UTILISATEUR_PRENOM']." TEL: ".$demandeur['UTILISATEUR_TEL']." ".$demandeur['SERVICE_CODE']." has required ";
                    foreach ($demandes as $demande) {
                        $xt=$this->Model->getOne('approv_produit',array('PRODUIT_ID' => $demande['id']));

                  $message.="<b>".$demande['qty']." ".$xt['PRODUIT_NOM']."</b><br> ";
            }
               $message.="<p>The request was formulated by <b>".$demandeur['UTILISATEUR_NOM']." ".$demandeur['UTILISATEUR_PRENOM']." TEL: ".$demandeur['UTILISATEUR_TEL']." ".$demandeur['SERVICE_CODE']."</b><p>";

                $message.="for more information, click <a href='".base_url('Login')."'>here</a>";
                   $this->notifications->send_mail($value1['UTILISATEUR_EMAIL'],'Notification request CASE HOSPITAL',array(),$message,array());

         $msg = "The request has been sent";
            $this->cart->destroy();

                }
            }
        }

        $data['msg'] = $msg;
        $this->session->set_flashdata($data);
        redirect(base_url('demande/Demande'));
    }

    public function getApproved()
    {
        $data['title'] = "The requests";
        $data['breadcrumb'] = $this->make_bread->output();
        $this->load->view('Approved_Liste_View', $data);
    }

    public function approved()
    {

        $var_search = $_POST['search']['value'];

        $table = "approv_demande";
        $critere_txt = isset($_POST['search']['value']) ? ("DEMANDE_CODE LIKE '%$var_search%'") : NULL;
        $critere_array = array('SERVICE_CODE' => $this->session->userdata('CASEHOSP_SERVICE_CODE'), 'IS_COMMANDE' => 0, 'STATUT_APPROB_ID' => 1);
        $order_column = array('DEMANDE_CODE', 'UTILISATEUR_ID', 'SERVICE_CODE', 'DATE_INSERTION', 'IS_COMMANDE', 'BUDGET_PROVISOIRE');
        $order_by = isset($_POST['order']) ? array($order_column[$_POST['order']['0']['column']] => $_POST['order']['0']['dir']) : array('DEMANDE_ID' => 'DESC');
        $select_column = array('DEMANDE_ID', 'DEMANDE_CODE', 'UTILISATEUR_ID', 'SERVICE_CODE', 'DATE_INSERTION', 'IS_COMMANDE', 'BUDGET_PROVISOIRE');

        $fetch_demandes = $this->Model_Demande->make_datatables($table, $select_column, $critere_txt, $critere_array, $order_by);

        // print_r($fetch_demandes);
        $data = array();
        foreach ($fetch_demandes as $row) {
            $sub_array = array();
            $utilisateur = $this->Model->getOne('admin_utilisateurs', array('UTILISATEUR_ID' => $row->UTILISATEUR_ID));
            $service = $this->Model->getOne('admin_service', array('SERVICE_CODE' => $row->SERVICE_CODE));
            $details = $this->Model->getList('approv_demande_detail', array('DEMANDE_CODE' => $row->DEMANDE_CODE));


            $sub_array[] = $row->DEMANDE_CODE;
            $sub_array[] = $utilisateur['UTILISATEUR_NOM'] . ' ' . $utilisateur['UTILISATEUR_PRENOM'];
            $sub_array[] = $service['SERVICE_NOM'];
            $sub_array[] = $row->BUDGET_PROVISOIRE;
            $sub_array[] = ($row->IS_COMMANDE == 1) ? 'Oui' : 'Non';
            $sub_array[] = $row->DATE_INSERTION;

            $options = '<div class="dropdown ">
                        <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Options
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-left">
                            ';
            // $options .= "<li></li>";
            
            // if($this->mylibrary->permissions($this->uri->segment(2).'/'.$this->uri->segment(3)) ==1){                          
            $options .= "<li><a href='" . base_url('demande/Demande/detail/' . $row->DEMANDE_ID) . "'>
                                        Détail</li></ul>
                                   </div>";
            //}
            

            $sub_array[] = $options;

            $data[] = $sub_array;
        }

        $output = array(
            "draw" => intval($_POST['draw']),
            "recordsTotal" => $this->Model_Demande->count_all_data($table, $critere_array),
            "recordsFiltered" => $this->Model_Demande->get_filtered_data($table, $select_column, $critere_txt, $critere_array, $order_by),
            "data" => $data
        );
        echo json_encode($output);

    }

    public function getToorder()
    {
        $data['title'] = "The requests";
        $data['breadcrumb'] = $this->make_bread->output();
        $this->load->view('Toorder_Liste_View', $data);
    }

    public function toOrder()
    {

        $var_search = $_POST['search']['value'];

        $table = "approv_demande";
        $critere_txt = isset($_POST['search']['value']) ? ("DEMANDE_CODE LIKE '%$var_search%'") : NULL;
        $critere_array = array('SERVICE_CODE' => $this->session->userdata('CASEHOSP_SERVICE_CODE'), 'IS_COMMANDE' => 1);
        $order_column = array('DEMANDE_CODE', 'UTILISATEUR_ID', 'SERVICE_CODE', 'DATE_INSERTION', 'IS_COMMANDE', 'BUDGET_PROVISOIRE');
        $order_by = isset($_POST['order']) ? array($order_column[$_POST['order']['0']['column']] => $_POST['order']['0']['dir']) : array('DEMANDE_ID' => 'DESC');
        $select_column = array('DEMANDE_ID', 'DEMANDE_CODE', 'UTILISATEUR_ID', 'SERVICE_CODE', 'DATE_INSERTION', 'IS_COMMANDE', 'BUDGET_PROVISOIRE');

        $fetch_demandes = $this->Model_Demande->make_datatables($table, $select_column, $critere_txt, $critere_array, $order_by);

        // print_r($fetch_demandes);
        $data = array();
        foreach ($fetch_demandes as $row) {
            $sub_array = array();
            $utilisateur = $this->Model->getOne('admin_utilisateurs', array('UTILISATEUR_ID' => $row->UTILISATEUR_ID));
            $service = $this->Model->getOne('admin_service', array('SERVICE_CODE' => $row->SERVICE_CODE));
            $details = $this->Model->getList('approv_demande_detail', array('DEMANDE_CODE' => $row->DEMANDE_CODE));


            $sub_array[] = $row->DEMANDE_CODE;
            $sub_array[] = $utilisateur['UTILISATEUR_NOM'] . ' ' . $utilisateur['UTILISATEUR_PRENOM'];
            $sub_array[] = $service['SERVICE_NOM'];
            $sub_array[] = $row->BUDGET_PROVISOIRE;
            $sub_array[] = ($row->IS_COMMANDE == 1) ? 'Oui' : 'Non';
            $sub_array[] = $row->DATE_INSERTION;

            $options = '<div class="dropdown ">
                        <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Options
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-left">
                            ';
            // $options .= "";
            
            // if($this->mylibrary->permissions($this->uri->segment(2).'/'.$this->uri->segment(3)) ==1){                          
            $options .= "<li><a href='" . base_url('demande/Demande/detail/' . $row->DEMANDE_ID) . "'>
                                        Détail</li></ul>
                                   </div>";
            //}
            

            $sub_array[] = $options;

            $data[] = $sub_array;
        }

        $output = array(
            "draw" => intval($_POST['draw']),
            "recordsTotal" => $this->Model_Demande->count_all_data($table, $critere_array),
            "recordsFiltered" => $this->Model_Demande->get_filtered_data($table, $select_column, $critere_txt, $critere_array, $order_by),
            "data" => $data
        );
        echo json_encode($output);

    }

    public function supprimer($id){

        $demande_code=$this->Model->getOne('approv_demande',array('DEMANDE_ID'=>$id));


        $this->Model->delete('approv_demande_detail',array('DEMANDE_CODE'=>$demande_code['DEMANDE_CODE']));

        $this->Model->delete('approv_demande',array('DEMANDE_CODE'=>$demande_code['DEMANDE_CODE']));


        $msg = "<div class='alert alert-success text-center'>The request has been deleted</div>";

        $data['msg'] = $msg;
        $this->session->set_flashdata($data);
       
        redirect(base_url('demande/Demande'));
    }

}

