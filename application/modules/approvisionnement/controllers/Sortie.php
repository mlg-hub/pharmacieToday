<?php

// ------ Alain --- 27/02/2018 

defined("BASEPATH") OR exit("No direct script access allowed");

class Sortie extends CI_Controller
{
	public function _construct()
	{
		parent::_construct();
		$this->load->library('cart');
		$this->make_bread->add('Sortie', "approvisionnement/Sortie", 0);
		$this->breadcrumb = $this->make_bread->output();
	}

	public function index(){
		$this->make_bread->add('Procuration','approvisionnement/Sortie');
		$data['breadcrumb'] = $this->make_bread->output();
		$approv= $this->Model->getList('approv_demande',array('IS_DELIVERED'=>1,'IS_OUT'=>0));
		$data['table']= '<table id="requests_list" class="table table-bordered table-hover table-stripped table-responsive"><thead><tr><th>Demande code</th><th>Fournisseur</th><th>Détails</th></tr></thead><tbody>';
		foreach($approv as $ap){
			$code= $this->Model->getOne('approv_demande',array('DEMANDE_CODE'=>$ap['DEMANDE_CODE']));
           $four= $this->Model->getOne('approv_soumission_commande',array('DEMANDE_ID'=>$code['DEMANDE_ID']));
           $four_n= $this->Model->getOne('approv_soummissionaire',array('ID_SOUMISSIONAIRE'=>$four['SOUMMISSIONAIRE_ID']));
           $data['table'] .= '<tr><td>'.$ap['DEMANDE_CODE'].'</td><td>'.$four_n['NOM_SOUMMISSIONAIRE'].' '.$four_n['PRENOM_SOUMMISSIONAIRE'].'</td><td class="text-center">
             <div class="dropdown ">
                        <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Action
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-left">
                       <li><a href="'. base_url('approvisionnement/Sortie/details/'.$ap['DEMANDE_CODE']) .'">
                                        Details</li>
                        </ul>
                    </div>
           </td></tr>';
		}
        

        $data['title'] = "Output";
		$this->load->view('Sortie_list_view',$data);
	}

	public function details(){
		$this->make_bread->output();
		$this->make_bread->add('Confirmation de la sortie','rh/approvisionnement/Sortie/details');
		$data['breadcrumb'] = $this->make_bread->output();
		$approv= $this->Model->getList('approv_demande_detail',array('DEMANDE_CODE'=>$this->uri->segment(4),'IS_LIVRE'=>1,'IS_OUT'=>0));
		$data['table']= '<table id="requests_list" class="table table-bordered table-hover table-stripped table-responsive"><thead><tr><th>Produit</th><th>Qté disponible</th><th>Qté sortie</th><th>Commentaire</th><th>Confirmer</th></tr></thead><tbody>';
		foreach($approv as $ap){
           $code= $this->Model->getOne('approv_demande',array('DEMANDE_CODE'=>$ap['DEMANDE_CODE']));
           $four= $this->Model->getOne('approv_soumission_commande',array('DEMANDE_ID'=>$code['DEMANDE_ID']));
           $four_n= $this->Model->getOne('approv_soummissionaire',array('ID_SOUMISSIONAIRE'=>$four['SOUMMISSIONAIRE_ID']));
           $prod= $this->Model->getOne('approv_produit',array('PRODUIT_ID'=>$ap['PRODUIT_ID']));
           $data['table'] .= '<tr><td><input id="prod'.$ap['DETAIL_ID'].'" value="'.$ap['PRODUIT_ID'].'" type="hidden"><input id="code'.$ap['DETAIL_ID'].'" value="'.$ap['DEMANDE_CODE'].'" type="hidden">'.$prod['PRODUIT_NOM'].'</td><td>'.$prod['QUANTITE_DISPONIBLE'].'</td><td class="text-center"><input class="form-control" onchange="" type="number" id="approv'.$ap['DETAIL_ID'].'" value="'.$ap['QUANTITE_DEMMANDE'].'"></td><td class="text-center"><textarea class="form-control" type="text" id="com'.$ap['DETAIL_ID'].'"></textarea></td><td class="text-center"><input type="checkbox" value="1" id="'.$ap['DETAIL_ID'].'" onchange="confirmer(this)"></td></tr>';
		}
		$data['table'] .= '</tbody></table><a class="btn btn-primary" href="'.base_url('approvisionnement/Sortie').'">Terminer</a>';
		 $data['title'] = "Output";

		$this->load->view('Sortie_details_view',$data);
	}

