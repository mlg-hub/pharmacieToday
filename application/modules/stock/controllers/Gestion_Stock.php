<?php

 
class Gestion_Stock extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // $this->is_Oauth();
        //$this->make_bread->add('stock/Stock', "stock/Stock", 0);
        //$this->breadcrumb = $this->make_bread->output();
    }

    // public function is_Oauth()
    // {
    //    if($this->session->userdata('USER_EMAIL') == NULL)
    //     redirect(base_url());
    // }

    public function index()
       {
          $this->make_bread->add('Gestion Stock', "gestion_stock_views/stock_add_view", 0);
          $data['breadcrumb'] = $this->make_bread->output();
         $data['MEDICAMENT'] = $this->Model->getList('medicament');
         $data['TYPE'] = $this->Model->getList('type_medicament');
         $data['FOURN']=$this->Model->getList('fournisseur');
          $data['title']="Stock";
       $this->load->view('gestion_stock_views/stock_add_view',$data);
      }

     public function add() {
        $this->form_validation->set_rules('Medicament','description', 'trim|required');
        $this->form_validation->set_rules('Type','type Medicament', 'trim|required');
        $this->form_validation->set_rules('DateExp','date expiration', 'trim|required');
        $this->form_validation->set_rules('DateStock','date stockage', 'trim|required');
        $this->form_validation->set_rules('Nombre','nombre', 'trim|required');
        $this->form_validation->set_rules('Quantite','Quantite', 'trim|required');
        $this->form_validation->set_rules('TypeStock','Type du stock', 'trim|required');
        $this->form_validation->set_rules('PrixVente','prix d\'achat', 'trim|required');
        $this->form_validation->set_rules('fourn','Fournisseur', 'trim|required');
        $this->form_validation->set_rules('PrixAchat','prix de vente', 'trim|required');

        if ($this->form_validation->run() == FALSE)
          {  
          $this->make_bread->add('Nouveau Médicament', "stock/Gestion_stock", 0);
          $data['breadcrumb'] = $this->make_bread->output();
         
         $MEDICAMENT=$this->input->post('Medicament');
         $PRIX_ACHAT=$this->input->post('PrixAchat');
         $PRIX_VENTE=$this->input->post('PrixVente');
         $NOMBRE=$this->input->post('Nombre');
         $Quantite=$this->input->post('Quantite');
         $DATE_EXPIRATION=$this->input->post('DateExp');
         $DATE_STOCKAGE=$this->input->post('DateStock');
         $TYPE=$this->input->post('Type');
         $TYPESTOCK=$this->input->post('TypeStock');
         $FOURNISSEUR=$this->input->post('Fournisseur');

$idmed=$this->Model->getone('medicament',array('DESCRIPTION'=>$MEDICAMENT));
$idfourn=$this->Model->getone('fournisseur',array('DESCRIPTION'=>$FOURNISSEUR));
$idtype=$this->Model->getone('type_medicament',array('DESCRIPTION'=>$TYPE));

      
$idm=$idmed['MEDICAMENT_ID'];
$idt=$idtype['TYPE_ID'];
$idf=$idfourn['ID_FOURNISSEUR'];
// exit();
     
$datacomplet=array(
  'MEDICAMENT_ID'=>$idm,
  'TYPE_ID'=>$idt,
  'PRIX_ACHAT'=>$PRIX_ACHAT,
  'PRIX_VENTE'=>$PRIX_VENTE,
  'DATE_STOCKAGE'=>$DATE_STOCKAGE,
  'DATE_EXPIRATION'=>$DATE_EXPIRATION,
  'QUANTIT_INITIAL'=>$Quantite,
  'QUANTIT_FINAL'=>$NOMBRE,
  'NOMBRE_FINAL'=>$NOMBRE,
  'ID_FOURNISSEUR'=>$idf,
  'NOMBRE_INITIAL'=>$Quantite,
  'TYPE_STOCKAGE'=>$TYPESTOCK);

  $this->Model->create('stock',$datacomplet);
     $datas['success']= "<div class='alert alert-info alert-dismissible'id='aleter' align='center'>
  <button type='button' class='close' data-dismiss='alert'>&times;</button>
  Enregistrement réussi!
</div>";
     $this->session->set_flashdata($datas);
    $this->load->view('gestion_stock_views/stock_add_view',$data);
             }
    }
function listing()
  {

        $table['tableau']= '<table id="msg_table" class="table table-bordered table-stripped table-hover table-condensed"><tr><th>Fournisseur</th><th>type Medicament</th><th>PrixAchat</th><th>PrixVente</th> <th>Quantite</th><th>Fournisseur</th> <th>Option</th></tr>';
        $data= $this->Model->getList('stock',array());

             foreach($data as $da)
            {
 
            $fourn= $this->Model->getOne("fournisseur",array('ID_FOURNISSEUR'=>$da['ID_FOURNISSEUR']));
            $med= $this->Model->getOne("medicament",array('MEDICAMENT_ID'=>$da['MEDICAMENT_ID']));


               $table['tableau'] .= '<tr><td>'.$med["DESCRIPTION"].'</td><td>'.$da["PRIX_ACHAT"].'</td><td>'.$da["PRIX_ACHAT"].'</td><td>'.$da["PRIX_ACHAT"].'</td><td>'.$da["PRIX_ACHAT"].'</td><td>'.$fourn["DESCRIPTION"].'</td> <td>

  <div class="dropdown ">
 <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Action
         <span class="caret"></span></a>
           <ul class="dropdown-menu dropdown-menu-right">
                        ';


                $table['tableau'] .='<li><a href="'.base_url("administration/Users_Profil/update_profil/".$da['STOCK_ID']).'">Modifier</a></li>';

               $table['tableau'] .= "<li><a hre='#' data-toggle='modal' 
                                  data-target='#mydelete" . $da['STOCK_ID'] . "'><font color='red'>Supprimer</font></a></li>";
           
           $table['tableau'] .= "   </ul>
                  </div>
      <div class='modal fade' id='mydelete" . $da['STOCK_ID'] . "'>
        <div class='modal-dialog'>
         <div class='modal-content'>
       <div class='modal-body'>
         <h5>Supprimer  :<b>" . $da['PRIX_ACHAT'] . "</b>?</h5>
                                                </div>
       <div class='modal-footer'>
        <a class='btn btn-danger btn-md' href='" . base_url('stock/'.$da['STOCK_ID']). "'>Supprimer</a>
           <button class='btn btn-primary btn-md' class='close' data-dismiss='modal'>Annuler</button>
               </div>

           </div>
                                        </div>
                                    </div>";

            }
            $table['tableau'] .= '</table>';
            $table['breadcrumb'] = $this->make_bread->output(); 
         
            $table['title']= "Stock";
            $this->load->view("stock/gestion_stock_views/Stock_List_View",$table);
  }


}


