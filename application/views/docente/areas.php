  <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div style="min-height: 524px;">
            <!-- Content Header (Page header) -->
            <section class="content-header">

                <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center wow zoomIn">
                        <h2>Areas del Docente<a href="#"  class="btn " data-toggle="modal" data-target="#RegAreaDoc"><span style="color: red;" class="glyphicon glyphicon-plus"></span></a></h2>
                 
                    </div>
                </div>
            </div>
        </div>

            </section>
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="box box-solid">
                    <div class="box-body">
                    
                     <?php if($areas_doc!=false){?>
                    <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($areas_doc as $ad):?>
            <tr>
                
                   
                <td><?php echo $ad-> id;?></td>
                <td><?php echo $ad-> nombre;?></td>

                <td>
                                    
                                    <center>

                                        <!--eliminar categoria-->
                                        <a href="#" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>

                                     </center>   
                                    </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    
                                </table>
            <?php
                   
                }
                else{?>
                <p><center>No has registrado Areas de Conocimiento</center></p>
                <?php } ?>


                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->