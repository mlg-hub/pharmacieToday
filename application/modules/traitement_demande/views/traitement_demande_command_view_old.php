
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
                                    <a href="#" class="btn btn-default">New</a>
                                    <a href="<?=base_url('traitement_demande/Traitement_Demande')?>" class="btn btn-default">List</a>
                                </div>

                                 <div class="col-lg-9 col-md-9">                                  
                                   <h4 class=""><b>The produits</b></h4> 
                                   
                                </div>
                                
                            </div>  
                        </div>
                         
                     <div class="col-lg-12 jumbotron"> 

                       <div class="col-lg-4">
                          <div class="bg-default"><h4>Produict card</h4></div>
                          <?php
                            if(!empty($this->cart->contents())){
                            ?>
                            <?php
                                   foreach ($this->cart->contents() as $panier) {
                                      ?>
                    <form name="myform" method="post" action='<?= base_url()?>traitement_demande/Traitement_Demande/is_command/<?=$panier["id"]?>' class="form-horizontal">
                            <table class="table table-responsive" id='produit_list'>
                                <tr>
                                    <th>PRODUIT</th>
                                    <th>QTY DISPO</th>
                                    <th>QTY WANTED</th>
                                </tr>
                                
                                        <tr>
                                            <input type="hidden" name="demande_code" value="<?=$panier['demande_code']?>">
                                            <td><?=$panier['name']?></td>     
                                            <td><?=$panier['qty']?></td>
                                            <td><input type="text" name="quantite" value='<?=$panier['qty1']?>' class="form-control" id="quantite"></td>
                                        </tr>
                                      <?php
                                   }
                                ?>
                            </table>
                            <input type="submit" class='btn btn-primary' value="Command"/>
                            <?php
                            }else
                            echo "<font color='red'>Empty</font>";
                          ?>
                      </form>
                       </div>                       
                    </div>
                    </div>

                </div>
            </div>
            </div>
    </body>
     
</html>
