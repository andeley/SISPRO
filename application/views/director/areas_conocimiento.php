<div id="page_content">

        <div class="container-fluid">
            <div id="indice_pag">
                <p>Director > <a href="<?=base_url();?>director/Areas">Areas</a></p>
            </div>


            <div id="cotenido_pag">

                    <?php
                        if ($this->session->flashdata("error")) {
                              echo $this->session->flashdata("error");
                        } else if ($this->session->flashdata("bien")) {
                              echo $this->session->flashdata("bien");
                        }
                    ?>

                     <div class="cuadro_prin_dir_areas_uno">
                        <div id="cuadro_content_dir_areas_uno">
                            <div id="cuadro_uno_dir_areas_uno">
                                <div id="indice_pag_dir_areas_uno">
                                    <center><p>Registrar Nueva Area</p></center>
                                </div>
                                </div>
                                <div id="cuadro_dos_dir_areas_uno">
                                <form id="Area" action="<?php echo base_url(); ?>Director/Areas/registrar" method="post">
                                     <center><p class="login-box-msg">Nombre del area</p></center>
                                    <input type="text" class="form-control" style="border-radius: 3px;" placeholder="Ingrese nombre area" name="nombreA" required>
                                    <button type="submit" class="btn btn-danger btn-block btn-flat" style="border-radius: 3px;">Registrar nueva area</button>
                                </form>
                                </div>
                        </div>
                     </div>

    <?php if (!$todas_las_areas) {
    echo "no hay areas de conocimiento registradas";
    } else {
    ?>
                <div id="indice_pag">
                    <center><p>Areas de Conocimiento</p></center>
                </div>  

                            <div class="table_dir_areas">
                           <table class="table table-hover">
              <thead>
                <tr id="tit_table">
                  <th scope="col">Id</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">No. Preguntas</th>
                  <th scope="col">No. de Docentes Asignados</th>
                </tr>
              </thead>
              <tbody>
                            <?php $i=-1;
                            foreach ($todas_las_areas as $area): 
                                  $i++;
                                ?>
                                <tr>
                                  <th scope="row"><?php echo $area->id; ?></th>
                                  <td><?php echo $area->nombre; ?></td>
                                  <td><center><?php echo $n_preguntas[$i]; ?></center></td>
                                  <td><center><?php echo $n_docentes[$i]; ?></center></td>
                                </tr>
                            <?php endforeach; ?> 
              </tbody>
            </table>
            </div>
                                <?php } ?>

            <div id="indice_pag">
                    <center><p>Opciones del Usuario - Relacionarse a un Area</p></center>
                </div>
                       <div class="cuadro_prin_dir_areas_dos">
                        <div id="cuadro_content_reg_are_dos">
                        <form method="post" action="<?php echo base_url(); ?>director/Areas/registrarArea?>">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6">
                                        <select id="inputState" class="form-control" name="areaR" >
                                <?php foreach ($todas_las_areas as $area): ?>
                                     <?php $validacion = false;?>
                                     <?php foreach ($areas_doc as $area_doc) {
                                         if ($area_doc->nombre == $area->nombre) {
                                                //el docente ya registró esa era, no mostrarla
                                                $validacion = true;
                                                break;
                                            }
                                        }
                                    if (!$validacion) {?>
                                        <option ><?=$area->nombre?></option>
                                    <?php } ?>

                                  <?php endforeach;?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <center>
                                            <input type="submit" name="guardarA" align="center" height="5px" style="margin:0;" class="btn btn_reg_pre" value="Registrar Area">
                                        </center>
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                      </div>
                    </div>
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
