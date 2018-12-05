<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SISPRO UFPS</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/template/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="<?php echo base_url(); ?>assets/template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/template/css/grayscale.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/template/css/simple-sidebar.css" rel="stylesheet">
    <link href="https://ww2.ufps.edu.co/assets/img/ico/favicon.ico" rel="Shortcut icon">
  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a  class="navbar-brand js-scroll-trigger" href="#page-top">SISPRO UFPS</a>
         <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#inicio">Inicio</a>
            </li>

            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#noticias">Noticias</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#signup">Unirme</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <section id="inicio">
     <header class="masthead">
      <div class="container d-flex h-100 align-items-center">
        <div id="mast">
           <div id="mast_cont">
            <div id="mast_img">
                <img src="<?php echo base_url(); ?>assets/template/img/lg_sispro.png" alt="">
            </div>
            <div id="mast_form"> <!--Form login-->

              <?php if ($this->session->flashdata("error")): ?>
                    <!--si hay un mensaje de usuario y contraseña incorr-->
                    <div id="mensaje">
                        <p>
                            <?php echo ($this->session->flashdata("error")); ?>
                        </p>
                    </div>
                    <?php endif;?>

                <form id="login" action="<?php echo base_url(); ?>AutenticarLogin/login" method="post">
  <div class="form-group">
    <label for="codigoform">Codigo</label>
    <input type="text" class="form-control" id="codigoform" name="codigo" required>
  </div>

  <div class="form-group">
    <label for="claveform">Password</label>
    <input type="password" class="form-control" id="claveform" name="contraseña" required>
  </div>

  <button type="submit" class="btn btn-danger">Iniciar</button>
  <div class="small text-black-50 text-center "> <a id="link_contra" href="">¿Olvidaste tu contraseña?</a></div>
</form>
            </div>
        </div>
        </div>
      </div>
    </header>
    </section>

   <!--NOTICIAS-->
   <section id="noticias" class="info-section">
      <div class="container">
        <div class="row">

           <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center">
                <i class="fas fa-spa text-primary mb-2" style="color: #FC0758!important"></i>
                <h4 class="text-uppercase m-0">Simulacro Prueba Saber Pro 2016 - 02</h4>
                <h4 class="text-uppercase m-0">05/12/2018</h4>
                <hr class="my-4">
                <div class="small text-black-50 ">Hora comienzo: 8:00am
                <br>Hora finalización: 12:00pm<br>
              </div>
            </div>
          </div>


</div>
      </div>
    </section>


    <!-- Signup Section -->
    <section id="signup" class="signup-section">
      <div class="container">


        <div id="reg">
              <h1>Unete y prueba tus habiliades academicas</h1>
               <p>Por favor, introduce tus datos de registro</p>
               <div id="reg_form">


        <form id="registro" action="<?php echo base_url(); ?>AutenticarLogin/registro" method="post">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="nombrereg">Nombre</label>
      <input type="text" class="form-control" id="nombrereg" name="nombreR" required>
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">Programa academico</label>
      <select id="inputState" class="form-control" name="programaR">
        <option style="color:#B0AEAE;" selected disabled>Programa Académico</option>
         <?php if ($programas != false): ?>
                <?php foreach ($programas->result() as $programa): ?>
                    <option><?=$programa-> nombre;?></option>
                <?php endforeach;?>
         <?php endif;?>
      </select>
    </div>
  </div>

  <div class="form-row">

   <div class="form-group col-md-6">
      <label for="codigoreg">Codigo</label>
      <input type="text" class="form-control" id="codigoreg" name="codigoR" required>
    </div>
  </div>


   <div class="form-row">
    <div class="form-group col-md-6">
      <label for="emailreg">Email</label>
      <input type="email" class="form-control" id="emailreg" name="correoR" required>
    </div>

  </div>


  <div>
      <div id="bt_circle"class="form-group has-feedback radio-green" >

       <input  type="radio" value="docente" onclick="deshabilitaropc();" name="tipo_usuario" checked="checked" style="margin-right:15px;">Docente

       <input  type="radio" onclick="habilitaropc();" value="estudiante" name="tipo_usuario" style="margin-right:15px; margin-left:20px; "> Estudiante

  </div>

  <div class="form-group has-feedback " id="nperiodos" style="display: none;">
    <input type="text" class="form-control" placeholder="Semestre" name="semestreR"> <span class="glyphicon glyphicon-envelope form-control-feedback"></span> </div>
                            <div class="form-group has-feedback">
                                <input type="password" class="form-control" style="border-radius: 3px;" placeholder="Contraseña" name="contraseñaR" required> <span class="glyphicon glyphicon-lock form-control-feedback"></span> </div>
  </div>

  <button type="submit" class="btn btn-primary">Unirme</button>
</form>


        </div>
        </div>
      </div>
    </section>

    <!-- Contact Section -->


    <!-- Footer -->
    <footer class="small text-center text-white-50">
      <div class="container">
        Copyright &copy; Ingenieria de software
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/template/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        function deshabilitaropc() {
            document.getElementById('nperiodos').style.display = "none";
        }

        function habilitaropc() {
            document.getElementById('nperiodos').style.display = "block";
        }

    </script>
    <!-- Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>assets/template/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="<?php echo base_url(); ?>assets/template/js/grayscale.min.js"></script>

  </body>

</html>
