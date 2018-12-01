<div id="page_content">
      <div class="container-fluid">
        <?php if ($tipo == "general") {
    ?>
          <div id="indice_pag">

            <p>Gestionar > <a href="<?=base_url();?>director/Preguntas">Preguntas</a></p>
            </div>
         <div id="cotenido_pag">
        <!-------------- CUADRO LISTADO PREGUNTAS------->

            <div class="cuadro_prin">

           <div id="cuadro_content">
            <div id="cuadro_uno">
                <p>Opciones Preguntas</p>
            </div>

            <div id="cuadro_dos">
                 <form>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Registrar</button>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal2">Aprobar Preguntas</button>
                 </form>
            </div>
            </div>


        </div>
<!--Ver Areas existentes para las preguntas-->
         <div id="indice_pag">
         <center><p>Menú de preguntas <a href="<?php echo base_url(); ?>director/Preguntas/ver_preguntas_director">(Ver Preguntas del director)</a></p></center>
         </div>

         <!--contenido areas-->
     <section id="noticias" class="info-section">
      <div class="container">
        <?php
$num_filas = ceil(count($todas_las_areas) / 3);
    $cont      = 0;
    for ($i = 0; $i < $num_filas; $i++) {
        ?>

           <div class="row">
            <?php for ($i = 0; $i < 3 && $cont < count($todas_las_areas); $i++, $cont++) {?>

           <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center">
                <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                <h4 class="m-0"><a href="<?php echo base_url(); ?>director/Preguntas/ver_preguntas_area/<?=$todas_las_areas[$cont]->id?>"><?php echo $todas_las_areas[$cont]->nombre ?></a></h4>
              </div>
            </div>
          </div>

          <?php }
        ;?>
</div>

        <?php }?>
      </div>
    </section>
         <!--fin contenido areas-->
</div>
<?php } else if ($tipo == "ver preguntas area") {?>

    <div id="indice_pag">
            <p>Gestionar > <a href="<?=base_url();?>director/Preguntas">Preguntas</a> > <a href="<?php echo base_url(); ?>director/Preguntas/ver_preguntas_area/<?=$id_a?>"><?=$nombre_area?></a></p>
            </div>
         <div id="cotenido_pag">
            <?php if ($preguntas) {?>
    <div class="table_">
               <table class="table table-hover">
  <thead>
    <tr id="tit_table">
      <th scope="col">Id</th>
      <th scope="col">Estado</th>
      <th scope="col">Visibilidad</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>

     <?php foreach ($preguntas as $pregunta): ?>
        <tr>
        <th scope="row"><?php echo $pregunta->id; ?></th>
        <td><?php echo $pregunta->estado; ?></td>
        <td><?php echo $pregunta->visibilidad; ?></td>
        <td><center><a href="<?php echo base_url(); ?>director/Preguntas/verDetalle/<?=$pregunta->id?>"><button type="button" class="btn btn-danger btn-sm">Ver detalle</button></a></center></td>
        </tr>
    <?php endforeach;?>

  </tbody>
</table>
</div>
</div>
<?php } else {?>
            <div id="indice_pag">
            <center><p>No tienes Preguntas registradas</p></center>
            </div>
    <?php }?>
</div>
<?php } else if ($tipo == "ver detalle pregunta") {
    ?>

    <div id="indice_pag">
            <p>Gestionar > <a href="<?=base_url();?>director/Preguntas">Preguntas</a> > <a href="<?php echo base_url(); ?>director/Preguntas/ver_preguntas_area/<?=$area_p->id?>"><?=$area_p->nombre?></a></p>
            </div>
         <div id="cotenido_pag">
            <center><h3>Informacion acerca de la pregunta <?=$info_pregunta->id?></h3></center>
<?php
if ($enunciado != "no existe enunciado") {
        ?>
<p><?=$enunciado;?></p>
<?php
}
    ?>
<p><?=$info_pregunta->descripcion?></p>
<?php
$i = 97;
    foreach ($opciones_respuesta as $o) {
        ?>
        <p><?=chr($i++) . ". " . $o->descripcion;?></p>
        <?php

    }?>
    <center><h3>Informacion de las opcion(es) de respuesta</h3></center> <br>
    <?php
if ($info_pregunta->tipo == "sm") {
        ?>
        <div class="table_">
               <table class="table table-hover">
  <thead>
    <tr id="tit_table">
      <th scope="col"><center>Opción</center></th>
      <th scope="col"><center>Respuesta</center></th>
      <th scope="col"><center>Justificación</center></th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 97;?>
     <?php foreach ($opciones_respuesta as $o): ?>
        <tr>
        <th scope="row"><center><?php echo chr($i++); ?></center></th>
        <td><center><?php if ($o->correcta == "si") {
            echo "Correcta";
        } else {
            echo "Incorrecta";
        }?></center></td>
        <td><center><?php echo $o->justificacion; ?></center></td>
        </tr>
    <?php endforeach;?>
  </tbody>
</table>
</div>
<?php
} else {
        //verdadero-falso, pregunta-abierta
        foreach ($opciones_respuesta as $o) {
            if ($o->correcta == "si") {
                ?>
        <p>Respuesta correcta: <?=$o->descripcion;?></p>
        <p>Justificacion: <?=$o->justificacion;?></p>
        <?php
break;
            }
        }
    }
    ?>
        </div>

<?php } else if ($tipo == "ver preguntas docente") {?>

            <div id="indice_pag">
            <p>Gestionar > <a href="<?=base_url();?>director/Preguntas">Preguntas</a></p>
            </div>
                 <div id="indice_pag">
                 <center><p>Preguntas del Director de Programa</a></p></center>
                 </div>
         <div id="cotenido_pag">
            <?php if ($preguntas) {?>
    <div class="table_">
               <table  class="table table-hover">
  <thead>
    <tr id="tit_table">
      <th scope="col"><center>Id</center></th>
      <th scope="col"><center>Area</center></th>
      <th scope="col"><center>Estado</center></th>
      <th scope="col"><center>Visibilidad</center></th>
      <th scope="col"><center>Opciones</center></th>
    </tr>
  </thead>
  <tbody>

     <?php foreach ($preguntas as $pregunta): ?>
        <tr>
        <th scope="row"><center><?php echo $pregunta->id; ?></center></th>
        <td><center><?php echo $pregunta->area; ?></center></td>
        <td><center><?php echo $pregunta->estado; ?></center></td>
        <td><center><?php echo $pregunta->visibilidad; ?></center></td>
        <td>
            <center>
                <a href="<?php echo base_url(); ?>director/Preguntas/verDetalle/<?=$pregunta->id?>"><button type="button" class="btn btn-danger btn-sm">Ver detalle</button></a>
                <a href="<?php echo base_url(); ?>director/Preguntas/editar/<?=$pregunta->id?>"><button type="button" class="btn btn-danger btn-sm">Editar</button></a></a>
                <a href="<?php echo base_url(); ?>director/Preguntas/eliminar/<?=$pregunta->id?>"><button type="button" class="btn btn-danger btn-sm">Eliminar</button></a>
            </center>
        </tr>
    <?php endforeach;?>

  </tbody>
</table>
</div>
</div>
<?php } else {?>
            <div id="indice_pag">
            <center><p>No tienes Preguntas registradas</p></center>
            </div>
    <?php }?>
</div>

<?php }?>
</div>
      </div>

   <!-------------VENTANA MODAL VER PREGUNTAS EN ESPERA----------------->
