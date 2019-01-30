<?php

class Users_Profil extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->make_bread->add('Profil utilisateur', "administration/Users_Profil/listing", 0);
        $this->breadcrumb = $this->make_bread->output();
        //$this->verify_autolisazation();
    }

    public function index()
     {
   $this->make_bread->add('Nouvel droit', "administration/Users_Profil", 0);
         $datas['breadcrumb'] = $this->make_bread->output(); 
         $datas['success']= "";
         $datas['title']= "profils";
         $this->load->view("users_profil/Users_Profil_Add_View",$datas);

     }


  function droit_add_data()
  {

 $this->form_validation->set_rules('profil','Profil Description','trim|required');

  if($this->form_validation->run()==true)

  {


      
     if($this->input->post('facturation') != null)
       { $facturation= 1;}else{ $facturation= 0; }

     if($this->input->post('stock') != null)
       { $stock= 1;}else{ $stock= 0; }

     if($this->input->post('reporting') != null)
       { $reporting= 1;}else{ $reporting= 0; }

     if($this->input->post('admin') != null)
       { $admin= 1;}else{ $admin= 0; }

     if($this->input->post('boncommande') != null)
       { $boncommande= 1;}else{ $boncommande= 0; }
   
       $dataprofile= array('DESCRIPTION'=>$this->input->post('profil'));

       $conditio=$this->Model->getOne('profil',array('DESCRIPTION'=>$this->input->post('profil')));

        $datas=array();
        if($conditio['DESCRIPTION']!=$this->input->post('profil'))
        {
           $idprofile= $this->Model->insert_last_id("profil",$dataprofile);

          $datadroit= array('PROFIL_ID'=>$idprofile,'FACTURATION'=>$facturation,'STOCK'=>$stock,'REPORTING'=>$reporting,'ADMIN'=>$admin,'BON_COMMANDE'=>$boncommande);
          
           $this->Model->create("droits",$datadroit);
           $datas['success']= "<div class='alert alert-success alert-dismissible'id='aleter' align='center'>
  <button type='button' class='close' data-dismiss='alert'>&times;</button>
  Enregistre avec success.
</div>";
           
        }
        else{
            $datas['success']="<div class='alert alert-danger alert-dismissible'id='aleter' align='center'>
  <button type='button' class='close' data-dismiss='alert'>&times;</button>
 Le profile saisi existe déjà!
</div>";
             
           
        }
        $this->session->set_flashdata($datas);
        redirect(base_url('administration/Users_Profil/listing'));


  }

  else
  {

         $this->make_bread->add('Profil utilisateur', "droit_add_data", 1);
         $datas['breadcrumb'] = $this->make_bread->output(); 
         $datas['success']= "";
         $datas['title']= "profils";
         $this->load->view("users_profil/Users_Profil_Add_View",$datas);
  }

  }


  function listing()
  {

        $table['tableau']= '<table id="msg_table" class="table table-bordered table-stripped table-hover table-condensed"><tr><th>Profil</th><th>Facturation</th><th>Admin</th><th>Bon de Commande</th> <th>Rapport</th><th>Stock</th> <th>Option</th></tr>';
        $dataprof= $this->Model->getList("profil",array());

             foreach($dataprof as $da)
            {
 
            $droit= $this->Model->getOne("droits",array('PROFIL_ID'=>$da['PROFIL_ID']));



            if($droit['FACTURATION'] == 1)
               { $facturation= "<div class='bg-success text-center'><span class='glyphicon glyphicon-ok-sign'></span></div>";}
             else
              { $facturation= "<div class='bg-danger text-center'><span class='glyphicon glyphicon-minus-sign'></span></div>"; }
            if($droit['STOCK'] == 1)
               { $stock= "<div class='bg-success text-center'><span class='glyphicon glyphicon-ok-sign'></span></div>";}
             else
              { $stock= "<div class='bg-danger text-center'><span class='glyphicon glyphicon-minus-sign'></span></div>"; }

           if($droit['REPORTING'] == 1)
               { $reporting= "<div class='bg-success text-center'><span class='glyphicon glyphicon-ok-sign'></span></div>";}
             else
              { $reporting= "<div class='bg-danger text-center'><span class='glyphicon glyphicon-minus-sign'></span></div>"; }


             if($droit['ADMIN'] == 1)
               { $admin= "<div class='bg-success text-center'><span class='glyphicon glyphicon-ok-sign'></span></div>";}
             else
              { $admin= "<div class='bg-danger text-center'><span class='glyphicon glyphicon-minus-sign'></span></div>"; }

           


            if($droit['BON_COMMANDE'] == 1)
               { $boncommande= "<div class='bg-success text-center'><span class='glyphicon glyphicon-ok-sign'></span></div>";}
             else
              { $boncommande= "<div  class='bg-danger text-center'><span class='glyphicon glyphicon-minus-sign'></span></div>"; }
            

               $table['tableau'] .= '<tr><td>'.$da["DESCRIPTION"].'</td><td>'.$facturation.'</td><td>'.$admin.'</td><td>'.$boncommande .'</td><td>'.$reporting.'</td><td>'.$stock.'</td>



               <td>

  <div class="dropdown ">
 <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Action
         <span class="caret"></span></a>
           <ul class="dropdown-menu dropdown-menu-right">
                        ';


                $table['tableau'] .='<li><a href="'.base_url("administration/Users_Profil/update_profil/".$da['PROFIL_ID']).'">Modifier</a></li>';

               $table['tableau'] .= "<li><a hre='#' data-toggle='modal' 
                                  data-target='#mydelete" . $da['PROFIL_ID'] . "'><font color='red'>Supprimer</font></a></li>";
           
           $table['tableau'] .= "   </ul>
                  </div>
      <div class='modal fade' id='mydelete" . $da['PROFIL_ID'] . "'>
        <div class='modal-dialog'>
         <div class='modal-content'>
       <div class='modal-body'>
         <h5>Supprimer  :<b>" . $da['DESCRIPTION'] . "</b>?</h5>
                                                </div>
       <div class='modal-footer'>
        <a class='btn btn-danger btn-md' href='" . base_url('administration/Users_Profil/delete_profil/'.$da['PROFIL_ID']). "'>Supprimer</a>
           <button class='btn btn-primary btn-md' class='close' data-dismiss='modal'>Annuler</button>
               </div>

           </div>
                                        </div>
                                    </div>";

            }
            $table['tableau'] .= '</table>';
            $table['breadcrumb'] = $this->make_bread->output(); 
         
            $table['title']= "profils";
            $this->load->view("users_profil/Users_Profil_List_View",$table);
  }



  function delete_profil()
    {
        $this->Model->delete("profil",array('PROFIL_ID'=>$this->uri->segment(4)));
        $this->Model->delete("droits",array('PROFIL_ID'=>$this->uri->segment(4)));
        $datas['success']= "<div class='alert alert-info alert-dismissible'id='aleter' align='center'>
  <button type='button' class='close' data-dismiss='alert'>&times;</button>
  Suppression réussi!
</div>";
        $this->session->set_flashdata($datas);
        redirect(base_url('administration/Users_Profil/listing'));
    }



    function update_profil()
    {
        $data['datas']= $this->Model->getOne('profil',array('PROFIL_ID'=>$this->uri->segment(4)));
        
        $data['breadcrumb'] = $this->make_bread->output(); 
         
        $data['title']= "profils";
        $this->load->view('users_profil/Users_Profil_Edit_View',$data);
        
    }


    function update_data()
    {


  $this->form_validation->set_rules('profil','Profil Description','trim|required');

  if($this->form_validation->run()==true)

  {
      

     if($this->input->post('facturation') != null)
       { $facturation= 1;}else{ $facturation= 0; }

     if($this->input->post('stock') != null)
       { $stock= 1;}else{ $stock= 0; }

     if($this->input->post('reporting') != null)
       { $reporting= 1;}else{ $reporting= 0; }

     if($this->input->post('admin') != null)
       { $admin= 1;}else{ $admin= 0; }

    

        if($this->input->post('boncommande') != null)
       { $boncommande= 1;}else{ $boncommande= 0; }

      
    $dataprof= array('DESCRIPTION'=>$this->input->post('profil'));

     $datadroit= array('DROIT_ID'=>$this->input->post('id_droit'),'PROFIL_ID'=>$this->input->post('id_profil'),'FACTURATION'=>$facturation,'STOCK'=>$stock,'REPORTING'=>$reporting,'ADMIN'=>$admin,'BON_COMMANDE'=>$boncommande);
     
     
    $this->Model->update("profil",array('PROFIL_ID'=>$this->input->post('id_profil')),$dataprof);

     $this->Model->update("droits",array('PROFIL_ID'=>$this->input->post('id_profil')),$datadroit);
     $datas['success']= "<div class='alert alert-info alert-dismissible'id='aleter' align='center'>
  <button type='button' class='close' data-dismiss='alert'>&times;</button>
  Modification réussi!
</div>";
     $this->session->set_flashdata($datas);
    redirect(base_url('administration/Users_Profil/listing'));
    }

     else
  {

        $data['datas']= $this->Model->getOne('profil',array('PROFIL_ID'=>$this->input->post('id_profil')));
        $data['breadcrumb'] = $this->make_bread->output(); 
         
        $data['title']= "profils";
        $this->load->view('users_profil/Users_Profil_Edit_View',$data);
  }

  }


      

}

