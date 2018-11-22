<!--ARREGLAR ESTA VISTA, BOTA ERROR-->
 <!-- Content Wrapper. Contains page content -->
        <div style="min-height: 524px;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1><center> <div class="section-title text-center wow zoomIn">AREAS DE CONOCIMIENTO</a></div></center></h1>
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="box box-solid">
                    <div class="box-body">
                        <!--ini-perfil-->
                        <?php
if ($tipo == "general") {
    if ($this->session->flashdata("error")) {
        echo $this->session->flashdata("error");
    } else if ($this->session->flashdata("bien")) {
        echo $this->session->flashdata("bien");
    }
    ?>
                   <h3>Registrar nueva area de conocimiento</h3>
                     <form id="Area" action="<?php echo base_url(); ?>Director/Areas/registrar" method="post">
                            <p class="login-box-msg">Nombre del area, no debe repetirse</p>
                                <input type="text" class="form-control" style="border-radius: 3px;" placeholder="Ingrese nombre area" name="nombreA" required>
                            <button type="submit" class="btn btn-danger btn-block btn-flat" style="border-radius: 3px;">Registrar nueva area</button>
                        </form>
            <?php if (!$todas_las_areas) {
        echo "no hay areas de conocimiento registradas";
    } else {
        ?>
                   <table id="example" class="table table-striped table-bordered nowrap tabla-docentes-espera" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>N° de preguntas</th>
                <th>N° de docentes asignados</th>
            </tr>
        </thead>
        <tbody>
            <?php
foreach ($todas_las_areas as $area): ?>
            <tr>
                <td><?php echo $area->id; ?></td>
                <td><?php echo $area->nombre; ?></td>
            </tr>
                <?php endforeach;
        ?>
                                    </tbody>
                                </table>
                                <?php }
} else {
    //ver areas director
    ?>
 <h4>Relacionarse a un Area</h4>
                        <form class="form-group" method="post" id="insertarAreaDirector" action="<?php echo base_url(); ?>director/Areas/registrarArea?>">

                             <select  name="areaR" data-live-search="true">
                        <?php foreach ($areas as $area): ?>
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
                            <?php }
    ?>

                  <?php endforeach;?>
                    </select>
                            <input type="submit" name="guardarA" value="Registrar Area">
                        </form>
                    

}

?>
                    <!--fin-perfil-->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </section>
            <!-- /.content -->
     
        <!-- /.content-wrapper -->