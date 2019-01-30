
<!DOCTYPE html>
<html lang="en">

<head>
<?php include VIEWPATH.'includes/header.php' ?>
</head>

<body>
    <div class="container-fluid" style="background-color: white">
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 5px" id="navp">
                <!-- /.navbar-top-links -->
               <?php include VIEWPATH.'includes/menu_principal.php' ?>
                <!-- /.navbar-static-side -->
            </nav>

            <!-- Page Content -->
            <?php 
            $useradd ='';
            $userlist ='active';
            ?>
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                     
                        <div class="col-lg-12" style=" margin-bottom: 5px">
                             <div class="row" style="" id="conta">
                             <?= $breadcrumb ?>
                             </div>
                            <div class="row" id="conta" style="margin-top: -10px">
                                 <div class="col-lg-6 col-md-6">                                  
                                   <h4 class=""><b>Listes des médicaments</b></h4>
                                 </div>
                                 <div class="col-lg-6 col-md-6" style="padding-bottom: 3px">
                                  <?php include 'includes/sous_menu_medicament.php' ?>;
                                 </div>
                            </div>  
                        </div>
                    </div>
                         
                     <div class="col-lg-12 jumbotron"> 

                     <?=$this->session->flashdata('message')?> 
                     <?=$this->table->generate($user)?>  

             

                    </div>
                    </div>

                </div>
            </div>
            </div>
    </body>

     <script>
        $(document).ready(function () {
            $("#user_list").DataTable();
        });
    </script>

</html>
