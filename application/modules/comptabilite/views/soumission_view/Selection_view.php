
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
                                   <h4 class=""><b>Bidders selection</b></h4> 
                                   
                                </div>
                                <div class="col-lg-6 col-md-6" style="padding-bottom: 3px">
                                     <?php include 'include/sous_menu_soumission.php' ?>
                                   <!--  <a href="<?=base_url('demande/Demande/new')?>" class="btn btn-default">New</a>
                                    <a href="<?=base_url('demande/Demande/index')?>" class="btn btn-default">List</a> -->
                                </div>

                             
                                
                            </div>  
                        </div>
                         
                     <div class="col-lg-12 jumbotron">
 <div class="col-lg-12 col-md-12" >                                  
                                   <h4 class=""><b>Draft budget : <?=$budget_provisoire?></b></h4> <P>
                                   
                                </div>
                       <?= $this->session->flashdata('message') ?>
                           <?= $this->table->generate($table); ?>   
                       <!--     <div class="table-responsive">   
                         <table id='requests_list' class="table table-responsive">
                             <thead>
                                 <th>DATE</th>
                                 <th>PRODUCT NAME</th>
                                 <th>QUANTITY</th>   
                                 <th>BIDDERS</th>
                                 <th>ACTION</th>
                                 
                             </thead>
                         </table> 
                      </div>
 -->                    </div>
                    </div>

                </div>
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
    //     $(document).ready(function(){
    //         var requests_list = $("#requests_list").DataTable({
    //             "processing":true,
    //             "serverSide":true,
    //             "oreder":[],
    //             "ajax":{
    //                 url:"<?php echo base_url(). 'comptabilite/Soumission/get_soumission'?>",
    //                 type:"POST"
    //             },
    //             "columnDefs":[{
    //                 "targets":[1,2,3,4,6],
    //                 "orderable":false
    //             }]
                  
    //     });
    // });
$(document).on('click','.select',function(){
    var id=$(this).attr("id"); 
    var selected=$('#'+id).val();
    var demande_id="<?php echo $demande_id; ?>";
    // alert(selected);
        $.ajax({
                            url:"<?php echo base_url() ?>comptabilite/Soumission/soumissionaire",
                            method:"POST",
                            async:false,
                            data: {id:selected},
                                                                                 
                            success:function(data)
                                                        {
        if(confirm('A CHO0SEN BIDDER IS REALLY '+data+'?')){

$.ajax({
                            url:"<?php echo base_url() ?>comptabilite/Soumission/is_applied",
                            method:"POST",
                            async:false,
                            data: {id:selected,demande_id:demande_id},
                                                                                 
                            success:function(data)
                                                        {
                                                            alert('SELECTION SUCCESSFUL');
                                                            // window.location.replace="<?php base_url("comptabilite/Soumission"); ?>";
                                                            var url = "<?php echo base_url("comptabilite/Soumission"); ?>";    
                                                            $(location).attr('href',url);
                                                        }
                                                    });
    }else{
    	$(':radio').prop('checked', false);
    }
                                                         }
                                                    });

})
    </script>
</html>
