
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

                      
                <form class="form-horizontal" action="<?=base_url('clients/clients/update');?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">


                           <div class="form-group">


    <input type="hidden" class="form-control" id="NOM" name="CLIENT_ID" value="<?=$user['CLIENT_ID']?>" autofocus>

                               <div class="form-group">
                                   <div class="col-md-12">
                                       <label for="clientSimple">Client simple</label>
                                       <input type="radio"
                                              id="clientSimple"
                                              name="CLIENT_TYPE" style="margin-left: 15px; margin-right: 30px" checked/>
                                       <label for="societe">Societé partenaire</label>
                                       <input type="radio"
                                              id="societe"
                                              name="CLIENT_TYPE" style="margin-left: 15px"/>
                                   </div></div>
                               <div class="form-group" id="societe-select">
                                   <div class="col-md-4 col-sm-6 col-xs-6">
                                       <label for="exampleFormControlSelect1">Choisir le nom :</label>
                                       <select class="form-control" id="societes" name="CLIENT_SOCIETE" value="<?php $user['CLIENT_SOCIETE'];?>">
                                           <option>1</option>
                                           <option>2</option>
                                           <option>3</option>
                                           <option>4</option>
                                           <option>5</option>
                                       </select>
                                   </div>

                               </div>

                               <div class="form-group">
                                   <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Nom</label>
                                   <div class="col-md-4 col-sm-6 col-xs-6">
                                       <input type="text" class="form-control" id="NOM" name="CLIENT_NOM" value="<?= $user['CLIENT_NOM']?>" autofocus>
                                       <div style="color: red"><?php echo form_error('CLIENT_NOM'); ?></div>
                                   </div>

                                   <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Prénom
                                   </label>
                                   <div class="col-md-4 col-sm-6 col-xs-6">
                                       <input type="text" class="form-control" id="PRENOM" name="CLIENT_PRENOM" value="<?= $user['CLIENT_PRENOM']?>" >
                                       <div style="color: red"><?php echo form_error('CLIENT_PRENOM'); ?></div>
                                   </div>
                               </div>


                               <div class="form-group">
                                   <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Email</label>
                                   <div class="col-md-4 col-sm-6 col-xs-6">
                                       <input type="text" class="form-control" name="CLIENT_EMAIL" value="<?=   $user['CLIENT_EMAIL']?>" >
                                       <div style="color: red">  <?php echo form_error('CLIENT_EMAIL'); ?> </div>
                                   </div>

                                   <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Télephone</label>
                                   <div class="col-md-4 col-sm-6 col-xs-6">
                                       <input type="text" class="form-control" name="CLIENT_TELEPHONE" value="<?= $user['CLIENT_TELEPHONE']?>" >
                                       <div style="color: red">  <?php echo form_error('CLIENT_TELEPHONE'); ?> </div>
                                   </div>

                               </div>
                               <div class="form-group">
                                   <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Address</label>
                                   <div class="col-md-4 col-sm-6 col-xs-6">
                                       <input type="text" class="form-control" name="CLIENT_" value="<?=set_value('CLIENT_')?>" >
                                       <div style="color: red">  <?php echo form_error('CLIENT_'); ?> </div>
                                   </div>

                                   <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Code client</label>
                                   <div class="col-md-4 col-sm-6 col-xs-6">
                                       <input type="text" class="form-control" name="TELEPHONE" value="<?= $user['CLIENT_TELEPHONE']?>" >
                                       <div style="color: red">  <?php echo form_error('tTELEPHONE'); ?> </div>
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
