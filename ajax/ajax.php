<?php

include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funcionesReferencias.php');


$serviciosUsuarios  		= new ServiciosUsuarios();
$serviciosFunciones 		= new Servicios();
$serviciosHTML				= new ServiciosHTML();
$serviciosReferencias		= new ServiciosReferencias();


$accion = $_POST['accion'];


switch ($accion) {
    case 'login':
        enviarMail($serviciosUsuarios);
        break;
	case 'entrar':
		entrar($serviciosUsuarios);
		break;
	case 'insertarUsuario':
        insertarUsuarios($serviciosReferencias);
        break;
	case 'modificarUsuario':
        modificarUsuario($serviciosUsuarios);
        break;
	case 'registrar':
		registrar($serviciosUsuarios);
        break;
	case 'recuperar':
		recuperar($serviciosUsuarios);
		break;


case 'insertarUsuarios': 
insertarUsuarios($serviciosReferencias); 
break; 
case 'modificarUsuarios': 
modificarUsuarios($serviciosReferencias); 
break; 
case 'eliminarUsuarios': 
eliminarUsuarios($serviciosReferencias); 
break; 

case 'insertarClientes': 
insertarClientes($serviciosReferencias); 
break; 
case 'modificarClientes': 
modificarClientes($serviciosReferencias); 
break; 
case 'modificarClientePorCliente':
	modificarClientePorCliente($serviciosReferencias);
	break;
case 'eliminarClientes': 
eliminarClientes($serviciosReferencias); 
break; 


case 'insertarArchivos': 
insertarArchivos($serviciosReferencias); 
break; 
case 'modificarArchivos': 
modificarArchivos($serviciosReferencias); 
break; 
case 'eliminarArchivos': 
eliminarArchivos($serviciosReferencias); 
break; 

case 'traerArchivosPorCliente':
	traerArchivosPorCliente($serviciosReferencias);
	break;
}

/* Fin */

function traerArchivosPorCliente($serviciosReferencias) {
	$id = $_POST['id'];

	$res = $serviciosReferencias->traerArchivosPorCliente($id);

	$cad3 = '';
	//////////////////////////////////////////////////////busquedajugadores/////////////////////
	$cad3 = $cad3.'
				<div class="col-md-12">
				<div class="panel panel-info">
                                <div class="panel-heading">
                                	<h3 class="panel-title">Archivos Encontrados</h3>
                                	
                                </div>
                                <div class="panel-body-predio" style="padding:5px 20px;">
                                	';
	$cad3 = $cad3.'
	<div class="row">
                	<table id="example" class="table table-responsive table-striped" style="font-size:1.2em; padding:2px;">
						<thead>
                        <tr>
                        	<th>Observacion</th>
                        	<th>Fecha Creación</th>
							<th>Descargar</th>
                        </tr>
						</thead>
						<tbody id="resultadosProd">';
	while ($rowJ = mysql_fetch_array($res)) {
		$cad3 .= '<tr>
					<td>'.($rowJ['observacion']).'</td>
					<td>'.($rowJ['fechacreacion']).'</td>
					<td><a href="descargar.php?token='.$rowJ['token'].'" target="_blank"><img src="../imagenes/download-2-icon.png" style="width:8%;"></a></td>
				 </tr>';
	}
	
	$cad3 = $cad3.'</tbody>
                                </table></div>
                            </div>
						</div>';
						
	echo $cad3;
}

function insertarArchivos($serviciosReferencias) { 
	$refclientes = $_POST['refclientes']; 
	$token = $_POST['token']; 
	//$imagen = $_POST['imagen'];  
	$observacion = $_POST['observacion']; 
	
	if ($_FILES['imagen']['tmp_name'] != '') {
		$res = $serviciosReferencias->subirArchivo('imagen',$refclientes,$serviciosReferencias->obtenerNuevoId('dbarchivos'),$token,$observacion); 
		
		if ($res == '') { 
			echo ''; 
		} else { 
			echo 'Hubo un error al insertar datos';	 
		} 
	} else {
		echo 'Debe seleccionar un archivo';	
	}
}


function modificarArchivos($serviciosReferencias) { 
	$id = $_POST['id']; 
	$refclientes = $_POST['refclientes']; 
	$token = $_POST['token']; 
	$imagen = $_POST['imagen']; 
	$type = $_POST['type']; 
	$observacion = $_POST['observacion']; 
	
	$res = $serviciosReferencias->modificarArchivos($id,$refclientes,$token,$imagen,$type,$observacion); 
	
	if ($res == true) { 
		echo ''; 
	} else { 
		echo 'Hubo un error al modificar datos'; 
	} 
} 


