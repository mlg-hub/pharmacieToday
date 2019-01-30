<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include VIEWPATH.'includes/header.php' ?>
</head>

</head>
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
        $mission1 = 'active';
        $mission2 = '';
        ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12" style=" margin-bottom: 5px">
                        <div class="row" style="" id="conta">
                            <?=$breadcrumb?>
                        </div>
                        <div class="row" id="conta" style="margin-top: -10px">
                            <div class="col-lg-6 col-md-6">
                                <h4 class=""><b>Modification du Profil </b></h4>
                            </div>
                            <div class="col-lg-6 col-md-6" style="padding-bottom: 3px">
                                <?php include 'includes/sous_menu_profil.php' ?>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-12 jumbotron" style="padding: 5px">



                     <style>
           .error{
      color:red;
      font-weight:normal;
      font-size: 15px;
    }
        </style>

      <?php if(isset($success)){
                  echo $success;
                }?>

             <form id="myform" action="<?php echo base_url('administration/Users_Profil/update_data')?>" method="post" >
                <div class="form-group">
               
                  <?php $datad= $this->Model->getOne('droits',array('PROFIL_ID'=>$datas['PROFIL_ID']));?>


                 <input type="hidden" class="form-control"  name="id_profil" value="<?=$datas['PROFIL_ID']?>" autofocus>

                 <input type="hidden" class="form-control"  name="id_droit" value="<?=$datad['DROIT_ID']?>" autofocus>
                   

                  <label>Profil</label>
                  <input type="text" cl


                  ass="form-control" id="profil" name="profil" value="<?=$datas['DESCRIPTION']?>" autofocus>
                  <div style="color: red"><?=form_error('profil')?></div>
                </div>
                <div class="form-group">
                  <label>Droits</label><br>

                  <input type="checkbox" name="facturation" value="1" <?php echo ($datad['FACTURATION']==1)? 'checked':'' ?>> Facturation<br>
                  
                  <input type="checkbox" name="stock" value="1" <?php echo ($datad['STOCK']==1)? 'checked':'' ?>> Stock<br>

                    <input type="checkbox" name="reporting" value="1" <?php echo ($datad['REPORTING']==1)? 'checked':'' ?>> Rapport<br>
                  
                  <input type="checkbox" name="admin" value="1" <?php echo ($datad['ADMIN']==1)? 'checked':'' ?>> Admin<br>

                

                  <input type="checkbox" name="boncommande" value="1" <?php echo ($datad['BON_COMMANDE']==1)? 'checked':'' ?> > Bon de Commande<br>
           
                  
                </div>
                  <input type="button" id="send" class="btn btn-primary btn-block" value="Modifier">
               </form>
                </div>
            </div>
</body>


   <script>

    $('#send').click(function(){
       $('#myform').submit();
    });
            $(document).ready(function(){
               validation_run();
               $('#profil').focus();
          });
            function validation_run(){
            $('#myform').validate({
              rules:{
               profil: {
                 required: true
               }
              },
              messages:{
               profil: {
                 required: "Veuillez saisir le profil"
               }
              }
            });
          }
    </script>
</HTML>

