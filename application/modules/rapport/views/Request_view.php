
<!DOCTYPE html>
<html lang="en">

<?php
  include VIEWPATH."includes/header.php";
?>
<script>
 function get_date(val){
  var v= $(val).val();
     myform.action += v;
     myform.submit();
 }

</script>
<body>
    <div class="container-fluid" style="background-color: white">
        <div id="wrapper">
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 5px" id="navp">
                
                <?php  include VIEWPATH.'includes/menu_principal.php' ?>
                
            </nav>

            <!-- Page Content -->
            <?php 
            $diligence1 ='';
            $diligence2 ='';
            ?>
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                       <div class="col-lg-12" style=" margin-bottom: 5px">
                             <div class="row" style="" id="conta">
                                
                             </div>
                            <div class="row" id="conta" style="margin-top: -10px">

                                 <div class="col-lg-9 col-md-9">                                  
                                   <h4 class=""><b>Reporting</b></h4> 
                                   
                                </div>
                                
                            </div>  
                        </div>
                         
                     <div class="col-lg-12 jumbotron">
                     <div class="col-md-4">
                     <form action="<?php echo base_url() ?>rapport/Dashboard/change/" method="post" name="myform">
                     <select type="text" class=" form-control" onchange="get_date(this)">
                          <option>-- sélectionner une année --</option>
                          <option value="<?php echo date('Y')?>" <?php if($annee == date('Y')){ echo "selected";}?>><?php echo date('Y')?></option>
                          <option value="<?php echo date('Y') - 1?>" <?php if($annee == date('Y') - 1){ echo "selected";}?>><?php echo date('Y') - 1?></option>
                          <option value="<?php echo date('Y') - 2?>" <?php if($annee == date('Y') - 2){ echo "selected";}?>><?php echo date('Y') - 2?></option>
                     </select>
                     </form>
                     </div>
                       <div class="col-md-12 table-responsive" id="container">   
                           <!--     -->
                      </div>
                    </div>
                    </div>

                </div>
            </div>
            </div>
    </body>
    
    <script>
   
   Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: '<?php echo $titre; ?>'
    },
    subtitle: {
        text: '<?php echo $annee; ?>'
    },
    credits:{
              enabled: false
            },
    xAxis: {
        categories: [
            <?php echo $categorie; ?>
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: ' '
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:1f} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Request(s) undelivered',
        data: [<?php echo $entree; ?>]

    }, {
        name: 'Request(s) delivered',
        data: [<?php echo $sortie; ?>]

    }]
});
    </script>
</html>