function eliminarArchivos($serviciosReferencias) { 
	$id = $_POST['id']; 
	$res = $serviciosReferencias->eliminarArchivos($id); 
	echo $res; 
} 


/* PARA Clientes */
function insertarClientes($serviciosReferencias) { 
	$cuit = $_POST['cuit']; 
	$apellido = $_POST['apellido']; 
	$nombre = $_POST['nombre']; 
	$direccion = $_POST['direccion']; 
	$telefono = $_POST['telefono']; 
	$celular = $_POST['celular']; 
	$email = $_POST['email']; 
	
	$res = $serviciosReferencias->insertarClientes($cuit,$apellido,$nombre,$direccion,$telefono,$celular,$email); 
	
	if ((integer)$res > 0) { 
		echo ''; 
	} else { 
		echo 'Hubo un error al insertar datos';	 
	} 
} 


function modificarClientes($serviciosReferencias) { 
	$id = $_POST['id']; 
	$cuit = $_POST['cuit']; 
	$apellido = $_POST['apellido']; 
	$nombre = $_POST['nombre']; 
	$direccion = $_POST['direccion']; 
	$telefono = $_POST['telefono']; 
	$celular = $_POST['celular']; 
	$email = $_POST['email']; 
	
	$res = $serviciosReferencias->modificarClientes($id,$cuit,$apellido,$nombre,$direccion,$telefono,$celular,$email); 
	
	if ($res == true) { 
		echo ''; 
	} else { 
		echo 'Hubo un error al modificar datos'; 
	} 
} 


function modificarClientePorCliente($serviciosReferencias) { 
	$id = $_POST['id']; 
	$cuit = $_POST['cuit']; 
	$apellido = $_POST['apellido']; 
	$nombre = $_POST['nombre']; 
	$direccion = $_POST['direccion']; 
	$telefono = $_POST['telefono']; 
	$celular = $_POST['celular']; 
	
	if (($apellido == '') || ($nombre == '') || ($cuit == '')) {
		echo 'Hubo un error al modificar datos, los campos Apellido, Nombre y CUIT son obligatorios'; 
	} else {
		$res = $serviciosReferencias->modificarClientePorCliente($id,$cuit,$apellido,$nombre,$direccion,$telefono,$celular); 
		
		if ($res == true) { 
			echo ''; 
		} else { 
			echo 'Hubo un error al modificar datos'; 
		} 
	}
} 

function eliminarClientes($serviciosReferencias) { 
	$id = $_POST['id']; 
	$res = $serviciosReferencias->eliminarClientes($id); 
	echo $res; 
} 

/* Fin */ /* Fin de la Tabla: dbclientes*/
////////////////////////// FIN DE TRAER DATOS ////////////////////////////////////////////////////////////

//////////////////////////  BASICO  /////////////////////////////////////////////////////////////////////////

function toArray($query)
{
    $res = array();
    while ($row = @mysql_fetch_array($query)) {
        $res[] = $row;
    }
    return $res;
}


function entrar($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	echo $serviciosUsuarios->loginUsuario($email,$pass);
}


function cambiarSede($serviciosUsuarios) {
	$sede		=	$_POST['sede'];

	echo $serviciosUsuarios->cambiarSede($sede);
}


function registrar($serviciosUsuarios) {
	$usuario			=	$_POST['usuario'];
	$password			=	$_POST['password'];
	$refroll			=	$_POST['refroll'];
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombrecompleto'];
	
	$res = $serviciosUsuarios->insertarUsuario($usuario,$password,$refroll,$email,$nombre);
	if ((integer)$res > 0) {
		echo '';	
	} else {
		echo $res;	
	}
}

function recuperar($serviciosUsuarios) {
	$email		=		$_POST['email'];
	
	$res		=	$serviciosUsuarios->recuperar($email);
	
	echo $res;
}


function insertarUsuarios($serviciosReferencias) { 
	$usuario = $_POST['usuario']; 
	$password = $_POST['password']; 
	$refroles = $_POST['refroles']; 
	$email = $_POST['email']; 
	$nombrecompleto = $_POST['nombrecompleto']; 
	
	if (isset($_POST['activo'])) { 
		$activo	= 1; 
	} else { 
		$activo = 0; 
	} 

	$refclientes = ($_POST['refclientes'] == '' ? 0 : $_POST['refclientes']); 
	
	$res = $serviciosReferencias->insertarUsuarios($usuario,$password,$refroles,$email,$nombrecompleto,$activo,$refclientes); 
	
	if ((integer)$res > 0) { 
		echo ''; 
	} else { 
		echo 'Hubo un error al insertar datos ';	 
	} 
} 


