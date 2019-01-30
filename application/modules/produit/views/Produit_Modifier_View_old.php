
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

                                   <div class="col-lg-3 col-md-3" style="padding-bottom: 3px">
                                    <a href="<?=base_url('produit/Produit/new')?>" class="btn btn-default">New</a>
                                    <a href="<?=base_url('produit/Produit/index')?>" class="btn btn-default">List</a>
                                </div>


                                 <div class="col-lg-6 col-md-6">                                  
                                   <h4 class=""><b>Modifier un produit</b></h4>
                                </div>
                                
                            </div>  
                        </div>
                    </div>

                            
                    <div class="col-md-12 jumbotron" style="padding: 5px">  
             
           
                     <form   name="myform" method="post" class="form-horizontal" action="<?= base_url('produit/Produit/modifier_produit'); ?>">

                       <!--    <div class="form-group">
                                <label class="col-md-4 col-sm-12 col-xs-12 control-label">Product code</label>
                                <div class="col-md-5 col-sm-12 col-xs-12 col-md-push-1">
                                    <input type="text" name="PRODUIT_CODE"  value="<?php echo!empty($PRODUIT_CODE) ? $PRODUIT_CODE : ''; ?>" class="form-control"> 
                                        <span class="error"><?php echo form_error('PRODUIT_CODE'); ?></span> 
                                </div>
                            </div> -->
                            <input type="hidden" name="PRODUIT_ID" value="<?php echo!empty($PRODUIT_ID) ? $PRODUIT_ID : ''; ?>">

                            <div class="form-group">
                                <label class="col-md-4 col-sm-12 col-xs-12 control-label">Product name</label>
                                <div class="col-md-5 col-sm-12 col-xs-12 col-md-push-1">
                                    <input type="text" name="PRODUIT_NOM"  value="<?php echo!empty($PRODUIT_NOM) ? $PRODUIT_NOM : ''; ?>" class="form-control"> 
                                        <span class="error"><?php echo form_error('PRODUIT_NOM'); ?></span> 
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <label class="col-md-4 col-sm-12 col-xs-12 control-label">Quantity</label>
                                <div class="col-md-5 col-sm-12 col-xs-12 col-md-push-1">
                                    <input type="text" name="QUANTITE_DISPONIBLE"  value="<?php echo!empty($QUANTITE_DISPONIBLE) ? $QUANTITE_DISPONIBLE : ''; ?>" class="form-control"readonly> 
                                        <span class="error"><?php echo form_error('QUANTITE_DISPONIBLE'); ?></span> 
                                </div>
                            </div>

                             <div class="form-group">
                                <label class="col-md-4 col-sm-12 col-xs-12 control-label">Mesure</label>
                                <div class="col-md-5 col-sm-12 col-xs-12 col-md-push-1">
                                    <input type="text" name="MESURE_PRODUCT"  value="<?php echo!empty($MESURE_PRODUCT) ? $MESURE_PRODUCT : ''; ?>" class="form-control"> 
                                        <span class="error"><?php echo form_error('MESURE_PRODUCT'); ?></span> 
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 col-sm-12 col-xs-12 control-label">Description product</label>
                                <div class="col-md-5 col-sm-12 col-xs-12 col-md-push-1">
                                    <input type="text" name="PRODUIT_DESCRIPTION"  value="<?php echo!empty($PRODUIT_DESCRIPTION) ? $PRODUIT_DESCRIPTION : ''; ?>" class="form-control"> 
                                        <span class="error"><?php echo form_error('PRODUIT_DESCRIPTION'); ?></span> 
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 col-sm-12 col-xs-12 control-label">Type of the product</label>
                                <div class="col-md-5 col-sm-12 col-xs-12 col-md-push-1">
                                <select class="form-control" id="PRODUIT_TYPE_ID" name="PRODUIT_TYPE_ID">
                                    <option value=""> - Sélectionner - </option>
                                    <?php
                                      foreach ($type_produit as $typ):?>
                                         <option value="<?=$typ['PRODUIT_TYPE_ID']?>"><?=$typ['PRODUIT_TYPE_NOM']?></option>
                                        <?php
                                         endforeach
                                        ?>
                                </select>                             

                            </div>
                           
                           </div>

                            <div class="form-group">
                                <label class="col-md-4 col-sm-12 col-xs-12 control-label"></label>
                                <div class="col-md-5 col-sm-12 col-xs-12 col-md-push-1">
                                    <input type="submit" class="btn btn-primary btn-block" value="Enregistrer"/>
                                </div>
                            </div>
                       

                </form>
            </div>         
        </div>    

    </body>
</HTML>
