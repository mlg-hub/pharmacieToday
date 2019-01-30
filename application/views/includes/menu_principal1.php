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
                <img src="<?= base_url() ?>upload/logos_societe/<?php echo $this->session->userdata('LOGO') ?>" style="width:250px;height: 67px "/>
                
                <!-- <img src="img/expertise.jpg" style="width: 100px;height: 70px"> -->
                
            </div>
            <!-- /.navbar-header -->
            <div class="col-lg-6"><h2 style="text-align: right ">PARKING MANAGEMENT SYSTEM</h2></div>
            <div class="col-lg-3">
                
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
                   <?= $this->session->userdata('USER_EMAIL') ?> <i class="fa fa-caret-down"></i> 
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="<?=base_url()?>Change_Pwd"><i class="fa fa-gear fa-fw"></i> Settings</a>
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

                <div class="navbar-default sidebar" id="cont" role="navigation" style="background-color: #253E62;margin-top: 72px">
                <div class="sidebar-nav navbar-collapse" id="side-menu">
                    <ul class="nav">

                      

                                
                                        <li >
                                            <a href="#" id="men"><i class="fa fa-dashboard fa-fw"></i> <span>Dashboard</span><span class="fa arrow"></span></a>

                                            <!-- <ul class="nav nav-second-level">
                                                <li>

                                              <a href="<?=base_url('Reporting')?>"><i class="fa fa-bar-chart-o fa-fw"></i>Reporting</a>

                                               </li>
                                            </ul> -->

                                        </li>


                                        <li>
                                            <a href="#" id="men"><i class="fa fa-group fa-fw"></i> Administrations <span class="fa arrow"></span></a>
                                            <ul class="nav nav-second-level">
                                                
                                                 <li>
                                                    <a href="<?php echo base_url("administration/Societe/index") ?>" id="act">Sociètés </a>
                                                </li>
                                                
                                                
                                                <li>
                                                    <a href="<?php echo base_url("administration/Users/index") ?>" id="act">Utilisateurs </a>
                                                </li>

                                                 
                                                <li>
                                                    <a href="<?php echo base_url("administration/Vehicule/index") ?>" id="act"> Vehicules </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url("administration/Appareils/index") ?>" id="act"> Appareils </a>
                                                </li>
                                                
                                            </ul>
                                            <!-- /.nav-second-level -->
                                        </li>

                                         
                                        <li>
                                            <a href="#" id="men"><i class="fa fa-list fa-fw"></i> Zones <span class="fa arrow"></span></a>
                                            <ul class="nav nav-second-level" id="level2">

                                             
                                                <li>
                                                    <a href="<?=base_url()?>" id="act"> Localisations </a>
                                                </li>
                                                <li>

                                                    <a href="<?=base_url()?>" id="act"> Zones de Stationnement </a>
                                                </li>
                                                <li>

                                                    <a href="<?=base_url()?>" id="act"> Niveaux </a>
                                                </li>
                                            </ul>

                                            <!-- /.nav-second-level -->
                                        </li> 
                                
                                        
                                        <li>
                               
                                            <a href="#" id="men"><i class="fa fa-search fa-fw"></i> Payements <span class="fa arrow"></span></a>
                                            <ul class="nav nav-second-level">
                                                 
                                                 <li>
                                                    <a href="<?php echo base_url() ?>payement/Versement_Agent" id="act"> Versement des agents </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url() ?>payement/Versement_Client" id="act"> Versement des clients </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url() ?>payement/Payement_Ticket" id="act"> Payements de Tickets </a>
                                                </li>
                                            </ul>
                                            <!-- /.nav-second-level -->
                                        </li>
                                        

                                        <li>
                                            <a href="#" id="men"><i class="fa fa-wrench fa-fw"></i> Parking <span class="fa arrow"></span></a>
                                            <ul class="nav nav-second-level">
                                                <li>
                                                    <a href="<?php echo base_url() ?>" id="act"> Agents </a>
                                                </li>

                                              
                                                <li>
                                                    <a href="<?php echo base_url('parking/Sessio/add') ?>" id="act"> Sessions </a>
                                                </li>
                                                
                                                <li>

                                                <a href="<?php echo base_url('parking/Ticket/listing') ?>" id="act"> Tickets </a>
                                                </li>
                                              
                                                
                                            </ul>
                                        
                                        </li>

                                       
                                        <li>
                                            <a href="#" id="men"><i class="fa fa-cogs"></i> Comptabilité <span class="fa arrow"></span></a>
                                            <ul class="nav nav-second-level">
                                                <li>
                                                    <a href="<?=base_url() ?>" id="act"> Vehicules </a>
                                                </li>
                                                
                                                <li>
                                                    <a href="<?=base_url() ?>" id="act"> Agents </a>
                                                </li>
                                                <li>
                                                    <a href="<?=base_url() ?>" id="act"> Socièté </a>
                                                </li>

                                            </ul>
                                        
                                        </li>


                                        <li>
                                            <a href="#" id="men"><i class="fa fa-credit-card"></i> Rapports <span class="fa arrow"></span></a>
                                            <ul class="nav nav-second-level">
                                                <li>
                                                    <a href="<?=base_url('CarteDeVisite')?>" id="act"> Rapports de versements Agents</a>
                                                </li>
                                                
                                                <li>
                                                    <a href="#" id="act"> Rapports de versements Clients </a>
                                                </li>

                                            </ul>
                                        
                                        </li>
                
                      
                                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>