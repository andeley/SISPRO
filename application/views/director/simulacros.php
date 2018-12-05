<div id="page_content">

      <div class="container-fluid">
          <div id="indice_pag">
              <p>Director ><a href="<?=base_url();?>director/Simulacros">Simulacros</a></p>
          </div>
          <div id="cotenido_pag">

          <?php if ($est == "viewall") {
  ?>

          <!--Opcion registrar pregunta-->
          <div class="cuadro_prin_dir_simulacro_reg">

         <div id="cuadro_content_dir_simulacro_reg">
          <div id="cuadro_uno_dir_simulacro_reg">
              <p>Opciones Simulacros</p>
          </div>
          <div id="cuadro_dos_dir_simulacro_reg">
               <form>
                  <button type="button" class="btn" data-toggle="modal" data-target="#myModal">Registrar Nuevo Simulacro</button>
               </form>
          </div>
          </div>
      </div>

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
          
          <a href="<?php echo base_url(); ?>director/Simulacros/editar/<?php echo $s->id; ?>"><button type="button" class="btn btn-danger btn-sm"><span class="fa fa-pencil"></span></button>
          </a>
          
      </center>

    </td>
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
      <a href="<?=base_url();?>director/Simulacros/verPreguntas/<?=$s->id;?>"><button type="button" class="btn btn-danger">Ver Preguntas</button></a>
      <a href="<?php echo base_url(); ?>director/Simulacros/eliminar/<?php echo $s->id; ?>"><button type="button" class="btn btn-danger">Eliminar</button></a>
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
} else if ($est = "editS") {
  ?>

 <div id="indice_pag">
              <center><p>Editar Simulacro</p></center>
  </div>


<div class="cuadro_prin_dir_simulacro_edit">
 
  <!--Insert JavaScript behavior-->
 <ul class="nav nav-tabs" id="myTab" role="tablist">
<li class="nav-item">
  <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
</li>
<li class="nav-item">
  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#areas" role="tab" aria-controls="areas" aria-selected="false">Areas de Conocimiento</a>
</li>
<li class="nav-item">
  <a class="nav-link" id="estudiantes-tab" data-toggle="tab" href="#estudiantes" role="tab" aria-controls="estudiantes" aria-selected="false">Estudiantes</a>
</li>
</ul>

<div class="tab-content" id="myTabContent">
<div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
  <!--formulario editar datos generales-->
        <div id="form_uno_sim_2">
        <form class="form-group" method="post"  action="<?php echo base_url(); ?>director/Simulacros/editarDatosBase/<?=$simulacroid;?>">
          <br><br><br>
          <center><label for="inputState">Nombre del Simulacro </label>
          <input type="text" size="80" name="nombreSE" value="<?php echo $info_simulacro->nombre; ?>" required></center>

          <br>
          <center>
            <label for="inputState">Descripción</label></center>
          <center>
            <textarea name="descripcionSE" id="inputState" rows="3" cols="80" required placeholder="Ingresar la Descripcion"><?php echo $info_simulacro->descripcion; ?>
            </textarea>
          </center>

          <div class="container">
             <center>
            <div class="row">
              <div class="col-md-6">
                <center><label for="inputState">Ingrese Inicio</label></center><br>
                  <input type="datetime-local" size="54" value="<?php echo (date("Y-m-d\TH:i:s", strtotime($info_simulacro->fecha_inicio))); ?>" name="Fecha_iniSE" required>
              </div>
              <div class="col-md-6">
                <center><label for="inputState">Ingrese Finalización</label></center><br>
                  <input type="datetime-local" size="54" value="<?php echo (date("Y-m-d\TH:i:s", strtotime($info_simulacro->fecha_fin))); ?>"  name="Fecha_finSE"required>
              </div>
            </div>
            </center>
            <div class="row">
              <div class="col-md-12">
                <center><br> <button type="submit" class="btn btn-danger " style="border-radius: 3px;">Guardar Cambios</button</center>
              </div>
            </div>
          </div>
           </form>
</div>


</div>
<div class="tab-pane fade" id="areas" role="tabpanel" aria-labelledby="areas-tab">

  <!--Areas del conocimiento del simulacro-->
<br><br>
                        <center>
                            <form style="margin-left: 75px;" class="form-inline" action="<?php echo base_url(); ?>director/Simulacros/registroAreaSimulacro/<?php echo $simulacroid; ?>" method="post">
                 <label style="margin-right: 25px;">Registrar Area a Evaluar: </label>
                <!--todas las areas-->
                  <select class="form-control" name="areaS">
                  <?php if ($areasNo) {?>
                      <!--listar las areas que aun no han sido registradas dentro del simulacro-->
                  <?php foreach ($areasNo as $n): ?>
                    <option class="form-control"><?=$n->nombre;?></option>

                     <?php
endforeach;?>
                              <?php } else {?>
                    <option class="form-control" selected>has seleccionado todas las areas</option>
                    <?php }?>
                  </select>

              <?php
//if(count($areasNo) > count($areas)){?>
              <button type="submit" style="margin-left: 45px; margin-top: 0px;" class="btn btn-danger"><span class="fas fa-plus-circle"></span></button>
                                </form>
                        </center>
                         <br>
                                 <?php if ($areas != false) {
      ?>
<div id="indice_pag">
              <center><p>Areas de Conocimiento del Simulacro</p></center>
          </div>
                                  <div class="table_">
             <table class="table table-hover">
<thead>
  <tr id="tit_table">
    <th scope="col">Id Area</th>
    <th scope="col">Nombre</th>
    <th scope="col">No. Preguntas</th>
    <th scope="col">Opciones</th>
  </tr>
</thead>
<tbody>
  <?php foreach ($areas as $area): ?>
    <tr>
    <?php //numero de preguntas por area:
      $numPreguntas = 0;
      if ($preguntas != false) {
          foreach ($preguntas as $pregunta) {
              if ($pregunta->id_area == $area->id) {
                  $numPreguntas++;
              }
          }
      }
      ?>
         <td><?php echo $area->id; ?></td>
              <td><?php echo $area->nombre; ?></td>
              <td><center><?php echo $numPreguntas ?></center></td>
              <td> <center>


       <button type="button" data-target="#myModal<?=$area->id;?>" data-toggle="modal" class="btn btn-danger btn-sm"><span class="fa fa-pencil"></span></button>
        <a href="<?php echo base_url(); ?>director/Simulacros/eliminarArea/<?=$area->id;?>/<?=$simulacroid;?>"><button type="button" class="btn btn-danger btn-sm"><span class="fa fa-remove"></span></button></a>

                                  </center>
              </td>
  </tr>
  <!--Modal detalle area Simulacro-->
  <div id="myModal<?=$area->id;?>" class="modal fade " role="dialog">
        <div class="modal-dialog modal-lg ">

      <!-- Modal content-->
  <div class="modal-content modal_per ">
   <div class="reg_sim">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
      <div class="modal-header">

      <div id="reg_sim_titu_modal">
              <h3>Preguntas del Area <?=$area->nombre;?></h3>
      </div>
    </div>
     <div class="modal-body">
     <div id="reg_sim_content">
         <form  class="form-group" style="margin-left: 80px;" action="<?php echo base_url(); ?>director/Simulacros/registrarPreguntaSimulacro/<?php echo $simulacroid; ?>" method="post">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-6">
                                <center><label>Seleccione pregunta a registrar</label></center>
                        </div>
                        <div class="col-md-6">
                                 <center>
                                   <select class="form-control"  name="id_pregunta" >
                                     <option class="form-control" selected disabled>Seleccione el ID</option>
                                        <?php if ($preguntas_no) {?>
                                            <!--listar las areas que aun no han sido registradas dentro del simulacro-->
                                         <?php foreach ($preguntas_no as $p): ?>
                                          <?php if ($p->id_area == $area->id): ?>
                                          <option class="form-control"><?=$p->id;?></option>
                                           <?php endif;?>
                                           <?php endforeach;?>
                                                    <?php }?>
                              </select>
                                 </center>
                        </div>
                      </div>
                    </div>
                    <input type="submit" class="btn btn_reg_pre" value="RegistrarPregunta">
                  </form>
    </div>
    </div>
    <div class="modal-footer">

      <button type="button" class="btn btn_reg_pre" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
            </div>
</div>
</div>
  <?php endforeach;?>
</tbody>
</table>
</div>
<?php } else {
      ?>
                      <p><center>No hay Areas de conocimiento registradas para el simulacro</center></p>
                      <?php }?>

                      <br>
                      
</div>
<div class="tab-pane fade" id="estudiantes" role="tabpanel" aria-labelledby="estudiantes-tab">

    <div id="indice_pag">
    <center>
    <p>Registrar estudiante al simulacro</p>
    </center>
    </div>

 <?php if ($this->session->flashdata("error")): ?>
  <center><p style="color:  #C70039 ;"><?php echo $this->session->flashdata("error"); ?></p></center>
 <?php endif;?>
                                  <form  class="form-group" style="margin-left: 80px;" action="<?php echo base_url(); ?>director/Simulacros/registrarEstudianteSimulacro/<?php echo $simulacroid; ?>" method="post">
                          <label>Ingrese codigo</label>
                              <input  type="text" size="30"  placeholder="Ingrese codigo" name="codigoes" required>
                          <button type="submit" class="btn btn-danger" style="padding-bottom: 2px; padding-top: 4px; margin-top: 0px; margin-left: 90px;">Registrar estudiante</button>
                      </form>
                                <?php
if (!$estudiantes) {?>
                                    <center><p>No hay estudiantes registrados en el simulacro</p></center>
                                    <?php
} else {
      ?>
                                <br>
                                <div id="indice_pag">
                                  <center><p>Estudiantes Registrados en el Simulacro</p></center>
                              </div>
            <div class="table_">
             <table class="table table-hover">
<thead>
  <tr id="tit_table">
    <th scope="col">Id</th>
    <th scope="col">Código</th>
    <th scope="col">Nombre</th>
    <th scope="col">Opciones</th>
  </tr>
</thead>
<tbody>
  <?php foreach ($estudiantes as $estudiante): ?>
  <tr>

    <th scope="row"><?php echo $estudiante->id; ?></th>
    <td><?php echo $estudiante->codigo; ?></td>
    <td><?php echo $estudiante->nombre; ?></td>
    <td> <center><a href="<?php echo base_url(); ?>director/Simulacros/eliminarEstudianteSimulacro/<?=$estudiante->id;?>/<?php echo $simulacroid; ?>"><button type="button" class="btn btn-danger btn-sm">Eliminar</button></a></center></td>
  </tr>
   <?php endforeach;?>

</tbody>
</table>
</div>
<?php
}
  ?>

</div>
</div>
  <?php }?>


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