function modificarUsuarios($serviciosReferencias) { 
	$id = $_POST['id']; 
	$usuario = $_POST['usuario']; 
	$password = $_POST['password']; 
	$refroles = $_POST['refroles']; 
	$email = $_POST['email']; 
	$nombrecompleto = $_POST['nombrecompleto']; 
	
	if (isset($_POST['activo'])) { 
		$activo	= 1; 
	} else { 
		$activo = 0; 
	} 

	$refclientes = ($_POST['refclientes'] == '' ? 0 : $_POST['refclientes']); 
	
	$res = $serviciosReferencias->modificarUsuarios($id,$usuario,$password,$refroles,$email,$nombrecompleto,$activo,$refclientes); 
	
	if ($res == true) { 
		echo ''; 
	} else { 
		echo 'Hubo un error al modificar datos'; 
	} 
} 

function eliminarUsuarios($serviciosReferencias) { 
	$id = $_POST['id']; 
	$res = $serviciosReferencias->eliminarUsuarios($id); 
	echo $res; 
} 

function enviarMail($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	
	echo $serviciosUsuarios->login($email,$pass);
}


function devolverImagen($nroInput) {
	
	if( $_FILES['archivo'.$nroInput]['name'] != null && $_FILES['archivo'.$nroInput]['size'] > 0 ){
	// Nivel de errores
	  error_reporting(E_ALL);
	  $altura = 100;
	  // Constantes
	  # Altura de el thumbnail en píxeles
	  //define("ALTURA", 100);
	  # Nombre del archivo temporal del thumbnail
	  //define("NAMETHUMB", "/tmp/thumbtemp"); //Esto en servidores Linux, en Windows podría ser:
	  //define("NAMETHUMB", "c:/windows/temp/thumbtemp"); //y te olvidas de los problemas de permisos
	  $NAMETHUMB = "c:/windows/temp/thumbtemp";
	  # Servidor de base de datos
	  //define("DBHOST", "localhost");
	  # nombre de la base de datos
	  //define("DBNAME", "portalinmobiliario");
	  # Usuario de base de datos
	  //define("DBUSER", "root");
	  # Password de base de datos
	  //define("DBPASSWORD", "");
	  // Mime types permitidos
	  $mimetypes = array("image/jpeg", "image/pjpeg", "image/gif", "image/png");
	  // Variables de la foto
	  $name = $_FILES["archivo".$nroInput]["name"];
	  $type = $_FILES["archivo".$nroInput]["type"];
	  $tmp_name = $_FILES["archivo".$nroInput]["tmp_name"];
	  $size = $_FILES["archivo".$nroInput]["size"];
	  // Verificamos si el archivo es una imagen válida
	  if(!in_array($type, $mimetypes))
		die("El archivo que subiste no es una imagen válida");
	  // Creando el thumbnail
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  $img = imagecreatefromjpeg($tmp_name);
		  break;
		case $mimetypes[2]:
		  $img = imagecreatefromgif($tmp_name);
		  break;
		case $mimetypes[3]:
		  $img = imagecreatefrompng($tmp_name);
		  break;
	  }
	  
	  $datos = getimagesize($tmp_name);
	  
	  $ratio = ($datos[1]/$altura);
	  $ancho = round($datos[0]/$ratio);
	  $thumb = imagecreatetruecolor($ancho, $altura);
	  imagecopyresized($thumb, $img, 0, 0, 0, 0, $ancho, $altura, $datos[0], $datos[1]);
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  imagejpeg($thumb, $NAMETHUMB);
			  break;
		case $mimetypes[2]:
		  imagegif($thumb, $NAMETHUMB);
		  break;
		case $mimetypes[3]:
		  imagepng($thumb, $NAMETHUMB);
		  break;
	  }
	  // Extrae los contenidos de las fotos
	  # contenido de la foto original
	  $fp = fopen($tmp_name, "rb");
	  $tfoto = fread($fp, filesize($tmp_name));
	  $tfoto = addslashes($tfoto);
	  fclose($fp);
	  # contenido del thumbnail
	  $fp = fopen($NAMETHUMB, "rb");
	  $tthumb = fread($fp, filesize($NAMETHUMB));
	  $tthumb = addslashes($tthumb);
	  fclose($fp);
	  // Borra archivos temporales si es que existen
	  //@unlink($tmp_name);
	  //@unlink(NAMETHUMB);
	} else {
		$tfoto = '';
		$type = '';
	}
	$tfoto = utf8_decode($tfoto);
	return array('tfoto' => $tfoto, 'type' => $type);	
}


?>