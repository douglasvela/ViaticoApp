<?php
		$host = "localhost";
        $usuario = "root";
        $pass = "";
        $bd = "mtps";
		
		$servidor = mysql_connect($host, $usuario, $pass);
		
	 	mysql_set_charset("utf8", $servidor);
		$conexion = mysql_select_db($bd, $servidor);
?>