<div id="myModal2" class="modal fade " role="dialog">
    <div class="modal-dialog modal-lg ">
         <div class="modal-content modal_per ">
     <div class="reg_sim">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="modal-header">

        <div id="reg_sim_titu_modal">
                <h3>Ver Preguntas de los docentes en Espera de su Aprobación</h3>
        </div>
      </div>
       <div class="modal-body">
    <!--------------------------------------------------------------------------->


        <!-------------- CUADRO LISTADO PREGUNTAS------->
        <?php if ($preguntas_espera) {
    ?>
        <div class="table_">
               <table class="table table-hover">
  <thead>
    <tr id="tit_table">
      <th scope="col">Id</th>
      <th scope="col">Creador</th>
      <th scope="col">Materia</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>

    <?php foreach ($preguntas_espera as $pregunta): ?>
      <tr>
      <th scope="row"><?php echo $pregunta->id; ?></th>
      <td><?php echo $pregunta->docente; ?></td>
      <td><?php echo $pregunta->area; ?></td>
      <td>
         <a href="<?php echo base_url(); ?>director/Preguntas/verDetalle/<?=$pregunta->id?>">Ver detalle</a><br>
        <a href="<?php echo base_url(); ?>director/Preguntas/aprobar_pregunta/<?=$pregunta->id?>">Aprobar</a>
      </td>
    </tr>
      <?php endforeach;?>

  </tbody>
</table>
</div>
<?php } else {?>
                  <center><p>No hay preguntas en espera de ser aprobadas.</p></center>
                  <?php
}?>
       </div>
