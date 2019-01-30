<!DOCTYPE html>
<html lang="en">

<head>
<?php include VIEWPATH.'includes/header.php' ?>
</head>

<?php
$affect1="active";
$affect2="";
 ?>
<script type="text/javascript">
           function rapport()
           {
              myform.submit();
           }
        </script>
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
                              <div class="col-lg-12 col-md-12">  
                                  <form action="<?php echo base_url('rapport/Reporting/ticket');?>" name="myform" method="post" class="col-md-12 col-sm-12 col-xs-12">
             <!--            Année      -->
              <div class="col-md-3 col-sm-3">
              <div class="form-group">
              <label>Année:</label>
              <select class=" form-control" onchange="rapport()" name="annee">
                 <option value="">-sélectionner une année-</option>
                 <?php for($i = $date_max; $i > $date_min; $i--){
                    if($annee != "" && $annee == $i){
                      echo '<option value="'.$i.'" selected>'.$i.'</option>';
                    }else{
                      echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                 } ?>
              </select>
              </div>
              </div>
              <!--            Semestre      -->
              <!--            Mois      -->
              <div class="col-md-3 col-sm-3">
              <div class="form-group">
              <label>Choisir un intervalle de mois:</label>
              <div class="input-group">
              <span class="input-group-addon" style="border:none;background-color:white">De</span>
              <select class="form-control " onchange="rapport()" name="mois">
                 <option value="">-sélectionner un mois-</option>
                 <?php
                 if($annee == date('Y')){
                    for($i = 1; $i<= date('m'); $i++){
                      if($i == 1){ $n= "Janvier"; }else if($i == 2){$n= "Février";}else if($i == 3){$n= "Mars";}else if($i == 4){$n= "Avril";}else if($i == 5){$n= "Mai";}else if($i == 6){$n= "Juin";}else if($i == 7){$n= "Juillet";}else if($i == 8){$n= "Aout";}else if($i == 9){$n= "Septembre";}else if($i == 10){$n= "Octobre";}else if($i == 11){$n= "Novembre";}else if($i == 12){$n= "Décembre";}
                        if($mois == $i){
                          echo "<option value='".$i."' selected>".$n."</option>";
                        }else{
                            echo "<option value='".$i."'>".$n."</option>";
                        }
                    }
                 }else if($annee != date('Y') && $annee != ""){
                     for($i = 1; $i<=12; $i ++){
                      if($i == 1){ $n= "Janvier"; }else if($i == 2){$n= "Février";}else if($i == 3){$n= "Mars";}else if($i == 4){$n= "Avril";}else if($i == 5){$n= "Mai";}else if($i == 6){$n= "Juin";}else if($i == 7){$n= "Juillet";}else if($i == 8){$n= "Aout";}else if($i == 9){$n= "Septembre";}else if($i == 10){$n= "Octobre";}else if($i == 11){$n= "Novembre";}else if($i == 12){$n= "Décembre";}
                       if($mois == $i){
                          echo "<option value='".$i."' selected>".$n."</option>";
                        }else{
                            echo "<option value='".$i."'>".$n."</option>";
                        }
                     }
                 }
                 ?>
              </select>
              </div>
              </div>
              </div>
              <div class="col-md-3 col-sm-3">
              <div class="form-group">
              <label style="opacity:0.0">-</label>
              <div class="input-group">
              <span class="input-group-addon" style="border:none;background-color:white">à</span>
              <select class="form-control " onchange="rapport()" name="mois2">
                 <option value="">-sélectionner un mois-</option>
                 <?php
                 if($annee == date('Y')){
                    for($i = 1; $i<= date('m'); $i++){
                      if($i == 1){ $n= "Janvier"; }else if($i == 2){$n= "Février";}else if($i == 3){$n= "Mars";}else if($i == 4){$n= "Avril";}else if($i == 5){$n= "Mai";}else if($i == 6){$n= "Juin";}else if($i == 7){$n= "Juillet";}else if($i == 8){$n= "Aout";}else if($i == 9){$n= "Septembre";}else if($i == 10){$n= "Octobre";}else if($i == 11){$n= "Novembre";}else if($i == 12){$n= "Décembre";}
                        if($mois2 == $i){
                          echo "<option value='".$i."' selected>".$n."</option>";
                        }else{
                            echo "<option value='".$i."'>".$n."</option>";
                        }
                    }
                 }else if($annee != date('Y') && $annee != ""){
                     for($i = 1; $i<=12; $i ++){
                      if($i == 1){ $n= "Janvier"; }else if($i == 2){$n= "Février";}else if($i == 3){$n= "Mars";}else if($i == 4){$n= "Avril";}else if($i == 5){$n= "Mai";}else if($i == 6){$n= "Juin";}else if($i == 7){$n= "Juillet";}else if($i == 8){$n= "Aout";}else if($i == 9){$n= "Septembre";}else if($i == 10){$n= "Octobre";}else if($i == 11){$n= "Novembre";}else if($i == 12){$n= "Décembre";}
                       if($mois2 == $i){
                          echo "<option value='".$i."' selected>".$n."</option>";
                        }else{
                            echo "<option value='".$i."'>".$n."</option>";
                        }
                     }
                 }
                 ?>
              </select>
              </div>
              </div>
              </div>
             </form>
                              </div>
                            </div>  
                        </div>
                        <div id="container" class="col-lg-12 jumbotron table-responsive" style="padding: 5px"> 
                             
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
Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Montants de tickets générés par société'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.y:,.0f} FBU</b>'
    },
    credits:{
       enabled: false
    },
    exporting:{
       enabled:false
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.y:,.0f} FBU',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: 'Montant',
        colorByPoint: true,
        data: [<?php echo $tickets; ?>]
    }]
});
</script>
