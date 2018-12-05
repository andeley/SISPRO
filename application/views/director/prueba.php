<!DOCTYPE html>
<html lang="es">
<!--Vista realización de la prueba-->

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

      <title>SISPRO - Docente</title>

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
              <a class="nav-link js-scroll-trigger" href="<?=base_url();?>director/Areas">Areas</a>
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

<div id="page_content">

    
      
<div class="container-fluid">
  <center>
    <div id="indice_pag">          
        <p>Programa de <?php echo $programa; ?></p>
    </div> 
    <div id="indice_pag">          
        <p><b>Muestra de la prueba: </b><?php echo $simulacro -> nombre; ?> </p>
    </div> 
  </center>
       
    
    <div id="cotenido_pag">          
      <!-------------Componente Areas Preguntas------------------->

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

      <div class="container">
      <?php foreach ($opciones [$p -> id_pregunta] as $opcion): ?>
    
      <?php if($opcion -> correcta =="no"){ ?> 
      <p style="color: #6E6E6E;" class="form-check-label" for="exampleCheck1">
        <b><?php echo(chr($i++)).". "; ?></b>
        <?php echo $opcion -> descripcion; ?>
      </p>
  <?php }else{ ?>
      <p style="color: #900C3F; background-color: #FFB3B4;" class="form-check-label" for="exampleCheck1">
        <b><?php echo(chr($i++)).". "; ?></b>
        <?php echo $opcion -> descripcion; ?>
      </p>
  <?php } ?>
  
  <?php endforeach; ?><!--for opc rta-->
                </div>
                </div>
              <?php endif; ?><!--fin if existencia opc-->
                
            </div>
            <?php endif; ?><!--fin if existencia pregunta-->

             <?php endforeach; ?><!--for recorrer preguntas de seleccion Múltiple-->
            
            </div>
            <?php endif; ?><!--if existencia de preguntas en el area-->
            
          
        </div>
        </div>
      </div>
      <?php  endforeach; ?>
        <?php endif; ?>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
   

<!--Guardar Automáticamebte la respuesta-->
<script type="text/javascript">
  //llenar porcentaje
  var porc = "<?php echo $porcentaje ?>";
  var respuestas_id = ["."]; //error aca
  var p_totales = "<?php echo $num_preguntas; ?>";
  var p_respondidas = "<?php if($preguntas_respondidas) echo count($preguntas_respondidas); else echo 0; ?>";
$(document).ready( function() {
$('input[type=radio]').change(function(e) {
  var ruta = "<?php echo base_url(); ?>estudiante/Simulacros/anadir_rta/"+$(this).val()  ;
  var nam = $(this).attr("name");
  var respondidas = "<?php if($preguntas_respondidas) foreach($preguntas_respondidas as $pp) echo $pp-> id_pregunta."-"; else echo ".";?>";
                $.ajax({
                    url:  ruta,
                    type:"POST",
                    data: $(this).serialize(),
                    success:function(resp){
                    var ya_m = respondidas.indexOf(nam);
                    if(respuestas_id.indexOf(nam) == -1 && ya_m == -1 ){
                        p_respondidas++;
                        respuestas_id.push(nam);
                       
                        ya_m+="nam"+"-";
                    }
                    var t = ((p_respondidas*100)/p_totales);
                        document.getElementById("pro").style.width = t+"%";
                        document.getElementById("pro").innerHTML  = parseInt(t)+"%";
                   
                   toastr.success('Respuesta Guardada'+resp);
                   if(parseInt(t)==100){
                      document.getElementById("envio_info").disabled  = false;
                   }
            }
        });
                e.preventDefault();
            });
        });
        //opciones notoficacion rtas
       toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-left",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "400",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
          }
</script>

<style type="text/css">
    #toast-container > .toast-success {
    background-image: none;
    background-color: #900C3F;
    color: #FFFFFF;
}
</style>
   
  </body>

</html>