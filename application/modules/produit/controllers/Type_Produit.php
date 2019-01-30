<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Type_Produit extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->make_bread->add('New type of Product', "produit/Type_Produit", 0);
        $this->breadcrumb = $this->make_bread->output();
    }

    public function index()
    {

      $data['title'] = "Type of Products";
      $data['breadcrumb'] = $this->make_bread->output();
      $this->load->view('Type_Produit_Nouvelle_View',$data);


    }

  function listing()
    {


    $table="approv_produit_type";
     $resultat=$this->Model->getList($table,array());
     $tabledata=array();
     foreach ($resultat as $key) {
  
      $type=array();
      $type[]=$key['PRODUIT_TYPE_CODE'];
      $type[]=$key['PRODUIT_TYPE_NOM'];

       $type['OPTIONS'] = '<div class="dropdown ">
                    <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Action
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        ';
    
 
     $type['OPTIONS'] .= "<li><a href='" . base_url('produit/Type_Produit/getOne/' . $key['PRODUIT_TYPE_ID']) . "'>Edit</a></li>";
     

       $type['OPTIONS'] .= "<li><a hre='#' data-toggle='modal' 
                                  data-target='#mydelete" . $key['PRODUIT_TYPE_ID'] . "'><font color='red'>Supprimer</font></a></li>";
   

            

       $type['OPTIONS'] .= "   </ul>
                  </div>
                                    <div class='modal fade' id='mydelete" . $key['PRODUIT_TYPE_ID'] . "'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>

                                                <div class='modal-body'>
                                                    <h5>Supprimer :<b>" . $key['PRODUIT_TYPE_NOM'] . "</b>?</h5>
                                                </div>

                                               <div class='modal-footer'>
                                                    <a class='btn btn-danger btn-md' href='" . base_url('produit/Type_Produit/delete/' . $key['PRODUIT_TYPE_ID']) . "'>Supprimer</a>
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
        $this->load->view('Type_Produit_List_View',$data);

    }


  public function add()
  {

    $this->form_validation->set_rules('PRODUIT_DESCRIPTION', 'Description', 'trim|required');
     if ($this->form_validation->run() == FALSE)
        {


      $data['title'] = "Type of Products";
      $data['breadcrumb'] = $this->make_bread->output();
      $this->load->view('Type_Produit_Nouvelle_View',$data);


        }

        else
        {


    $codeproduit=uniqid();
    $data=array(

    'PRODUIT_TYPE_CODE'=>$codeproduit,
    'PRODUIT_TYPE_NOM'=>$this->input->post('PRODUIT_DESCRIPTION'),
   
    );
   

    $this->Model->insert_last_id('approv_produit_type',$data);
     $data['message']='<div class="alert alert-success text-center">'."Saved of new type of product".' '.$this->input->post('PRODUIT_DESCRIPTION').'  '."done successfuly".'</div>';
     $this->session->set_flashdata($data);
    redirect(base_url('produit/Type_Produit/listing'));



        }
  
  }

  function getOne()
  {

    $criteres=$this->uri->segment(4);
    $data['type']=$this->Model->getOne('approv_produit_type',array('PRODUIT_TYPE_ID'=>$criteres));
    $data['title'] = "Type of Products";
    $data['breadcrumb'] = $this->make_bread->output();
    $this->load->view('Type_Produit_update_View',$data);


  }


function update()
{


      $this->form_validation->set_rules('PRODUIT_DESCRIPTION', 'Description', 'trim|required');
     if ($this->form_validation->run() == FALSE)
        {

   $criteres=$this->input->post('PRODUIT_TYPE_ID');
    $data['type']=$this->Model->getOne('approv_produit_type',array('PRODUIT_TYPE_ID'=>$criteres));
    $data['title'] = "Type of Products";
    $data['breadcrumb'] = $this->make_bread->output();
    $this->load->view('Type_Produit_update_View',$data);


        }

        else
        {

    
    $data=array(

    'PRODUIT_TYPE_NOM'=>$this->input->post('PRODUIT_DESCRIPTION'),
   
    );
   
    $criteres=$this->input->post('PRODUIT_TYPE_ID');
    $this->Model->update('approv_produit_type',array('PRODUIT_TYPE_ID'=>$criteres),$data);
     $data['message']='<div class="alert alert-success text-center">'."Modification of type of product".' '.$this->input->post('PRODUIT_DESCRIPTION').'  '."done successfuly".'</div>';
     $this->session->set_flashdata($data);
    redirect(base_url('produit/Type_Produit/listing'));


}

}



 function delete()
 {
  $table="approv_produit_type";
  $criteres['PRODUIT_TYPE_ID']=$this->uri->segment(4);
  $data['rows']= $this->Model->getOne( $table,$criteres);
  $this->Model->delete($table,$criteres);
  
  $data['message']='<div class="alert alert-success text-center">'."Deleted of product type ".' '.$data['rows']['PRODUIT_TYPE_NOM'].'  '."done successfuly".'</div>';
  $this->session->set_flashdata($data);
  redirect(base_url('produit/Type_Produit/listing'));
  

  }


}