
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
                         
                     <div class="col-lg-12 jumbotron"> 
                       <div class="col-lg-8">
                           <div class="table-responsive">   
                                 <table id='produit_list' class="table table-responsive">
                                     <thead>
                                         <th>PRODUIT</th>
                                         <th>QTY DISPO.</th>   
                                         <th>QTY WANTED</th>
                                     </thead>
                                 </table> 
                              </div>
                       </div>
                       <div class="col-lg-4">
                          <div class="bg-default"><h4>Produict card</h4></div>
                          <?php
                            if(!empty($this->cart->contents())){
                            ?>
                            <table class="table">
                                <tr>
                                    <th>Produit</th>
                                    <th>Qty</th>
                                    <th>Option</th>
                                </tr>
                                <?php
                                   foreach ($this->cart->contents() as $panier) {
                                      ?>
                                        <tr>
                                            <td><?=$panier['name']?></td>
                                            <td><?=$panier['qty']?></td>
                                            <td><a href="<?=base_url('demande/Produits/remove_edit/'.$demande_id.'/'.$panier['rowid'])?>"><font color='red'>X</font></a></td>
                                        </tr>
                                      <?php
                                   }
                                ?>
                            </table>
                            <a class='btn btn-primary' href="<?=base_url('demande/Demande/validerMofication/'.$demande_id)?>"> Valider</a>
                            <?php
                            }else
                            echo "<font color='red'>Empty</font>";
                          ?>
                       </div>                       
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
