
<!DOCTYPE html>
<html lang="en">

<head>
<?php include VIEWPATH. 'includes/header.php' ?>
</head>
<body>
    <div class="container-fluid" style="background-color: white">
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 5px" id="navp">
                <!-- /.navbar-top-links -->
                <?php include VIEWPATH. 'includes/menu_principal.php' ?>
                <!-- /.navbar-static-side -->
            </nav>

            <!-- Page Content -->
            
            <div id="page-wrapper">
               <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12" style=" margin-bottom: 5px">
                             <div class="row" style="" id="conta">
                                <?=$breadcrumb?> 
                             </div>
                            <div class="row" id="conta" style="margin-top: -10px">

                                   <div class="col-lg-6 col-md-6" style="padding-bottom: 3px">
                                    <a href="<?=base_url('produit/Produit/new')?>" class="btn btn-default">New</a>
                                    <a href="<?=base_url('produit/Produit/index')?>" class="btn btn-default">List</a>


                                     <a href="<?=base_url('produit/Type_Produit')?>" class="btn btn-default">New product type</a>
                                    <a href="<?=base_url('produit/Type_Produit/listing')?>" class="btn btn-default">List of product type</a>
                                </div>


                                 <div class="col-lg-6 col-md-6">                                  
                                   <h4 class=""><b>List of product type</b></h4>
                                </div>
                                
                            </div>  
                        </div>
                    </div>

                            
                    <div class="col-md-12 jumbotron" style="padding: 5px">  
             
           
                  

                   <?=  $this->session->flashdata('message');?>
                  
                     
                    <?= $this->table->generate($type); ?>


                           
                           </div>
                           
                       

              
            </div>         
        </div>    

    </body>

       <script>
       
        $(document).ready( function () {
    $('#mytable').DataTable({
     /*dom: 'lBfrtip',
    buttons: ['copy', 'print']*/ });  
} );



    </script>
</HTML>
