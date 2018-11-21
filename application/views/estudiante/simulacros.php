
<div id="page_content">

<div class="container-fluid">
    <div id="indice_pag">
        <p>Estudiante > <a href="<?=base_url();?>estudiante/Simulacros">Simulacros</a></p>
    </div>

    <div id="cotenido_pag">

      <div id="clock"></div>

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

      <?php } else {?>
        <center><p>No debo mostrar nada xd</p></center>
      <?php }?>
    </div>
</div>

</div>

   <!-------------------------------------->
    <footer class="small text-center text-white-50">
      <div class="container">
        Copyright &copy; Ingeniería de Software
      </div>
    </footer>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

    <!-- Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>assets/template/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for this template -->
    <script src="<?php echo base_url(); ?>assets/template/js/grayscale.min.js"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

   <!--Agregar Cronómetro-->

   <script type="text/javascript">
     $('table').dataTable({
                "dom": '<"top">rt<"bottom"p><"clear">',
                responsive: true
            });
   </script>
   <script src="<?php echo base_url(); ?>assets/template/vendor/jquery/jquery.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>