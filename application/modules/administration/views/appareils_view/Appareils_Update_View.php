<!DOCTYPE html>
<html lang="en">

<head>
<?php include VIEWPATH.'includes/header.php' ?>
<link href="<?= base_url() ?>MultiSelect/css/bootstrap-multiselect.css" rel="stylesheet" />
</head>

<?php
$affect1="active";
$affect2="";
$affect3="";

 ?>
<style type="text/css">
    .form-group{
        margin-top: 1px;
    }
</style>

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
                                <?= $breadcrumb ?>

                             </div>
                            <div class="row" id="conta" style="margin-top: -10px">
                                 <div class="col-lg-6 col-md-6">                                  
                                   <h4 class=""><b>Modification d'un appareil</b></h4>  
                                </div>
                                <div class="col-lg-6 col-md-6" style="padding-bottom: 3px">
                                    <?php include 'includes/sous_menu_example.php' ?>
                                </div>
                            </div>  
                        </div>
                        <div class="col-lg-12 jumbotron" style="padding: 5px">
                            <?= $this->session->flashdata('message') ?>
                            <form id="regiration_form" action="<?php echo base_url()?>administration/Appareils/update"  method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Numero de tel</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 form-group">
                                        <input type="hidden" name="APPAREIL_ID" id="APPAREIL_ID" value="<?php echo $detailapp['APPAREIL_ID']; ?>" class="form-control input-sm" >

                                        <input type="text" name="APPAREIL_NUM_TEL" id="APPAREIL_NUM_TEL" value="<?php echo $detailapp['APPAREIL_NUM_TEL']; ?>" class="form-control input-sm" >
                                        <div style="color: red"><?php echo form_error('APPAREIL_NUM_TEL', '<span class=text-center text-danger>', '</span>'); ?></div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Agent</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 form-group">
                                        <select name="AGENT_ID" id="AGENT_ID" class="form-control input-sm">
                                            <option value="">Selectionner</option>
                                            <?php
                                            foreach ($listagent as $listsociets) {
                                                if ($listsociets['AGENT_ID'] == $detailapp['AGENT_ID']) {
                                                    # code...
                                                    echo '<option value="'.$listsociets['AGENT_ID'].'" selected="selected">'.$listsociets['NOM'].' '.$listsociets['PRENOM'].'</option>';
                                                }
                                                else{
                                                 echo '<option value="'.$listsociets['AGENT_ID'].'">'.$listsociets['NOM'].' '.$listsociets['PRENOM'].'</option>';   
                                                }
                                                
                                            }
                                            ?>
                                        </select>


                                        <div style="color: red"><?php echo form_error('AGENT_ID', '<span class=text-center text-danger>', '</span>'); ?></div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Societe</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 form-group">

                                        <select name="SOCIETE_ID" id="SOCIETE_ID" class="form-control input-sm">
                                            <option value="">Selectionner</option>
                                            <?php
                                            foreach ($listsociet as $listsociets) {
                                                if ($listsociets['SOCIETE_ID'] == $detailapp['SOCIETE_ID']) {
                                                    # code...
                                                    echo '<option value="'.$listsociets['SOCIETE_ID'].'" selected="selected">'.$listsociets['SOCIETE_NOM'].' </option>';
                                                }
                                                else{
                                                 echo '<option value="'.$listsociets['SOCIETE_ID'].'">'.$listsociets['SOCIETE_NOM'].' </option>';   
                                                }
                                                
                                            }
                                            ?>
                                            
                                        </select>


                                        <!-- <input type="text" name="SOCIETE_ID" id="SOCIETE_ID" placeholder="" class="form-control input-sm" > -->
                                        <div style="color: red"><?php echo form_error('SOCIETE_ID', '<span class=text-center text-danger>', '</span>'); ?></div>
                                    </div>





                                    
                                    


                                    

                                    
                                    
                                    
                                    



                                    <div class="col-lg-6 col-lg-offset-4 col-sm-6 col-sm-offset-4 xs-6 form-group">
                                        <button type="submit" name="save" class="btn btn-primary">Modifier</button>
                                         <!-- <input type="button" name="next" class="btn btn-primary btn-block envoi" value="Enregistrer" /> -->
                                    </div>
                                
                                
                                    
                                            
                                </div>
                            </form>
                            
                                
                            </div>
                             
                        </div>
                        
                        
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
    </div>

</body>

