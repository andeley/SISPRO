  
<div id="page_content">

<div class="container-fluid">
    <div id="indice_pag">
        <p>Estudiante > <a href="<?=base_url();?>estudiante/Simulacros">Simulacros</a></p>
    </div>

    <div id="cotenido_pag">
      <?php if ($tipo == "General") {
    ?>


           <div class="cuadro_prin_est_simu">

           <div id="cuadro_content_est_simu">
           
            <div id="cuadro_uno_est_simu">
                <p>Opciones Simulacros</p>
            </div>

            <div id="cuadro_dos_est_simu">
                 <form>
                    <a href="<?=base_url();?>estudiante/Simulacros/verResultados"><button type="button" class="btn ">Ver mi Desempeño</button></a>
                 </form>
            </div>
            </div>


        </div>
      <!--verificar pruebas en vivo-->
      <?php if ($simulacros_estudiante != false) {

        ?>
         <div id="indice_pag">
          <center><p>Simulacros en Vivo del estudiante</p></center>
        </div>

        <div class="table_">
  <table class="table table-hover">
  <thead>
    <tr id="tit_table">
      <th scope="col">Id</th>
      <th scope="col">Nombre</th>
      <th scope="col">Tiempo Para Finalizar</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>

    <?php
$i = 0;
        for (; $i < count($simulacros_estudiante); $i++) {?>
        <tr>
            <th scope="row"><?=$simulacros_estudiante[$i]->id;?></th>
            <td><?=$simulacros_estudiante[$i]->nombreS;?></td>
            <td id="diferencia" align="center">
              <script type="text/javascript">

                      //cargar tiempo que falta para que finalice el simulacro
                       window.onload = function(e){

                      var fin = "<?php echo $simulacros_estudiante[$i]->fecha_fin; ?>";
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

            </td>
            

            <td><center><a href="<?=base_url();?>estudiante/Simulacros/realizarSimulacro/<?=$simulacros_estudiante[$i]->id;?>"><button type="button" <?php if(count($calificaciones)>0  && array_search($simulacros_estudiante[$i]->id, array_column($calificaciones, 'id_simulacro'))>-1){ ?> disabled <?php } ?> class="btn btn-danger btn-sm">Realizar Simulacro</button></a></center></td>
        </tr>
    <?php }?>
  </tbody>
</table>
</div>
<br>
      <?php }?>
        <div id="indice_pag">
          <center><p>Simulacros de <?=$programa;?></p></center>
        </div>
<?php if ($simulacros != false) {
        ?>
         <div class="table_">
               <table class="table table-hover">
  <thead>
    <tr id="tit_table">
      <th scope="col">Id</th>
      <th scope="col">Nombre</th>
      <th scope="col">Estado</th>
      <th scope="col">Fecha Realización</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
<?php $cont = -1;?>
    <?php foreach ($simulacros as $s) { $cont++;?>

    <tr>
      <th scope="row"><?=$s->id;?></th>
      <td><?=$s->nombreS;?></td>
      <td><center>
        <?php
            date_default_timezone_set('America/Bogota');
            if (strtotime($s->fecha_inicio) > strtotime(date("d-m-Y H:i:00", time()))) {
                echo "Sin Iniciar";
            } else if (strtotime($s->fecha_fin) < strtotime(date("d-m-Y H:i:00", time()))) {
                echo "Finalizado";
            } else {
                echo "Ejecutando";
            }

            ?>
      </center></td>
      <td><center><?=date("d/m/Y", strtotime($s->fecha_inicio));?></center></td>
      <td> <button type="button" data-target="#myModal<?=$s->id;?>" data-toggle="modal" class="btn btn-danger btn-sm">Ver Detalle</button></td>
    </tr>

    <!--Modal Detalle del Simulacro-->

    <div id="myModal<?=$s->id;?>" class="modal fade " role="dialog">
          <div class="modal-dialog modal-lg ">

       



        <!-- Modal content-->
    <div class="modal-content modal_per ">
     <div class="ver_datos_est">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="modal-header">

        <div id="ver_datos_est_titu_modal">
                <h3>Detalle Simulacro</h3>
        </div>
      </div>


       <div class="modal-body">
        <div id="ver_datos_est_content">
         
            <p><b>nombre: </b><?=$s-> nombreS;?> </p>
            <p><b>Descripción: </b><?=$s-> descripcion;?> </p>
            <p><b>Director A cargo: </b><?=$s-> nombreDir;?></p>
            <p><b>Fecha del Simulacro: </b>Fecha del Simulacro: <?php echo date("d/m/Y", strtotime($s->fecha_inicio)); ?></p>
            <p><b>Horario: </b>de <?php echo date("g:i:s A", strtotime($s->fecha_inicio)); ?> a <?php echo date("g:i:s  A", strtotime($s->fecha_fin)); ?></p>
            <?php if($areas_simulacros[$cont] ){ ?>
                  <p><b>Areas a evaluar:</b>
                  <?php foreach ($areas_simulacros[$cont] as $a_s) { ?>
                    <?php echo $a_s -> nombre.", " ; ?>
                  <?php } ?></p>
            <?php } ?>
      </div>
      </div>
      <div class="modal-footer">  
        <a href="<?=base_url();?>estudiante/Simulacros/Registrarse/<?=$s->id;?>"><button type="button" class="btn btn-danger" <?php if($simulacros_estudiante && array_search($s -> id, array_column($simulacros_estudiante, 'id'))>-1){ ?> disabled <?php } ?>>
           Registrarse
    </button></a>
    
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
              </div>
  </div>
</div>
        <!--Fin de la ventana Modal-->







    <?php }?>
  </tbody>
</table>
</div>

<?php } else {?> <center><p>No existen Simulacros Registrados.</p></center><?php }?>
    <?php }else if($tipo == "ver desempeño"){?>
<?php if(count($calificaciones)<1){ ?>
  <div id="indice_pag">
        <center><p>No has realizado Simulacros.</p></center>
    </div>
<?php }else{ ?>
<div id="indice_pag">
        <center><p>Desempeño del Estudiante <?php echo $this->session->userdata("nombre"); ?></p></center>
    </div>

    <div class="table_">
               <table class="table table-hover">
  <thead>
    <tr id="tit_table">
      <th scope="col">Id</th>
      <th scope="col">Nombre Simulacro</th>
      <th scope="col">Fecha Realización</th>
      <th scope="col">Calificación</th>
      <th scope="col">Ver más</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($simulacros_estudiante as $se) {?>
    <tr>
      <th scope="row"><?php echo $se -> id; ?></th>
      <td><?php echo $se -> nombreS; ?></td>
      <td><center><?=date("d/m/Y", strtotime($se->fecha_inicio));?></center></td>
      <?php $nota = 0.0; $areas=0;
       $calificaciones2=array();
          foreach ($calificaciones as $c) {
           if($c-> id_simulacro == $se-> id){
            $areas++;
            $nota+= $c-> puntaje;
            array_push($calificaciones2, $c);
           }
          }

          $p = $nota / $areas;
         ?>
      <td <?php if($p>=3 && $p< 4){ ?> style="background-color:#FBE637;" <?php }else if($p<3){ ?> style="background-color:#C70039; color: #FFFFFF;" <?php }else{ ?> style="background-color:#52FB37;"<?php } ?>><center><b>
        <?php echo(round($p,2)); ?>
      </b></center></td>
      <td>
      <center>
        <button type="button" data-target="#myModal<?=$se-> id;?>" data-toggle="modal" class="btn btn-danger btn-sm"><span class="fa fa-search"></span>
        </button> 
      </center>
    </td>
    </tr>
    <!--Modal detalle de los resultados-->
     <div id="myModal<?=$se->id;?>" class="modal fade " role="dialog">
        <div class="modal-dialog modal-lg ">

      <!-- Modal content-->
  <div class="modal-content modal_per ">
   <div class="reg_sim">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
      <div class="modal-header">

      <div id="reg_sim_titu_modal">
              <h3>Detalle de Resultado</h3>
      </div>
    </div>
     <div class="modal-body">
     <div id="reg_sim_content">
          


<div class="container">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
      <canvas id="myChart"></canvas>
    </div>
    <div class="col-md-2"></div>
  </div>
</div>

<script>
  var vector = <?php echo(json_encode(array_column($calificaciones2, 'id_area'))); ?>;
  
  var calificaciones = <?php echo(json_encode(array_column($calificaciones2, 'puntaje'))); ?>;

var ctx = document.getElementById("myChart").getContext('2d');
ctx.canvas.width = 50;
ctx.canvas.height = 50;
/*
'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'

,
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
                */
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: vector,
        datasets: [{
            labels: 'Calificación',
            data: calificaciones,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {

        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>





    </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
            </div>
</div>
</div>
    <?php } ?>
  </tbody>
</table>
</div>

<?php } ?>
    <?php } ?>
    </div>
</div>

</div>

    <footer class="small text-center text-white-50">
      <div class="container">
        Copyright &copy; Ingeniería de Software
      </div>
    </footer>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
   <script type="text/javascript">
     $('table').dataTable({
                "dom": '<"top">rt<"bottom"p><"clear">',
                responsive: true
            });
   </script>


   <!----------->
   <script src="<?php echo base_url(); ?>assets/template/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/template/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/template/js/grayscale.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  </body>

</html>