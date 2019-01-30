
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
        <!--     <?php 
            $diligence1 ='';
            $diligence2 ='active';
            ?> -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                       <div class="col-lg-12" style=" margin-bottom: 5px">
                             <div class="row" style="" id="conta">
                                <?=$breadcrumb?> 
                             </div>
                            <div class="row" id="conta" style="margin-top: -10px">
                                <!-- <div class="col-lg-3 col-md-3" style="padding-bottom: 3px">
                                    <a href="<?=base_url('demande/Demande/new')?>" class="btn btn-default">New</a>
                                    <a href="<?=base_url('demande/Demande/index')?>" class="btn btn-default">List</a>
                                </div> -->

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




                           <!-- form -->

                           <br><br>


                               <form name="myform"  class="form-horizontal" action="<?=base_url('comptabilite/Soumission/soummissioner');?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">

              
                <input type="hidden" name="DEMANDE_ID"  class="form-control input-sm" value="<?=$demande['DEMANDE_ID']?>">

              <!--       <div class="form-group">
                      
                      <label class="col-md-4 col-sm-12 col-xs-12 control-label">Product</label>
                     <div class="col-md-4 col-sm-12 col-xs-12">
                      <input type="text" name="PRODUIT_NOM"  class="form-control input-sm" value="<?=$produit['PRODUIT_NOM']?>" disabled>

                      </div>

                    </div>

               
                    <div class="form-group">
                      
                      <label class="col-md-4 col-sm-12 col-xs-12 control-label">Quantity requested</label>
                     <div class="col-md-4 col-sm-12 col-xs-12">
                      <input type="text" name="QUANTITE_DEMMANDE"  class="form-control input-sm" value="<?=$qte['QUANTITE_DEMMANDE']?>" disabled>

                      </div>

                    </div> -->


                    <div class="form-group">

                                <label class="col-md-2 col-sm-12 col-xs-12 control-label">Bidders</label><label><a href="#" data-toggle="modal" data-target="#addsoumission" data-backdrop="static"> New bidder </a></label>

                            <div class="col-md-6 col-sm-12 col-xs-12">

                               <select type="text" class="form-control" id="soummissionaire" name="ID_SOUMMISSIONAIRE" value="<?=set_value('ID_SOUMMISSIONAIRE')?>" >
                              <option value="">--Select a bidder--</option> 
                            <?php foreach($soumissio as $soumi){
                                if($soumi['ID_SOUMISSIONAIRE'] == $ID_SOUMISSIONAIRE){
                                  echo "<option value='".$soumi['ID_SOUMISSIONAIRE']."' selected>".$soumi['NOM_SOUMMISSIONAIRE']." ".$soumi['PRENOM_SOUMMISSIONAIRE']."</option>";
                                }else{
                                   echo "<option value='".$soumi['ID_SOUMISSIONAIRE']."'>".$soumi['NOM_SOUMMISSIONAIRE']." ".$soumi['PRENOM_SOUMMISSIONAIRE']."</option>";
                                }
                               }?>
                           </select>

                          <div>

                          <div style="color: red"> <?php echo form_error('ID_SOUMMISSIONAIRE'); ?>
                      </div>
                              
                            </div> 
                      </div> 
                 </div> 


                   <div class="form-group">
                      
                      <label class="col-md-2 col-sm-12 col-xs-12 control-label">Amount</label>
                     <div class="col-md-6 col-sm-12 col-xs-12">
                      <input type="number" name="MONTANT_FOURNISSEUR"  class="form-control input-sm" value="<?=set_value('MONTANT_FOURNISSEUR')?>" >

                      </div>

                    </div>

               
                    <div class="form-group">
                      
                      <label class="col-md-2 col-sm-12 col-xs-12 control-label">Delivery date</label>
                     <div class="col-md-6 col-sm-12 col-xs-12">
                      <input type="text" name="DATE_LIVRAISON"  class="form-control input-sm" value="<?php echo!empty($DATE_LIVRAISON) ? $DATE_LIVRAISON : date('Y-m-d'); ?>" id="datelivraison">

                      </div>

                    </div>





                                  
                                          <div class="form-group">
                                <label class="col-md-2 col-sm-12 col-xs-12 control-label"></label>
                                <div class="col-md-6 col-sm-12 col-xs-12 ">
                                    
                                
                                        </div> 

                                         </div>

                                           

                           <!-- form -->



                           
                        </div>

                           <div class="col-md-6 col-lg-6">
                              <h4>Items</h4>
                          <?php if($array_details){?>
                           <table class="table">
                               <tr>
                                   <th>Product</th>
                                   <th>Qty Request</th>
                                   <th>Qty ordered</th>
                                   <!-- <th>new Commandée</th> -->
                                   <!-- <th>Qty Livrée</th> -->
                               </tr>
                               <?php
                                  foreach ($array_details as $detail) {
                                     ?>
                                       <tr>
                                           <td><?=$detail['produit_non']?></td>
                                           <td><?=$detail['qty_demande']?></td>
                                           <td><?=$detail['qty_commande']?></td>
                                           <!-- <td><input type='number' name="qty_commande[]" value="<?=$detail['qty_demande']?>" class='form-control' size ='4'></td> -->
                                           <!-- <td> -->
                                            <!-- <form action="<?=base_url('comptabilite/Soumission/add_produit/'.$detail['id_produit'])?>" method='POST'><input type='numeric' name='qty_commande' value='1' class='form-control' size ='4'> -->

                                            <!-- <input type='hidden' name="DEMANDE_ID" value="<?=$detail['id_commande']?>"> -->



                                            <!-- <input type='submit' value='add' class='btn btn-primary'> -->
                                          <!-- </form> -->
                                          <!-- </td> -->
                                           <!-- <td><?=$detail['qty_livre']?></td> -->
                                       </tr>
                                     <?php
                                  }
                               ?>
                           </table>
                           <?php }?>
                        </div>
 <input  type="submit" name="get_form" value="Submit"  class="btn btn-primary btn-block">
</form>
                        <!-- cart -->

                 
                         
                     
                    </div>

                </div>
            </div>
            </div>
   


       <div class="modal fade" id="addsoumission" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">×</button>
                              <h4 class="modal-title">Register a new bidder</h4>
                            </div>
                            <div class="modal-body" style="text-align: center">
                              
                            <form  action="<?php echo base_url('comptabilite/Soumission/addnew')?>"  method="post" enctype="multipart/form-data" >


                              <input type="hidden" name="DEMANDE_ID"  class="form-control input-sm" value="<?=$demande['DEMANDE_ID']?>">


                                <input type="text" name="PRENOM" id="idprenom" class="form-control input-sm" placeholder="First name" required="required"><br>


                              <input type="text" name="NOM" id="idnom" class="form-control input-sm" placeholder="Last name" required="required"><br>


                              <input type="text" name="TEL" id="idtel" class="form-control input-sm" placeholder="Phone number" required="required"><br>

                              <input type="text" name="ADDRESSE" id="idaddress" class="form-control input-sm" placeholder="Address" required="required"><br>

                              <input type="submit" name="previous" class="btn btn-primary" value="Save" />
                            </form>

                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-primary" data-dismiss="modal">Exit</button>
                            </div>
                          </div>
                          
                        </div>
                    </div>

    </body>


         <script>
            $(function () {
                $("#datelivraison").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    format: 'yyyy-mm-dd',
                    startDate:'0',
                    minDate: new Date(),
                    todayHighlight: true,
                    autoclose: true
                });

            });

        </script>
   
</html>
