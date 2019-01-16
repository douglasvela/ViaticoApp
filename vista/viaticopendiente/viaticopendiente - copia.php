<?php session_start();
$id = trim($_SESSION['id']);
if($_SESSION['login']!="ok"){
	header("Location: ../login.php");
	exit();
}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=0.60, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Metro, a sleek, intuitive, and powerful framework for faster and easier web development for Windows Metro Style.">
    <meta name="keywords" content="HTML, CSS, JS, JavaScript, framework, metro, front-end, frontend, web development">

	<title>SECCION</title>

<!--********************* LIBRERIAS *************************-->

    <link href="../../css/metro.min.css" rel="stylesheet">
    <link href="../../css/docs.css" rel="stylesheet">
    <link href="../../css/metro-schemes.min.css" rel="stylesheet">
    <link href="../../css/metro-rtl.min.css" rel="stylesheet">
    <link href="../../css/metro-responsive.min.css" rel="stylesheet">
    <link href="../../css/metro-icons.min.css" rel="stylesheet">
    <script src="../../js/jquery-2.1.3.min.js"></script>
    <script src="../../js/metro.min.js"></script>
    <script src="../../js/validator.js"></script>

<!--********************* LIBRERIAS *************************-->
<style>
a {
	cursor:pointer
}

#encima {
	position: absolute;
	}
</style>

<!-- ***************************** <script> ****************************** -->

