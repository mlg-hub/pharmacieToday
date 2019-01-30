<!DOCTYPE html>
<html lang="en">

<head>
<?php include VIEWPATH.'includes/header.php' ?>
</head>

<?php
$affect1="";
$affect2="active";
$affect3="";
 ?>

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
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12" style=" margin-bottom: 5px">
                             <div class="row" style="" id="conta">
                                <?= $breadcrumb ?>
                          
                             </div>
                            <div class="row" id="conta" style="margin-top: -10px">
                                 <div class="col-lg-6 col-md-6">                                  
                                   <h4 class=""><b>Details de la sociètés <?php echo $detailssoc['SOCIETE_NOM']; ?></b></h4>  
                                </div>
                                <div class="col-lg-6 col-md-6" style="padding-bottom: 3px">
                                    <?php include 'includes/sous_menu_example.php' ?>
                                </div>
                            </div>  
                        </div>
                        <div class="col-lg-12 jumbotron table-responsive" style="padding: 5px">
                            <?= $this->session->flashdata('message') ?>    

                            <table class="table">
                                <tr>
                                    <td colspan="4" class="text-center"><img src="<?= base_url() ?>upload/logos_societe/<?php echo $detailssoc['SOCIETE_LOGO'] ?>" style="width:250px;height: 67px "/></td>
                                </tr>
                                <tr>
                                    <td>Nom</td>
                                    <td><?php echo $detailssoc['SOCIETE_NOM']; ?></td>
                                    <td>Type</td>
                                    <td><?php 
            $typesoc=$this->Model->getOne('admin_type_societe',array('TYPE_SOCIETE_ID'=>$detailssoc['SOCIETE_TYPE']));
            $userdet=$this->Model->getOne('admin_utilisateurs',array('UTILISATEUR_ID'=>$detailssoc['ENREGISTRE_PAR']));

                                    echo $typesoc['TYPE_SOCIETE_DESCRIPTION']; ?></td>
                                </tr>
                                <tr>
                                    <td>Enregistre par</td>
                                    <td><?php echo $userdet['UTILISATEUR_NOM'].' '.$userdet['UTILISATEUR_PRENOM']; ?></td>
                                    <td>Date enregistement</td>
                                    <td><?php echo $detailssoc['DATE_INSERTION']; ?></td>
                                </tr>
                                <tr>
                                    <td>Representant</td>
                                    <td><?php echo $detailssocdet['DETAIL_SOCIETE_NOM_REPRESENTANT'].' '.$detailssocdet['DETAIL_SOCIETE_PRENOM_REPRESENTANT']; ?></td>
                                    <td>Adresse</td>
                                    <td><?php echo $detailssocdet['DETAIL_SOCIETE_ADRESSE']; ?></td>
                                </tr>

                                <tr>
                                    <td>E-mail</td>
                                    <td><?php echo $detailssocdet['DETAIL_SOCIETE_EMAIL_REPRESENTANT']; ?></td>
                                    <td>Tel</td>
                                    <td><?php echo $detailssocdet['DETAIL_SOCIETE_TEL_REPRESENTANT']; ?></td>
                                </tr>
                                <tr>
                                    <td>NIF</td>
                                    <td><?php echo $detailssocdet['DETAIL_SOCIETE_NIF']; ?></td>
                                    <td>RC</td>
                                    <td><?php echo $detailssocdet['DETAIL_SOCIETE_RC']; ?></td>
                                </tr>
                                
                            </table>
                        </div>
                        
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
    </div>

</body>

</html>
<script>
$(document).ready( function () {
    $('#mytable').DataTable({
     /*dom: 'lBfrtip',
    buttons: ['copy', 'print']*/ });  
} );
</script>
<script>
      $(document).ready(function(){
          $('[data-toggle="popover"]').popover({
            html:true
          });
      });
</script>