<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Type_Medicament extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->make_bread->add('Nouveau type de médicament', "stock/Type_Medicament", 0);
        $this->breadcrumb = $this->make_bread->output();
    }

    public function index()
    {

      $data['title'] = "Type of Products";
      $data['breadcrumb'] = $this->make_bread->output();
      $this->load->view('type_medicament_views/Type_Medicament_Nouvelle_View',$data);


    }

  function listing()
    {


    $table="type_medicament";
     $resultat=$this->Model->getList($table,array());
     $tabledata=array();
     foreach ($resultat as $key) {
  
      $type=array();
      $type[]=$key['TYPE_ID'];
      $type[]=$key['DESCRIPTION'];

       $type['OPTIONS'] = '<div class="dropdown ">
                    <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Action
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        ';
    
 
     $type['OPTIONS'] .= "<li><a href='" . base_url('stock/Type_Medicament/getOne/' . $key['TYPE_ID']) . "'>Modifier</a></li>";
     

       $type['OPTIONS'] .= "<li><a hre='#' data-toggle='modal' 
                                  data-target='#mydelete" . $key['TYPE_ID'] . "'><font color='red'>Supprimer</font></a></li>";
   

            

       $type['OPTIONS'] .= "   </ul>
                  </div>
                                    <div class='modal fade' id='mydelete" . $key['TYPE_ID'] . "'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>

                                                <div class='modal-body'>
                                                    <h5>Supprimer :<b>" . $key['DESCRIPTION'] . "</b>?</h5>
                                                </div>

                                               <div class='modal-footer'>
                                                    <a class='btn btn-danger btn-md' href='" . base_url('stock/Type_Medicament/delete/' . $key['TYPE_ID']) . "'>Supprimer</a>
                                                    <button class='btn btn-primary btn-md' class='close' data-dismiss='modal'>Quitter</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>";
      



      $tabledata[]=$type;
     }

        $template = array(
            'table_open' => '<table id="mytable" class="table table-bordered table-stripped table-hover table-condensed col-sm-4">',
            'table_close' => '</table>'
        );
        $this->table->set_template($template);
        $this->table->set_heading(array('Code','Description of product type','Option'));
        $data['type']=$tabledata;
        $data['title'] = "Type of Products";
        $data['breadcrumb'] = $this->make_bread->output();
        $this->load->view('type_medicament_views/Type_Medicament_List_View',$data);

    }


  public function add()
  {

    $this->form_validation->set_rules('DESCRIPTION', 'Description', 'trim|required');
     if ($this->form_validation->run() == FALSE)
        {


      $data['title'] = "Type de médicament";
      $data['breadcrumb'] = $this->make_bread->output();
      $this->load->view('type_medicament_views/Type_Medicament_Nouvelle_View',$data);


        }

        else
        {


   // $codestock=uniqid();
    $data=array(

    
    'DESCRIPTION'=>$this->input->post('DESCRIPTION'),
   
    );
   

    $this->Model->create('type_medicament',$data);
    $data['message']='<div class="alert alert-success text-center">'."Saved of new type of product".' '.$this->input->post('DESCRIPTION').'  '."done successfuly".'</div>';
     $this->session->set_flashdata($data);
    redirect(base_url('stock/Type_Medicament/listing'));



        }
  
  }

 function getOne()
  {

    $criteres=$this->uri->segment(4);
    $data['type']=$this->Model->getOne('type_medicament',array('TYPE_ID'=>$criteres));
    $data['title'] = "Type of Products";
    $data['breadcrumb'] = $this->make_bread->output();
    $this->load->view('type_medicament_views/Type_Medicament_update_View',$data);


  }


function update()
{


      $this->form_validation->set_rules('DESCRIPTION', 'Description', 'trim|required');
     if ($this->form_validation->run() == FALSE)
        {

   $criteres=$this->input->post('TYPE_ID');
    $data['type']=$this->Model->getOne('type_medicament',array('TYPE_ID'=>$criteres));
    $data['title'] = "Type of Products";
    $data['breadcrumb'] = $this->make_bread->output();
    $this->load->view('type_medicament_views/Type_Medicament_update_View',$data);


        }

        else
        {

    
    $data=array(

    'DESCRIPTION'=>$this->input->post('DESCRIPTION'),
   
    );
   
    $criteres=$this->input->post('TYPE_ID');
    $this->Model->update('type_medicament',array('TYPE_ID'=>$criteres),$data);
     $data['message']='<div class="alert alert-success text-center">'."Modification du type de médicament".' '.$this->input->post('DESCRIPTION').'  '."fait avec succès".'</div>';
     $this->session->set_flashdata($data);
    redirect(base_url('stock/Type_Medicament/listing'));


}

}



 function delete()
 {
  $table="type_medicament";
  $criteres['TYPE_ID']=$this->uri->segment(4);
  $data['rows']= $this->Model->getOne( $table,$criteres);
  $this->Model->delete($table,$criteres);
  
  $data['message']='<div class="alert alert-success text-center">'."Type de médicament Supprimer ".' '.$data['rows']['DESCRIPTION'].'  '."avec succès".'</div>';
  $this->session->set_flashdata($data);
  redirect(base_url('stock/Type_Medicament/listing'));
  

  }


}