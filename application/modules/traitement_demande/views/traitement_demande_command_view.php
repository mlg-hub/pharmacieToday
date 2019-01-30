
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
                          
                    <form name="myform" method="post" action='<?= base_url()?>traitement_demande/Traitement_Demande/is_command/<?=$row["id"]?>' class="form-horizontal" id="msg">
                            <table class="table table-responsive" id='produit_list'>
                                <tr>
                                    <th>PRODUIT</th>
                                    <th>QTY DISPO</th>
                                    <th>QTY WANTED</th>
                                </tr>
                                
                                        
                                            <input type="hidden" name="demande_code" value="">
                           <?php 
                              foreach ($row as $value) {
                            $req=$this->Model->getOne('approv_produit', array('PRODUIT_ID'=>$value['PRODUIT_ID']));
                        
                           ?>
                                    
                                            <tr>
                                              <td><?=$req['PRODUIT_NOM']?></td>
                                              <td><?=$value['QUANTITE_DEMMANDE']?></td>
                                
                                              <td><input type="number" name="quantite" value='<?=$value['QUANTITE_COMMANDE']?>' class="form-control" id="quantite"></td>
                                            </tr>   
      <?php   }  ?>
                                  
                                        
                                      
                            </table>
                            <input type="button" class='btn btn-primary envoi' value="Command"/>
                            
                      </form>
                       </div>                       
                    </div>
                    </div>

                </div>
            </div>
            </div>
    </body>
     
</html>
<script type="text/javascript">
    $(document).ready(function(){
        $(".envoi").click(function(){
        
            if(!$('#quantite').val().trim()){
                    alert('The quantity is required');
                $('#quantite').focus();
                }else{
                    document.getElementById("msg").submit();
                }
        });
    });
</script>
