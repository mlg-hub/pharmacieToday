                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 <?php
    //echo '1'.$this->session->userdata('LOGO');
 ?>
<style type="text/css">
    .jumbotron, #conta{
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    background-color: white;
    }
  }
    #cont, #wrapper, #navp{
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    }
     
    #cont:hover {
        box-shadow: 0 8px 16px 0 #063361;
    }
    #wrapper:hover {
        box-shadow: 0 8px 16px 0 #063361;
    }
    #side-menu li a{
        color:white;
    }
    #side-menu li a:hover{
        color:#253E62;


    }
    
    #side-menu li a.active{
        color:#253E62;

        
    }
    #tete li a {
        color: black;
        font-weight: bold;
    }
    #tete li a:hover {
        color: #253E62;
    }
    #act{
        border:1px solid #253E62;
    }

    #men:focus{
        color: #253E62;
    }



    

    
</style>


            <div class="col-lg-3" style="margin-left: -14px">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- <img src="<?= base_url() ?>upload/logos_societe/" style="width:250px;height: 67px "/> -->
                
                <img src="<?php echo base_url() ?>upload/banderole/petit.jpg" style="width:250px;height: 70px">
                
            </div>
            <!-- /.navbar-header -->
            <div class="col-lg-3"><h2 style="text-align: left">Procurement Process</h2></div>
            <div class="col-lg-6">
                
                <ul class="nav navbar-top-links navbar-right" id="tete" style="padding:8px">    
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a  href="<?=$this->session->userdata('URL_REPORTING')?>">
                        <i class="fa fa-bar-chart-o fa-fw"></i> Reporting
                    </a>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                   <?= $this->session->userdata('EMAIL') ?> <i class="fa fa-caret-down"></i> 
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="<?=base_url()?>administration/User_setting"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?=base_url()?>Login/do_logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
                </ul>
            </div>

                <div class="navbar-default sidebar" id="cont" role="navigation" style="background-color: #579353;margin-top: 72px">
                <div class="sidebar-nav navbar-collapse" id="side-menu">
                    <ul class="nav">

                      

                                
                                        <li >
                                            <a href="<?=base_url('rapport/Dashboard')?>" id="men"><i class="fa fa-dashboard fa-fw"></i> <span>Dashboard</span><span class="fa arrow"></span></a>

                                             <ul class="nav nav-second-level" id="level2">
                                                <li>
                                                     <a href="<?=base_url('rapport/Dashboard')?>" id="men">Reception vs output</a>
                                                </li>
                                                <li>
                                                     <a href="<?=base_url('rapport/Request')?>" id="men">Requests</a>
                                                </li>
                                             </ul>
                                            <!-- <ul class="nav nav-second-level">
                                                <li>

                                              <a href="<?=base_url('Reporting')?>"><i class="fa fa-bar-chart-o fa-fw"></i>Reporting</a>

                                               </li>
                                            </ul> -->

                                        </li>
                                       




                           <li>

                         <a href="<?=base_url('stock/Type_Medicament/index')?>" id="men"><i class="fa fa-table fa-fw"></i> <span>Gestion Stock</span><span class="fa arrow"></span></a>

                                             <ul class="nav nav-second-level" id="level2">
                                                <li>
                                                     <a href="<?=base_url('stock/Medicament/listing')?>" id="men">Medicament</a>
                                                </li>
                                                <li>
                                                     <a href="<?=base_url('stock/Type_Medicament/listing')?>" id="men">Type de Medicament</a>
                                                </li>
                                                <li>
                                                     <a href="<?=base_url('stock/Gestion_Stock/')?>" id="men">Stock</a>
                                                </li>
                                             </ul>
                           </li>
                
                  

                   


                                       
                                        <li>
                                            <a href="<?=base_url('demande/Demande/index')?>" id="men"><i class="fa fa-table fa-fw"></i> <span>Request</span><span class="fa arrow"></span></a>
                                        </li>

                                        

                                        <li>
                                            <a href="#" id="men"><i class="fa fa-list fa-fw"></i> Treatment Request <span class="fa arrow"></span></a>
                                            <ul class="nav nav-second-level" id="level2">

<!-- 
                                                <!--  <li>
                                                    <a href="<?=base_url('traitement_demande/Traitement_Demande')?>" id="act"> Treatment </a>
                                                </li> --> 


                                                 <li>
                                                    <a href="<?=base_url('traitement_demande/Traitement_Demande')?>" id="act"> Treatment </a>
                                                </li>


                <?php if($this->session->userdata('CASEHOSP_STOCK')==1){ ?>

                                                 <li>
                                                    <a href="<?=base_url('demande/Order')?>" id="act"> Order </a>
                                                </li>
                                            <?php

                                            }
                                            ?>


                  <?php if($this->session->userdata('CASEHOSP_COMPTABILITE')==1){ ?>


                                                <li>
                                                    <a href="<?=base_url('comptabilite/Soumission')?>" id="act"> Submission </a>
                                                </li>

                                                <li>
                                                    <a href="<?=base_url('demande/Commande')?>" id="act"> Command </a>
                                                </li>

                                        <?php  }

                                            ?>

                                             
                                                
            <?php if($this->session->userdata('CASEHOSP_STOCK')==1){ ?>

                                                 
                                                <li>
                                                    <a href="<?=base_url('approvisionnement/Procurement')?>" id="act"> Reception</a>
                                                </li>

                                      <?php
                                            } ?>

                                                


             <?php if($this->session->userdata('CASEHOSP_COMPTABILITE')==1) { ?>

                                                <li>
                                                    <a href="<?=base_url('demande/Delivered')?>" id="act">Payment</a>
                                                </li>

                                     <?php
                                            } ?>
                                              <li>
                                                    <a href="<?=base_url('approvisionnement/Sortie')?>" id="act"> Output</a>
                                                </li> 
                                                
                                                
                                                
                                            </ul>

                                            <!-- /.nav-second-level -->
                                        </li>

                                    <!--     <li>
                                            <a href="<?=base_url('approvisionnement/Procurement')?>" id="men"><i class="fa fa-list fa-fw"></i> procurement <span class="fa arrow"></span></a>
                                            <ul class="nav nav-second-level" id="level2">

                                             
                                                
                                                
                                            </ul>

                                            <!-- /.nav-second-level 
                                        </li> -->


                                <?php if($this->session->userdata('CASEHOSP_CONFIGURATION')==1) { ?>

                                        <li>
                                            <a href="#" id="men"><i class="fa fa-list fa-fw"></i> Administration <span class="fa arrow"></span></a>
                                            <ul class="nav nav-second-level" id="level2">

                                             
                                                <li>
                                                    <a href="<?=base_url('administration/Users/listing')?>" id="act">  Users</a>
                                                </li>
                                                 <li>
                                                    <a href="<?=base_url('administration/Users_Profil')?>" id="act">  Profiles</a>
                                                </li>
                                                
                                                
                                            </ul>

                                            <!-- /.nav-second-level -->
                                        </li>

                                 <?php
                                            } ?>


                                     
                
                      
                                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>