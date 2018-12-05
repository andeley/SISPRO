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
                            <?php $i =0; ?>
                            <?php  foreach ($estudiantes as $estudiante):?>
                                <tr>
                              <th scope="row"><?php echo $estudiante-> id;?></th>
                              <td><?php echo $estudiante-> codigo;?></td>
                              <td><?php echo $estudiante-> nombre;?></td>
                              <td><center> <button type="button" data-target="#myModal<?=$estudiante->id;?>" data-toggle="modal" class="btn btn-danger btn-sm"><span class="fa fa-search"></span>
          </button></center></td>
                            </tr>

                            <!--Modal Detalle del Estudiante-->

    <div id="myModal<?=$estudiante->id;?>" class="modal fade " role="dialog">
          <div class="modal-dialog modal-lg ">

        <!-- Modal content-->
    <div class="modal-content modal_per ">
     <div class="ver_datos_est">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="modal-header">

        <div id="ver_datos_est_titu_modal">
                <h3>Desempeño en Areas de Conocimiento</h3>
        </div>
      </div>
       <div class="modal-body">
          
       <canvas id="myChart<?php echo $estudiante->id;?>"></canvas>
  <script type="text/javascript">

    function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}

    var ctxForecastChart = $("#myChart<?php echo $estudiante->id;?>").get(0).getContext("2d");
var forecastChartData = {
    labels: [
        "Acumulado Promedio del desempeño"
    ],
    datasets: [
    {
        label: "Formulacion, Evaluación y Gestión de Proyectos",
        backgroundColor: getRandomColor(),
        hoverBackgroundColor: getRandomColor(),
        data: [(Math.random() * 5).toFixed(2)]
    },
    {
        label: "Diseño de Software",
        backgroundColor: getRandomColor(),
        hoverBackgroundColor: getRandomColor(),
        data: [(Math.random() * 5).toFixed(2)]
    }]
};

var forecastOptions = {
    tooltips: {
        enabled: true
    }
};

var forecastBarChart = new Chart(ctxForecastChart,
{
    type: 'bar',
    data: forecastChartData,
    options: forecastOptions
});
  </script>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
              </div>
  </div>
</div>
<!--fin modal detalle del Estudiante-->
                            <?php $i++; ?>
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