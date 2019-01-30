
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
                                <?= $breadcrumb?> 
                             </div>
                            <div class="row" id="conta" style="margin-top: -10px">
                                                                <div class="col-lg-3 col-md-3" style="padding-bottom: 3px">
                                                                <a href="<?=base_url('approvisionnement/Procurement')?>" class="btn btn-default">New</a>
                                    <a href="<?=base_url('approvisionnement/Procurement/reception')?>" class="btn btn-default">List</a>
                                </div>
                                 <div class="col-lg-9 col-md-9">                                  
                                   <h4 class=""><b>Confirmation de la réception</b></h4> 
                                   
                                </div>
                                
                            </div>  
                        </div>
                         
                     <div class="col-lg-12 jumbotron">
                       <div class="table-responsive">   
                         <?php echo $table; ?> 
                      </div>
                    </div>
                    </div>

                </div>
            </div>
            </div>
            <div id="res"></div>
    </body>

    
    <script>
      function confirmer(val){

        var valer= $(val).attr('id');
        var ok= $(val).val();
        var id= $('#prod'+valer).attr('id');
        id= $('#prod'+valer).val();
        var code= $('#code'+valer).attr('id');
        code= $('#code'+valer).val();
        //alert(id);
        var liv= $('#approv'+valer).attr('id');
        liv= $('#approv'+valer).val();
        var com= $('#com'+valer).attr('id');
        
        com= $('#com'+valer).val();
        //alert(com);
            $.post('<?php echo base_url("approvisionnement/Procurement/confirmer")?>',
            {id:id, valer:valer, liv:liv, com:com, ok:ok, code:code}, function(data){
               $('#res').html(data);
            }
              );
            
      }

        $(document).ready(function(){
            var requests_list = $("#requests_list").DataTable({
            
        });
    });

    </script>
</html>
