
<!DOCTYPE html>
<html lang="en">
<title>Users</title>

<?php
  include VIEWPATH."includes/header.php";
?>

<body>
    <div class="container-fluid" style="background-color: white">
        <div id="wrapper">
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 5px" id="navp">
                
                <?php  include VIEWPATH.'includes/menu_principal.php' ?>
                
            </nav>

            <!-- Page Content -->
            <?php 
            $diligence1 ='';
            $diligence2 ='active';
            ?>
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                       <div class="col-lg-12" style=" margin-bottom: 5px">
                             <div class="row" style="" id="conta">
                                <?=$breadcrumb?> 
                             </div>
                             
                             <div class="row" id="conta" style="margin-top: -10px">
                                <div class="col-lg-3 col-md-3" style="padding-bottom: 3px">
                                    <a href="<?=base_url('administration/Users/')?>" class="btn btn-default">Nouveau</a>
                                    <a href="<?=base_url('administration/Users/listing')?>" class="btn btn-default">Liste</a>
                                </div>

                                 <div class="col-lg-9 col-md-9">                                  
                                   <h4 class=""><b>Utilisateurs</b></h4> 
                                   
                                </div>
                                
                            </div> 
                        </div>
                    </div>
                         
                     <div class="col-lg-12 jumbotron">  

                      
                <form class="form-horizontal" action="<?=base_url('administration/Users/add');?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                           <div class="form-group">
                        <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Nom</label>
                        <div class="col-md-4 col-sm-6 col-xs-6">
                           <input type="text" class="form-control" id="NOM" name="NOM" value="<?=set_value('NOM')?>" autofocus>
                            <div style="color: red"><?php echo form_error('NOM'); ?></div>
                        </div>

                        <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Prénom
</label>
                        <div class="col-md-4 col-sm-6 col-xs-6">
                           <input type="text" class="form-control" id="PRENOM" name="PRENOM" value="<?=set_value('PRENOM')?>" >
                             <div style="color: red"><?php echo form_error('PRENOM'); ?></div>
                        </div>
                      </div>
           

                     <div class="form-group">
                          <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Email</label>
                          <div class="col-md-4 col-sm-6 col-xs-6">
                               <input type="text" class="form-control" name="EMAIL" value="<?=set_value('EMAIL')?>" >
                               <div style="color: red">  <?php echo form_error('EMAIL'); ?> </div>
                          </div>

                          <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Télephone</label>
                          <div class="col-md-4 col-sm-6 col-xs-6">
                               <input type="text" class="form-control" name="TELEPHONE" value="<?=set_value('TELEPHONE')?>" >
                               <div style="color: red">  <?php echo form_error('TELEPHONE'); ?> </div>
                          </div>

                      </div>


                          <div class="form-group">
                          
                          <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Profiles</label>
                          <div class="col-md-4 col-sm-6 col-xs-6">
                              
                                  <select class="form-control" name="PROFILE">

                                  <option value="" disabled selected> - A selectionner - </option>
                                  <?php
                                      foreach ($profiles as $prof) {
                                        if($prof['PROFIL_ID']==$ID_PROFIL)
                                        {

                                       ?>
                                      
                                    <option value="<?=$prof['PROFIL_ID']?>" selected><?=$prof['DESCRIPTION']?></option>
                                        <?php 
                                      }

                                      else
                                      {
                                        ?>

                                      <option value="<?=$prof['PROFIL_ID']?>"><?=$prof['DESCRIPTION']?></option>  

                                     <?php
                                      }
                                      

                                    }

                                    
                                      
                                  ?>
                                </select>


                               



                               <div style="color: red">  <?php echo form_error('PROFILE'); ?> </div>
                          </div>





                      </div>

            


                     <div class="form-group">
                                <label class="col-md-12 col-sm-12 col-xs-12 control-label"></label>
                                <div class="col-md-10 col-sm-12 col-xs-12 col-md-push-2">
                                    <input type="submit" class="btn btn-primary btn-block" value="Enregister"/>
                                 </div>
                         </div>
                     </form>

                    </div>
                    </div>

                </div>
            </div>
            </div>
    </body>

</html>
