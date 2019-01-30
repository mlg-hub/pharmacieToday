
<!DOCTYPE html>
<html lang="en">

<?php
  include VIEWPATH."includes/header.php";
  $sms='active';
$sms1="";
$sms2="";
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
                                    <div class="col-lg-6 col-md-6" >                                  
                                   <h4 class=""><b>Take in stock</b></h4> 
                                   
                                </div>
                                <div class="col-lg-6 col-md-6" style="padding-bottom: 3px">
                                     <?php include 'include/sous_menu_soumission.php' ?>
                                   <!--  <a href="<?=base_url('demande/Demande/new')?>" class="btn btn-default">New</a>
                                    <a href="<?=base_url('demande/Demande/index')?>" class="btn btn-default">List</a> -->
                                </div>

                             
                                
                            </div>  
                        </div>
                         
                     <div class="col-lg-12 jumbotron">

                       <?= $this->session->flashdata('message') ?>
                       <h4>The remain : <?=$qte_disponible ?> <?=$produit_nom?></h4>
                       <form  action="<?php echo base_url('comptabilite/Soumission/take_in_stock1')?>"  method="post" enctype="multipart/form-data" >
                       <div class="col-lg-3">
                        Quantity of <?=$produit_nom?> to take </div>
                        <div class="col-lg-6">
                          <input type="number" name="xt" id="xt" max="<?=$qte_disponible?>" class="form-control input-sm" value="<?=$qte_commander?>">
                        </div>
                        <div class="col-lg-3">
                          <input type="submit" name="submit" id="submit" class=" btn btn-primary">
                        </div>
                     </form>
                     </div>
                    </div>

                </div>
            </div>
            </div>
            </div>
    </body>
    <script>
       
    </script>
</html>
