
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
            $fournisseuradd ='';
            $fournisseurlist ='active';
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
                                   <h4 class=""><b>Modification du fournisseur</b></h4>
                                 </div>
                                 <div class="col-lg-6 col-md-6" style="padding-bottom: 3px">
                                 <?php include 'includes/sous_menu_fournisseur.php' ?> 
                                 </div>
                            </div>  
                        </div>
                    </div>
                         
                     <div class="col-lg-12 jumbotron">  

                      
                <form class="form-horizontal" action="<?=base_url('stock/Fournisseur/update');?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">


                           <div class="form-group">


    <input type="hidden" class="form-control" id="NOM" name="id_fournisseur" value="<?=$fournisseur['ID_FOURNISSEUR']?>" autofocus>


                        <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Type fournisseur</label>
                        <div  class="col-md-4 col-sm-6 col-xs-6">
                           <input type="text" class="form-control" id="TYPE_FOURNISSEUR" name="TYPE_FOURNISSEUR" value="<?=$fournisseur['TYPE_FOURNISSEUR']?>" autofocus readonly>
                            <div style="color: red"><?php echo form_error('TYPE_FOURNISSEUR'); ?></div>
                        </div>

                        <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Déscription</label>
                        <div class="col-md-4 col-sm-6 col-xs-6">
                           <input type="text" class="form-control" id="DESCRIPTION" name="DESCRIPTION" value="<?=$fournisseur['DESCRIPTION']?>" >
                             <div style="color: red"><?php echo form_error('DESCRIPTION'); ?></div>
                        </div>
                      </div>
           

                     <div class="form-group">
                          <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Adresse</label>
                          <div class="col-md-4 col-sm-6 col-xs-6">
                               <input type="text" class="form-control" name="ADRESSE" value="<?=$fournisseur['ADRESSE']?>" >
                               <div style="color: red">  <?php echo form_error('ADRESSE'); ?> </div>
                          </div>

                            <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Latitude</label>
                          <div class="col-md-4 col-sm-6 col-xs-6">
                               <input type="text" class="form-control" name="LATITUDE" value="<?=$fournisseur['LATITUDE']?>" >
                               <div style="color: red">  <?php echo form_error('LATITUDE'); ?> </div>
                          </div>

                           
                         
                      </div>


                          <div class="form-group">
                          <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Longitude</label>
                          <div class="col-md-4 col-sm-6 col-xs-6">
                               <input type="text" class="form-control" name="LONGITUDE" value="<?=$fournisseur['LONGITUDE']?>" >
                               <div style="color: red">  <?php echo form_error('LONGITUDE'); ?> </div>
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
