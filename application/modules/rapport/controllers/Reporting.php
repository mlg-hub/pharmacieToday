<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reporting extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->make_bread->add('Reporting', "Reporting", 0);
        $this->breadcrumb = $this->make_bread->output();
    }

    public function ticket() {
        $data['breadcrumb'] = $this->make_bread->output();
        $data['date_max']= date('Y');
        $data['date_min']= date('Y') - 5;
        // $data['annee']= $this->input->post('annee');
        // $data['mois']= $this->input->post('mois');
        // $data['mois2']= $this->input->post('mois2'); 
        $annee= $this->input->post('annee');
        $mois= $this->input->post('mois');
        $mois2= $this->input->post('mois2');

        if($annee != "" && $mois != "" && $mois2 != ""){
            $cond_annee= "DATE_PARK_PAID LIKE '%$annee%'";
            $cond_mois= "MONTH(DATE_PARK_PAID) BETWEEN '$mois' AND '$mois2'";
            $data['annee']= $this->input->post('annee');
            $data['mois']= $this->input->post('mois');
            $data['mois2']= $this->input->post('mois2');

        }else if($annee != "" && $mois != "" && $mois2 ==""){
            $cond_annee= "DATE_PARK_PAID LIKE '%$annee%'";
            $cond_mois= "DATE_PARK_PAID LIKE '%$mois-%'"; 
            $data['annee']= $this->input->post('annee');
            $data['mois']= $this->input->post('mois');

        }else if($annee != "" && $mois == "" && $mois2 !=""){
            $cond_annee= "DATE_PARK_PAID LIKE '%$annee%'";
            $cond_mois= "DATE_PARK_PAID LIKE '%$mois2-%'";
            $data['annee']= $this->input->post('annee');
            $data['mois2']= $this->input->post('mois2');

        }else{
            $date= date('Y');
            $cond_annee= "DATE_PARK_PAID LIKE '%$date%'";
            $cond_mois =array();
            $data['annee']= date('Y');
        }
        
        $data['tickets']= "";
        $soc= $this->Model->getList("admin_societe",array());
        $somme= 0;
        foreach($soc as $so){
            $ticket= $this->Model->getList_distinct_s("park_ticket","DISTINCT(NUMERO_TEL_LOG)","SUM(MONTANT_PAYE) as som",array(),$cond_annee,$cond_mois,'NUMERO_TEL_LOG');
            //print_r($ticket);
            foreach($ticket as $tc){
               if($this->Model->checkvalue("park_agent",array('SOCIETE_ID'=>$so['SOCIETE_ID'],'TELEPHONE'=>$tc['NUMERO_TEL_LOG']))){
                   $somme = $somme + $tc['som'];
               }
            }
            if($somme > 0){
                $data['tickets'] .= "{name:'".$so['SOCIETE_NOM']."',y:".$somme."},";
            }
            $somme =0;
            //print_r($ticket);
        }

        
        $data['tickets'] .= "//";
        $data['tickets'] = str_replace(',//', '', $data['tickets']);

    	$this->load->view('rapport_versement_agent_view/ticket',$data);
    }
}