
<!DOCTYPE html>
<html lang="en">

<head>

</head>
<?php include VIEWPATH.'includes/header.php' ?>
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
            <?php 
            $useradd ='';
            $userlist ='active';
            ?>
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                     
                        <div class="col-lg-12" style=" margin-bottom: 5px">
                             <div class="row" style="" id="conta">
                             <?= $breadcrumb ?>
                             </div>
                            <div class="row" id="conta" style="margin-top: -10px">
                                 <div class="col-lg-6 col-md-6">                                  
                                   <h4 class=""><b>Modification de l'utilisateur</b></h4>
                                 </div>
                                 <div class="col-lg-6 col-md-6" style="padding-bottom: 3px">
                                 <?php include 'includes/sous_menu_utilisateur.php' ?> 
                                 </div>
                            </div>  
                        </div>
                    </div>
                         
                     <div class="col-lg-12 jumbotron">  

                      
                <form class="form-horizontal" action="<?=base_url('administration/Users/update');?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">


                           <div class="form-group">


    <input type="hidden" class="form-control" id="NOM" name="id_user" value="<?=$user['USER_ID']?>" autofocus>


                        <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Nom</label>
                        <div  class="col-md-4 col-sm-6 col-xs-6">
                           <input type="text" class="form-control" id="NOM" name="NOM" value="<?=$user['NOM']?>" autofocus>
                            <div style="color: red"><?php echo form_error('NOM'); ?></div>
                        </div>

                        <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Le prénom</label>
                        <div class="col-md-4 col-sm-6 col-xs-6">
                           <input type="text" class="form-control" id="PRENOM" name="PRENOM" value="<?=$user['PRENOM']?>" >
                             <div style="color: red"><?php echo form_error('PRENOM'); ?></div>
                        </div>
                      </div>
           

                     <div class="form-group">
                          <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Email</label>
                          <div class="col-md-4 col-sm-6 col-xs-6">
                               <input type="text" class="form-control" name="EMAIL" value="<?=$user['EMAIL']?>" >
                               <div style="color: red">  <?php echo form_error('EMAIL'); ?> </div>
                          </div>

                           <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Télephone</label>
                          <div class="col-md-4 col-sm-6 col-xs-6">
                               <input type="text" class="form-control" name="TELEPHONE" value="<?=$user['TELEPHONE']?>" >
                               <div style="color: red">  <?php echo form_error('TELEPHONE'); ?> </div>
                          </div>

                         
                      </div>


                          <div class="form-group">
                         


                          <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Profiles</label>
                          <div class="col-md-4 col-sm-6 col-xs-6">
                              
                                  <select class="form-control" name="PROFILE">

                                  <option value="<?=$profil['PROFIL_ID']?>"><?=$profil['DESCRIPTION']?></option>
                                  <?php
                                      foreach ($profilist as $prof) {
                                        if($prof['PROFIL_ID']==$PROFIL_ID)
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
                                    <input type="submit" class="btn btn-primary btn-block" value="Modifier"/>
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
