 <?php
	$usuario_sesion = $_POST['nr'];
 ?>
<!DOCTYPE html>
<html>
<head>
	
	<script type="text/javascript">
		$(document).ready(function(){
			mostrarReporteVPendiente('reporte_viatico_pendiente_empleado');
		});
		function mostrarReporteVPendiente(funcion){
	       var formData = new FormData();
	       formData.append("funcion", funcion);
	       formData.append("id_empleado", $("#id_empleado").val());
	        $.ajax({
	              //url: "http://192.168.0.16/viaticoapp/indicadores_inicio.php",
	              url: "http://viaticos.proyectotesisuesfmp.com/controlador/viaticopendiente.php",
	              type: "post",
	              dataType: "html",
	              data: formData,
	              crossDomain: true,
	              cache: false,
	              contentType: false,
	              processData: false
	          })
	          .done(function(res1){
	            $("#informe_vista").html(res1);
	          }); 
	     }
	</script>
</head>
<body >
	    <div class="container-fluid">
	        <div class="row page-titles">
	            <div class="align-self-center" align="center">
	                <h3 class="text-themecolor m-b-0 m-t-0">Viáticos Pendientes de Pago</h3>
	            </div>
	        </div>
	         <div class="row " id="cnt_form">
	            <div class="col-lg-4"  style="display: none;">
	                <div class="card">
	                    <div class="card-header bg-success2" id="">
	                        <h4 class="card-title m-b-0 text-white">Datos</h4>
	                    </div>
	                    <div class="card-body b-t">
	                    	<div class="form-group">
                                	<input type="text" id="id_empleado" value="<?php echo $usuario_sesion;?>">
                            </div>
                            <div align="right">
                            <button type="button" onclick="mostrarReporteVPendiente('reporte_viatico_pendiente_empleado')" class="btn waves-effect waves-light btn-success2"><i class="ti-clipboard"></i> Consultar</button>
                            </div>
	                    </div>
	                </div>
	            </div>
	            <div class="col-lg-8" id="cnt_form" style="display: block;">
	                <div class="card"> 
	                    <div class=""  >
							 <!-- <embed src="" width="770" height="400"> -->
								<div id="informe_vista"></div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
</body>
 <script> jQuery(document).ready(function() { 
        $(".container-fluid").css("padding",'0 14');
        $(".page-titles").css("margin",'0 -14 10');
        $(".page-titles").css("padding",'15');
     }); </script>
</html>