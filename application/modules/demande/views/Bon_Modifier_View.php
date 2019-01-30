
<!DOCTYPE html>
<html lang="en">

<?php
include VIEWPATH."includes/header.php";
?>

<body>
<div class="container-fluid" style="background-color: white">
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 5px" id="navp">

            <?php  include VIEWPATH.'includes/menu_principal.php' ?>

        </nav>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12" style=" margin-bottom: 5px">
                        <div class="row" style="" id="conta">
                            <?=$breadcrumb?>
                        </div>
                        <div class="row" id="conta" style="margin-top: -10px">
                            <div class="col-lg-3 col-md-3" style="padding-bottom: 3px">
                                <a href="<?=base_url('demande/Demande/new')?>" class="btn btn-default">New</a>
                                <a href="<?=base_url('demande/Demande/index')?>" class="btn btn-default">List</a>
                            </div>

                            <div class="col-lg-9 col-md-9">
                                <h4 class=""><b>The produits</b></h4>

                            </div>

                        </div>
                    </div>

                    <div class="col-md-12 jumbotron" style="padding: 5px">


                        <form   name="myform" method="post" class="form-horizontal" action="<?= base_url(''); ?>">

                            <div class="form-group">
                                <label class="col-md-4 col-sm-12 col-xs-12 control-label">Commentaires</label>
                                <div class="col-md-5 col-sm-12 col-xs-12 col-md-push-1">
                                    <input type="text" name="COMMENTAIRE"  value="<?php echo!empty($COMMENTAIRE) ? $COMMENTAIRE : ''; ?>" class="form-control">
                                    <span class="error"><?php echo form_error('COMMENTAIRE'); ?></span>
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

            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function(){
        var produit_list = $("#produit_list").DataTable({
            "processing":true,
            "serverSide":true,
            "oreder":[],
            "ajax":{
                url:"<?php echo base_url(). 'demande/Produits/get_produit_edit'?>",
                type:"POST"
            },
            "columnDefs":[{
                "targets":[1],
                "orderable":false
            }]

        });
    });

</script>
</html>
