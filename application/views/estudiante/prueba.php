<!DOCTYPE html>
<html lang="es">
<!--Vista realización de la prueba-->

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

      <title>SISPRO - Simulacros</title>

    <!-- Bootstrap core-->
    <link href="<?php echo base_url(); ?>assets/template/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/template/css/est_pru_style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/template/css/menu.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment-with-locales.min.js"></script>
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
              <a class="nav-link js-scroll-trigger" href="<?=base_url();?>estudiante/Preguntas">Preguntas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="<?=base_url();?>estudiante/Simulacros">Simulacros</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="<?php echo base_url(); ?>estudiante/Perfil">Perfil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="<?php echo base_url(); ?>AutenticarLogin/logout">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

<div id="page_content">
      
<div class="container-fluid">
   <div id="titulo_programa">          
        <p>Programa de <?php echo $programa; ?></p>
    </div> 
    <div id="indice_pag">          
        <p><?php echo $simulacro -> nombre; ?> </p>
    </div>     
    
    <div id="cotenido_pag">          
      <!-------------CUADRO------------------->
      <form>
        <?php if($areas_simulacro): ?>
          
          <?php foreach ($areas_simulacro as $as):?>




          <!--------------------Mostrar en un for las preguntas del area de conocimiento----------------------->
                 <div class="cuadro_prin">
                  
                  
           <div id="cuadro_content">
                <div class="pregunta_prueba">
               <div id="cuadro_uno">
                <p><?php echo $as -> nombre; ?></p>
            </div>
            




              
              <?php $preguntas = $preguntas_area[$as -> id]; ?>
              <?php if($preguntas): ?>
                <div id="cuadro_dos">
                <!--mostrar preguntas de seleccion Múltiple-->
                <br>
                <p class="tipo_preg"><b><center>Pregunta(s) de Selección Múltiple con única respuesta</center></b></p>
                <?php $n_pregunta = 0; ?>
                <?php foreach ($preguntas as $p): ?>
                <!-----------Preguntas del Area--------------->

                <div class="pru_preg">
                       <?php if($p -> tipo == "sm"):?>
                     <p class="enun_preg">
                        <b>Lea el siguiente enunciado.</b> <br>
                       <?php echo ($p-> enunciado); ?>
                       <?php echo ("<b>".++$n_pregunta.". </b>".$p-> descripcion); ?>
                     </p>
                
                <!--Opciones de respuesta-->
                <?php if($opciones [$p -> id_pregunta]): ?>
                  <br>
                <div class="pru_res">
      <?php $i = 97; //a ?>
      <div class="form-grou">
      <?php foreach ($opciones [$p -> id_pregunta] as $opcion): ?>
  
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label style="color: #6E6E6E;" class="form-check-label" for="exampleCheck1">
      <?php echo $opcion -> descripcion; ?>
    </label><br>
  
  <?php endforeach; ?><!--for opc rta-->

                    
                </div>
                </div>
              <?php endif; ?><!--fin if existencia opc-->
                
            </div>
            <?php endif; ?><!--fin if existencia pregunta-->

             <?php endforeach; ?><!--for recorrer preguntas-->
            
            </div>
            <?php endif; ?><!--if existencia de preguntas en el area-->
            
          
        </div>
        </div>
      </div>
      <?php  endforeach; ?>
        <?php endif; ?>
        

        
         <button id="envio_info" type="submit" class="btn ">Enviar</button>
    </form> 

    </div> 
              
</div>
    
</div>
   
   <!-------------------------------------->
    <footer class="small text-center text-white-50">
      <div class="container">
        Copyright &copy; Ingenieria de software
      </div>
    </footer>
    
   <!-- Bootstrap core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/template/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  
    <!-- Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>assets/template/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="<?php echo base_url(); ?>assets/template/js/grayscale.min.js"></script>
   
   
   
  </body>

</html>