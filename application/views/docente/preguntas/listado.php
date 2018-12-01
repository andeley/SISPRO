  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div style="min-height: 524px;">
	<!-- Content Header (Page header) -->
			<!--section class="content-header">
				<h1>
				Perfil
				<small>Editar</small>
				</h1>
			</section-->
			<!-- Main content -->
			<section class="content">
				<!-- Default box -->
				<div class="box box-solid">
					<div class="box-body">
						<?php if($est== "general"){?>
						<div class="container-fluid">
						 <div class="row">
							<?php if($this->session->flashdata("error")):?><!--si hay un mensaje de usuario y contraseña incorr-->
							  <div id="mensaje" style="text-align: center;" class="alert alert-danger alert-dismissible">
								<p data-dismiss="alert"><?php echo ($this->session->flashdata("error"));?></p>
							</div>
						<?php endif;?>
						<?php if($this->session->flashdata("bien")):?><!--si hay un mensaje de usuario y contraseña incorr-->
						  <div id="mensaje" style="text-align: center;" class="alert alert-success alert-dismissible">
							<p><?php echo ($this->session->flashdata("bien"));?></p>
						</div>
					<?php endif;?>
					<br>
					<?php if($crear){?>
					<center><a href="<?php echo base_url();?>docente/Preguntas/crearPregunta" class="btn btn-danger">Crear Conjunto de Preguntas</a><!--btn-remove se usara para la peticion ajax--></center>
					<?php }?>
				</div>

				<div class="row">
				 <div class="col-md-12">

					<?php if($preguntas!=false){?>
					<h2><center>Tablero de Preguntas</center></h2><br>
					<table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
						<thead>
							<tr>
								<th>Id</th>
								<th>Area</th>
								<th>Estado</th>
								<th>Opciones</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($preguntas as $pregunta):?>
								<tr>


									<td><?php echo $pregunta-> id;?></td>
									<td><?php echo $pregunta-> area;?></td>
									<td style="
									<?php if($pregunta-> estado == "aprobada"){
										?>
										color:green; background-color:#AEFF8B;
										<?php }else if($pregunta->estado == "En espera"){?>
											color:#703719;
											<?php }else{?>
												color:red; background-color:#FFB4B4;
												<?php }?>">
												<center><b><?php echo $pregunta-> estado;?></b></center></td>

												<td>

													<center><div class="btn-group">

														<!--visualizar pregunta, cargar con ajax la infor de la pregunta y si tiene enunciado-->
														<button type="button" class="btn btn-info btn-view" data-toggle="modal" data-target="#modal-default" ><span class="fa fa-search"></span></button><!--ventana modal  btn-view se usara para la peticion ajax-->

														<!--editar pregunta-->
														<a href="<?php echo base_url();?>docente/Preguntas/editar/<?php echo $pregunta-> id;?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a><!--btn-remove se usara para la peticion ajax-->

														<!--eliminar pregunta-->
														<a href="<?php echo base_url();?>docente/Preguntas/eliminar/<?php echo $pregunta-> id;?>" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>

													</div> </center>   
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
									
								</table>
								<?php

							}
							else{?>
							<p><center>No existen preguntas registradas</center></p>
							<?php } ?>

						</div>
					</div>
				</div>
				<?php } ?>
	</div>
	<!-- /.box-body -->
</div>
<!-- /.box -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

