    <div id="page_content">

        <div class="container-fluid">
            <div id="indice_pag">
                <p>Director > <a href="<?=base_url();?>director/Simulacros">Simulacros</a></p>
            </div>
            <div id="cotenido_pag">

            <?php if($est=="viewall"){?>            

            <!--Opcion registrar pregunta-->
            <div class="cuadro_prin">

           <div id="cuadro_content">
            <div id="cuadro_uno">
                <p>Opciones Simulacros</p>
            </div>
            <div id="cuadro_dos">
                 <form>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Registrar Nuevo Simulacro</button>
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
    <?php foreach ($simulacros as $s) { $cont++;?>

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
            <button type="button" data-target="#myModal<?=$s->id;?>" data-toggle="modal" class="btn btn-danger btn-sm"><span class="fa fa-search"></span></button>
            <a href="<?php echo base_url();?>director/Simulacros/editar/<?php echo $s-> id;?>"><button type="button" class="btn btn-danger btn-sm"><span class="fa fa-pencil"></span></button></a>
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
            <p><b>nombre: </b><?=$s-> nombreS;?> </p>
            <p><b>Descripción: </b><?=$s-> descripcion;?> </p>
            <p><b>Director A cargo: </b><?=$s-> nombreDir;?></p>
            <p><b>Fecha del Simulacro: </b>Fecha del Simulacro: <?php echo date("d/m/Y", strtotime($s->fecha_inicio)); ?></p>
            <p><b>Horario: </b>de <?php echo date("g:i:s A", strtotime($s->fecha_inicio)); ?> a <?php echo date("g:i:s  A", strtotime($s->fecha_fin)); ?></p>
            <?php if($areas_simulacros[$cont] ){ ?>
                  <p><b>Areas a evaluar:</b>
                  <?php foreach ($areas_simulacros[$cont] as $a_s) { ?>
                    <?php echo $a_s -> nombre.", " ; ?>
                  <?php } ?></p>
            <?php } ?>
      </div>
      </div>
      <div class="modal-footer">
        <a href="<?=base_url();?>estudiante/Simulacros/Registarse/<?=$s->id;?>"><button type="button" class="btn btn-danger">Ver Preguntas</button></a>
        <a href="<?php echo base_url();?>director/Simulacros/eliminar/<?php echo $s-> id;?>"><button type="button" class="btn btn-danger">Eliminar</button></a>
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
    }else if($est="editS"){?>


 <div style="min-height: 524px;"">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              
          
            <section class="content">
               
            <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center wow zoomIn">
                        <h1>Editar Simulacro</h1>
                        <span></span>
                        
                    </div>
                </div>
            </div>

            <div class="row">               
                <div class="col-md-12">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        General 
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    
            <form class="form-group" method="post" id="formRegistroS" action="<?php echo base_url();?>director/Simulacros/editarDatosBase/<?php echo $simulacroid;?>">

            <div class="container-fluid">
                <div class="row">
                    <center><div class="col-md-6"><p><b>Director: </b><?php echo $user-> nombre;?></p></div></center>
                   <center> <div class="col-md-6"><p><b>Programa: </b><?php echo $user-> programa;?></p></div></center>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2">
                        <label><b>Fecha de Inicio: </b></label>
                    </div>
                    <div class="col-md-10">
                    <div class="form-group">
                    <input type="date" class="form-control" id="exampleInputPassword1" 
                    value="<?php echo $info_simulacro-> fecha;?>" name="fecha" required>
                  </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-2"><label><b>Hora Inicial: </b></label></div>
                    <div class="col-md-4">
                        
                        <div class="form-group">
                    <input type="time" class="form-control" value="<?php echo $info_simulacro-> hora_ini;?>" id="exampleInputPassword1" name="horaI" required>
                  </div>
                    </div>
                    <div class="col-md-2"> <label><b>Hora Final: </b></label></div>
                    <div class="col-md-4">
                        
                        <div class="form-group">
                    <input type="time" class="form-control" value="<?php echo $info_simulacro-> hora_fin;?>" id="exampleInputPassword1" name="horaF" required>
                  </div>
                    </div>
                </div>
            </div>
        
        <center><button type="submit" class="btn btn-danger">Editar Simulacro</button></center>

        </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Areas de Conocimiento 
                                    </a>
                                </h4>

                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <?php if($this->session->flashdata("error")):?><!--si hay un mensaje de usuario y contraseña incorr-->
                  <div id="mensaje" style="text-align: center;" class="alert alert-danger">
                    <p><?php echo ($this->session->flashdata("error"));?></p>
                  </div>
                <?php endif;?>
                <a href="#">Genarar pdf examen</a>
                            <center><form class="form-inline" action="<?php echo base_url();?>director/Simulacros/registroAreaSimulacro/<?php echo $simulacroid;?>" method="post">
                                    <label>Registrar Area a Evaluar: </label>
                                       <div class="form-group has-feedback">
                  
                  <!--todas las areas-->
                    <select class="form-control" name="areaS">
                    <?php if($areasNo){?>
                        <!--listar las areas que aun no han sido registradas dentro del simulacro-->
                    <?php foreach ($areasNo as $n):?>
                      <option class="form-control"><?=$n-> nombre;?></option>
                       
                       <?php 
                       endforeach;?>
                                <?php }else{?>
                      <option class="form-control" selected>has seleccionado todas las areas</option>
                      <?php }?>
                    </select>
                </div>
                <?php 
                //if(count($areasNo) > count($areas)){?>
                <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span></button>
                                   </form> </center><br>
                                   <?php if($areas!=false){?>

                                      <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id Area</th>
                <th>Nombre</th>
                <th>Numero de Preguntas</th>
                <th>Opciones</th> 
            </tr>
        </thead>
        <tbody>
            <?php foreach ($areas as $area):?>
            <tr>
                
                <?php //numero de preguntas por area:
                $numPreguntas=0;
                if($preguntas!=false){
                foreach ($preguntas as $pregunta) {
                    if($pregunta-> id_area == $area-> id ){
                        $numPreguntas++;
                    }
                }
              }
                ?>
                   
                <td><?php echo $area-> id;?></td>
                <td><?php echo $area-> nombre;?></td>
                <td><?php echo $numPreguntas?></td>

                <td>
                                    
                                    <center><div class="btn-group">

                                        <!--visualizar categoria-->
                                        <button type="button" class="btn btn-info btn-view" data-toggle="modal" data-target="#modal-default" ><span class="fa fa-search"></span></button><!--ventana modal  btn-view se usara para la peticion ajax-->

                                        <!--editar categoria-->
                                        <a href="#" class="btn btn-warning"><span class="fa fa-pencil"></span></a><!--btn-remove se usara para la peticion ajax-->

                                        <!--eliminar categoria-->
                                        <a href="#" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>

                                    </div> </center>   
                                    </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                        <?php }else{
                            ?>
                        <p><center>No hay Areas de conocimiento registradas para el simulacro</center></p>
                        <?php }?>
                                </div>
                            </div>
                        </div>


                         <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Estudiantes 
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <p>Registrar estudiante al simulacro</p>
                                      <form id="est-s" action="#" method="post">
                            <p class="login-box-msg">Ingrese codigo del estudiante</p>
                                <input type="text" class="form-control" style="border-radius: 3px;" placeholder="Ingrese codigo" name="codigo" required>
                            <button type="submit" class="btn btn-danger btn-block btn-flat" style="border-radius: 3px;">Registrar estudiante</button>
                        </form>
                                  <?php
                                    if(!$estudiantes){ echo "No hay estudiantes registrados en el simulacro";
                                }else{
                                  ?>
                                  <table class="table table-bordered tabla-estudiantes-s">
        <thead>
            <tr>
                <th>Id</th>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Opciones</th> 
            </tr>
        </thead>
        <tbody>
            <?php foreach ($estudiantes as $estudiante):?>
            <tr>
                   
                <td><?php echo $estudiante-> id;?></td>
                <td><?php echo $estudiante-> codigo;?></td>
                <td><?php echo $estudiante-> nombre;?></td>
                <td>     
                                    <center><div class="btn-group">
                                        <!--visualizar-->
                                        <button type="button" class="btn btn-info btn-view" data-toggle="modal" data-target="#modal-default" ><span class="fa fa-search"></span></button>
                                        <!--eliminar-->
                                        <a href="#" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>

                                    </div> </center>   
                                    </td>
                                        </tr>
                                        <?php endforeach; ?>
                                <?php
                                }
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--- END COL -->     
            </div><!--- END ROW -->         
        </div>
              <style type="text/css">
                  .template_faq {
    background: #edf3fe none repeat scroll 0 0;
}
.panel-group {
    background: #fff none repeat scroll 0 0;
    border-radius: 3px;
    /*box-shadow: 0 5px 30px 0 rgba(0, 0, 0, 0.04);*/
    margin-bottom: 0;
    padding: 30px;
}
#accordion .panel {
    border: medium none;
    border-radius: 0;
    box-shadow: none;
    margin: 0 0 15px 10px;
}
#accordion .panel-heading {
    border-radius: 30px;
    padding: 0;
}
#accordion .panel-title a {
    background: #FE3F3F none repeat scroll 0 0;
    border: 1px solid transparent;
    border-radius: 30px;
    color: #fff;
    display: block;
    font-size: 18px;
    font-weight: 600;
    padding: 12px 20px 12px 50px;
    position: relative;
    transition: all 0.3s ease 0s;
}
#accordion .panel-title a.collapsed {
    background: #fff none repeat scroll 0 0;
    border: 1px solid #ddd;
    color: #333;
}
#accordion .panel-title a::after, #accordion .panel-title a.collapsed::after {
    background: #FE3F3F none repeat scroll 0 0;
    border: 1px solid transparent;
    border-radius: 50%;
    /*box-shadow: 0 3px 10px rgba(0, 0, 0, 0.58);*/
    color: #fff;
    content: "";
    font-family: fontawesome;
    font-size: 25px;
    height: 55px;
    left: -20px;
    line-height: 55px;
    position: absolute;
    text-align: center;
    top: -5px;
    transition: all 0.3s ease 0s;
    width: 55px;
}
#accordion .panel-title a.collapsed::after {
    background: #fff none repeat scroll 0 0;
    border: 1px solid #ddd;
    box-shadow: none;
    color: #333;
    content: "";
}
#accordion .panel-body {
    background: transparent none repeat scroll 0 0;
    border-top: medium none;
    padding: 20px 25px 10px 9px;
    position: relative;
}
#accordion .panel-body p {
    border-left: 1px dashed #8c8c8c;
    padding-left: 25px;
}
              </style> 
            </section>
            <!-- /.content -->
        </div>
    <?php }?>


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