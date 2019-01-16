<table class="bg-white table border hovered no-margin-top">
		<div class="panel">
		<div class="heading bg-teal" align="center">
            <span class="title">LISTADO DE SECCIONES</span>
        </div>
        </div>
        <thead>
            <tr>
            	<th class="sortable-column">ID</th>
                <th class="sortable-column">Descripción</th>
                <th class="sortable-column">Institción</th>
                <th class="sortable-column">Acciones</th>
            </tr>
        </thead>
        <tbody>
        
       		<?php
				
				include_once ("../../modelo/Conexion.php");
				include_once ("../../modelo/DAO.php");
				$conexions=new Conexion();
				$conexion=$conexions->conectar();
				$DAO=new DAO();
				
				
				/*************************** PAGINACION *******************************/
				$buscar = strtoupper($_GET["busq"]);
				$contad = ($_GET["cont"]);
				$page = ($_GET["page"]);
				$estad = $_GET["est"];
				if(empty($estad)){
					$estad = "";	
				}else{
					$estad = "estado = '".$estad."' AND ";	
				}
				
				$totalres=$DAO->contarDatos($conexion,"SELECT * FROM tseccion WHERE ((idseccion LIKE '%$buscar%') OR (descripcion LIKE '%$buscar%') OR (idinstitucion LIKE '%$buscar%')) ORDER BY idseccion DESC, idseccion");
					if(round($totalres/5) >= ($totalres/5))
						$last = round($totalres/5)-1;
					else
						$last = round($totalres/5);	
						
					if(round($page/5) >= ($page/5)){
						$init = round($page/5);
					}else{
						$init = round($page/5)+1;
					}
					
					if(($init*5)>=($last+1)){
						$fin = ($last+1);
					}else{
						$fin =($init*5);
					}
					/*************************** PAGINACION *******************************/
				
				$datos1=$DAO->mostrarAll($conexion,"SELECT * FROM tseccion WHERE ((idseccion LIKE '%$buscar%') OR (descripcion LIKE '%$buscar%') OR (idinstitucion LIKE '%$buscar%') ) ORDER BY idseccion ASC, idseccion LIMIT 5 OFFSET $contad");
				$correlativo = 0;
				if(empty($datos1))echo "<tr><td colspan='2' align='center'>NO HAY REGISTROS ACTUALMENTE... <span class='mif-notification'></span></td></tr>";
				else
				foreach($datos1 as $fila1){
					
			?>	     
				<tr>
                    <td><?php echo $fila1[0]; ?></td>
                    <td><?php echo $fila1[1]; ?></td>
                    <td><?php 
					$midato=$fila1[2];
					$midatos1=$DAO->mostrarAll($conexion,"SELECT nombre FROM tinstitucion WHERE idinstitucion='$midato'");
					foreach($midatos1 as $mifila1){
					}
					echo $mifila1[0];
					?></td>
                  <td>
                    <button type="button" class="button small-button cycle-button bg-cyan bg-active-darkCyan fg-white" onClick="mostrardatos('<?php echo $fila1[0]; ?>','<?php echo $fila1[1]; ?>','<?php echo $fila1[2]; ?>');">
                    <span class="mif-wrench"></span>
                    </button>
                    <button class="button cycle-button small-button" onclick="imprimir('<?php echo $fila1[0]; ?>');"><span class="mif-file-pdf"></span></button>
                    </td>
            	</tr>
			<?php } ?>
            
            
            
            <!-- *************************** PAGINACION ***************************** -->
        	<tr>
                <td colspan='10' align="right">
                	<div class="pagination cycle">
                    	
                        <span class="item current" <?php if($contad!=0) echo "onClick='firstcount();'"; ?>><<</span>
                        <span class="item current" <?php if($contad!=0) echo "onClick='backcount();'"; ?>><</span>
                        
                        <?php for($i = (($init*5)-4); $i <= $fin ; $i++){ ?>
                        	<span class="item <?php if ($i==$page)echo "current"; ?>"  onClick="numberpage('<?php echo $i; ?>');"><?php echo $i; ?></span>
                        <?php } ?>
                        
             			
                        <span class="item current"  <?php if($totalres > $contad+5) echo 'onClick="nextcount();"'; ?>>></span>
                        <span class="item current" <?php if($totalres > $contad+5) echo "onClick='lastcount($last);'"; ?>>>></span>
                        <?php 
							if($totalres == 0)
								echo "0 DE 0 PÁGINAS - TOTAL: 0 REGISTRO(S)"; 
							else
								echo (($contad/5)+1)." DE ".($last+1)." PÁGINAS - TOTAL: ".$totalres." REGISTRO(S)"; 
						
						?>
                    </div>           
                </td>
            </tr>
            <!-- *************************** PAGINACION ***************************** -->
            
            
            
        </tbody>
    </table>