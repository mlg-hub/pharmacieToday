
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
                                    
                                </div>

                                 <div class="col-lg-9 col-md-9">                                  
                                   <h4 class=""><b>Orders Delivered</b></h4> 
                                   
                                </div>
                                
                            </div>  
                        </div>
                         
                     <div class="col-lg-12 jumbotron">
                     <?php
                        if($this->session->flashdata('msg'))
                            echo $this->session->flashdata('msg');
                     ?> 
                       <div class="table-responsive">   
                         <table id='requests_list' class="table table-responsive">
                             <thead>
                                 <th>ORDER</th>
                                 <th>AGENT</th>
                                 <th>SERVICE</th>   
                                 <th>BUDGET</th>
                                 <th>IS DELIVERED</th>
                                 <th>DELIVERY DATE</th>
                                 <th>OPTIONS</th>
                             </thead>
                         </table> 
                      </div>
                    </div>
                    </div>

                </div>
            </div>
            </div>
    </body>
    <script>
        $(document).ready(function(){
            var requests_list = $("#requests_list").DataTable({
                "processing":true,
                "serverSide":true,
                "oreder":[],
                "ajax":{
                    url:"<?php echo base_url(). 'demande/Delivered/get_demandes'?>",
                    type:"POST"
                },
                "columnDefs":[{
                    "targets":[1,2,3,4,6],
                    "orderable":false
                }]
                  
        });
    });

    </script>
</html>
