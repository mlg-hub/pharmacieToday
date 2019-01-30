<!DOCTYPE html>
<html lang="en">

<head>
<?php include VIEWPATH. 'includes/header.php' ?>
</head>
<?php
$smpark1="active";
$smpark2="";
$smpark3="";


 // if($this->session->userdata('DESCRIPTION_PROFILE')=='Collaborateur'){
 //                                      }

 ?>
<body>
    <div class="container-fluid" style="background-color: white">
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 5px" id="navp">
                <!-- /.navbar-top-links -->
                <?php include VIEWPATH.'includes/menu_principal.php' ?>
                <!-- /.navbar-static-side -->
            </nav>

            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12" style=" margin-bottom: 5px">
                             <div class="row" style="" id="conta">
                                <?= $breadcrumb ?>
                             </div>
                            <div class="row" id="conta" style="margin-top: -10px">
                                 <div class="col-lg-6 col-md-6">                                  
                                   <h4 class=""><b>Enregistrer la Liste noire dans parking</b></h4>  

                                </div>
                                <div class="col-lg-6 col-md-6" style="padding-bottom: 3px">
                                  <button class="btn btn-warning"><a href="<?php echo base_url() ?>administration/Parkbacklist/add">Excel</a></button>
                                    <?php include 'includes/sous_menu_parkbacklist.php' ?>
                                </div>
                            </div>  
                        </div>

                        
                        <div class="col-lg-12 jumbotron table-responsive" style="padding: 5px">
                          <?= $this->session->flashdata('message') ?>
                             <form   id="myform" method="POST" class="form-horizontal" action="<?php echo base_url() ?>administration/Parkbacklist/add_data" accept-charset="utf-8" enctype="multipart/form-data">

                              <div class="row">
              <!-- <div class="col-md-12 sm-12 xs-12 form-group">
                <div id="message_affiche" class="message_affiche"></div>
              </div> -->

         <div class="form-group">
               <label for="" class="col-md-3 col-sm-12 col-xs-12 control-label">Plaque du véhicule <span style="color: red;">*</span></label>
                          <div class="col-md-5 col-sm-12 col-xs-12 col-md-push-1">
                             <input type="text" class="form-control" name="PLAQUE_VEHICULE" id="PLAQUE_VEHICULE" value="<?=set_value('PLAQUE_VEHICULE')?>">
                            <span class="error"><?php echo form_error('PLAQUE_VEHICULE'); ?></span> 
                            
                          </div>
          </div>
          <div class="form-group">

          
              <label for="" class="col-md-3 col-sm-12 col-xs-12 control-label">Type violation <span style="color: red;">*</span></label>
              
                          <div class="col-md-5 col-sm-12 col-xs-12 col-md-push-1">
                            <select name="TYPE_VIOLATION" id="TYPE_VIOLATION" class="form-control">
                              <option></option>
                <?php 
                  foreach ($list as $value) {
                    ?>


                    <option value="<?php echo $value['TYPE_VIOLATION_ID'] ?>"><?php echo $value['NOM']?></option>
                    <?php
                  }

           ?>
                           </select>
                             
                          </div>
        

          </div>

         <div class="form-group">

          
              <label for="" class="col-md-3 col-sm-12 col-xs-12 control-label">Propriétaire du véhicule <span style="color: red;">*</span></label>
                          <div class="col-md-5 col-sm-6 col-xs-6 col-md-push-1">
                             <input type="text" class="form-control" name="PROPRIETAIRE" id="PROPRIETAIRE" value="<?=set_value('PROPRIETAIRE')?>">
                             <span class="error"><?php echo form_error('PROPRIETAIRE'); ?></span> 
                             
                          </div>

          </div>

         <div class="form-group">

          
              <label for="" class="col-md-3 col-sm-12 col-xs-12 control-label">Numéro de téléphone <span style="color: red;">*</span></label>
                          <div class="col-md-5 col-sm-12 col-xs-12 col-md-push-1">
                             <input type="text" class="form-control" name="TELEPHONE" id="TELEPHONE" value="<?=set_value('TELEPHONE')?>">
                             <span class="error"><?php echo form_error('TELEPHONE'); ?></span> 
                          
                          </div>

          </div>

         <div class="form-group">
                                <label class="col-md-3 col-sm-12 col-xs-12 control-label"></label>
                                <div class="col-md-5 col-sm-12 col-xs-12 col-md-push-1">
                                    <input type="button" class="btn btn-primary btn-block envoi" value="Enregistrer"/>
                                 </div>
          </div>
          
                   
                          
                      
                
                </form>
</div></div></div></div></div></div>




</body>
</html>

<script type="text/javascript">
    $(document).ready(function(){
        $(".envoi").click(function(){
            
            var email=$('#email1').val();
             // var EMAILCHECK=$('#EMAILCHECK').val();

            if(!$('#PLAQUE_VEHICULE').val().trim()){
                    alert('La plaque du véhicule est requise');
                $('#PLAQUE_VEHICULE').focus();
                }else if(!$('#TYPE_VIOLATION').val()){
                    alert('Le type violation du véhicule est requis');
                $('#TYPE_VIOLATION').focus();
                }else if(!$('#PROPRIETAIRE').val().trim()){
                    alert('Le propriétaire du véhicule est requis');
                $('#PROPRIETAIRE').focus();
                }else if(!$('#TELEPHONE').val().trim()){
                    alert('Le numéro du phone est requis');
                $('#TELEPHONE').focus();
                }else{
                    document.getElementById("myform").submit();
                }
        });
    });
</script>


