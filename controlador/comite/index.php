<?php session_start();
$id = trim($_SESSION['id']);
if($_SESSION['login']!="ok"){
   header("Location: ../../view/cerrar.php");
    exit();
}
 date_default_timezone_set('America/El Salvador');
 include_once ("../../modelo/Conexion.php");
 include_once ("../../modelo/DAO.php");
 $conexions=new Conexion();
 $conexion=$conexions->conectar();
 $DAO=new DAO();

/* VALIDACION DE ROLES DE USUARIO */
$datosRol=$DAO->mostrarAll($conexion,"SELECT *  FROM  roles_usuarios as r inner join usuarios as u on r.id_role=u.id_role WHERE usuario_nombre = '$id'");
if(!empty($datosRol)){

  foreach($datosRol as $filaRol){}
    if($filaRol[4]==0){
      //Indicamos la fecha y hora del suceso.
$fecha = date('d-m-Y H:i:s');
$para='d_recinos@outlook.com';
$asunto='Documento no encontrado.';
$mensaje='El documento: ' . $_SERVER['REQUEST_URI'] . ' no ha sido encontrado en el sitio: ' .$_SERVER['SERVER_NAME']. ' al tratar de ser accedido el ' . $fecha . ' desde la dirección ' . $_SERVER['HTTP_REFERER'];

mail($para, $asunto, $mensaje);

    echo "<script>";
    echo "parent.window.location=' ../../view/sin_permiso.php'";
    echo "</script>";
  }else{
  	echo "<script>";
    echo "window.location=' ../../view/menu.php'";
    echo "</script>";
  }
}
/* VALIDACION DE ROLES DE USUARIO */


?>