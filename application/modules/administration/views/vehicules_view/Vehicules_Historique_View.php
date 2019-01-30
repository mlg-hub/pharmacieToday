<!DOCTYPE html>
<html lang="en">

<head>
<?php include VIEWPATH.'includes/header.php' ?>
</head>

<?php
$affect1="";
$affect2="active";
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
                                   <h4 class=""><b>Details du vehicule</b></h4>  
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
                                    <td>Plaque</td>
                                    <td><?php echo $detailsveh['VEHICULE_PLAQUE']; ?></td>
                                    <td> Proprietaire</td>
                                    <td><?php echo $detailsveh['VEHICULE_NOM_PROPRIETAIRE']; ?> <?php echo $detailsveh['VEHICULE_PRENOM_PROPRIETAIRE']; ?> </td>
                                </tr>
                                <tr>
                                    <td>Tel Proprietaire</td>
                                    <td><?php echo $detailsveh['VEHICULE_TEL_PROPRIETAIRE']; ?></td>
                                    <td>E-mail Proprietaire</td>
                                    <td><?php echo $detailsveh['VEHICULE_EMAIL_PROPRIETAIRE']; ?></td>
                                </tr>

                            </table>
                                <div class="col-lg-12 col-md-12">                                  
                                   <h4 class=""><b>Histoire du vehicule</b></h4>  
                                </div>
                            <table class="table" id="mytable">
                                <thead>
                                    <tr>
                                    <td>Date</td>
                                    <td>Plaque</td>
                                    <td>Proprietaire</td>
                                    <td>Tel</td>
                                    <td>E-mail</td>
                                </tr>
                                </thead>
                                <?php 

                                foreach ($detailsvehdet as $detailsvehdets) {


                                    echo "<tr>
                                    <td>".$detailsvehdets['VEHICULE_HISTORIQUE_DATE']."</td>
                                    <td>".$detailsvehdets['VEHICULE_HISTORIQUE_PLAQUE']."</td>
                                    <td>".$detailsvehdets['VEHICULE_HISTORIQUE_NOM_PROPRIETAIRE']." ".$detailsvehdets['VEHICULE_HISTORIQUE_PRENOM_PROPRIETAIRE']."</td>
                                    <td>".$detailsvehdets['VEHICULE_HISTORIQUE_TEL_PROPRIETAIRE']."</td>
                                    <td>".$detailsvehdets['VEHICULE_HISTORIQUE_EMAIL_PROPRIETAIRE']."</td>
                                    
                                    
                                </tr>";



                                }

                                 ?>
                               

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