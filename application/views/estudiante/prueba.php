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
        <div class="row">
          <div class="col-md-3">
            <a  class="navbar-brand js-scroll-trigger" href="#page-top" style="margin-top: 15px;">
    <img src="<?php echo base_url(); ?>assets/template/img/logo_blanco.png" alt="">         
        </a>
          </div>
          <div class="col-md-2" style="text-align: center;">
            
           <div id="diferencia" class=" nav-link" >
         
             <!--js con tiempo de finalización-->
             <script type="text/javascript">

                      //cargar tiempo que falta para que finalice el simulacro
                       window.onload = function(e){

                          document.getElementById("pro").style.width = "<?php echo $porcentaje ?>"+"%";
                          

                      var fin = "<?php echo $simulacro-> fecha_fin; ?>";
                      var $clock = $('#diferencia'),
                          eventTime = moment(fin, 'YYYY-MM-DD HH:mm:ss').unix(),
                          currentTime = moment().unix(),
                          diffTime = eventTime - currentTime,
                          duration = moment.duration(diffTime * 1000, 'milliseconds'),
                          interval = 1000;

                      // if time to countdown
                      if(diffTime > 0) {

                          var $d = $('<div class="days" ></div>').appendTo($clock),
                              $h = $('<div class="hours" ></div>').appendTo($clock),
                              $m = $('<div class="minutes" ></div>').appendTo($clock),
                              $s = $('<div class="seconds" ></div>').appendTo($clock);

                          setInterval(function(){

                              duration = moment.duration(duration.asMilliseconds() - interval, 'milliseconds');
                              var d = moment.duration(duration).days(),
                                  h = moment.duration(duration).hours(),
                                  m = moment.duration(duration).minutes(),
                                  s = moment.duration(duration).seconds();

                             d = $.trim(d).length === 1 ? '0' + d : d;
                             h = $.trim(d).length === 1 ? '0' + h : h;
                             m = $.trim(m).length === 1 ? '0' + m : m;
                             s = $.trim(s).length === 1 ? '0' + s : s;

                             $d.text(h+" : "+m+" : "+s);
                          }, interval);
                      }
                  };
            </script>


           </div>
          </div>
          <div class="col-md-3">
             <center>
              <div class="progress" style="height: 13px; align-self: center; margin-top: 32px;">
              <div class="progress-bar" id="pro" role="progressbar" style="width: 0%; background-color: #7F072A;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $porcentaje; ?> %</div>
              </div>
             </center>
          </div>
          <div class="col-md-4">
          
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
      <!-------------Componente Areas Preguntas------------------->
      <form class="form-group" method="post" id="formr" action="<?php echo base_url(); ?>estudiante/Simulacros/guardar_simulacro/<?=$simulacro_id;?>?>">

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
    
    <label style="color: #6E6E6E;" class="form-check-label" for="exampleCheck1">
    <?php 
    if(!$preguntas_respondidas) $key = -1;
    else $key = array_search($opcion-> id, array_column($preguntas_respondidas, 'id_opcion')); ?>
      <input type="radio" name="check<?=$p-> id_pregunta;?>" <?php if($key>-1){ ?> checked <?php }?>   class="form-check-input" id="exampleCheck1" value="<?=$simulacro_id."/".$p->id_pregunta."/".$opcion-> id;?>" />


      <b><?php echo(chr($i++)).". "; ?></b>
      <?php echo $opcion -> descripcion; ?>
    </label><br>
  
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

         <button id="envio_info" type="submit" class="btn ">Finalizar</button>
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

                $.ajax({
                    url:  ruta,
                    type:"POST",
                    data: $(this).serialize(),
                    success:function(resp){

                     // arreglar aca
                    if(respuestas_id.indexOf(nam) == -1){
                        p_respondidas++;
                        respuestas_id.push(nam);
                        
                    }
                    var t = ((p_respondidas*100)/p_totales);
                        document.getElementById("pro").style.width = t+"%";
                        document.getElementById("pro").innerHTML  = parseInt(t)+"%";
                   
            }
        });
                e.preventDefault();
            });
        });


</script>
   
  </body>

</html>