	public function details2(){

		$this->make_bread->output();
		$this->make_bread->add('Confirmation de la sortie','rh/approvisionnement/Sortie/details');
		$data['breadcrumb'] = $this->make_bread->output();
		$approv= $this->Model->getList('approv_demande_detail',array('DEMANDE_CODE'=>$this->uri->segment(4),'IS_LIVRE'=>1,'IS_OUT'=>1));
		$data['table']= '<table id="requests_list" class="table table-bordered table-hover table-stripped table-responsive"><thead><tr><th>Produit</th><th>Qté disponible</th><th>Qté sortie</th><th>Commentaire</th></tr></thead><tbody>';
		foreach($approv as $ap){
           $code= $this->Model->getOne('approv_demande',array('DEMANDE_CODE'=>$ap['DEMANDE_CODE']));
           $four= $this->Model->getOne('approv_soumission_commande',array('DEMANDE_ID'=>$code['DEMANDE_ID']));
           
           $four_n= $this->Model->getOne('approv_soummissionaire',array('ID_SOUMISSIONAIRE'=>$four['SOUMMISSIONAIRE_ID']));

           $prod= $this->Model->getOne('approv_produit',array('PRODUIT_ID'=>$ap['PRODUIT_ID']));
           $data['table'] .= '<tr><td>'.$prod['PRODUIT_NOM'].'</td><td>'.$prod['QUANTITE_DISPONIBLE'].'</td><td>'.$prod['QUANTITE_DISPONIBLE'].'</td><td>'.$ap['COMMENTAIRE'].'</td></tr>';
		}
		$data['table'] .= '</tbody></table>';
		 $data['title'] = "Output"; 

		$this->load->view('Sortie_details_view',$data);
	}

	public function reception(){
		$this->make_bread->output();
		$this->make_bread->add('Reception','rh/approvisionnement/Sortie/reception');
		$data['breadcrumb'] = $this->make_bread->output();
		// $approv= $this->Model->getList('approv_demande_detail',array('IS_LIVRE'=>1));
		// $demande= $this->Model->getList('stock_historique',array('SORTANT_ENTRANT'=>'SORTIE'));
		// $data['table']= '<table id="requests_list" class="table table-bordered table-hover table-stripped table-responsive"><thead><tr><th>Produit</th><th>Qté sortie</th><th>Date de sortie</th></tr></thead><tbody>';

		// $i= 1;
		// foreach($demande as $d){
		// 	$prod= $this->Model->getOne('approv_produit',array('PRODUIT_ID'=>$d['PRODUIT_ID']));
		// 	//$dat= date_create($d['IS_COMMANDE_DATE']);
        //           $data['table'] .= '<tr><td>'.$prod['PRODUIT_NOM'].'</td><td>'.$d['QUANTITE'].'</td><td>'.$d['DATE_TIME'].'</td></tr>';
  //           $i = $i + 1;
		// }

        $approv= $this->Model->getList('approv_demande',array('IS_DELIVERED'=>1,'IS_OUT'=>1));
		$data['table']= '<table id="requests_list" class="table table-bordered table-hover table-stripped table-responsive"><thead><tr><th>Demande code</th><th>Fournisseur</th><th>Détails</th></tr></thead><tbody>';
		foreach($approv as $ap){
			$code= $this->Model->getOne('approv_demande',array('DEMANDE_CODE'=>$ap['DEMANDE_CODE']));
           $four= $this->Model->getOne('approv_soumission_commande',array('DEMANDE_ID'=>$code['DEMANDE_ID']));
           $four_n= $this->Model->getOne('approv_soummissionaire',array('ID_SOUMISSIONAIRE'=>$four['SOUMMISSIONAIRE_ID']));
           $data['table'] .= '<tr><td>'.$ap['DEMANDE_CODE'].'</td><td>'.$four_n['NOM_SOUMMISSIONAIRE'].' '.$four_n['PRENOM_SOUMMISSIONAIRE'].'</td><td class="text-center">
             <div class="dropdown ">
                        <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Action
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-left">
                       <li><a href="'. base_url('approvisionnement/Sortie/details2/'.$ap['DEMANDE_CODE']) .'">
                                        Details</li>
                        </ul>
                    </div>
           </td></tr>';
		}

          $data['title'] = "Output";
		$this->load->view('Sortie_liste_recu_view',$data);
	}

