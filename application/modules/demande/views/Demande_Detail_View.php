
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
                                <div class="col-lg-3 col-md-3" style="padding-bottom: 3px">
                                    <a href="<?=base_url('demande/Demande/new')?>" class="btn btn-default">New</a>
                                    <a href="<?=base_url('demande/Demande/index')?>" class="btn btn-default">List</a>
                                </div>

                                 <div class="col-lg-9 col-md-9">                                  
                                   <h4 class=""><b>Show a request</b></h4>                                    
                                </div>                                
                            </div>  
                        </div>
                        <div class="col-lg-12 col-md-12">
                           <div class="col-md-6 col-lg-6">
                              <h4>Request information</h4>
                            
                           <table class="table">
                               <tr>
                                   <th>Code request</th>
                                   <td><?=$demande['DEMANDE_CODE']?></td>
                                   <th>Date</th>
                                   <td><?=$demande['DATE_INSERTION']?></td>
                               </tr>
                               <tr>
                                   <th>User</th>
                                   <td><?=$utilisateur['UTILISATEUR_NOM'].' '.$utilisateur['UTILISATEUR_PRENOM']?></td>
                                   <th>Service</th>
                                   <td><?=$service['SERVICE_NOM']?></td>
                               </tr>
                           </table>
                           <!-- <a href="<?=base_url('demade/Demande/Modifier/'.$demande['DEMANDE_ID'])?>" class='btn btn-primary'>Edit</a> -->
                        </div>

                           <div class="col-md-6 col-lg-6">
                              <h4>Items</h4>
                          <?php if($array_details){?>
                           <table class="table">
                               <tr>
                                   <th>Produit</th>
                                   <th>Qty Demandée</th>
                                   <th>Qty Commandée</th>
                                   <th>Qty Livrée</th>
                               </tr>
                               <?php
                                  foreach ($array_details as $detail) {
                                     ?>
                                       <tr>
                                           <td><?=$detail['produit_non']?></td>
                                           <td><?=$detail['qty_demande']?></td>
                                           <td><?=$detail['qty_commande']?></td>
                                           <td><?=$detail['qty_livre']?></td>
                                       </tr>
                                     <?php
                                  }
                               ?>
                           </table>
                           <?php }?>
                        </div>
                         
                     
                    </div>

                </div>
            </div>
            </div>
    </body>
   
</html>
