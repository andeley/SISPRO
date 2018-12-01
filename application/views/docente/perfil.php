  <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div style="min-height: 524px;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                <center> <div class="section-title text-center wow zoomIn">
                        <h2>PERFIL DOCENCIA<a href="<?php echo base_url();?>docente/Perfil/editar"  class="btn " ><span style="color: red;" class="glyphicon glyphicon-pencil"></span></a></h2>
                 
                    </div></center>
                <!--small>Editar</small-->
                </h1>
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="box box-solid">
                    <div class="box-body">
                        <!--ini-perfil-->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <center><img src="<?php echo base_url()?>assets/template/dist/img/usuario_p.png" border="1"  width="200" height="190">
                                </center>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <br><br>
                                <center>
                                    <b>Nombre:</b>  <?=$info -> nombre?> <br><br>
                                </center>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <center>
                                    <br>
                                    <p>
                                        <b>Id:</b>  <?=$info -> id?> <br><br>
                                        <b>Código:</b>  <?=$info -> codigo?> <br><br>
                                    </p>
                                </center>
                            </div>
                            <div class="col-md-6">
                                <center>
                                    <br>
                                    <p>
                                        <b>Correo Electrónico: </b> <?=$info -> correo?> <br><br>
                                        <b>Programa Académico:</b>  <?=$programa;?> <br><br>
                                    </p>
                                </center>
                            </div>
                        </div>
                    </div>
                    <!--fin-perfil-->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->