</html>
 <script>

            $(function () {
                $("#date_reception").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    format: 'yyyy-mm-dd',
                    // startDate:'0',
                    // minDate: new Date(),
                    // todayHighlight: true,
                    autoclose: true
                });

                $("#date_limite").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    format: 'yyyy-mm-dd',
                    // startDate:'0',
                    // minDate: new Date(),
                    // todayHighlight: true,
                    autoclose: true
                });
            });

        </script>
<script>
$(document).ready( function () {
    $('#mytable').DataTable({
     /*dom: 'lBfrtip',
    buttons: ['copy', 'print']*/ });
    $('#intitule_ami').focus();  
} );
</script>
<script src="<?= base_url() ?>MultiSelect/js/bootstrap-multiselect.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#equipe').multiselect({
            buttonWidth: '350px',
             numberDisplayed: 1
        });
        
    });
</script>

<!-- POUR LES DOMAINES -->
<script>
    function select_domaine()
        {
          var domaine_exige=$('#domaine_exige').val();
          if(domaine_exige==''){
            alert('Veuillez saisir un domaine');
          }else{
            $.post('<?php echo base_url();?>Ami/add_cart_domaine',
                {
                domaine_exige:domaine_exige,
                
                
                },
                function(data) 
                { 
                    domaine.innerHTML = data;  
                    $('#domaine').html(data);
                    $('#domaine_exige').val('');
                }
            ); }

        }
   
</script>

    <script>
    function remove_domaine()
{

  var rowid=$('#rowid').val();
  

    $.post('<?php echo base_url();?>Ami/remove_cart_domaine',
  {
    rowid:rowid
    
    },
    function(data) 
    { 
    domaine.innerHTML = data;  
    $('#domaine').html(data);
    }); 
}
   
    </script>

<!-- POUR LES CONCURRENTS -->


<script>
    function select_soummission()
        {
          var Soumissionaires=$('#Soumissionaires').val();
           if(Soumissionaires==''){
            alert('Veuillez saisir un Soumissionaire');
          }else{

            $.post('<?php echo base_url();?>Ami/add_cart_soumission',
                {
                Soumissionaires:Soumissionaires,
                
                
                },
                function(data) 
                { 
                    soumis.innerHTML = data;  
                    $('#soumis').html(data);
                    $('#Soumissionaires').val('');
                }
            ); 
        }
        }
   
</script>

    <script>
    function remove_soummission()
{

  var rowid=$('#rowida').val();
  

    $.post('<?php echo base_url();?>Ami/remove_cart_soumission',
  {
    rowid:rowid
    
    },
    function(data) 
    { 
    soumis.innerHTML = data;  
    $('#soumis').html(data);
    }); 
}
   
    </script>

    <!-- LES PIECES -->
    

<script>
    function select_piece()
        {
          var piece_exigee=$('#piece_exigee').val();
           if(piece_exigee==''){
            alert('Veuillez saisir une piece exigée');
          }else{


            $.post('<?php echo base_url();?>Ami/add_cart_piece',
                {
                piece_exigee:piece_exigee,
                
                
                },
                function(data) 
                { 
                    pieceee.innerHTML = data;  
                    $('#pieceee').html(data);
                    $('#piece_exigee').val('');
                }
            ); 
        }
        }
   
</script>

    <script>
    function remove_piece()
{

  var rowid=$('#rowidb').val();
  alert(rowid);
  

    $.post('<?php echo base_url();?>Ami/remove_cart_piece',
  {
    rowid:rowid
    
    },
    function(data) 
    { 
    pieceee.innerHTML = data;  
    $('#pieceee').html(data);
    }); 
}
   
    </script>



    <script type="text/javascript">
    $(document).ready(function(){
        $(".envoi").click(function(){
            var eq=$('#equipe').val();
            

            if(!$('#intitule_ami').val().trim()){
                    alert('L\'intitulé de l\'A.M.I est requis');
                $('#intitule_ami').focus();
                }else if(!$('#autorite_contractante').val()){
                    alert('L\'autorite contractante requise');
                $('#autorite_contractante').focus();
                }else if(!$('#redacteur').val().trim()){
                    alert('Le Redacteur est requis');
                $('#redacteur').focus();
                }else if(!$('#date_reception').val().trim()){
                    alert('La date de reception est requis');
                $('#date_reception').focus();
                }else if(!$('#etat_depot').val().trim()){
                    alert('L\'etat du depot est requis');
                $('#etat_depot').focus();
                }else if(!$('#date_limite').val().trim()){
                    alert('La date limite  est requise');
                $('#date_limite').focus();
                }else if(eq==''){
                    alert('L\'equipe est requise');
                $('#equipe').focus();
                }else{
                    document.getElementById("regiration_form").submit();
                }
        });
    });
</script>