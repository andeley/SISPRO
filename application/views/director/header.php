<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

      <title>SISPRO - Preguntas</title>

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
    <!-----------MENU--------------->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a  class="navbar-brand js-scroll-trigger" href="#page-top">
    <img src="<?php echo base_url(); ?>assets/template/img/logo_blanco.png" alt="">        
            
            
        </a>
         <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">  
           
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#" class="dropdown-toggle" data-toggle="dropdown">Areas</a>
            </li>
            
             <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="<?=base_url();?>director/Preguntas">Preguntas</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="<?=base_url();?>director/Simulacros">Simulacros</a>
            </li>
            
            
             <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="<?=base_url();?>director/usuarios/Docentes">Docentes</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="<?=base_url();?>director/usuarios/Estudiantes">Estudiantes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="<?php echo base_url(); ?>director/Perfil">Perfil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="<?php echo base_url(); ?>AutenticarLogin/logout">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>