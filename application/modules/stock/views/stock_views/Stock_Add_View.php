
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

                                   <div class="col-lg-6 col-md-6" style="padding-bottom: 3px">
                                    <a href="#" class="btn btn-default">New</a>
                                    <a href="#" class="btn btn-default">List</a>

                                </div>


                                 <div class="col-lg-6 col-md-6">                                  
                                   <h4 class=""><b>New type of product</b></h4>
                                </div>
                                
                            </div>  
                        </div>
                    </div>

                            
                    <div class="col-md-12 jumbotron" style="padding: 5px">  
             
           
                     <form   name="myform" method="post" class="form-horizontal" action="<?= base_url('stock/Stock/add'); ?>">

                            <div class="form-group">
                                <label class="col-md-3 col-sm-12 col-xs-12 control-label">Storage type</label>
                                <div class="col-md-5 col-sm-12 col-xs-12 col-md-push-1">
                                <select class="form-control" name="TYPE_STOCK">
                                    <option value="1">Carton</option>
                                    <option value="2">Piece</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-12 col-xs-12 control-label">Nombre de carton</label>
                                <div class="col-md-5 col-sm-12 col-xs-12 col-md-push-1">
                                    <input type="number" name="NOMBR_CARTON" class="form-control" autofocus> 
                                        <span class="error text-danger"><?php echo form_error('NOMBR_CARTON'); ?></span> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-12 col-xs-12 control-label">Fournisseur</label>
                                <div class="col-md-5 col-sm-12 col-xs-12 col-md-push-1">
                                <select class="form-control" name="FOURNISSEUR">
                            <?php
                            foreach ($fournisseur as $key) {
                                 
                            ?>
                                    <option value="<?= $key['ID_FOURNISSEUR']?>">
                                    <?php echo $key['TYPE_FOURNISSEUR'];?>
                                    </option>
                             <?php
                        }
                        ?>
                                </select>
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <label class="col-md-3 col-sm-12 col-xs-12 control-label">Medicament</label>
                                <div class="col-md-5 col-sm-12 col-xs-12 col-md-push-1">
                                <select class="form-control" name="MEDOC">
                                    <?php
                            foreach ($medicament as $key) {
                                 
                            ?>
                                    <option value="<?= $key['MEDICAMENT_ID']?>">
                                    <?php echo $key['DESCRIPTION'];?>
                                    </option>
                             <?php
                        }
                        ?>
                                </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-12 col-xs-12 control-label">Type Medicamment</label>
                                <div class="col-md-5 col-sm-12 col-xs-12 col-md-push-1">
                                <select class="form-control" name="TYPE_MEDOC">
                                    <?php
                            foreach ($type_medicament as $key) {
                                 
                            ?>
                                    <option value="<?= $key['TYPE_ID']?>">
                                    <?php echo $key['DESCRIPTION'];?>
                                    </option>
                             <?php
                        }
                        ?>
                                </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-12 col-xs-12 control-label">Nombre de</label>
                                <div class="col-md-5 col-sm-12 col-xs-12 col-md-push-1">
                                    <input type="number" name="TYPE_NOMBR"  value="<?php echo!empty($TYPE_NOMBR) ? $TYPE_NOMBR : ''; ?>" class="form-control" autofocus> 
                                        <span class="error text-danger"><?php echo form_error('TYPE_NOMBR'); ?></span> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-12 col-xs-12 control-label">Prix de vente</label>
                                <div class="col-md-5 col-sm-12 col-xs-12 col-md-push-1">
                                    <input type="number" name="PRIX_VENTE"  value="<?php echo!empty($PRIX_VENTE) ? $PRIX_VENTE : ''; ?>" class="form-control" autofocus> 
                                        <span class="error text-danger"><?php echo form_error('PRIX_VENTE'); ?></span> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-12 col-xs-12 control-label">Prix d'achat</label>
                                <div class="col-md-5 col-sm-12 col-xs-12 col-md-push-1">
                                    <input type="number" name="PRIX_ACHAT"  value="<?php echo!empty($PRIX_ACHAT) ? $PRIX_ACHAT : ''; ?>" class="form-control" autofocus> 
                                        <span class="error text-danger"><?php echo form_error('PRIX_ACHAT'); ?></span> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-12 col-xs-12 control-label">Expiration date</label>
                                <div class="col-md-5 col-sm-12 col-xs-12 col-md-push-1">
                                    <input type="date" name="EXP_DATE"  value="<?php echo!empty($EXP_DATE) ? $EXP_DATE : ''; ?>" class="form-control" autofocus> 
                                        <span class="error text-danger"><?php echo form_error('EXP_DATE'); ?></span> 
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
