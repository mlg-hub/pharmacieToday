
<!DOCTYPE html>
<html lang="en">

<head>
<?php include VIEWPATH. 'includes/header.php' ?>
</head>
<body>
    <div class="container-fluid" style="background-color: white">
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 5px" id="navp">
                <!-- /.navbar-top-links -->
                <?php include VIEWPATH. 'includes/menu_principal.php' ?>
                <!-- /.navbar-static-side -->
            </nav>

            <!-- Page Content -->
            
            <div id="page-wrapper">
               <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12" style=" margin-bottom: 5px">
                             <div class="row" style="" id="conta">
                                <?=$breadcrumb?> 
                             </div>
                            <div class="row" id="conta" style="margin-top: -10px">

                                   <div class="col-lg-6 col-md-6">                                  
                                   <h4 class=""><b>Nouveau type de Médicament</b></h4>
                                   </div>


                                   <div class="col-lg-6 col-md-6" style="padding-bottom: 3px">
                                    <!--a href="#" class="btn btn-default">Nouveau</a>
                                    <a href="#" class="btn btn-default">Liste</a-->



                                     <a href="<?=base_url('stock/Type_Medicament')?>" class="btn btn-default">Nouveau type de Médicament</a>
                                    <a href="<?=base_url('stock/Type_Medicament/listing')?>" class="btn btn-default">Liste de  type de Médicament</a>
                                </div>
                                
                            </div>  
                        </div>
                    </div>

                            
                    <div class="col-md-12 jumbotron" style="padding: 15px">  
             
           
                     <form   name="myform" method="post" class="form-horizontal" action="<?= base_url('stock/Type_Medicament/add'); ?>">


                            <div class="form-group">
                                <label class="col-md-3 col-sm-12 col-xs-12 control-label">Description du type de médicament</label>
                                <div class="col-md-5 col-sm-12 col-xs-12 col-md-push-1">
                                    <input type="text" name="DESCRIPTION"  value="<?php echo!empty($DESCRIPTION) ? $DESCRIPTION : ''; ?>" class="form-control" autofocus> 
                                        <span class="error text-danger"><?php echo form_error('DESCRIPTION'); ?></span> 
                                </div>
                            </div>


                             <div class="form-group">
                                <label class="col-md-3 col-sm-12 col-xs-12 control-label"></label>
                                <div class="col-md-5 col-sm-12 col-xs-12 col-md-push-1">
                                    <input type="submit" class="btn btn-primary btn-block" value="Enregistrer"/>
                                </div>
                            </div>

                           
                           </div>
                           
                       

                </form>
            </div>         
        </div>    

    </body>
</HTML>
