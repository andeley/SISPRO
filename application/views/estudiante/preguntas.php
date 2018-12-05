<div id="page_content">
      <div class="container-fluid">
        <?php if ($tipo == "general") {
    ?>
          <div id="indice_pag">

            <p>Gestionar > <a href="<?=base_url();?>estudiante/Preguntas">Preguntas</a></p>
            </div>
         <div id="cotenido_pag">

<!--Ver Areas existentes para las preguntas-->
         <div id="indice_pag">
         <center><p>Menú de preguntas</p></center>
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
            <?php for ($i = 0; $i < 3 || $cont < count($todas_las_areas); $i++, $cont++) {?>

           <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center text_style_pre">

                <i class="fas fa-spa text-primary mb-2" style="color: #FC0758!important"></i>
                <h4 class="m-0"><a href="<?php echo base_url(); ?>estudiante/Preguntas/ver_preguntas_area/<?=$todas_las_areas[$cont]->id?>"><?php echo $todas_las_areas[$cont]->nombre ?></a></h4>
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
            <p>Gestionar > <a href="<?=base_url();?>estudiante/Preguntas">Preguntas</a> > <a href="<?php echo base_url(); ?>estudiante/Preguntas/ver_preguntas_area/<?=$id_a?>"><?=$nombre_area?></a></p>
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
        <td><center><a href="<?php echo base_url(); ?>estudiante/Preguntas/verDetalle/<?=$pregunta->id?>"><button type="button" class="btn btn-danger btn-sm">Ver detalle</button></a></center></td>
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
            <p>Gestionar > <a href="<?=base_url();?>estudiante/Preguntas">Preguntas</a> > <a href="<?php echo base_url(); ?>estudiante/Preguntas/ver_preguntas_area/<?=$area_p->id?>"><?=$area_p->nombre?></a></p>
            </div>
         

         <div id="cotenido_pag">
          <div class="cuadro_prin_est_simu">
            <center><h3>Informacion acerca de la pregunta <?=$info_pregunta->id?></h3></center>
<?php
if ($enunciado != "no existe enunciado") {
        ?>
<p class="pru_preg"><?=$enunciado;?></p>
<?php
}
    ?>
<p><?=$info_pregunta-> descripcion?></p>
<?php
$i = 97;
    foreach ($opciones_respuesta as $o) {
        ?>
        <p><b><?=chr($i++) . ". ";?></b><?=$o->descripcion;?></p>
        <?php

    }?>

</div>
  </div>

<?php } ?>
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

    <!-- Plugin JavaScript -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/template/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="<?php echo base_url(); ?>assets/template/js/grayscale.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
  </body>

</html>