</div>
       <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
       </div>
</div>
          </div>
</div>

   <!---------------VENTANA MODAL REG PREGUNTAS------------------------->

         <div id="myModal" class="modal fade " role="dialog">
          <div class="modal-dialog modal-lg ">

        <!-- Modal content-->
    <div class="modal-content modal_per ">
     <div class="reg_sim">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="modal-header">

        <div id="reg_sim_titu_modal">
                <h3>Registrar preguntas</h3>
        </div>
      </div>
       <div class="modal-body">
       <div id="reg_sim_content">

    <form class="form-group" method="post" id="formCrearPregunta" action="<?php echo base_url(); ?>director/Preguntas/anadir?>">
<!--------------------EDITOR DE TEXTO------------------------------->

    <div class="panel_edit_text">
        <div id="frm-test">
            <div class="form-group col-md-12">
                    <center><label for="inputState">Selecciona un Area:</label></center>
                    <select id="inputState" class="form-control" name="area">
                        <?php foreach ($Areas as $area): ?>
                        <option value="<?=$area->id;?>"><?=$area->nombre?></option>
                        <?php endforeach?>
                    </select>
            </div>

            <center><label for="inputState">Ingresar Enunciado</label></center>
            <div  class="form-group" id="inputState">
                <center><textarea id="js-textarea" rows="5" cols="10" name="enunciado">Esto es Opcional</textarea></center>
                 <script type="text/javascript">
                  CKEDITOR.replace( 'js-textarea' );
                  //CKEDITOR.config.width="95%";
                  //CKEDITOR.config.height="150px";
              </script>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <center><label for="inputState">Tipo de Pregunta</label></center><br>
                    <select id="tipo_pregunta" onchange="contenido_preguntas()" class="form-control" name="tipo">
                       <option value="sm">Seleccion Múltiple</option>
                       <option value="vf">Verdadero y Falso</option>
                       <option value="pa">Pregunta abierta</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <center><label for="inputState">Visibilidad</label></center><br>
                    <select id="inputState" class="form-control tipo_pregunta" name="visibilidad">
                       <option value="publico">Publico</option>
                       <option value="privada">Privada</option>
                    </select>
                </div>
            </div>
            <br>
            <center><label for="inputState">Menú de Preguntas</label></center><hr>
            <div  class="form-group">
                <center><textarea name="descripcionPregunta" id="inputState" rows="3" cols="75" placeholder="Ingresar la Pregunta"></textarea></center>
            </div>
             <div  class="form-group">
                <center><label for="inputState">Ingresa las respuestas</label></center><br>

                     <div id="seleccionMultiple" style="display: block;">
                        <div id="contenido_opcion1">
                    <div id="opciones">

              <input type="radio" name="correcta" value="1"
              style="margin-right:15px;">
              <input type="text" size="42" name="opcion[]" placeholder="Ingrese opcion">
              <input type="text" size="30" name="justificacion[]" placeholder="Ingrese justificación(opcional)">
              </div>
              <a href="#" id="mas">Mas opciones</a> /
              <a href="#" id="menos">Menos Opciones</a>

              <script type="text/javascript">
                var opcion = 1;
                  $(document).ready( function() {
            $('#mas').click( function(e) {
                opcion++;
                document.getElementById("opciones").innerHTML+='<div id="group_ques'+opcion+'"><input type="radio"  name="correcta" value="'+opcion+'" style="margin-right:15px;"> <input type="text" size="42" name="opcion[]" placeholder="Ingrese opcion"> <input type="text" size="30" name="justificacion[]" placeholder="Ingrese justificación(opcional)"></div>';
            });

             $('#menos').click( function(e) {
                $('#group_ques'+opcion).remove();
                opcion--;
            });
        });
              </script>


    </div>
    <hr>
