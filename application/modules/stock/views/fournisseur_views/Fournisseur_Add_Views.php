
<!DOCTYPE html>
<html lang="en">
<title>Fournisseurs</title>

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
                                    <a href="<?=base_url('stock/Fournisseur/')?>" class="btn btn-default">Nouveau</a>
                                    <a href="<?=base_url('stock/Fournisseur/listing')?>" class="btn btn-default">Liste</a>
                                </div>

                                 <div class="col-lg-9 col-md-9">                                  
                                   <h4 class=""><b>Fournisseur</b></h4> 
                                   
                                </div>
                                
                            </div> 
                        </div>
                    </div>
                         
                     <div class="col-lg-12 jumbotron">  

                      
                <form class="form-horizontal" action="<?=base_url('stock/Fournisseur/add');?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                           <div class="form-group">
                      
                         <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Type de fournisseur</label>
                          <div class="col-md-4 col-sm-6 col-xs-6">
                              
                                  <select class="form-control" name="TYPE_FOURNISSEUR">

                                  <option > Type normale</option>
                                  

                                </select>
                              </div>

                        <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Déscription
</label>
                        <div class="col-md-4 col-sm-6 col-xs-6">
                           <input type="text" class="form-control" id="DESCRIPTION" name="DESCRIPTION" value="<?=set_value('DESCRIPTION')?>" >
                             <div style="color: red"><?php echo form_error('DESCRIPTION'); ?></div>
                        </div>
                      </div>
           

                     <div class="form-group">
                         
                          <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Adresse</label>
                          <div class="col-md-4 col-sm-6 col-xs-6">
                               <input type="text" class="form-control" name="ADRESSE" value="<?=set_value('ADRESSE')?>" >
                               <div style="color: red">  <?php echo form_error('ADRESSE'); ?> </div>
                          </div>

                          <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Latitude</label>
                          <div class="col-md-4 col-sm-6 col-xs-6">
                               <input type="text" class="form-control" name="LATITUDE" value="<?=set_value('LATITUDE')?>" >
                               <div style="color: red">  <?php echo form_error('LATITUDE'); ?> </div>
                          </div>

                      </div>

                  <div class="form-group">
                         <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Longitude</label>
                          <div class="col-md-4 col-sm-6 col-xs-6">
                               <input type="text" class="form-control" name="LONGITUDE" value="<?=set_value('LONGITUDE')?>" >
                               <div style="color: red">  <?php echo form_error('LONGITUDE'); ?> </div>
                          </div>

                          

                      </div>

                       


                     <div class="form-group">
                                <label class="col-md-12 col-sm-12 col-xs-12 control-label"></label>
                                <div class="col-md-10 col-sm-12 col-xs-12 col-md-push-2">
                                    <input type="submit" class="btn btn-primary btn-block" value="Enregistrer"/>
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
