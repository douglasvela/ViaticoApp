<!DOCTYPE html>
<html>
<head>

	<script type="text/javascript">

		/*function mostrarReporteEmpleado(tipo){
	       var id = $("#id_empleado").val();
	       var xhr = "";
	       if(id==""){
	        // swal({ title: "¡Ups! Error", text: "Completa los campos.", type: "error", showConfirmButton: true });
	       }else{
	        
	        if(document.getElementById('radio_pdf_pendiente').checked==true && tipo==""){
	         	window.open(xhr+"index.php/informes/menu_reportes/reporte_viatico_pendiente_empleado/pdf/"+id,"_blank");
	        }else if(document.getElementById('radio_excel_pendiente').checked==true && tipo==""){
	        	window.open(xhr+"index.php/informes/menu_reportes/reporte_viatico_pendiente_empleado/excel/"+id,"_blank");
	        }else{
	           
	        	var html="<embed src='"+xhr+"index.php/informes/menu_reportes/reporte_viatico_pendiente_empleado/vista/"+id+"'  width='780' height='400'>";
    			$("#informe_vista").html(html);
	        }
	       	
	       }
	     }*/ 
	</script>
</head>
<body>

	
	    <div class="container-fluid">
	        <div class="row page-titles">
	            <div class="align-self-center" align="center">
	                <h3 class="text-themecolor m-b-0 m-t-0">Viaticos Pendientes de Pago</h3>
	            </div>
	        </div>
	         <div class="row " id="cnt_form">
	            <div class="col-lg-4"  style="display: block;">
	                <div class="card">
	                    <div class="card-header bg-success2" id="">
	                        <h4 class="card-title m-b-0 text-white">Datos</h4>
	                    </div>
	                    <div class="card-body b-t">
	                    	<div class="form-group">
							 	<h5>Empleado: <span class="text-danger">*</span></h5>
                                <select id="id_empleado" name="id_empleado" class="select2" onchange="" style="width: 100%" required>
                                <option value=''>[Elija el empleado]</option>
                                
                                </select>
                            </div>
                            <div align="right">
                            <button type="button" onclick="mostrarReporteEmpleado('vista')" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-view-dashboard"></i> Vista Previa</button>
                            </div>
	                    </div>
	                </div>
	            </div>
	            <div class="col-lg-8" id="cnt_form" style="display: block;">
	                <div class="card">
	                    <div class="card-header bg-success2" id="">
	                        <h4 class="card-title m-b-0 text-white">Vista Preliminar</h4>
	                    </div>
	                    <div class="card-body b-t"  >
							 <!-- <embed src="" width="770" height="400"> -->
								<div id="informe_vista"  >
									
								</div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	


</body>
	
</html>