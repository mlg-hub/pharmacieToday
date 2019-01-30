
<!DOCTYPE html>
<html lang="en">
<title>Médicament</title>

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
                                <div class="col-lg-7 col-md-7">                                  
                                   <h4 class=""><b>Médicament</b></h4> 
                                   
                                </div>
                                <div class="col-lg-5 col-md-5" style="padding-bottom: 3px">
                                    <a href="<?=base_url('stock/Medicament/')?>" class="btn btn-default">Nouveau Médicament</a>
                                    <a href="<?=base_url('stock/Medicament/listing')?>" class="btn btn-default">Liste des médicament</a>
                                </div>


                                
                            </div> 
                        </div>
                    </div>
                         
                     <div class="col-lg-12 jumbotron">  

                      
                <form class="form-horizontal" action="<?=base_url('stock/Medicament/add');?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                           <div class="form-group">
                        <label for="" class="col-md-2 col-sm-12 col-xs-6 control-label">Description</label>
                        <div class="col-md-5 col-sm-6 col-xs-6">
                           <input type="text" class="form-control" id="DESCRIPTION" name="DESCRIPTION" value="<?=set_value('DESCRIPTION')?>" autofocus>
                            <div style="color: red"><?php echo form_error('DESCRIPTION'); ?></div>
                        </div>
     


                     <div class="form-group">
                                <label class="col-md-12 col-sm-12 col-xs-12 control-label"></label>
                                <div class="col-md-5 col-sm-12 col-xs-12 col-md-push-2">
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
