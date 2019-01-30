<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Delivered extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Model_Demande");
        $this->make_bread->add('Order Delivered', "demande/Delivered", 0);
        $this->load->library('Mylibrary');
        $this->breadcrumb = $this->make_bread->output();
    }

    public function index()
    {
        $data['title'] = "Order Delivered";
        $data['breadcrumb'] = $this->make_bread->output();
        $this->load->view('Delivered_Liste_View', $data);
    }

    public function get_demandes()
    {

        $var_search = $_POST['search']['value'];

        $table = "approv_demande";
        $critere_txt = isset($_POST['search']['value']) ? ("DEMANDE_CODE LIKE '%$var_search%'") : NULL;
        $critere_array = array('IS_PAID' => 0,'IS_DELIVERED' => 1);
        $order_column = array('DEMANDE_CODE', 'UTILISATEUR_ID', 'SERVICE_CODE', 'DELIVERY_DATE', 'IS_DELIVERED', 'BUDGET_CONTRACTUEL');
        $order_by = isset($_POST['order']) ? array($order_column[$_POST['order']['0']['column']] => $_POST['order']['0']['dir']) : array('DEMANDE_ID' => 'DESC');
        $select_column = array('DEMANDE_ID', 'DEMANDE_CODE', 'UTILISATEUR_ID', 'SERVICE_CODE', 'DELIVERY_DATE', 'IS_DELIVERED', 'BUDGET_CONTRACTUEL');

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
            $sub_array[] = $row->BUDGET_CONTRACTUEL;
            $sub_array[] = ($row->IS_DELIVERED == 1) ? 'Oui' : 'Non';
            $sub_array[] = $row->DELIVERY_DATE;
            //}
            $field = "
                    <tr><div class='form-group'>
                        <td><label class='col-md-4 col-sm-12 col-xs-12 control-label'>Transaction code</label></td>
                        <td><div class='col-md-5 col-sm-12 col-xs-12 col-md-push-1'>
                            <input type='text' name='transaction' value='' class='form-control' required=''>
                        </div></td>
                    </div></tr>
                    <tr><div class='form-group'>
                        <td><label class='col-md-4 col-sm-12 col-xs-12 control-label'>Amount</label></td>
                        <td><div class='col-md-5 col-sm-12 col-xs-12 col-md-push-1'>
                            <input type='number' name='amount' min='1' value='' class='form-control' required=''>
                        </div></td>
                    </div></tr>
                    ";

            $options = "<button class='btn btn-primary btn-md' data-toggle='modal' data-target='#myorder" . $row->DEMANDE_ID . "'>Enter Payment</button>
                                    <div class='modal fade' id='myorder" . $row->DEMANDE_ID . "'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>

                                                
                                                <form name='myform' method='post' class='form-horizontal' action=" . base_url('demande/Delivered/payment/' . $row->DEMANDE_ID) . ">
                                                <div class='modal-body'>
                                                    <h5>Please, Enter the payment details for request : <b>" . $row->DEMANDE_CODE . "</b>?</h5>
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

    public function payment()
    {
        $demande_id = $this->uri->segment(4);

        $data['message'] = '';

        $amount = $_POST['amount'];
        $transaction = $_POST['transaction'];

        $donnee = array(
            'PAIEMENT_CODE' => $transaction,
            'PAIEMENT_MONTANT' => $amount,
            'PAIEMENT_DATE' => date("Y-m-d H:i:s"),
            'UTILISATEUR_ID' => $this->session->userdata('CASEHOSP_UTILISATEUR_ID')
        );


        $this->Model->insert_last_id('approv_paiement', $donnee);

        $donnee1 = array(
                'IS_PAID' => 1
                           );

        $this->Model->update_table('approv_demande', array('DEMANDE_CODE' => 'DM_'.$demande_id), $donnee1);

        $data['msg'] = "<div class='alert alert-success'>Le paiement a été enregistré avec succès.</div>";


        redirect(base_url('demande/Delivered'));

    }

}