	public function detailsnew(){
		$this->make_bread->output();
		$this->make_bread->add('Confirmation de la réception','rh/approvisionnement/Procurement/details');
		$data['breadcrumb'] = $this->make_bread->output();
		$approv= $this->Model->getList('approv_demande_detail',array('DEMANDE_CODE'=>$this->uri->segment(4),'IS_LIVRE'=>0));
		$data['table']= '<table id="requests_list" class="table table-bordered table-hover table-stripped table-responsive"><thead><tr><th>Produit</th><th>Qté commandée</th><th>Qté livrée</th></tr></thead><tbody>';
		foreach($approv as $ap){
           $prod= $this->Model->getOne('approv_produit',array('PRODUIT_ID'=>$ap['PRODUIT_ID']));
           $data['table'] .= '<tr><td>'.$prod['PRODUIT_NOM'].'</td><td>'.$ap['QUANTITE_BON_COMMANDE'].'</td><td class="text-center"><input class="form-control" readonly="readonly" onchange="" type="number" id="approv'.$ap['DETAIL_ID'].'" value="'.$ap['QUANTITE_BON_COMMANDE'].'"></td></tr>';
		}
		$data['table'] .= '</tbody></table><a class="btn btn-primary" href="'.base_url('approvisionnement/Sortie').'">Terminer</a>';
        $data['title'] = "Output";
		$this->load->view('Sortie_details_view',$data);
	}
	public function confirmer(){
         
         $prod= $this->input->post('id');
		 $id= $this->input->post('valer');
		 $liv= $this->input->post('liv');
		 $com= $this->input->post('com');
		 $code= $this->input->post('code');
		 if($this->input->post('ok') == '1'){
            $dispo= $this->Model->getOne('approv_produit',array('PRODUIT_ID'=>$prod));
            $reste= $dispo['QUANTITE_DISPONIBLE'] - $liv;
            $this->Model->update('approv_produit',array('PRODUIT_ID'=>$prod),array('QUANTITE_DISPONIBLE'=>$reste));
            $this->Model->create('stock_historique',array('PRODUIT_ID'=>$prod,'SORTANT_ENTRANT'=>'SORTIE','DATE_TIME'=>date('Y-m-d H:i:s'),'QUANTITE'=>$liv));
            if($this->Model->checkvalue('approv_demande_detail',array('DEMANDE_CODE'=>$code,'IS_OUT'=>0)) == false){
                $this->Model->update('approv_demande',array('DEMANDE_CODE'=>$code),array('IS_OUT'=>1));
            }
		 }else{
		 	$dispo= $this->Model->getOne('approv_produit',array('PRODUIT_ID'=>$prod));
            $reste= $dispo['QUANTITE_DISPONIBLE'] - $liv;
            $this->Model->update('approv_produit',array('PRODUIT_ID'=>$prod),array('QUANTITE_DISPONIBLE'=>$reste));
            $this->Model->create('stock_historique',array('PRODUIT_ID'=>$prod,'SORTANT_ENTRANT'=>'SORTIE','DATE_TIME'=>date('Y-m-d H:i:s'),'QUANTITE'=>$liv));
            if($this->Model->checkvalue('approv_demande_detail',array('DEMANDE_CODE'=>$code,'IS_OUT'=>0)) == false){
                $this->Model->update('approv_demande',array('DEMANDE_CODE'=>$code),array('IS_OUT'=>1));
            }
		 }
		 echo '';
	}

}