</div>
<div id="verdaderoFalso" style="display: none;">
<div id="contenido_opcion2">

             <input type="radio" name="correcta2" value="1"
              style="margin-right:15px;">
              <input type="text" size="42" name="opcion2[]" value="verdadero">
              <input type="text" size="30" name="justificacion2[]" placeholder="Ingrese justificación(opcional)">

         <input type="radio" name="correcta2" value="2"
              style="margin-right:15px;">
              <input type="text" size="42" name="opcion2[]" value="Falso">
              <input type="text" size="30" name="justificacion2[]" placeholder="Ingrese justificación(opcional)">

    </div>
</div>
<div id="preguntaAbierta" style="display: none;">
<div id="contenido_opcion3">
        <div  class="form-group">

                <center><textarea name="opciona" id="inputState" rows="3" cols="75" placeholder="Ingresar la Respuesta"></textarea></center>
            </div>
        <input type="text" size="50" style= "display : none; " name="justificaciona" placeholder="Ingrese justificación(opcional)">
    </div>
    </div>
        </div>
             <input type="submit" class="btn btn_reg_pre" value="Registrar">
                </div>
            </div>

   <!-------------------- FIN EDITOR DE TEXTO------------------------------->

</form>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
              </div>
  </div>
</div>

   <!----------------FOOTER---------------------->
    <footer class="small text-center text-white-50">
      <div class="container">
        Copyright &copy; Ingenieria de software
      </div>
    </footer>

   <!-- Bootstrap core JavaScript -->
    <!--<script src="../vendor/jquery/jquery.min.js"></script>-->
    <script src="<?php echo base_url(); ?>assets/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-------------------SCRIPT CORRESPONDIENTE AL PANEL DE TEXTO--------------------------------->
 

   <!---------------------RESPUESTAS DINAMICAS--------------------------->

   <script type="text/javascript">

    //llamar funcion cuando cambia tipo de pregunta en el select
function contenido_preguntas(){
    //alert("hombre");
    var tipo_pregunta = (document.getElementById('tipo_pregunta')).value;
    if(tipo_pregunta == "sm"){
         document.getElementById('seleccionMultiple').style.display = "block";
         document.getElementById('verdaderoFalso').style.display = "none";
         document.getElementById('preguntaAbierta').style.display = "none";
    }else if(tipo_pregunta == "vf"){
         document.getElementById('seleccionMultiple').style.display = "none";
         document.getElementById('verdaderoFalso').style.display = "block";
         document.getElementById('preguntaAbierta').style.display = "none";
    }else{ //pa
         document.getElementById('seleccionMultiple').style.display = "none";
         document.getElementById('verdaderoFalso').style.display = "none";
         document.getElementById('preguntaAbierta').style.display = "block";
    }
}

    var i=1;
          function agregar_pregunta(){

              i++;
              var div=document.createElement('div');
              div.innerHTML='<input class="form-check-input" type="radio" name="radio_'+i+'" value="opt_circle_'+i+'"><input class="op_preg"  type="text" name="opt_text_'+i+'"><input type="button" id="add_kid()" onclick="agregar_pregunta()" value=" + " /><input type="button"  onclick="delete_pregunta(this)" value="-"/>'
              document.getElementById('group_ques').appendChild(div);
          }

          function delete_pregunta(div){
              document.getElementById('group_ques').removeChild(div.parentNode);
              i--;
          }

    //Ajax agregar pregunta bd

    $(document).ready( function() {

        toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-full-width",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}

            $('table').dataTable({
                "dom": '<"top">rt<"bottom"p><"clear">',
                responsive: true
            });
            
           /* $('#formCrearPregunta').submit( function(e) {
                $.ajax({
                    url:  $(this).attr('action'),
                    type:"POST",
                    data: $(this).serialize(),
                    success:function(resp){
                     toastr.info('Pregunta Registrada exitosamente'+resp);
                     //$("#enunciado").remove();
                   //modificar elementos form
            }
        });
                e.preventDefault();
            });*/
        });

    </script>

    <!-- Plugin JavaScript -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/template/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="<?php echo base_url(); ?>assets/template/js/grayscale.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
  </body>

</html>