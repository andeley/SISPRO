<!DOCTYPE html>
<html lang="es">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

      <title>SISPRO - Director</title>

    <!-- Bootstrap core-->
    <link href="<?php echo base_url(); ?>assets/template/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/template/css/dir_pre_style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/template/css/menu.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
   <!-------editor de texto------->
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/template/js/jquery-1.12.0.js"></script>
   <script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/template/css/editor.css">
    <link href="https://ww2.ufps.edu.co/assets/img/ico/favicon.ico" rel="Shortcut icon">
    <!--Notificaciones-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    
  </head>

  <body>


    
            
               <nav class="navbar navbar-default navbar-static-top " role="navigation" role="navigation" style="background-color: #C10303">
                <!-- Sidebar toggle button-->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        

                        <li>
                            <!--class="treeview"-->
                            <a href="<?php echo base_url();?>docente/Preguntas">
                            <i class="fa fa-question-circle"></i> <span>Preguntas</span>
                            <!--span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span-->
                        </a>
                            <!--ul class="treeview-menu">
                            <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Categorias</a></li>
                            <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Clientes</a></li>
                            <li><a href="../../index2.html"><i class="fa fa-circle-o"></i> Productos</a></li>
                        </ul-->
                        </li>

                        <li>
                            <a href="<?php echo base_url();?>docente/Areas">
                            <i class="fa fa-sitemap"></i> <span>Areas</span>
                        </a>
                        </li>

                        <li>
                            <a href="#">
                            <i class="fa fa-sticky-note-o"></i> <span>Simulacros</span>
                        </a>
                        </li>
                        
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo base_url()?>assets/template/dist/img/usuario.png" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?php echo $this->session->userdata("nombre")?></span>
                            </a>
                

                            <ul class="dropdown-menu">
                                  <li>
                            <a href="<?php echo base_url()?>/docente/Perfil" style="text-align: center;">
                            <i class="fa fa-home"></i> <span>Perfil</span>
                        </a>
                        </li>
                                <li class="user-body">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <a href="<?php echo base_url();?>AutenticarLogin/logout"> <i class="fa fa-power-off"></i><span> Cerrar Sesión</span></a>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </li>
                            </ul>
                        </li>
                    </ul>

                </div>
            </nav>
        </header>