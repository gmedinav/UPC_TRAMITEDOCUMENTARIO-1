<?php include_once("template/cabecera.php"); ?>
<?php
  require_once('../controlador/TramiteControlador.php');
  require_once('../entidades/beanTramite.php');
  require_once('../entidades/empleado.php');

  $objTramites = new TramiteControlador();
  $beanTramite = new beanTramite();
  $empleado = new empleado();

  $beanTramite = $objTramites->getTramite($_GET['id']);
  $lt_tramitesadjuntos = $objTramites->obtenerTramitesAdjuntos($_GET['id']);
  $empleado = $objTramites->getEmpleadoSugerido($_SESSION["cod_area"]);

?>
<!-- Accordion - START -->
<div class="container">
	<div class="row">


		<?php include_once("template/menu.php"); ?>

		<div class="col-sm-9 col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						Delegar Carga de Trabajo Expedientes : <a
							style="color: blue; font-weight: bold"> <?php echo $beanTramite->POST_cod_tramite();?>
						</a>
					</h3>
				</div>

				<div class="panel-body">
          <!-- Inicio Datos tramite -->
          <div class="form-group row">
            <div class="col-xs-6">
              <label for="ejemplo_email_1">Administrado</label>
              <input type="text" disabled="true" value="<?php echo $beanTramite->POST_des_administrado();?>" class="form-control input-sm" id="ejemplo_email_1" />
            </div>
            <div class="col-xs-6">
              <label for="formGroupExampleInput2">Fecha</label>
              <input id="fechaentrega" value=" <?php echo $beanTramite->POST_fec_recepcion();?> " disabled="true" name="fechaentrega" placeholder="fecha entrega" class="form-control input-sm"
                required="">
            </div>
          </div>

          <div class="form-group row">
              <div class="col-xs-12">
                <label for="formGroupExampleInput2">Descripción Tramite</label>
                <input type="text" disabled="true" value="<?php echo $beanTramite->POST_nom_tramite();?>" class="form-control input-sm" id="ejemplo_email_1" />
              </div>
          </div>
          <div class="form-group row">
            <div class="col-xs-12">
              <label for="formGroupExampleInput2">Observaciones</label>
              <textarea class="form-control input-sm" disabled="true" type="textarea"
                  id="referencia" name="referencia" placeholder="referencia"
                  maxlength="200" rows="5"><?php echo $beanTramite->POST_observaciones();?></textarea>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-xs-4">
              <label for="formGroupExampleInput2">Confirmación de Jefe</label>&nbsp;
               
      
                
              <input type="checkbox" id="confirmacionJefe" >
              
              
            </div>
          </div>
          <!-- Fin Datos tramite -->
          <hr>
          <!-- Inicio Lilstado Documentos Adjuntos -->
          <div class="panel panel-default">
            <div class="panel-heading">Documentos Adjuntos</div>
            <div class="panel-body">
              <table
                class="table table-bordered table-striped table-hover table-condensed">
                <thead>
                  <tr>
                    <th>Cod. Tramite</th>
                    <th>Registrado Por</th>
                    <th>Descripción</th>
                    <th>Nro Doc</th>
                    <!--<th>Ruta</th>-->
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($lt_tramitesadjuntos as $key=> $row) { ?>
                  <tr>
                    <td>
                      <?php echo $row['cod_tramite'];?>
                    </td>
                    <td>
                      <?php echo $row['registradopor'];?>
                    </td>
                    <td>
                      <?php echo $row['des_adj'];?>
                    </td>
                    <td>
                      <?php echo $row['nom_docu'];?>
                    </td>
                    <!--<td>
                        <?php echo $row['ruta_doc_adjunta'];?>
                    </td>-->
                    <td style="width: 35px">
											<a class="btn btn-info btn-sm" href="JavaScript:void(0);" data-toggle="modal" data-target="#dialog_<?php echo $key;?>">
												<span class="glyphicon glyphicon-zoom-in"></span>
                      </a>
											<div class="modal fade" id="dialog_<?php echo $key;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
											  <div class="modal-dialog modal-lg" role="document">
											    <div class="modal-content">
											      <div class="modal-header">
											      </div>
											      <div class="modal-body">
															<center>
																<div class="embed-responsive embed-responsive-4by3">
																  <embed src="../<?php echo $row['ruta_doc_adjunta'];?>">
																</div>
															</center>
											      </div>
											      <div class="modal-footer">
											      </div>
											    </div>
											  </div>
											</div>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- Fin Lilstado Documentos Adjuntos -->
          <!-- Inicio empleados para delegacion -->
          <div class="panel panel-default">
            <div class="panel-heading">Empleados para Delegación</div>
            <div class="panel-body">
              <div class="form-group row">
                <div class="col-xs-5">
                  <label class="control-label">Empleado:</label>
                  <input type="text" class="form-control input-sm" id="nombre_empleado">
                </div>
                <div class="col-xs-5">
                  <label class="control-label">Codigo:</label>
                  <input type="text" class="form-control input-sm" id="codigo_empleado">
                </div>
                <div class="col-xs-1">
                  <label class="control-label">&nbsp;</label>
                  <button id="btnbuscar" name="btnbuscar" onclick="buscarEmpleados()" class="btn btn-primary btn-sm" title="Buscar">
    								<span class="glyphicon glyphicon-search"></span>
    							</button>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-xs-6">
                  <label for="formGroupExampleInput2">Empleado Sugerido</label>
                  <input type="text" disabled="true" value="<?php echo($empleado->POST_nombre()." ".$empleado->POST_apellido_pat()." ".$empleado->POST_apellido_mat());?>" class="form-control input-sm" id="ejemplo_email_1" />
                </div>
                <div class="col-xs-6">
                  <label for="formGroupExampleInput2">Seleccionar</label><br>
                  <input type="radio" checked name="seleccionado" value="<?php echo $empleado->POST_id()?>">
                </div>
              </div>
              <br>
              <table class="table table-bordered table-striped table-hover table-condensed">
                <thead>
                  <tr>
                    <th>Nombre Empleado</th>
                    <th>Cantidad de Expedientes Asignados</th>
                    <th>Seleccionar</th>
                  </tr>
                </thead>
                <tbody id="body_contenedor">
                </tbody>
              </table>
              <div class="form-group row">
                <div class="col-xs-12">
                  <label for="ejemplo_email_1">Descripción:</label>
                  <textarea
                      class="form-control input-sm" type="textarea" id="descripcion_asignacion"
                      name="descripcion_iteracion"
                      placeholder="Escribir la Descripción"
                      maxlength="200" rows="5"></textarea>
                </div>
              </div>
            </div>
          </div>
          <!-- Fin empleados para delegacion -->
          <div class="form-group row">
              <div class="col-xs-1">
                	<button type="button" onclick="guardarTramite()" class="btn btn-success btn-sm" onclick="">Guardar</button>
              </div>
              <div class="col-xs-1">
                  <button type="button" onclick="rechazarTramite()" class="btn btn-danger btn-sm">Rechazar</button>
              </div>
          </div>
        </div>
			</div>
		</div>
	</div>
	<!-- Accordion - END -->
	<?php include_once("template/pie.php"); ?>
  <script>
  $(function() {
    buscarEmpleados();
  });
  function buscarEmpleados(){
    $("#body_contenedor").html("");
    var nombre = $("#nombre_empleado").val();
    var codigo = $("#codigo_empleado").val();
    var cod_area = "<?php echo $_SESSION["cod_area"];?>";

    $.get("inc_listar_empleados.php?cod_area="+cod_area+"&nombre="+nombre+"&codigo="+codigo, function(data, status){
      $("#body_contenedor").html(data);
    });
  }

  function guardarTramite(){
    var codigo_empleado = $('input:radio[name=seleccionado]:checked').val();
    var descripcion =$("#descripcion_asignacion").val();
    var confirmacionJefe = $("#confirmacionJefe").is(':checked');
    var confirmacionJefe2 = 0;
    if(confirmacionJefe){
      confirmacionJefe2 = 1;
    }
    if(!isBlank(descripcion)){
      if(confirm('¿Esta seguro de guardar la asignación?')){
        $.post("inc_cambiar_estado.php",
          {
            cod_tramite: "<?php echo $beanTramite->POST_cod_tramite();?>",
            operation: "3",
            cod_user : "<?php echo $_SESSION["cod_user"];?>",
            cod_area : "<?php echo $_SESSION["cod_area"];?>",
            cod_empleado : codigo_empleado,
            descripcion : descripcion,
            confirmacionJefe : confirmacionJefe2
          },
          function(data, status){
            //document.location.href="Delegar_Tramite.php";
        });
      }
    }else{
      $("#descripcion_asignacion").focus();
      alert("Ingresar una descripción.");
    }
  }
  function rechazarTramite(){
    if(confirm('¿Esta seguro de rechazar el tramite?')){
      $.post("inc_cambiar_estado.php",
    		{
    			cod_tramite: "<?php echo $beanTramite->POST_cod_tramite();?>",
    			operation: "2",
    			cod_user : "<?php echo $_SESSION["cod_user"];?>",
    		  cod_area : "<?php echo $_SESSION["cod_area"];?>"
    		},
    		function(data, status){
    			document.location.href="Delegar_Tramite.php";
    	});
    }
  }
  </script>
