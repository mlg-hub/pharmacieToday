
<!DOCTYPE html>
<html lang="en">
<title>Stock</title>

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
                                <?php include 'includes/sous_menu_stock.php' ?>;

                                 <div class="col-lg-9 col-md-9">                                  
                                   <h4 class=""><b>Stock</b></h4> 
                                   
                                </div>
                                
                            </div> 
                        </div>
                    </div>
                         
                     <div class="col-lg-12 jumbotron">  
                      
                <form class="form-horizontal" action="<?=base_url('stock/Gestion_Stock/add');?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    
                      <div class="form-group">
                          <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Fournisseur</label>
                          <div class="col-md-4 col-sm-6 col-xs-6">
                              
                                  <select class="form-control" name="Fournisseur">

                                  <option value="" disabled selected> - To select - </option>
                                  <?php
                                      foreach ($FOURN as $fourn) {

                                  
                                       ?>
                                      
                                    <option value="<?=$fourn['DESCRIPTION']?>"><?=$fourn['DESCRIPTION']?></option>
                                      

                                   <?php  
                                      

                                    }

                                    
                                      
                                  ?>
                                </select>



                               <div style="color: red">  <?php echo form_error('Fourn'); ?> </div>
                          </div>

                      
                          <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Medicament</label>
                          <div class="col-md-4 col-sm-6 col-xs-6">
                              
                                  <select class="form-control" name="Medicament">

                                  <option value="" disabled selected> - To select - </option>
                                  <?php
                                      foreach ($MEDICAMENT as $medica) {

                                  
                                       ?>
                                      
                                    <option value="<?=$medica['DESCRIPTION']?>"><?=$medica['DESCRIPTION']?></option>
                                      

                                   <?php  
                                      

                                    }

                                    
                                      
                                  ?>
                                </select>



                               <div style="color: red">  <?php echo form_error('TYPE'); ?> </div>
                          </div>

                      </div><div class="form-group">
                          <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Nombre</label>
                          <div class="col-md-4 col-sm-6 col-xs-6">
                              
                        <input type="number"  class="form-control"  name="Nombre" value="<?=set_value('Nombre')?>" >

                               <div style="color: red">  <?php echo form_error('Nombre'); ?> </div>
                          </div>

                      
                        <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Type Medicament </label>
                        <div class="col-md-4 col-sm-6 col-xs-6">
                           <select class="form-control" name="Type">

                                  <option value="" disabled selected> - To select - </option>
                                  <?php
                                      foreach ($TYPE as $type) {

                                  
                                       ?>
                                      
                                    <option value="<?=$type['DESCRIPTION']?>"><?=$type['DESCRIPTION']?></option>
                                      

                                   <?php  
                                      

                                    }

                                    
                                      
                                  ?>
                                </select>
                            <div style="color: red"><?php echo form_error('Type'); ?></div>
                        </div>
                        </div>

<div class="form-group">
                          
                        <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Type Stockage</label>
                        <div class="col-md-4 col-sm-6 col-xs-6">
                           <select class="form-control" name="TypeStock">

                                  <option value="" disabled selected> - To select - </option>
                                  
                                      
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                      
                                </select>
                            <div style="color: red"><?php echo form_error('TypeStock'); ?></div>
                        </div>
                        </div>



                        <div class="form-group">
                        <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Prix d'Achat
</label>
                        <div class="col-md-4 col-sm-6 col-xs-6">
                           <input type="number" min="0"max="100" class="form-control" id="PRENOM" name="PrixAchat" value="<?=set_value('PrixAchat')?>" >
                             <div style="color: red"><?php echo form_error('PrixAchat'); ?></div>
                        </div>
                      
                          <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Date Stockage</label>
                          <div class="col-md-4 col-sm-6 col-xs-6">
                               <input type="datetime-local"  class="form-control" name="DateStock" value="<?=set_value('DateStock')?>" >
                               <div style="color: red">  <?php echo form_error('DateStock'); ?> </div>
                          </div>
                        </div>
                          <div class="form-group">
                          <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Prix de Vente</label>
                          <div class="col-md-4 col-sm-6 col-xs-6">
                               <input type="number" class="form-control" name="PrixVente" value="<?=set_value('PrixVente')?>" >
                               <div style="color: red">  <?php echo form_error('PrixVente'); ?> </div>
                          </div>

                          <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Date Expiration</label>
                          <div class="col-md-4 col-sm-6 cosl-xs-6">
                               <input type="datetime-local"  class="form-control" name="DateExp" value="<?=set_value('DateExp')?>" >
                               <div style="color: red">  <?php echo form_error('DateExp'); ?> </div>
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
