
<!DOCTYPE html>
<html lang="en">
<title>Users</title>

<?php
  include VIEWPATH."includes/header.php";
?>
he
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


                                 <div class="col-lg-9 col-md-9">                                  
                                   <h4 class=""><b>Clients</b></h4>
                                </div>
                                 <div class="col-lg-3 col-md-3" style="padding-bottom: 3px">
                                     <div class="pull-right">
                                         <a href="<?=base_url('clients/clients/add')?>" class="btn btn-primary">Nouveau</a>
                                         <a href="<?=base_url('clients/clients/listing')?>" class="btn btn-default">Liste</a>
                                     </div>
                                 </div>
                                
                            </div> 
                        </div>
                    </div>
                         
                     <div class="col-lg-12 jumbotron">  

                      
                <form class="form-horizontal" action="<?= base_url('clients/clients/add');?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    <div class="form-group">
                            <div class="col-md-12">
                                <label for="clientSimple">Client simple</label>
                                    <input type="radio"
                                           id="clientSimple"
                                           name="CLIENT_TYPE" style="margin-left: 15px; margin-right: 30px"/>
                                <label for="societe">Societé partenaire</label>
                                <input type="radio"
                                       id="societe"
                                       name="CLIENT_TYPE" style="margin-left: 15px"/>
                            </div></div>
                    <div class="form-group" id="societe-select">
                        <div class="col-md-4 col-sm-6 col-xs-6">
                            <label for="exampleFormControlSelect1">Choisir le nom :</label>
                            <select class="form-control" id="societes" name="CLIENT_SOCIETE">
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
                           <input type="text" class="form-control" id="NOM" name="CLIENT_NOM" value="<?=set_value('CLIENT_NOM')?>" autofocus>
                            <div style="color: red"><?php echo form_error('CLIENT_NOM'); ?></div>
                        </div>

                        <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Prénom
                        </label>
                        <div class="col-md-4 col-sm-6 col-xs-6">
                           <input type="text" class="form-control" id="PRENOM" name="CLIENT_PRENOM" value="<?=set_value('CLIENT_PRENOM')?>" >
                             <div style="color: red"><?php echo form_error('CLIENT_PRENOM'); ?></div>
                        </div>
                      </div>
           

                     <div class="form-group">
                          <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Email</label>
                          <div class="col-md-4 col-sm-6 col-xs-6">
                               <input type="text" class="form-control" name="CLIENT_EMAIL" value="<?=set_value('CLIENT_EMAIL')?>" >
                               <div style="color: red">  <?php echo form_error('CLIENT_EMAIL'); ?> </div>
                          </div>

                          <label for="" class="col-md-2 col-sm-6 col-xs-6 control-label">Télephone</label>
                          <div class="col-md-4 col-sm-6 col-xs-6">
                               <input type="text" class="form-control" name="CLIENT_TELEPHONE" value="<?=set_value('CLIENT_TELEPHONE')?>" >
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
                            <input type="text" class="form-control" name="TELEPHONE" value="<?=set_value('TELEPHONE')?>" >
                            <div style="color: red">  <?php echo form_error('tTELEPHONE'); ?> </div>
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
