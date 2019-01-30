
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
                                   <h4 class=""><b>Metre à jour le ,ot de passe</b></h4> 
                                   
                                </div>
                                <div class="col-lg-6 col-md-6" style="padding-bottom: 3px">
                                    <!--  <?php include 'include/sous_menu_soumission.php' ?> -->
                                   <!--  <a href="<?=base_url('demande/Demande/new')?>" class="btn btn-default">New</a>
                                    <a href="<?=base_url('demande/Demande/index')?>" class="btn btn-default">List</a> -->
                                </div>

                             
                                
                            </div>  
                        </div>
                         
                     <div class="col-lg-12 jumbotron">

                       <?= $this->session->flashdata('message') ?>
                       <h4></h4>
                       <form  action="<?php echo base_url('administration/User_setting/update')?>"  method="post" enctype="multipart/form-data" >
                        <div id="confirmation" ></div>
                        <div class="row">
                       <label class="col-lg-3">
                        Ancien mot de passe
                       </label>
                        <div class="col-lg-6">
                          <input type="password" name="old_pwd" id="old_pwd" max="" class="form-control input-sm" value="" required><div id="divcomp" ></div><p>
                        </div>
                        </div>
                       <div class="row">
                       <label class="col-lg-3">
                        Nouveau mot de passe
                       </label>
                        <div class="col-lg-6">
                          <input type="password" name="new_pwd" id="new_pwd" max="" class="form-control input-sm" value="" required><div id="divcomp1" ></div><p>
                        </div>
                        </div>
                        <div class="row">
                       <label class="col-lg-3">
                        Confirmer le mot de passe
                       </label>
                        <div class="col-lg-6">
                          <input type="password" name="confirm_pwd" id="confirm_pwd" max="" class="form-control input-sm" value="" onkeyup="checkPass()"><div id="divcomp2" ></div><p>
                        </div>
                        </div>
                         <div class="row">
                       <label class="col-lg-3">
                       
                       </label>
                        <div class="col-lg-6">
                           <button type="submit" name="submit" id="submit" class=" btn btn-primary">Enregistrer</button>
                        </div>
                        </div>
                         
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
<script language="javascript">
 
//   function checkPass()
// {
// var champA = document.getElementById("new_pwd").value;
// var champB = document.getElementById("confirm_pwd").value;
// var div_comp = document.getElementById("divcomp");
 
// if(champA == champB)
// {
// divcomp.innerHTML ="";
// }
// else
// {
// divcomp.innerHTML = "<span style='color:red;'>check new password and Confirm password !<span>";

// }
// }

//  $(document).on('click','#submit',function(){


// var old_pwd=$('#old_pwd').val();
// var new_pwd=$('#new_pwd').val();
// var confirm_pwd=$('#confirm_pwd').value();
// var div_comp = document.getElementById("divcomp");
// var div_comp1 = document.getElementById("divcomp1");
// var div_comp = document.getElementById("divcomp");
// var confirmation = document.getElementById("confirmation");

// if($('#old_pwd').val()){
//   alert();
// // if($('#new_pwd').val()){
// // if($('#confirm_pwd').val()){

// // }else divcomp2.innerHTML ="<span style='color:red;'>this field is empty !<span>";
// // }else divcomp1.innerHTML ="<span style='color:red;'>this field is empty !<span>";
// }else divcomp.innerHTML ="<span style='color:red;'>this field is empty !<span>";

// // if(($('#old_pwd').val())&&($('#new_pwd').val())&&($('#confirm_pwd').val())){

// // }else confirmation.innerHTML ="<span style='color:red;'>this field is empty !<span>";

//  });


</script>
