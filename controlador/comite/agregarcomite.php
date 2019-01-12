<?php session_start(); 
$usuario = $_SESSION['id'];
$time = $_SERVER['REQUEST_TIME'];
/**
 * for a 30 minute timeout, specified in seconds
 */
$timeout_duration = 2100;

/**
 * Here we look for the user’s LAST_ACTIVITY timestamp. If
 * it’s set and indicates our $timeout_duration has passed, 
 * blow away any previous $_SESSION data and start a new one.
 */
if (isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
   unset($_SESSION['login']);
  unset($_SESSION['id']);
  unset($_SESSION['LAST_ACTIVITY']);
  echo "EXPIRED";
  return;  
}
    
/**
 * Finally, update LAST_ACTIVITY so that our timeout 
 * is based on it and not the user’s login time.
 */
$_SESSION['LAST_ACTIVITY'] = $time;
	$id = $_POST["id"];
	$nombre = $_POST["nombre"];
	$minimo = $_POST["minimo"];
	$maximo =$_POST["maximo"];
	$nombre1 = $_POST["nombre1"];
	$nombre2 = $_POST["nombre2"];
	$nombre3 = $_POST["nombre3"];

	include_once ("../../modelo/Conexion.php");
	include_once ("../../modelo/DAO.php");

	$conexions=new Conexion();
	$conexion=$conexions->conectar();
	$DAO=new DAO();

	mysqli_begin_transaction($conexion);
	if(!$DAO->add($conexion,"insert into comites (id_comite,nomre_comite,intervalo_minimo,intervalo_maximo,representante1,representante2,representante3) values ('$id','$nombre','$minimo','$maximo','$nombre1','$nombre2','$nombre3')")){
            mysqli_rollback($conexion);
            echo "ERROR";
       }else{
            mysqli_commit($conexion);
            $codigo1=$DAO->mostrarAll($conexion,"SELECT usuario_id FROM usuarios WHERE usuario_nombre = '$usuario'");	
if(empty($codigo1))$codigo[0]="";
else
	foreach($codigo1 as $codigo){
	}
	$ip =$_SERVER['REMOTE_ADDR'];
$DAO->add($conexion,"insert into auditoria (au_usuario_sistema,tabla,PK,au_motivo,panel,au_ip) values ('$usuario','COMITES','$id_comite','AGREGAR COMITE','Nuevo comite','$ip')");
            echo "EXITO";
	}
?>