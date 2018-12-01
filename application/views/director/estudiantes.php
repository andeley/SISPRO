<div id="page_content">

        <div class="container-fluid">
            <div id="indice_pag">
                <p>Director > <a href="<?=base_url();?>director/usuarios/Estudiantes">Estudiantes</a></p>
            </div>
            <div id="cotenido_pag">
                <div id="indice_pag">
                <center><p>Estudiantes Vinculados Al Programa de <?php echo $programa; ?> </p></center>
                <br>
            </div>
                <?php if(!$estudiantes){?>
                        <center>No hay estudiantes Vinculados al Programa.</center>
                <?php }else{ ?>
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
                            <?php  foreach ($estudiantes as $estudiante):?>
                                <tr>
                              <th scope="row"><?php echo $estudiante-> id;?></th>
                              <td><?php echo $estudiante-> codigo;?></td>
                              <td><?php echo $estudiante-> nombre;?></td>
                              <td><center><button type="button" data-target="#myModal<?=$estudiante->id;?>" data-toggle="modal" class="btn btn-danger btn-sm">Ver detalle</button></center></td>
                            </tr>

                            <!--Modal Detalle del Estudiante-->

    <div id="myModal<?=$estudiante->id;?>" class="modal fade " role="dialog">
          <div class="modal-dialog modal-lg ">

        <!-- Modal content-->
    <div class="modal-content modal_per ">
     <div class="reg_sim">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="modal-header">

        <div id="reg_sim_titu_modal">
                <h3>Detalle del Estudiante</h3>
        </div>
      </div>
       <div class="modal-body">
       <div id="reg_sim_content">
            detalle estudiante <?php echo $estudiante-> nombre; ?>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
              </div>
  </div>
</div>
<!--fin modal detalle del Estudiante-->

                            <?php endforeach; ?>
                          </tbody>
                        </table>
                        </div>

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
   <script src="<?php echo base_url(); ?>assets/template/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/template/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/template/js/grayscale.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  </body>

</html>