<script>

	/*********************** NO TOCAR XD PAGINACION *******************************/
	var cont = 0,page = 1;
	function backcount(){
		if(cont>0){
			cont -= 5;
			page--;
			tabla();
		}
	}
	
	function nextcount(){
			cont += 5;
			page++;
			tabla();
	}
	
	function firstcount(){
			page = 1;
			cont = 0;
			tabla();
	}
	
	function lastcount(last){
			page = last+1;
			cont = last*5;
			tabla();
	}
	
	function numberpage(pag){
			page = pag;
			cont = (pag*5-5);
			tabla();
	}
	/*********************** NO TOCAR XD PAGINACION *******************************/
	
	var estado = "true";


	function tabla(str){
		var dato = document.getElementById("buscador").value;
		if (str==""){
			document.getElementById("tabla2").innerHTML="";
			buscaAjax(" ");
			return;
		}
		
		if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttpB=new XMLHttpRequest();
		}else{// code for IE6, IE5
			xmlhttpB=new ActiveXObject("Microsoft.XMLHTTPB");
		}
		
		xmlhttpB.onreadystatechange=function(){
			if (xmlhttpB.readyState==4 && xmlhttpB.status==200){
				  document.getElementById("tabla2").innerHTML=xmlhttpB.responseText;
				  
			}
		}
		
		xmlhttpB.open("GET","tablaseccion.php?busq="+dato+"&cont="+cont+"&page="+page+"&est="+estado,true);
		xmlhttpB.send();
	
	}
	
	var anterior = "activo";
	
	function nuevoInsti(objeto){
		$("#modificando").hide(500);
		$("#NIT").prop('disabled', false);
		if(objeto != anterior){
			if(!$("#formulario").is(":visible")){
				$("#"+anterior).removeClass("bg-yellow fg-white text-bold");
				$("#tabla").toggle(500);
				$("#formulario").toggle(500);
				$("#regresar").show(500);
			}
			$("#"+objeto).addClass("bg-yellow fg-white text-bold");
			limpiardatos();
			anterior = objeto;
		}
	}
	
	function limpiardatos(){
		document.getElementById("identificador").value = "";
		document.getElementsByName("DES").item(0).value = "";
		document.getElementsByName("institucion").item(0).value = "";
		
		$('#sav1').removeClass('ribbed-grayLight');
		$('#mod1').addClass('ribbed-grayLight');
	}
	
	function ListaResponsable(objeto,est){
		estado = est;
		$("#modificando").hide(500);
		if($("#formulario").is(":visible")){
			$("#"+anterior).removeClass("bg-yellow fg-white text-bold");
			$("#"+objeto).addClass("bg-yellow fg-white text-bold");
			$("#tabla").toggle(500);
			$("#formulario").toggle(500);
			anterior = objeto;
		}else if(objeto != anterior){
			$("#"+anterior).removeClass("bg-yellow fg-white text-bold");
			$("#"+objeto).addClass("bg-yellow fg-white text-bold");
			$("#tabla").fadeTo(100,0);
			$("#tabla").fadeTo(400,1);
			anterior = objeto;
		}
		tabla();
	}
	
	function verificarSeccion(accion,id){
		if(!($("#"+id).hasClass('ribbed-grayLight'))){
			var des = TEXTO('DES',6,200);
			var inst = document.getElementById('institucion').value;

			if( des == true  && inst!=""){
				
					enviar(accion);
			}else{
				document.getElementById("notifyCampos").click();
			}
		}
		
	}
	
	
	
	function objetoAjax(){
		var xmlhttp = false;
		try {
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {

			try {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (E) {
				xmlhttp = false; }
		}

		if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		  xmlhttp = new XMLHttpRequest();
		}
		return xmlhttp;
	}
	
	function enviar(accion){		
		
		var id = document.getElementById("identificador").value;
		var des = document.getElementsByName("DES").item(0).value;
		var inst = document.getElementById("institucion").value;

		jugador = document.getElementById('jugador');
		
		ajax = objetoAjax();
		
		if(accion == 'guardar'){
			ajax.open("POST", "../../controlador/Seccion/nuevaseccion.php", true);
		}else if(accion == 'modificar'){
			ajax.open("POST", "../../controlador/Seccion/modificarseccion.php", true);
		}
		
		ajax.onreadystatechange = function() {
		
			if (ajax.readyState == 4){
				jugador.value = (ajax.responseText) 
//				alert(document.getElementById('jugador').value)
				if(/EXITO/.test(jugador.value)){
					document.getElementById("notifyExito").click();
					firstcount();
					ListaResponsable('activo','true');
				}else{
					document.getElementById("notifyError").click();
				}
			}
		} 
		
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
		
		if(accion == 'guardar'){
			ajax.send("des="+des+"&inst="+inst)
		}else if(accion == 'modificar'){
			ajax.send("des="+des+"&inst="+inst+"&idS="+id)
		}
	
	}
	
	function mostrardatos(id,dui,nombre){		
		document.getElementById("identificador").value = id;
		document.getElementById("idbandera").value = id;
		document.getElementsByName("DES").item(0).value = dui;
		document.getElementById("institucion").value = nombre;
		
		$('#sav1').addClass('ribbed-grayLight');
		$('#mod1').removeClass('ribbed-grayLight');
		
		modificarResponsable();				
	}
	
	function modificarResponsable(){
		$("#"+anterior).removeClass("bg-yellow fg-white text-bold");
		$("#tabla").toggle(500);
		$("#formulario").toggle(500);
		$("#modificando").show(500);
		$("#regresar").show(500);
	}


function iniciar(){
	$("#barra").animate({width: '100%', opacity: '1'}, "slow");
     $("#panel1").toggle(1000);
	tabla();
	
}
function regre(){
		location.href="seccion.php";
	}

</script>
<!-- ***************************** </script> ****************************** -->
</head>

<body id="cuerpo" onLoad="iniciar();">

<!-- FORMULARIO -->
<div class="grid no-margin">
<div class="row cells12">
    <div class="cell">
    </div>
    <div class="cell colspan8" id="panel">
        
    <div class="panel" style="display:none;" id="formulario">
        <div class="heading bg-teal" align="center">
            <span class="title">GESTIONAR SECCION</span>
        </div>
        <div class="content padding20 no-padding-top">
        <br>
        <div class="row cells12">
            <div class="cell colspan10">
                <h5 align="justify" class="margin30 no-margin-top">
                    El simbolo (*) indica los campos requeridos
                </h5>
                <form autocomplete="off" role="form" id="gm" name="gm"  action="../../controlador/institucion/nuevainstitucion.php" enctype="multipart/form-data" method="post" onSubmit="return false;">
                <div class="row cells2">
        
                <div class="cell">
                <input type="hidden" id="identificador" name="identificador"><!--identificador-->
                <input type="hidden" id="jugador" name="jugador"><!--Response de Ajax-->
                <input type="hidden" id="bandera" name="bandera">
                <input id="idbandera" name="idbandera" value="" type="hidden">
                 <input type="hidden" id="jugador1" name="jugador1">
                <div class="input-control text full-size" id="DES1">
                    <label>Descripcion(*) </label>
                    <span class="mif-profile prepend-icon"></span>
                    <input type="text" id="DES" name="DES" onKeyUp="TEXTO('DES',6,200);" onFocus="mostrar('DESt');" onBlur="ocultar('DESt');">
                    <span class="placeholder" id="DESt" style="display:none;">Ingresar descripcion</span>
                </div>
                </div>
                
                <div class="cell">
                <div class="input-control text full-size" id="nombre1">
                    <label>Institucion (*) </label>

                     <select  name="institucion" id="institucion" data-placement="top" data-toggle="popover"   data-content="Ingrese Institucion" type="text" class="form-control" placeholder=""   list="tipom" > 
                                <!--<datalist id="tipom">-->
                                   <option value="">		[Elije]</option>
                                        <?php
                                            include_once ("../../modelo/Conexion.php");
                                            include_once ("../../modelo/DAO.php");
                                            $conexions=new Conexion();
                                            $conexion=$conexions->conectar();
                                            $DAO=new DAO();
                                            $datos=$DAO->mostrarAll($conexion,"select * from tinstitucion");
                                            
                                            if(empty($datos))echo "";
                                            else
                                                foreach($datos as $fila){
                                         ?>	     		
                                      <option value="<?php echo $fila[0];?>">
                                       <?php  echo ucwords(strtolower($fila[1]))." ".ucwords(strtolower($fila[2])); ?>
                                           </option>
                                        <?php 
                                            }
                                        ?>
                               <!-- </datalist>-->
                            </select>
                   
                </div>
                </div>
                
                </div>
               
				</form>
                
            </div>
            <div class="cell colspan2" align="center">
                <h5 class="no no-phone">ACCIONES:</h5>
                <button type="button" id="sav1" class="shortcut-button bg-teal bg-active-darkTeal fg-white" onclick="verificarSeccion('guardar',this.id);">
                    <span class="icon mif-user-plus"></span>
                    <span class="title">Nueva Sección</span>
                </button>
                <br class="no no-phone">
                <button type="button" id="mod1" class="shortcut-button bg-cyan bg-active-darkCyan fg-white ribbed-grayLight" onclick="verificarSeccion('modificar',this.id);">
                    <span class="icon mif-wrench"></span>
                    <span class="title">Modificar Sección</span>
                </button>
                
               
            </div>
        </div>
                    
        </div>
    </div>
     
     <div id="tabla">
          <div class="input-control text full-size" data-role="input">
              <input type="text" id="buscador" onKeyUp="tabla();">
              <button class="button"><span class="mif-search"></span></button>
          </div>          
          <div id="tabla2">
      		
          </div>
      </div>
            
            
    </div>
    
    <div class="cell colspan2" id="panel1" style="display:none;">
    	
        <ul class="v-menu">
        	<li class="menu-title bg-darkTeal fg-white align-center"><h5>OPCIONES</h4></li>
            <li class="menu-title">AGREGAR</li>
            <li><a onClick="nuevoInsti(this.id);" id="nuevo"><span class="mif-user-plus icon"></span> NUEVO</a></li>
            <li><a class="bg-yellow fg-white text-bold" id="modificando" style="display:none;"><span class="mif-wrench icon"></span> MODIFICANDO...</a></li>
            <li><a onClick="regre();" id="regresar" style="display:none;"><span class="mif-arrow-left icon"></span>Retornar</a></li>
        </ul>
    </div>
      
    <div class="cell">
    </div>
</div>
</div>
<!-- FIN FORMULARIO -->

<div style="display:none;">
<button type="button" class="button" id="notifyError">Create Notifies</button>
<button type="button" class="button" id="notifyCampos">Create Notifies</button>
<button type="button" class="button" id="notifyExito">Create Notifies</button>
</div>

</body>
<script>
    function showDialog(id){
        var dialog = $(id).data('dialog');
        dialog.open();
    }
</script>
<script>
    $(function(){
        $('#notifyError').on('click', function(){
            setTimeout(function(){
                $.Notify({keepOpen: true, type: 'alert', caption: 'Ups! Ocurrio un error!', content: "Verifique que no exista o intentelo nuevamente", icon: "<span class='mif-warning'></span>", keepOpen: false});
            });
        });
    });
	
	$(function(){
        $('#notifyCampos').on('click', function(){
            setTimeout(function(){
                $.Notify({keepOpen: true, type: 'alert', caption: 'Advertencia!', content: "Complete todos los campos requeridos para poder guardar", icon: "<span class='mif-warning'></span>", keepOpen: false});
            });
        });
    });
	
	$(function(){
        $('#notifyExito').on('click', function(){
            setTimeout(function(){
                $.Notify({keepOpen: true, type: 'success', caption: 'Éxito!', content: "Se guardaron los cambios exitosamente", icon: "<span class='mif-notification'></span>", keepOpen: false});
            });
        });
    });
</script>
</html>
