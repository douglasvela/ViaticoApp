<?php
$usuario = $_POST['usuario'];
$contrasenia = $_POST['contrasenia'];

$conexion = mysqli_connect("162.241.252.245","proyedk4_WPZF0","MAYO_nesa94","proyedk4_WPZF0"); 
$query_consulta=mysqli_query($conexion,"SELECT * FROM org_usuario WHERE usuario = '".$usuario."' AND password = '".md5($contrasenia)."' AND estado = 1");
      	 $row_cnt = mysqli_num_rows($query_consulta);
      	 if($row_cnt>0){
      	 	echo "correcto";
      	 }else{
      	 	echo "incorrecto";
      	 }
?>