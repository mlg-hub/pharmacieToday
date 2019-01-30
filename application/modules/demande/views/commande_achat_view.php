<!DOCTYPE html>
<html lang="en">
<title>Commande</title>
<head>
<?php include VIEWPATH. 'includes/header.php' ?>
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
           
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12" style=" margin-bottom: 5px">
                             <div class="row" style="" id="conta">
                                <?=$breadcrumb?> 
                             </div>
                            <div class="row" id="conta" style="margin-top: -10px">
                                <div class="col-lg-3 col-md-3" style="padding-bottom: 3px">
                                <a href="<?=base_url('demande/Commande')?>" class="btn btn-default">New</a>
                                    <a href="<?=base_url('demande/Commande/listing')?>" class="btn btn-default">List</a>
                                </div>
                                 <div class="col-lg-4 col-md-4">                                  
                                   <h4 class=""><b>Validate an order</b></h4>  
                                </div>
                                <!--div class="col-lg-8 col-md-8" style="padding-bottom: 3px">
                                    <?php include 'includes/sous_menu_conge.php' ?>
                                </div-->
                            </div>  
                        </div>
                 </div>


                            
    <div class="col-md-12 jumbotron" style="...">
       
        <form   name="myform" method="post" class="form-horizontal" action="<?= base_url('demande/Commande/valider'); ?>"> 

            <?= $info; ?>
            <div class="col-md-10">
                 <?php echo $this->table->generate($command_list); ?> 
                      
            </div>
            <div class="col-md-2">
                 <button type="submit" style="margin-top: 100px;" name="" class="btn btn-primary">Validate</button>
                      
            </div>
<!-- 
             <div class="table-responsive">  
                       </div> -->


        </form>
 
        </div>
        </div>


    </body>
    <script>
        $(document).ready(function () {
            $("#id_tabl").DataTable({
                    // language: {
                    //             "sProcessing":     "Traitement en cours...",
                    //             "sSearch":         "Rechercher&nbsp;:",
                    //             "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
                    //             "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                    //             "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                    //             "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                    //             "sInfoPostFix":    "",
                    //             "sLoadingRecords": "Chargement en cours...",
                    //             "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                    //             "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
                    //             "oPaginate": {
                    //                 "sFirst":      "Premier",
                    //                 "sPrevious":   "Pr&eacute;c&eacute;dent",
                    //                 "sNext":       "Suivant",
                    //                 "sLast":       "Dernier"
                    //             },
                    //             "oAria": {
                    //                 "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                    //                 "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                    //             }
                    //     }
            });
            $(".dt-buttons").addClass("pull-left");
            $("#table_Cras_paginate").addClass("pull-right");
            $("#table_Cras_filter").addClass("pull-left");
        });

    </script>



