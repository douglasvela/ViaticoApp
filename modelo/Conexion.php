<?php
   class Conexion {
     
      function __construct(){
      
      }
      public function conectar(){
          $server   = "localhost";
      $database = "mtps";
        $usuario  = "root";
        $clave    = ""; 

      $conexion1 = mysqli_connect($server,$usuario,$clave,$database);
    //  mysql_select_db($database,$conexion1) ;
         if (!$conexion1)
       header('Location: offline.html');              
        
       
          
      //$query_s= mysql_query($conexion1,"set names 'UTF-8'");  
        //$conexion->set_charset('utf8');
         
         return $conexion1;

      }
    
      
   }
?>