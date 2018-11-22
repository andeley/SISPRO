
<div id="page_content">

<div class="container-fluid">
    <div id="indice_pag">
        <p>Estudiante > <a href="<?=base_url();?>estudiante/Simulacros">Simulacros</a></p>
    </div>

    <div id="cotenido_pag">
      <?php if ($tipo == "General") {
    ?>
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
            <td><center><button type="button" class="btn btn-danger btn-sm">Realizar Simulacro</button></center></td>
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
     <div class="reg_sim">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="modal-header">

        <div id="reg_sim_titu_modal">
                <h3>Detalle del Simulacro</h3>
        </div>
      </div>
       <div class="modal-body">
       <div id="reg_sim_content">
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
        <a href="<?=base_url();?>estudiante/Simulacros/Registarse/<?=$s->id;?>"><button type="button" class="btn btn-danger">Registrarse</button></a>
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
    <?php }?>
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
   <script src="<?php echo base_url(); ?>assets/template/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/template/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/template/js/grayscale.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  </body>

</html>