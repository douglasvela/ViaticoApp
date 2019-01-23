<html>
<head>
	<title></title>
</head>
<body>
<?php
$nr = $_POST['nr'];
	$conexion = mysqli_connect("162.241.252.245","proyedk4_WPZF0","MAYO_nesa94","proyedk4_WPZF0"); 
	$query_consulta=mysqli_query($conexion,"SELECT count(*) AS cantidad FROM vyp_mision_oficial WHERE nr_empleado = '".$nr."' AND estado IN(1,3,5)"); 
	while( $fila=mysqli_fetch_array($query_consulta)){
			$indicador_revision[] = $fila;
			}
		foreach ($indicador_revision as $fila_indicador_revision) {}
?>
<div class="container-fluid">
	<div class="row page-titles">
           <div class="align-self-center" align="center">
               <h3 class="text-themecolor m-b-0 m-t-0">Indicadores de solicitud de viáticos</h3>
           </div>
       	</div>
	<div class="row">       	
<div class="col-md-6 col-lg-3 col-xlg-3">
    <a class="card card-inverse card-info" onclick="" href="#!">
        <div class="box bg-info text-center">
            <h1 class="font-light text-white"><?php echo $fila_indicador_revision[0];?></h1>
            <h5 class="text-white">Solicitudes en revisión</h5>
        </div>
    </a>
</div>
</div>
</div>
</body>
</html>