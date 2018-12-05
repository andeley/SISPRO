<div id="page_content">

      <div class="container-fluid">
          <div id="indice_pag">
              <p>Director ><a href="<?=base_url();?>director/Simulacros">Simulacros</a></p>
          </div>
          <div id="cotenido_pag">

          <?php if ($est == "viewall") {
  ?>

         

              <div id="indice_pag">
                  <center><p>Vista General de Simulacros</p></center>
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
    <th scope="col" >Opciones</th>
  </tr>
</thead>
<tbody>
<?php $cont = -1;?>
  <?php foreach ($simulacros as $s) {
          $cont++;?>

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
    <td>
      <center>
          <button type="button" data-target="#myModal<?=$s->id;?>" data-toggle="modal" class="btn btn-danger btn-sm"><span class="fa fa-search"></span>
          </button>  
      </center>

    </td>
  </tr>

  <!--Modal Detalle del Simulacro-->

  <div id="myModal<?=$s->id;?>" class="modal fade " role="dialog">
        <div class="modal-dialog modal-lg ">


      <!-- Modal content-->
  <div class="modal-content modal_per ">
   <div class="ver_datos_simul">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
      <div class="modal-header">

      <div id="ver_datos_simul_titu_modal">
              <h3>Detalle del Simulacro</h3>
      </div>
    </div>
     <div class="modal-body">
     <div id="ver_datos_simul_content">
          <p><b>nombre: </b><?=$s->nombreS;?> </p>
          <p><b>Descripción: </b><?=$s->descripcion;?> </p>
          <p><b>Director A cargo: </b><?=$s->nombreDir;?></p>
          <p><b>Fecha del Simulacro: </b>Fecha del Simulacro: <?php echo date("d/m/Y", strtotime($s->fecha_inicio)); ?></p>
          <p><b>Horario: </b>de <?php echo date("g:i:s A", strtotime($s->fecha_inicio)); ?> a <?php echo date("g:i:s  A", strtotime($s->fecha_fin)); ?></p>
          <?php if ($areas_simulacros[$cont]) {?>
                <p><b>Areas a evaluar:</b>
                <?php foreach ($areas_simulacros[$cont] as $a_s) {?>
                  <?php echo $a_s->nombre . ", "; ?>
                <?php }?></p>
          <?php }?>
    </div>
    </div>
    <div class="modal-footer">
      <a href="<?=base_url();?>docente/Simulacros/verPreguntas/<?=$s->id;?>"><button type="button" class="btn btn-danger">Ver Preguntas</button></a>
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



      <?php
} ?>


          </div>
      </div>
  </div>

</div>


  <!--Modal crear Simulacro-->

  <div id="myModal" class="modal fade " role="dialog">
        <div class="modal-dialog modal-lg ">

      <!-- Modal content-->
  <div class="modal-content modal_per ">
   <div class="reg_sim">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
      <div class="modal-header">

      <div id="reg_sim_titu_modal">
              <h3>Registrar Simulacro</h3>
      </div>
    </div>
     <div class="modal-body">
     <div id="reg_sim_content">
        <form class="form-group" method="post"  action="<?php echo base_url(); ?>director/Simulacros/registrar">
       <div class="container">
         <div class="row">
           <div class="col-md-12">
                <center><label for="inputState">Nombre del Simulacro </label>
          <input type="text" size="54" name="nombreS"required></center>
           </div>
         </div>
         <div class="row">
           <div class="col-md-12">
          <center><label for="inputState">Descripción</label></center>
          <center><textarea name="descripcionS" id="inputState" rows="3" cols="75" required placeholder="Ingresar la Descripcion"></textarea></center>
           </div>
         </div>
         <center>
         <div class="row">
           <div class="col-md-6">
            <center><label for="inputState">Ingrese Inicio</label></center><br>
             <input type="datetime-local" size="54" value="2018-04-15T10:00" name="Fecha_ini"required>
           </div>
           <div class="col-md-6">
            <center><label for="inputState">Ingrese Finalización</label></center><br>
             <input type="datetime-local" size="54" value="2018-04-15T12:00" name="Fecha_fin"required>
           </div>
         </div> </center>
       </div>
          <input type="submit" class="btn btn_reg_pre" value="Registrar Simulacro">
           </form>
    </div>
    </div>
    <div class="modal-footer" style="padding: 0px;">
      <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-right: 20px;">Cerrar</button>
    </div>
  </div>
            </div>
</div>
</div>
      <!--Fin de la ventana Modal-->

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