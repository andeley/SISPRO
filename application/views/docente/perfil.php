<div id="page_content">
      
<div class="container-fluid">
     <div id="indice_pag">          
        <center><p>Perfil del Docente</p></center>
    </div>     
     
    
    <div id="cotenido_pag">          
    
    <div class="cuadro_prin_dir_per">
                  
           <div id="cuadro_content_dir_per">
            <div id="cuadro_uno_dir_per">
                <p>Información basica</p>
            </div>
            
            <div id="division">
            <div id="cuadro_dos_dir_per">
                <ul>
                    <li><span class="info_basic_dir_per">Nombre: </span> <br><?=$info -> nombre?></li>
                    <li><span class="info_basic_dir_per">Codigo</span><br><?=$info -> codigo?></li>
                    <li><span class="info_basic_dir_per">Email: </span><br> <?=$info -> correo?></li>
                    <li><span class="info_basic_dir_per">Programa academico:</span><br><?=$programa;?> </li>
                    <li><span class="info_basic_dir_per">Función:</span><br>Docente de programa</li>
                </ul>
            
            </div>

            <div id="cuadro_tres_dir_per">
     <!--Areas de conocimiento del docente-->

       <?php if ($areas_doc != false) {
        ?>
        <b>Areas de conocimiento del Docente: </b>
       
            <?php 
            $primera = false;
            foreach ($areas_doc as $ad): ?>
                  <?php 
                  if($primera)echo (", ");
                  $primera = true;
                  echo ($ad->nombre);?>
            <?php endforeach;?>
            <?php }?>


            </div>
            </div>
            </div>
        </div>



      

    </div>              
</div>
    
</div>





<!-------------------------------------->
    <footer class="small text-center text-white-50">
      <div class="container">
        Copyright &copy; Ingeniería de Software
      </div>
    </footer>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
   <!-- Bootstrap core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/template/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>assets/template/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for this template -->
    <script src="<?php echo base_url(); ?>assets/template/js/grayscale.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  </body>

</html>