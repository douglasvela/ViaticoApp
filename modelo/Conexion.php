<?php
   class Conexion {
     
      function __construct(){
      
      }
      public function conectar(){
          $server   = "162.241.252.245";
      $database = "proyedk4_WPZF0";
        $usuario  = "proyedk4";
        $clave    = "MAYO_nesa94"; 

      $conexion1 = mysqli_connect($server,$usuario,$clave,$database);
         if (!$conexion1)
          echo "Fuera de linea";
         
         return $conexion1;

      }
    
      
   }
?>