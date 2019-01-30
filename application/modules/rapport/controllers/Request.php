<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Request extends CI_Controller {


 public function index()
{
    $data['title']= 'Reporting';
    $data['entree'] ="";
    $data['sortie'] ="";
    $data['categorie']= "'Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Décembre'";
    for($i= 1; $i<= date('m'); $i++){
        if($i == 1 || $i == 2 || $i == 3 || $i == 4 || $i == 5 || $i == 6 || $i == 7 || $i == 8 || $i == 9){
             $cond= "MONTH(DATE_INSERTION) = '0".$i."'";
             $cond2= "YEAR(DATE_INSERTION) = '".date('Y')."'";

             $cond3= "MONTH(DELIVERY_DATE) = '0".$i."'";
             $cond4= "YEAR(DELIVERY_DATE) = '".date('Y')."'";
             $entree= $this->Model->record_count_cond('approv_demande',$cond,$cond2,array('IS_DELIVERED'=>0));
             $sortie= $this->Model->record_count_cond('approv_demande',$cond3,$cond4,array('IS_DELIVERED'=>1));
             $data['entree'] .= $entree.",";
             $data['sortie'] .= $sortie.",";
             //print_r($cond);
        }else{
            $cond= "MONTH(DATE_INSERTION) = '".$i."'";
             $cond2= "YEAR(DATE_INSERTION) = '".date('Y')."'";

             $cond3= "MONTH(DELIVERY_DATE) = '0".$i."'";
             $cond4= "YEAR(DELIVERY_DATE) = '".date('Y')."'";
             $entree= $this->Model->record_count_cond('approv_demande',$cond,$cond2,array('IS_DELIVERED'=>0));
             $sortie= $this->Model->record_count_cond('approv_demande',$cond3,$cond4,array('IS_DELIVERED'=>1));
             $data['entree'] .= $entree.",";
             $data['sortie'] .= $sortie.",";
             //print_r($cond);
        }
    }
    $data['entree'] .= '//';
    $data['entree'] = str_replace(",//","", $data['entree']);
    $data['sortie'] .= '//';
    $data['sortie'] = str_replace(",//","", $data['sortie']);
    $data['titre'] = "Requests undelivered vs requests delivered";
    $data['annee']= date('Y');
    
    $this->load->view('Request_view',$data);
}

   function change(){

    $annee= $this->uri->segment(4);
    $data['title']= 'Reporting';
    $data['entree'] ="";
    $data['sortie'] ="";
    $data['categorie'] = "";
    $cate= array('1'=>'Janvier','2'=>'Février','3'=>'Mars','4'=>'Avril','5'=>'Mai','6'=>'Juin','7'=>'Juillet','8'=>'Aout','9'=>'Septembre','10'=>'Octobre','11'=>'Novembre','12'=>'Décembre');
    if($annee == date('Y')){
    $data['categorie']= "'Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Décembre'";
    for($i= 1; $i<= date('m'); $i++){
        if($i == 1 || $i == 2 || $i == 3 || $i == 4 || $i == 5 || $i == 6 || $i == 7 || $i == 8 || $i == 9){
             $cond= "MONTH(DATE_INSERTION) = '".$i."'";
             $cond2= "YEAR(DATE_INSERTION) = '".$annee."'";

             $cond3= "MONTH(DELIVERY_DATE) = '0".$i."'";
             $cond4= "YEAR(DELIVERY_DATE) = '".$annee."'";
             $entree= $this->Model->record_count_cond('approv_demande',$cond,$cond2,array('IS_DELIVERED'=>0));
             $sortie= $this->Model->record_count_cond('approv_demande',$cond3,$cond4,array('IS_DELIVERED'=>1));
             $data['entree'] .= $entree.",";
             $data['sortie'] .= $sortie.",";
             //print_r($cond);
        }else{
            $cond= "MONTH(DATE_INSERTION) = '".$i."'";
             $cond2= "YEAR(DATE_INSERTION) = '".$annee."'";

             $cond3= "MONTH(DELIVERY_DATE) = '0".$i."'";
             $cond4= "YEAR(DELIVERY_DATE) = '".$annee."'";
             $entree= $this->Model->record_count_cond('approv_demande',$cond,$cond2,array('IS_DELIVERED'=>0));
             $sortie= $this->Model->record_count_cond('approv_demande',$cond3,$cond4,array('IS_DELIVERED'=>1));
             $data['entree'] .= $entree.",";
             $data['sortie'] .= $sortie.",";
             //print_r($cond);
        }
    }
    $data['titre'] = "Requests undelivered vs requests delivered";
   }else{
      
      for($i= 1; $i<= 12; $i++){
        if($i == 1 || $i == 2 || $i == 3 || $i == 4 || $i == 5 || $i == 6 || $i == 7 || $i == 8 || $i == 9){
             $cond= "MONTH(DATE_INSERTION) = '".$i."'";
             $cond2= "YEAR(DATE_INSERTION) = '".$annee."'";

             $cond3= "MONTH(DELIVERY_DATE) = '0".$i."'";
             $cond4= "YEAR(DELIVERY_DATE) = '".$annee."'";
             $entree= $this->Model->record_count_cond('approv_demande',$cond,$cond2,array('IS_DELIVERED'=>0));
             $sortie= $this->Model->record_count_cond('approv_demande',$cond3,$cond4,array('IS_DELIVERED'=>1));
             if($entree > 0){
             $data['entree'] .= $entree.","; }
             if($sortie > 0){
             $data['sortie'] .= $sortie.","; }
             if( $entree > 0 || $sortie > 0){
             $data['categorie'] .= $cate[$i].",";
             $data['titre'] = "Requests undelivered vs requests delivered"; }
             //print_r($cond);
        }else{
            $cond= "MONTH(DATE_INSERTION) = '".$i."'";
             $cond2= "YEAR(DATE_INSERTION) = '".$annee."'";

             $cond3= "MONTH(DELIVERY_DATE) = '0".$i."'";
             $cond4= "YEAR(DELIVERY_DATE) = '".$annee."'";
             $entree= $this->Model->record_count_cond('approv_demande',$cond,$cond2,array('IS_DELIVERED'=>0));
             $sortie= $this->Model->record_count_cond('approv_demande',$cond3,$cond4,array('IS_DELIVERED'=>1));
             if($entree > 0){
             $data['entree'] .= $entree.","; }
             if($sortie > 0){
             $data['sortie'] .= $sortie.","; }
             if( $entree > 0 || $sortie > 0){
             $data['categorie'] .= $cate[$i].",";
             $data['titre'] = "Requests undelivered vs requests delivered"; }
        }
    }
    $data['categorie'] .= '//';
    $data['categorie'] = str_replace(",//","", $data['categorie']);

   }
    
    $data['entree'] .= '//';
    $data['entree'] = str_replace(",//","", $data['entree']);
    $data['sortie'] .= '//';
    $data['sortie'] = str_replace(",//","", $data['sortie']);

    if($data['entree'] == "" && $data['sortie'] == ""){
        $data['titre'] = "No results";
    }
    
    $data['annee']= $annee;
    $this->load->view('Request_view',$data);

   }
}