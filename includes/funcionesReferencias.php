<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosReferencias {


function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}


///**********  PARA SUBIR ARCHIVOS  ***********************//////////////////////////
	function borrarDirecctorio($dir) {
		array_map('unlink', glob($dir."/*.*"));	
	
	}
	
	function borrarArchivo($id,$archivo) {
		$sql	=	"delete from images where idfoto =".$id;
		
		$res =  unlink("./../archivos/".$archivo);
		if ($res)
		{
			$this->query($sql,0);	
		}
		return $res;
	}
	
	
	function existeArchivo($id,$nombre,$type) {
		$sql		=	"select * from images where refproyecto =".$id." and imagen = '".$nombre."' and type = '".$type."'";
		$resultado  =   $this->query($sql,0);
			   
			   if(mysql_num_rows($resultado)>0){
	
				   return mysql_result($resultado,0,0);
	
			   }
	
			   return 0;	
	}
	
	function sanear_string($string)
{
 
    $string = trim($string);
 
    $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );
 
    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );
 
    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );
 
    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );
 
    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );
 
    $string = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C',),
        $string
    );

    $string = str_replace(
        array('(', ')', '{', '}',' '),
        array('', '', '', '',''),
        $string
    );
 
 
 
    return $string;
}

function crearDirectorioPrincipal($dir) {
	if (!file_exists($dir)) {
		mkdir($dir, 0777);
	}
}


	function obtenerNuevoId($tabla) {
        //u235498999_aif
        $sql = "SELECT AUTO_INCREMENT FROM information_schema.TABLES
                WHERE TABLE_SCHEMA = 'u235498999_estud' 
                AND TABLE_NAME = '".$tabla."'";
        $res = $this->query($sql,0);
        return mysql_result($res, 0,0);
    }


	function subirArchivo($file,$carpeta,$id,$token,$observacion) {
		
		
		$dir_destino_padre = '../archivos/'.$carpeta.'/';
		$dir_destino = '../archivos/'.$carpeta.'/'.$id.'/';
		$imagen_subida = $dir_destino . $this->sanear_string(str_replace(' ','',basename($_FILES[$file]['name'])));
		
		$noentrar = '../imagenes/index.php';
		$nuevo_noentrar = '../archivos/'.$carpeta.'/'.$id.'/'.'index.php';
		
		//die(var_dump($dir_destino));
		if (!file_exists($dir_destino_padre)) {
			mkdir($dir_destino_padre, 0777);
		}

		if (!file_exists($dir_destino)) {
			mkdir($dir_destino, 0777);
		}
		
		 
		if(!is_writable($dir_destino)){
			
			echo "no tiene permisos";
			
		}	else	{
			if ($_FILES[$file]['tmp_name'] != '') {
				if(is_uploaded_file($_FILES[$file]['tmp_name'])){
					//la carpeta de libros solo los piso
					if ($carpeta == 'galeria') {
						$this->eliminarFotoPorObjeto($id);
					}
					/*echo "Archivo ". $_FILES['foto']['name'] ." subido con éxtio.\n";
					echo "Mostrar contenido\n";
					echo $imagen_subida;*/
					if (move_uploaded_file($_FILES[$file]['tmp_name'], $imagen_subida)) {
						
						$archivo = $this->sanear_string($_FILES[$file]["name"]);
						$tipoarchivo = $_FILES[$file]["type"];

						$filename = $dir_destino.'descarga.zip';
						$zip = new ZipArchive();

						if ($zip->open($filename, ZipArchive::CREATE) !== TRUE) {
						exit('cannot open <$filename>\n');
						}

						$zip->addFile($dir_destino.$archivo, $archivo);

						$zip->close();
						
						$this->insertarArchivos($carpeta,$token,str_replace(' ','',$archivo),$tipoarchivo, $observacion);

						echo "";
						
						copy($noentrar, $nuevo_noentrar);
		
					} else {
						echo "Posible ataque de carga de archivos!\n";
					}
				}else{
					echo "Posible ataque del archivo subido: ";
					echo "nombre del archivo '". $_FILES[$file]['tmp_name'] . "'.";
				}
			}
		}	
	}


	
	function TraerFotosRelacion($id) {
		$sql    =   "select 'galeria',s.idproducto,f.imagen,f.idfoto,f.type
							from dbproductos s
							
							inner
							join images f
							on	s.idproducto = f.refproyecto

							where s.idproducto = ".$id;
		$result =   $this->query($sql, 0);
		return $result;
	}
	
	
	function eliminarFoto($id)
	{
		
		$sql		=	"select concat('galeria','/',s.idproducto,'/',f.imagen) as archivo
							from dbproductos s
							
							inner
							join images f
							on	s.idproducto = f.refproyecto

							where f.idfoto =".$id;
		$resImg		=	$this->query($sql,0);
		
		if (mysql_num_rows($resImg)>0) {
			$res 		=	$this->borrarArchivo($id,mysql_result($resImg,0,0));
		} else {
			$res = true;
		}
		if ($res == false) {
			return 'Error al eliminar datos';
		} else {
			return '';
		}
	}
	
	function eliminarLibro($id)
	{
		
		$sql		=	"update dblibros set ruta = '' where idlibro =".$id;
		$res		=	$this->query($sql,0);
		
		if ($res == false) {
			return 'Error al eliminar datos';
		} else {
			return '';
		}
	}
	
	
	function eliminarFotoPorObjeto($id)
	{
		
		$sql		=	"select concat('galeria','/',s.idproducto,'/',f.imagen) as archivo,f.idfoto
							from dbproductos s
							
							inner
							join images f
							on	s.idproducto = f.refproyecto

							where s.idproducto =".$id;
		$resImg		=	$this->query($sql,0);
		
		if (mysql_num_rows($resImg)>0) {
			$res 		=	$this->borrarArchivo(mysql_result($resImg,0,1),mysql_result($resImg,0,0));
		} else {
			$res = true;
		}
		if ($res == false) {
			return 'Error al eliminar datos';
		} else {
			return '';
		}
	}

/* fin archivos */



function zerofill($valor, $longitud){
 $res = str_pad($valor, $longitud, '0', STR_PAD_LEFT);
 return $res;
}

function existeDevuelveId($sql) {

	$res = $this->query($sql,0);
	
	if (mysql_num_rows($res)>0) {
		return mysql_result($res,0,0);	
	}
	return 0;
}


function descargar($token) {
	session_start();

	if (isset($_SESSION['usua_predio'])) {

		$res = $this->traerArchivosPorToken($token);

		if (mysql_num_rows($res)>0) {
		    $file = '../archivos/'.mysql_result($res, 0,'refcliente').'/'.mysql_result($res, 0,'idarchivo').'/'.mysql_result($res, 0,'imagen');

		    header('Content-type: application/x-rar-compressed');
		    header('Content-length: ' . filesize($file));
		    readfile($file);
		} else {
			echo 'No existe el archivo o fue borrado';
		}

	} else {

	    echo 'No tienes permiso para la descarga';
	}
}



/* PARA Archivos */
function insertarArchivos($refclientes,$token,$imagen,$type,$observacion) { 
$sql = "insert into dbarchivos(idarchivo,refclientes,token,imagen,type,observacion) 
values ('',".$refclientes.",'".($token)."','".($imagen)."','".($type)."','".($observacion)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarArchivos($id,$refclientes,$token,$imagen,$type,$observacion) { 
$sql = "update dbarchivos 
set 
refclientes = ".$refclientes.",token = '".($token)."',imagen = '".($imagen)."',type = '".($type)."',observacion = '".($observacion)."' 
where idarchivo =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarArchivos($id) { 
$sql = "delete from dbarchivos where idarchivo =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerArchivos() { 
$sql = "select 
a.idarchivo,
a.refclientes,
a.token,
a.imagen,
a.type,
a.observacion
from dbarchivos a 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerArchivosPorId($id) { 
$sql = "select idarchivo,refclientes,token,imagen,type,observacion from dbarchivos where idarchivo =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerArchivosPorToken($token) { 
$sql = "select 
a.idarchivo,
a.refclientes,
a.token,
a.imagen,
a.type,
a.observacion
from dbarchivos a 
where token = '".$token."'"; 
$res = $this->query($sql,0); 
return $res; 
} 

function traerArchivosPorCliente($idcliente) {
	$sql = "select 
a.idarchivo,
a.observacion,
a.imagen,
a.refclientes,
a.token,
a.fechacreacion,
a.type
from dbarchivos a 
where refclientes = ".$idcliente; 
$res = $this->query($sql,0); 
return $res; 
}


/* Fin */
/* PARA Archivos */


/* PARA Images */

function insertarImages($refproyecto,$refuser,$imagen,$type,$principal) { 
$sql = "insert into images(idfoto,refproyecto,refuser,imagen,type,principal) 
values ('',".$refproyecto.",".$refuser.",'".($imagen)."','".($type)."',".$principal.")"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarImages($id,$refproyecto,$refuser,$imagen,$type,$principal) { 
$sql = "update images 
set 
refproyecto = ".$refproyecto.",refuser = ".$refuser.",imagen = '".($imagen)."',type = '".($type)."',principal = ".$principal." 
where idfoto =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarImages($id) { 
$sql = "delete from images where idfoto =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerImages() { 
$sql = "select 
i.idfoto,
i.refproyecto,
i.refuser,
i.imagen,
i.type,
i.principal
from images i 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerImagesPorId($id) { 
$sql = "select idfoto,refproyecto,refuser,imagen,type,principal from images where idfoto =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: images*/


/* PARA Estados */

function insertarEstados($estado) { 
$sql = "insert into tbestados(idestado,estado) 
values ('','".($estado)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarEstados($id,$estado) { 
$sql = "update tbestados 
set 
estado = '".($estado)."' 
where idestado =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarEstados($id) { 
$sql = "delete from tbestados where idestado =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerEstados() { 
$sql = "select 
e.idestado,
e.estado
from tbestados e 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerEstadosPorId($id) { 
$sql = "select idestado,estado from tbestados where idestado =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: tbestados*/


function nuevoBuscador($busqueda) { 
$sql = "select 
c.idcliente,
c.apellido,
c.nombre,
c.cuit
from dbclientes c 
where concat(c.apellido,' ',c.nombre,' ',c.cuit) like '%".$busqueda."%'
order by c.apellido,c.nombre
limit 15"; 
$res = $this->query($sql,0); 
return $res; 
} 



/* PARA Usuarios */

function insertarUsuarios($usuario,$password,$refroles,$email,$nombrecompleto,$activo) { 
$sql = "insert into dbusuarios(idusuario,usuario,password,refroles,email,nombrecompleto,activo) 
values ('','".($usuario)."','".($password)."',".$refroles.",'".($email)."','".($nombrecompleto)."',".$activo.")"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarUsuarios($id,$usuario,$password,$refroles,$email,$nombrecompleto,$activo) { 
$sql = "update dbusuarios 
set 
usuario = '".($usuario)."',password = '".($password)."',refroles = ".$refroles.",email = '".($email)."',nombrecompleto = '".($nombrecompleto)."',activo = ".$activo."
where idusuario =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarUsuarios($id) { 
$sql = "update dbusuarios set activo = '0' where idusuario =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerUsuarios() { 
$sql = "select 
u.idusuario,
u.usuario,
u.password,
u.refroles,
u.email,
u.nombrecompleto
from dbusuarios u 
inner join tbroles rol ON rol.idrol = u.refroles 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerUsuariosPorId($id) { 
$sql = "select idusuario,usuario,password,refroles,email,nombrecompleto,(case when activo = 1 then 'Si' else 'No' end) as activo from dbusuarios where idusuario =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: dbusuarios*/




/* PARA Predio_menu */

function insertarPredio_menu($url,$icono,$nombre,$Orden,$hover,$permiso) {
$sql = "insert into predio_menu(idmenu,url,icono,nombre,Orden,hover,permiso)
values ('','".($url)."','".($icono)."','".($nombre)."',".$Orden.",'".($hover)."','".($permiso)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarPredio_menu($id,$url,$icono,$nombre,$Orden,$hover,$permiso) {
$sql = "update predio_menu
set
url = '".($url)."',icono = '".($icono)."',nombre = '".($nombre)."',Orden = ".$Orden.",hover = '".($hover)."',permiso = '".($permiso)."'
where idmenu =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarPredio_menu($id) {
$sql = "delete from predio_menu where idmenu =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerPredio_menu() {
$sql = "select
p.idmenu,
p.url,
p.icono,
p.nombre,
p.Orden,
p.hover,
p.permiso
from predio_menu p
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerPredio_menuPorId($id) {
$sql = "select idmenu,url,icono,nombre,Orden,hover,permiso from predio_menu where idmenu =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: predio_menu*/



/* PARA Roles */

function insertarRoles($descripcion,$activo) {
$sql = "insert into tbroles(idrol,descripcion,activo)
values ('','".($descripcion)."',".$activo.")";
$res = $this->query($sql,1);
return $res;
}


function modificarRoles($id,$descripcion,$activo) {
$sql = "update tbroles
set
descripcion = '".($descripcion)."',activo = ".$activo."
where idrol =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarRoles($id) {
$sql = "delete from tbroles where idrol =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerRoles() {
$sql = "select
r.idrol,
r.descripcion,
r.activo
from tbroles r
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerRolesPorId($id) {
$sql = "select idrol,descripcion,activo from tbroles where idrol =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbroles*/



/* PARA Declaracionanualinteres */

function insertarDeclaracionanualinteres($refdeclaracionjuradacabecera,$essecretario,$esauditor,$ejercicio,$espublico,$refpoder,$registrofederalcontribuyente,$fechadeclaracionanterior,$fechatomaposesion,$cargoactual,$cargoanterior,$areaadquisicion,$areaadquisicionanterior,$dependencia,$dependenciaanterior) { 
	$sql = "insert into dbdeclaracionanualinteres(iddeclaracionanualinteres,refdeclaracionjuradacabecera,essecretario,esauditor,ejercicio,espublico,refpoder,registrofederalcontribuyente,fechadeclaracionanterior,fechatomaposesion,cargoactual,cargoanterior,areaadquisicion,areaadquisicionanterior,dependencia,dependenciaanterior) 
	values ('',".$refdeclaracionjuradacabecera.",".$essecretario.",".$esauditor.",".$ejercicio.",".$espublico.",".$refpoder.",'".($registrofederalcontribuyente)."','".($fechadeclaracionanterior == '' ? 'NULL' : "'".$fechadeclaracionanterior."'")."','".($fechatomaposesion == '' ? 'NULL' : "'".$fechatomaposesion."'")."','".($cargoactual)."','".($cargoanterior)."','".($areaadquisicion)."','".($areaadquisicionanterior)."','".($dependencia)."','".($dependenciaanterior)."')"; 
	$res = $this->query($sql,1); 
	return $res; 
	} 
	
	
	function modificarDeclaracionanualinteres($id,$refdeclaracionjuradacabecera,$essecretario,$esauditor,$ejercicio,$espublico,$refpoder,$registrofederalcontribuyente,$fechadeclaracionanterior,$fechatomaposesion,$cargoactual,$cargoanterior,$areaadquisicion,$areaadquisicionanterior,$dependencia,$dependenciaanterior) { 
	$sql = "update dbdeclaracionanualinteres 
	set 
	refdeclaracionjuradacabecera = ".$refdeclaracionjuradacabecera.",essecretario = ".$essecretario.",esauditor = ".$esauditor.",ejercicio = ".$ejercicio.",espublico = ".$espublico.",refpoder = ".$refpoder.",registrofederalcontribuyente = '".($registrofederalcontribuyente)."',fechadeclaracionanterior = ".($fechadeclaracionanterior == '' ? 'NULL' : "'".$fechadeclaracionanterior."'").",fechatomaposesion = ".($fechatomaposesion == '' ? 'NULL' : "'".$fechatomaposesion."'").",cargoactual = '".($cargoactual)."',cargoanterior = '".($cargoanterior)."',areaadquisicion = '".($areaadquisicion)."',areaadquisicionanterior = '".($areaadquisicionanterior)."',dependencia = '".($dependencia)."',dependenciaanterior = '".($dependenciaanterior)."' 
	where iddeclaracionanualinteres =".$id; 
	$res = $this->query($sql,0); 
	return $res; 
	} 
	
	
	function eliminarDeclaracionanualinteres($id) { 
	$sql = "delete from dbdeclaracionanualinteres where iddeclaracionanualinteres =".$id; 
	$res = $this->query($sql,0); 
	return $res; 
	} 
	
	
	function traerDeclaracionanualinteres() { 
	$sql = "select 
	d.iddeclaracionanualinteres,
	d.refdeclaracionjuradacabecera,
	(case when d.essecretario = 1 then 'Si' else 'No' end) as essecretario,
	(case when d.esauditor = 1 then 'Si' else 'No' end) as esauditor,
	d.ejercicio,
	(case when d.espublico = 1 then 'Si' else 'No' end) as espublico,
	d.refpoder,
	d.registrofederalcontribuyente,
	d.fechadeclaracionanterior,
	d.fechatomaposesion,
	d.cargoactual,
	d.cargoanterior,
	d.areaadquisicion,
	d.areaadquisicionanterior,
	d.dependencia,
	d.dependenciaanterior
	from dbdeclaracionanualinteres d 
	inner join tbpoder pod ON pod.idpoder = d.refpoder 
	inner join dbdeclaracionjuradacabecera dj on dj.iddeclaracionjuradacabecera = d.refdeclaracionjuradacabecera
	order by 1"; 
	$res = $this->query($sql,0); 
	return $res; 
	} 


	function traerDeclaracionanualinteresPorId($id) { 
	$sql = "select iddeclaracionanualinteres,refdeclaracionjuradacabecera
					,(case when essecretario = 1 then 'Si' else 'No' end) as essecretario
					,(case when esauditor = 1 then 'Si' else 'No' end) as esauditor
					,ejercicio
					,(case when espublico = 1 then 'Si' else 'No' end) as espublico
					,refpoder
					,registrofederalcontribuyente,fechadeclaracionanterior
					,fechatomaposesion,cargoactual,cargoanterior,areaadquisicion
					,areaadquisicionanterior,dependencia,dependenciaanterior 
				from dbdeclaracionanualinteres where iddeclaracionanualinteres =".$id; 
	$res = $this->query($sql,0); 
	return $res; 
	} 

	function traerDeclaracionanualinteresGrid() { 
		$sql = "select 
				d.iddeclaracionanualinteres,
				concat(dj.primerapellido, ' ', segundoapellido, ' ', nombres) as declaracioncabecera,
				(case when essecretario = 1 then 'Si' else 'No' end) as essecretario,
				(case when esauditor = 1 then 'Si' else 'No' end) as esauditor,
				d.ejercicio,
				(case when espublico = 1 then 'Si' else 'No' end) as espublico,
				pod.poder,
				d.registrofederalcontribuyente,
				d.fechadeclaracionanterior,
				d.fechatomaposesion,
				d.cargoactual,
				d.cargoanterior,
				d.areaadquisicion,
				d.areaadquisicionanterior,
				d.dependencia,
				d.dependenciaanterior,
				d.refdeclaracionjuradacabecera,
				d.refpoder
				from dbdeclaracionanualinteres d 
				inner join tbpoder pod ON pod.idpoder = d.refpoder 
				inner join dbdeclaracionjuradacabecera dj on dj.iddeclaracionjuradacabecera = d.refdeclaracionjuradacabecera
				order by 1"; 
		$res = $this->query($sql,0); 
		return $res; 
	}


	function traerDeclaracionanualinteresGridPorCabecera($id) { 
		$sql = "select 
				d.iddeclaracionanualinteres,
				concat(dj.primerapellido, ' ', segundoapellido, ' ', nombres) as declaracioncabecera,
				(case when essecretario = 1 then 'Si' else 'No' end) as essecretario,
				(case when esauditor = 1 then 'Si' else 'No' end) as esauditor,
				d.ejercicio,
				(case when espublico = 1 then 'Si' else 'No' end) as espublico,
				pod.poder,
				d.registrofederalcontribuyente,
				d.fechadeclaracionanterior,
				d.fechatomaposesion,
				d.cargoactual,
				d.cargoanterior,
				d.areaadquisicion,
				d.areaadquisicionanterior,
				d.dependencia,
				d.dependenciaanterior,
				d.refdeclaracionjuradacabecera,
				d.refpoder
				from dbdeclaracionanualinteres d 
				inner join tbpoder pod ON pod.idpoder = d.refpoder 
				inner join dbdeclaracionjuradacabecera dj on dj.iddeclaracionjuradacabecera = d.refdeclaracionjuradacabecera
				where dj.iddeclaracionjuradacabecera = ".$id."
				order by 1"; 
		$res = $this->query($sql,0); 
		return $res; 
	}


	function traerDeclaracionanualinteresGridPorUsuario($idUsuario) { 
		$sql = "select 
				d.iddeclaracionanualinteres,
				concat(dj.primerapellido, ' ', segundoapellido, ' ', nombres) as declaracioncabecera,
				(case when essecretario = 1 then 'Si' else 'No' end) as essecretario,
				(case when esauditor = 1 then 'Si' else 'No' end) as esauditor,
				d.ejercicio,
				(case when espublico = 1 then 'Si' else 'No' end) as espublico,
				pod.poder,
				d.registrofederalcontribuyente,
				d.fechadeclaracionanterior,
				d.fechatomaposesion,
				d.cargoactual,
				d.cargoanterior,
				d.areaadquisicion,
				d.areaadquisicionanterior,
				d.dependencia,
				d.dependenciaanterior,
				d.refdeclaracionjuradacabecera,
				d.refpoder
				from dbdeclaracionanualinteres d 
				inner join tbpoder pod ON pod.idpoder = d.refpoder 
				inner join dbdeclaracionjuradacabecera dj on dj.iddeclaracionjuradacabecera = d.refdeclaracionjuradacabecera
				where dj.refusuarios = ".$idUsuario."
				order by 1"; 
		$res = $this->query($sql,0); 
		return $res; 
	}


	function traerDeclaracionanualinteresPorCabeceraCURP($cabecera, $curp) { 
	$sql = "select 
	d.iddeclaracionanualinteres,
	d.refdeclaracionjuradacabecera,
	(case when d.essecretario = 1 then 'Si' else 'No' end) as essecretario,
	(case when d.esauditor = 1 then 'Si' else 'No' end) as esauditor,
	d.ejercicio,
	(case when d.espublico = 1 then 'Si' else 'No' end) as espublico,
	d.refpoder,
	d.registrofederalcontribuyente,
	d.fechadeclaracionanterior,
	d.fechatomaposesion,
	d.cargoactual,
	d.cargoanterior,
	d.areaadquisicion,
	d.areaadquisicionanterior,
	d.dependencia,
	d.dependenciaanterior
	from dbdeclaracionanualinteres d 
	inner join tbpoder pod ON pod.idpoder = d.refpoder 
	inner join dbdeclaracionjuradacabecera dj on dj.iddeclaracionjuradacabecera = d.refdeclaracionjuradacabecera
	where dj.curp = '".$curp."' and dj.iddeclaracionjuradacabecera = ".$cabecera."
	order by 1"; 
	$res = $this->query($sql,0); 
	return $res; 
	}
	
	/* Fin */
	/* /* Fin de la Tabla: dbdeclaracionanualinteres*/



	
/* PARA Dependienteseconomicos */

function insertarDependienteseconomicos($refdeclaracionjuradacabecera,$tiene,$nombre,$edad,$reftipoparentesco) { 
	$sql = "insert into dbdependienteseconomicos(iddependienteeconomico,refdeclaracionjuradacabecera,tiene,nombre,edad,reftipoparentesco) 
	values ('',".$refdeclaracionjuradacabecera.",".$tiene.",'".($nombre)."',".$edad.",".$reftipoparentesco.")"; 
	$res = $this->query($sql,1); 
	return $res; 
	} 
	
	
	function modificarDependienteseconomicos($id,$refdeclaracionjuradacabecera,$tiene,$nombre,$edad,$reftipoparentesco) { 
	$sql = "update dbdependienteseconomicos 
	set 
	refdeclaracionjuradacabecera = ".$refdeclaracionjuradacabecera.",tiene = ".$tiene.",nombre = '".($nombre)."',edad = ".$edad.",reftipoparentesco = ".$reftipoparentesco." 
	where iddependienteeconomico =".$id; 
	$res = $this->query($sql,0); 
	return $res; 
	} 
	
	
	function eliminarDependienteseconomicos($id) { 
	$sql = "delete from dbdependienteseconomicos where iddependienteeconomico =".$id; 
	$res = $this->query($sql,0); 
	return $res; 
	} 
	
	
	function traerDependienteseconomicos() { 
	$sql = "select 
	d.iddependienteeconomico,
	d.refdeclaracionjuradacabecera,
	d.tiene,
	d.nombre,
	d.edad,
	d.reftipoparentesco
	from dbdependienteseconomicos d 
	inner join dbdeclaracionjuradacabecera dj ON dj.iddeclaracionjuradacabecera = d.refdeclaracionjuradacabecera 
	inner join tbestadocivil es ON es.idestadocivil = dj.refestadocivil 
	inner join tbregimenmatrimonial re ON re.idregimenmatrimonial = dj.refregimenmatrimonial 
	inner join dbusuarios us ON us.idusuario = dj.refusuarios 
	inner join tbtipoparentesco tip ON tip.idtipoparentesco = d.reftipoparentesco 
	order by 1"; 
	$res = $this->query($sql,0); 
	return $res; 
	} 


	function traerDependienteseconomicosGrilla() { 
	$sql = "select 
	d.iddependienteeconomico,
	concat(dj.primerapellido, ' ', dj.segundoapellido, ' ', dj.nombres) as declaracioncabecera,
	d.tiene,
	d.nombre,
	d.edad,
	tip.tipoparentesco,
	d.refdeclaracionjuradacabecera,
	d.reftipoparentesco
	from dbdependienteseconomicos d 
	inner join dbdeclaracionjuradacabecera dj ON dj.iddeclaracionjuradacabecera = d.refdeclaracionjuradacabecera 
	inner join tbestadocivil es ON es.idestadocivil = dj.refestadocivil 
	inner join tbregimenmatrimonial re ON re.idregimenmatrimonial = dj.refregimenmatrimonial 
	inner join dbusuarios us ON us.idusuario = dj.refusuarios 
	inner join tbtipoparentesco tip ON tip.idtipoparentesco = d.reftipoparentesco 
	order by 1"; 
	$res = $this->query($sql,0); 
	return $res; 
	} 
	
	
	function traerDependienteseconomicosPorId($id) { 
	$sql = "select iddependienteeconomico,refdeclaracionjuradacabecera,tiene,nombre,edad,reftipoparentesco from dbdependienteseconomicos where iddependienteeconomico =".$id; 
	$res = $this->query($sql,0); 
	return $res; 
	} 

	function traerDependienteseconomicosPorCabeceraCURP($cabecera, $curp) { 
	$sql = "select 
	d.iddependienteeconomico,
	d.refdeclaracionjuradacabecera,
	d.tiene,
	d.nombre,
	d.edad,
	d.reftipoparentesco
	from dbdependienteseconomicos d 
	inner join dbdeclaracionjuradacabecera dj ON dj.iddeclaracionjuradacabecera = d.refdeclaracionjuradacabecera 
	inner join tbestadocivil es ON es.idestadocivil = dj.refestadocivil 
	inner join tbregimenmatrimonial re ON re.idregimenmatrimonial = dj.refregimenmatrimonial 
	inner join dbusuarios us ON us.idusuario = dj.refusuarios 
	inner join tbtipoparentesco tip ON tip.idtipoparentesco = d.reftipoparentesco 
	where dj.curp = '".$curp."' and dj.iddeclaracionjuradacabecera = ".$cabecera."
	order by 1"; 
	$res = $this->query($sql,0); 
	return $res; 
	} 


	
	
	/* Fin */
	/* /* Fin de la Tabla: dbdependienteseconomicos*/
	
	
	/* PARA Ingresosanuales */
	
	function insertarIngresosanuales($refdeclaracionjuradacabecera,$remuneracionanualneta,$actividadindustrial,$razonsocialactividadindustrial,$actividadfinanciera,$razonsocialactividadfinanciera,$actividadprofesional,$descripcionactividadprofesional,$otros,$especifiqueotros,$ingresoanualconyuge,$especifiqueingresosconyuge,$fueservidorpublico,$vigenciadesde,$vigenciahasta) { 
	$sql = "insert into dbingresosanuales(idingresoanual,refdeclaracionjuradacabecera,remuneracionanualneta,actividadindustrial,razonsocialactividadindustrial,actividadfinanciera,razonsocialactividadfinanciera,actividadprofesional,descripcionactividadprofesional,otros,especifiqueotros,ingresoanualconyuge,especifiqueingresosconyuge,fueservidorpublico,vigenciadesde,vigenciahasta) 
	values ('',".$refdeclaracionjuradacabecera.",".$remuneracionanualneta.",".$actividadindustrial.",'".($razonsocialactividadindustrial)."',".$actividadfinanciera.",'".($razonsocialactividadfinanciera)."',".$actividadprofesional.",'".($descripcionactividadprofesional)."',".$otros.",'".($especifiqueotros)."',".$ingresoanualconyuge.",'".($especifiqueingresosconyuge)."',".$fueservidorpublico.",'".($vigenciadesde == '' ? NULL : $vigenciadesde)."','".($vigenciahasta == '' ? NULL : $vigenciahasta)."')"; 
	$res = $this->query($sql,1); 

	return $res; 
	} 
	
	
	function modificarIngresosanuales($id,$refdeclaracionjuradacabecera,$remuneracionanualneta,$actividadindustrial,$razonsocialactividadindustrial,$actividadfinanciera,$razonsocialactividadfinanciera,$actividadprofesional,$descripcionactividadprofesional,$otros,$especifiqueotros,$ingresoanualconyuge,$especifiqueingresosconyuge,$fueservidorpublico,$vigenciadesde,$vigenciahasta) { 
	$sql = "update dbingresosanuales 
	set 
	refdeclaracionjuradacabecera = ".$refdeclaracionjuradacabecera.",remuneracionanualneta = ".$remuneracionanualneta.",actividadindustrial = ".$actividadindustrial.",razonsocialactividadindustrial = '".($razonsocialactividadindustrial)."',actividadfinanciera = ".$actividadfinanciera.",razonsocialactividadfinanciera = '".($razonsocialactividadfinanciera)."',actividadprofesional = ".$actividadprofesional.",descripcionactividadprofesional = '".($descripcionactividadprofesional)."',otros = ".$otros.",especifiqueotros = '".($especifiqueotros)."',ingresoanualconyuge = ".$ingresoanualconyuge.",especifiqueingresosconyuge = '".($especifiqueingresosconyuge)."',fueservidorpublico = ".$fueservidorpublico.",vigenciadesde = '".($vigenciadesde)."',vigenciahasta = '".($vigenciahasta)."' 
	where idingresoanual =".$id; 
	$res = $this->query($sql,0); 
	return $res; 
	} 

	function modificarVigencias($id) {
		$sql = "update dbingresosanuales 
				set 
				vigenciadesde = NULL,vigenciahasta = NULL
				where idingresoanual =".$id; 
		$res = $this->query($sql,0); 
		return $res; 
	}
	
	
	function eliminarIngresosanuales($id) { 
	$sql = "delete from dbingresosanuales where idingresoanual =".$id; 
	$res = $this->query($sql,0); 
	return $res; 
	} 
	
	
	function traerIngresosanuales() { 
	$sql = "select 
	i.idingresoanual,
	i.refdeclaracionjuradacabecera,
	i.remuneracionanualneta,
	i.actividadindustrial,
	i.razonsocialactividadindustrial,
	i.actividadfinanciera,
	i.razonsocialactividadfinanciera,
	i.actividadprofesional,
	i.descripcionactividadprofesional,
	i.otros,
	i.especifiqueotros,
	i.ingresoanualconyuge,
	i.especifiqueingresosconyuge,
	(case when i.fueservidorpublico = 1 then 'Si' else 'No' end) as fueservidorpublico,
	i.vigenciadesde,
	i.vigenciahasta
	from dbingresosanuales i 
	order by 1"; 
	$res = $this->query($sql,0); 
	return $res; 
	} 
	
	
	function traerIngresosanualesPorId($id) { 
	$sql = "select idingresoanual,refdeclaracionjuradacabecera,remuneracionanualneta,actividadindustrial,razonsocialactividadindustrial,actividadfinanciera,razonsocialactividadfinanciera,actividadprofesional,descripcionactividadprofesional,otros,especifiqueotros,ingresoanualconyuge,especifiqueingresosconyuge,(case when fueservidorpublico = 1 then 'Si' else 'No' end) as fueservidorpublico,vigenciadesde,vigenciahasta from dbingresosanuales where idingresoanual =".$id; 
	$res = $this->query($sql,0); 
	return $res; 
	} 


	function traerIngresosanualesGrilla() { 
	$sql = "select 
	i.idingresoanual,
	concat(dj.primerapellido, ' ', dj.segundoapellido, ' ', dj.nombres) as declaracioncabecera,
	i.remuneracionanualneta,
	i.remuneracionanualneta + i.actividadindustrial + i.actividadfinanciera + i.actividadprofesional + i.otros as neto,
	i.ingresoanualconyuge,
	i.remuneracionanualneta + i.actividadindustrial + i.actividadfinanciera + i.actividadprofesional + i.otros + i.ingresoanualconyuge as total,
	(case when i.fueservidorpublico = 1 then 'Si' else 'No' end) as fueservidorpublico,
	i.vigenciadesde,
	i.vigenciahasta,
	i.actividadindustrial,
	i.razonsocialactividadindustrial,
	i.actividadfinanciera,
	i.razonsocialactividadfinanciera,
	i.actividadprofesional,
	i.descripcionactividadprofesional,
	i.otros,
	i.especifiqueotros,
	i.especifiqueingresosconyuge,
	i.refdeclaracionjuradacabecera
	from dbingresosanuales i 
	inner join dbdeclaracionjuradacabecera dj ON dj.iddeclaracionjuradacabecera = i.refdeclaracionjuradacabecera 
	order by 1"; 
	$res = $this->query($sql,0); 
	return $res; 
	} 



	function traerIngresosanualesPorCabeceraCURP($cabecera, $curp) { 
		$sql = "select 
					i.idingresoanual,
					i.refdeclaracionjuradacabecera,
					i.remuneracionanualneta,
					i.actividadindustrial,
					i.razonsocialactividadindustrial,
					i.actividadfinanciera,
					i.razonsocialactividadfinanciera,
					i.actividadprofesional,
					i.descripcionactividadprofesional,
					i.otros,
					i.especifiqueotros,
					i.ingresoanualconyuge,
					i.especifiqueingresosconyuge,
					(case when i.fueservidorpublico = 1 then 'Si' else 'No' end) as fueservidorpublico,
					i.vigenciadesde,
					i.vigenciahasta
				from dbingresosanuales i 
				inner join dbdeclaracionjuradacabecera dj ON dj.iddeclaracionjuradacabecera = i.refdeclaracionjuradacabecera 
				where dj.curp = '".$curp."' and dj.iddeclaracionjuradacabecera = ".$cabecera."
				order by 1"; 
		$res = $this->query($sql,0); 
		return $res; 
	} 

	
	
	/* Fin */
	/* /* Fin de la Tabla: dbingresosanuales*/
	
	
	/* PARA Publicacion */
	
	function insertarPublicacion($refdeclaracionjuradacabecera,$estadeacuerdo,$eningresosnetos,$enbienesinmuebles,$enbienesmuebles,$envehiculos,$eninversiones,$enadeudos) { 
	$sql = "insert into dbpublicacion(idpublicacion,refdeclaracionjuradacabecera,estadeacuerdo,eningresosnetos,enbienesinmuebles,enbienesmuebles,envehiculos,eninversiones,enadeudos) 
	values ('',".$refdeclaracionjuradacabecera.",".$estadeacuerdo.",".$eningresosnetos.",".$enbienesinmuebles.",".$enbienesmuebles.",".$envehiculos.",".$eninversiones.",".$enadeudos.")"; 
	$res = $this->query($sql,1); 
	return $res; 
	} 
	
	
	function modificarPublicacion($id,$refdeclaracionjuradacabecera,$estadeacuerdo,$eningresosnetos,$enbienesinmuebles,$enbienesmuebles,$envehiculos,$eninversiones,$enadeudos) { 
	$sql = "update dbpublicacion 
	set 
	refdeclaracionjuradacabecera = ".$refdeclaracionjuradacabecera.",estadeacuerdo = ".$estadeacuerdo.",eningresosnetos = ".$eningresosnetos.",enbienesinmuebles = ".$enbienesinmuebles.",enbienesmuebles = ".$enbienesmuebles.",envehiculos = ".$envehiculos.",eninversiones = ".$eninversiones.",enadeudos = ".$enadeudos." 
	where idpublicacion =".$id; 
	$res = $this->query($sql,0); 
	return $res; 
	} 
	
	
	function eliminarPublicacion($id) { 
	$sql = "delete from dbpublicacion where idpublicacion =".$id; 
	$res = $this->query($sql,0); 
	return $res; 
	} 
	
	
	function traerPublicacion() { 
	$sql = "select 
	p.idpublicacion,
	p.refdeclaracionjuradacabecera,
	p.estadeacuerdo,
	p.eningresosnetos,
	p.enbienesinmuebles,
	p.enbienesmuebles,
	p.envehiculos,
	p.eninversiones,
	p.enadeudos
	from dbpublicacion p 
	order by 1"; 
	$res = $this->query($sql,0); 
	return $res; 
	} 
	
	
	function traerPublicacionPorId($id) { 
	$sql = "select idpublicacion,refdeclaracionjuradacabecera,
				(case when estadeacuerdo = 1 then 'Si' else 'No' end) as estadeacuerdo,
				(case when eningresosnetos = 1 then 'Si' else 'No' end) as eningresosnetos,
				(case when enbienesinmuebles = 1 then 'Si' else 'No' end) as enbienesinmuebles,
				(case when enbienesmuebles = 1 then 'Si' else 'No' end) as enbienesmuebles,
				(case when envehiculos = 1 then 'Si' else 'No' end) as envehiculos,
				(case when eninversiones = 1 then 'Si' else 'No' end) as eninversiones,
				(case when enadeudos = 1 then 'Si' else 'No' end) as enadeudos
				from dbpublicacion where idpublicacion =".$id; 
	$res = $this->query($sql,0); 
	return $res; 
	} 

	function traerPublicacionGrilla() {
		$sql = "select 
				p.idpublicacion,
				concat(dj.primerapellido, ' ', segundoapellido, ' ', nombres) as declaracioncabecera,
				(case when p.estadeacuerdo = 1 then 'Si' else 'No' end) as estadeacuerdo,
				(case when p.eningresosnetos = 1 then 'Si' else 'No' end) as eningresosnetos,
				(case when p.enbienesinmuebles = 1 then 'Si' else 'No' end) as enbienesinmuebles,
				(case when p.enbienesmuebles = 1 then 'Si' else 'No' end) as enbienesmuebles,
				(case when p.envehiculos = 1 then 'Si' else 'No' end) as envehiculos,
				(case when p.eninversiones = 1 then 'Si' else 'No' end) as eninversiones,
				(case when p.enadeudos = 1 then 'Si' else 'No' end) as enadeudos,
				p.refdeclaracionjuradacabecera
				from dbpublicacion p 
				inner join dbdeclaracionjuradacabecera dj on dj.iddeclaracionjuradacabecera = d.refdeclaracionjuradacabecera
				order by 1"; 
		$res = $this->query($sql,0); 
		return $res; 
	}


	function traerPublicacionGrillaPorCabecera($id) {
		$sql = "select 
				p.idpublicacion,
				concat(dj.primerapellido, ' ', segundoapellido, ' ', nombres) as declaracioncabecera,
				(case when p.estadeacuerdo = 1 then 'Si' else 'No' end) as estadeacuerdo,
				(case when p.eningresosnetos = 1 then 'Si' else 'No' end) as eningresosnetos,
				(case when p.enbienesinmuebles = 1 then 'Si' else 'No' end) as enbienesinmuebles,
				(case when p.enbienesmuebles = 1 then 'Si' else 'No' end) as enbienesmuebles,
				(case when p.envehiculos = 1 then 'Si' else 'No' end) as envehiculos,
				(case when p.eninversiones = 1 then 'Si' else 'No' end) as eninversiones,
				(case when p.enadeudos = 1 then 'Si' else 'No' end) as enadeudos,
				p.refdeclaracionjuradacabecera
				from dbpublicacion p 
				inner join dbdeclaracionjuradacabecera dj on dj.iddeclaracionjuradacabecera = p.refdeclaracionjuradacabecera
				where dj.iddeclaracionjuradacabecera = ".$id."
				order by 1"; 
		$res = $this->query($sql,0); 
		return $res; 
	}


	function traerPublicacionGrillaPorUsuario($idUsuario) {
		$sql = "select 
				p.idpublicacion,
				concat(dj.primerapellido, ' ', dj.segundoapellido, ' ', dj.nombres) as declaracioncabecera,
				(case when p.estadeacuerdo = 1 then 'Si' else 'No' end) as estadeacuerdo,
				(case when p.eningresosnetos = 1 then 'Si' else 'No' end) as eningresosnetos,
				(case when p.enbienesinmuebles = 1 then 'Si' else 'No' end) as enbienesinmuebles,
				(case when p.enbienesmuebles = 1 then 'Si' else 'No' end) as enbienesmuebles,
				(case when p.envehiculos = 1 then 'Si' else 'No' end) as envehiculos,
				(case when p.eninversiones = 1 then 'Si' else 'No' end) as eninversiones,
				(case when p.enadeudos = 1 then 'Si' else 'No' end) as enadeudos,
				p.refdeclaracionjuradacabecera
				from dbpublicacion p 
				inner join dbdeclaracionjuradacabecera dj on dj.iddeclaracionjuradacabecera = p.refdeclaracionjuradacabecera
				where dj.refusuarios = ".$idUsuario."
				order by 1"; 
		$res = $this->query($sql,0); 
		return $res; 
	}


	function traerPublicacionPorCabeceraCURP($cabecera, $curp) { 
	$sql = "select 
	p.idpublicacion,
	p.refdeclaracionjuradacabecera,
	(case when p.estadeacuerdo = 1 then 'Si' else 'No' end) as estadeacuerdo,
	(case when p.eningresosnetos = 1 then 'Si' else 'No' end) as eningresosnetos,
	(case when p.enbienesinmuebles = 1 then 'Si' else 'No' end) as enbienesinmuebles,
	(case when p.enbienesmuebles = 1 then 'Si' else 'No' end) as enbienesmuebles,
	(case when p.envehiculos = 1 then 'Si' else 'No' end) as envehiculos,
	(case when p.eninversiones = 1 then 'Si' else 'No' end) as eninversiones,
	(case when p.enadeudos = 1 then 'Si' else 'No' end) as enadeudos
	from dbpublicacion p 
	inner join dbdeclaracionjuradacabecera dj on dj.iddeclaracionjuradacabecera = p.refdeclaracionjuradacabecera
	where dj.curp = '".$curp."' and dj.iddeclaracionjuradacabecera = ".$cabecera."
	order by 1"; 
	$res = $this->query($sql,0); 
	return $res; 
	} 
	
	
		
	/* Fin */
	/* /* Fin de la Tabla: dbpublicacion*/



	
/* PARA Poder */

function insertarPoder($poder) { 
	$sql = "insert into tbpoder(idpoder,poder) 
	values ('','".($poder)."')"; 
	$res = $this->query($sql,1); 
	return $res; 
	} 
	
	
	function modificarPoder($id,$poder) { 
	$sql = "update tbpoder 
	set 
	poder = '".($poder)."' 
	where idpoder =".$id; 
	$res = $this->query($sql,0); 
	return $res; 
	} 
	
	
	function eliminarPoder($id) { 
	$sql = "delete from tbpoder where idpoder =".$id; 
	$res = $this->query($sql,0); 
	return $res; 
	} 
	
	
	function traerPoder() { 
	$sql = "select 
	p.idpoder,
	p.poder
	from tbpoder p 
	order by 1"; 
	$res = $this->query($sql,0); 
	return $res; 
	} 
	
	
	function traerPoderPorId($id) { 
	$sql = "select idpoder,poder from tbpoder where idpoder =".$id; 
	$res = $this->query($sql,0); 
	return $res; 
	} 
	
	/* Fin */
	/* /* Fin de la Tabla: tbpoder*/



	
/* PARA Tipoparentesco */

function insertarTipoparentesco($tipoparentesco) { 
	$sql = "insert into tbtipoparentesco(idtipoparentesco,tipoparentesco) 
	values ('','".($tipoparentesco)."')"; 
	$res = $this->query($sql,1); 
	return $res; 
	} 
	
	
	function modificarTipoparentesco($id,$tipoparentesco) { 
	$sql = "update tbtipoparentesco 
	set 
	tipoparentesco = '".($tipoparentesco)."' 
	where idtipoparentesco =".$id; 
	$res = $this->query($sql,0); 
	return $res; 
	} 
	
	
	function eliminarTipoparentesco($id) { 
	$sql = "delete from tbtipoparentesco where idtipoparentesco =".$id; 
	$res = $this->query($sql,0); 
	return $res; 
	} 
	
	
	function traerTipoparentesco() { 
	$sql = "select 
	t.idtipoparentesco,
	t.tipoparentesco
	from tbtipoparentesco t 
	order by 1"; 
	$res = $this->query($sql,0); 
	return $res; 
	} 
	
	
	function traerTipoparentescoPorId($id) { 
	$sql = "select idtipoparentesco,tipoparentesco from tbtipoparentesco where idtipoparentesco =".$id; 
	$res = $this->query($sql,0); 
	return $res; 
	} 
	
	/* Fin */
	/* /* Fin de la Tabla: tbtipoparentesco*/





/* PARA Declaracionjuradacabecera */

function traerAgenteReal($curp) {
	$sql = "SELECT 
			    empleado_id,
			    nombre,
			    paterno,
			    materno,
			    sexo,
			    curp,
			    rfc,
			    id_identificacion,
			    expide_ident,
			    no_ident,
			    edad,
			    telefono,
			    celular,
			    email,
			    domicilio_lab,
			    domicilio_entrega,
			    domicilio_particular,
			    departamento_id,
			    puesto_id,
			    fecha_inicio,
			    fecha_fin,
			    fecha_entraga,
			    clasificacion,
			    pass_user,
			    id_perfil
			FROM loginreal 
			where curp = '".$curp."'";
	$res = $this->query($sql,0); 
	return $res; 
}

function insertarDeclaracionjuradacabecera($fecharecepcion,$primerapellido,$segundoapellido,$nombres,$curp,$homoclave,$rfc,$emailinstitucional,$emailalterno,$refestadocivil,$refregimenmatrimonial,$paisnacimiento,$nacionalidad,$entidadnacimiento,$numerocelular,$lugarubica,$domicilioparticular,$localidad,$municipio,$telefono,$entidadfederativa,$codigopostal,$lada,$sexo,$estudios,$cedulaprofesional,$refusuarios) { 
$sql = "insert into dbdeclaracionjuradacabecera(iddeclaracionjuradacabecera,fecharecepcion,primerapellido,segundoapellido,nombres,curp,homoclave,rfc,emailinstitucional,emailalterno,refestadocivil,refregimenmatrimonial,paisnacimiento,nacionalidad,entidadnacimiento,numerocelular,lugarubica,domicilioparticular,localidad,municipio,telefono,entidadfederativa,codigopostal,lada,sexo,estudios,cedulaprofesional,refusuarios, refestados) 
values ('','".($fecharecepcion)."','".($primerapellido)."','".($segundoapellido)."','".($nombres)."','".($curp)."','".($homoclave)."','".($rfc)."','".($emailinstitucional)."','".($emailalterno)."',".$refestadocivil.",".$refregimenmatrimonial.",'".($paisnacimiento)."','".($nacionalidad)."','".($entidadnacimiento)."','".($numerocelular)."',".$lugarubica.",'".($domicilioparticular)."','".($localidad)."','".($municipio)."','".($telefono)."','".($entidadfederativa)."','".($codigopostal)."','".($lada)."',".$sexo.",'".($estudios)."','".($cedulaprofesional)."',".$refusuarios.", 1)"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarDeclaracionjuradacabecera($id,$fecharecepcion,$primerapellido,$segundoapellido,$nombres,$curp,$homoclave,$rfc,$emailinstitucional,$emailalterno,$refestadocivil,$refregimenmatrimonial,$paisnacimiento,$nacionalidad,$entidadnacimiento,$numerocelular,$lugarubica,$domicilioparticular,$localidad,$municipio,$telefono,$entidadfederativa,$codigopostal,$lada,$sexo,$estudios,$cedulaprofesional,$refusuarios, $refestados) { 
$sql = "update dbdeclaracionjuradacabecera 
set 
fecharecepcion = '".($fecharecepcion)."',primerapellido = '".($primerapellido)."',segundoapellido = '".($segundoapellido)."',
nombres = '".($nombres)."',curp = '".($curp)."',homoclave = '".($homoclave)."',rfc = '".($rfc)."',emailinstitucional = '".($emailinstitucional)."',emailalterno = '".($emailalterno)."',refestadocivil = ".$refestadocivil.",refregimenmatrimonial = ".$refregimenmatrimonial.",paisnacimiento = '".($paisnacimiento)."',nacionalidad = '".($nacionalidad)."',
entidadnacimiento = '".($entidadnacimiento)."',numerocelular = '".($numerocelular)."',
lugarubica = ".$lugarubica.",domicilioparticular = '".($domicilioparticular)."',localidad = '".($localidad)."',
municipio = '".($municipio)."',telefono = '".($telefono)."',entidadfederativa = '".($entidadfederativa)."',
codigopostal = '".($codigopostal)."',lada = '".($lada)."',sexo = ".$sexo.",estudios = '".($estudios)."',
cedulaprofesional = '".($cedulaprofesional)."',refusuarios = ".$refusuarios.", refestados = ".$refestados." 
where iddeclaracionjuradacabecera =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarDeclaracionjuradacabecera($id) { 
$sql = "delete from dbdeclaracionjuradacabecera where iddeclaracionjuradacabecera =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 



function traerDeclaracionjuradacabecera() { 
$sql = "select 
d.iddeclaracionjuradacabecera,
d.fecharecepcion,
d.primerapellido,
d.segundoapellido,
d.nombres,
d.curp,
d.homoclave,
d.rfc,
d.emailinstitucional,
d.emailalterno,
d.refestadocivil,
d.refregimenmatrimonial,
d.paisnacimiento,
d.nacionalidad,
d.entidadnacimiento,
d.numerocelular,
d.lugarubica,
d.domicilioparticular,
d.localidad,
d.municipio,
d.telefono,
d.entidadfederativa,
d.codigopostal,
d.lada,
d.sexo,
d.estudios,
d.cedulaprofesional,
d.refusuarios
from dbdeclaracionjuradacabecera d 
inner join tbestadocivil est ON est.idestadocivil = d.refestadocivil 
inner join tbregimenmatrimonial reg ON reg.idregimenmatrimonial = d.refregimenmatrimonial 
inner join dbusuarios usu ON usu.idusuario = d.refusuarios 
inner join tbroles ro ON ro.idrol = usu.refroles 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerDeclaracionjuradacabeceraPorId($id) { 
$sql = "select iddeclaracionjuradacabecera,fecharecepcion,primerapellido,segundoapellido,nombres,curp,homoclave,rfc,emailinstitucional,emailalterno,refestadocivil,refregimenmatrimonial,paisnacimiento,nacionalidad,entidadnacimiento,numerocelular,lugarubica,domicilioparticular,localidad,municipio,telefono,entidadfederativa,codigopostal,lada,sexo,estudios,cedulaprofesional,refusuarios, refestados from dbdeclaracionjuradacabecera where iddeclaracionjuradacabecera =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 



function traerDeclaracionjuradacabeceraGrilla() {
	$sql = "select 
				d.iddeclaracionjuradacabecera,
				concat(d.primerapellido, ' ', d.segundoapellido) as apellidos,
				d.nombres,
				d.curp,
				d.fecharecepcion,
				d.telefono,
				et.estado
			from dbdeclaracionjuradacabecera d 
			inner join tbestadocivil est ON est.idestadocivil = d.refestadocivil 
			inner join tbregimenmatrimonial reg ON reg.idregimenmatrimonial = d.refregimenmatrimonial 
			inner join dbusuarios usu ON usu.idusuario = d.refusuarios 
			inner join tbroles ro ON ro.idrol = usu.refroles 
			inner join tbestados et on et.idestado = d.refestados
			order by 1"; 
	$res = $this->query($sql,0); 
	return $res; 
}



function traerDeclaracionjuradacabeceraGrillaPorCURP($curp) {
	$sql = "select 
				d.iddeclaracionjuradacabecera,
				concat(d.primerapellido, ' ', d.segundoapellido) as apellidos,
				d.nombres,
				d.curp,
				d.fecharecepcion,
				d.emailinstitucional,
				et.estado
			from dbdeclaracionjuradacabecera d 
			inner join tbestadocivil est ON est.idestadocivil = d.refestadocivil 
			inner join tbregimenmatrimonial reg ON reg.idregimenmatrimonial = d.refregimenmatrimonial 
			inner join dbusuarios usu ON usu.idusuario = d.refusuarios 
			inner join tbroles ro ON ro.idrol = usu.refroles 
			inner join tbestados et on et.idestado = d.refestados
			where d.curp = '".$curp."'
			order by 1"; 
	$res = $this->query($sql,0); 
	return $res; 
}

/* Fin */
/* /* Fin de la Tabla: dbdeclaracionjuradacabecera*/



/* PARA Estadocivil */

function insertarEstadocivil($estadocivil) { 
$sql = "insert into tbestadocivil(idestadocivil,estadocivil) 
values ('','".($estadocivil)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarEstadocivil($id,$estadocivil) { 
$sql = "update tbestadocivil 
set 
estadocivil = '".($estadocivil)."' 
where idestadocivil =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarEstadocivil($id) { 
$sql = "delete from tbestadocivil where idestadocivil =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerEstadocivil() { 
$sql = "select 
e.idestadocivil,
e.estadocivil
from tbestadocivil e 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerEstadocivilPorId($id) { 
$sql = "select idestadocivil,estadocivil from tbestadocivil where idestadocivil =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: tbestadocivil*/


/* PARA Regimenmatrimonial */

function insertarRegimenmatrimonial($regimenmatrimonial) { 
$sql = "insert into tbregimenmatrimonial(idregimenmatrimonial,regimenmatrimonial) 
values ('','".($regimenmatrimonial)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarRegimenmatrimonial($id,$regimenmatrimonial) { 
$sql = "update tbregimenmatrimonial 
set 
regimenmatrimonial = '".($regimenmatrimonial)."' 
where idregimenmatrimonial =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarRegimenmatrimonial($id) { 
$sql = "delete from tbregimenmatrimonial where idregimenmatrimonial =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerRegimenmatrimonial() { 
$sql = "select 
r.idregimenmatrimonial,
r.regimenmatrimonial
from tbregimenmatrimonial r 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerRegimenmatrimonialPorId($id) { 
$sql = "select idregimenmatrimonial,regimenmatrimonial from tbregimenmatrimonial where idregimenmatrimonial =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: tbregimenmatrimonial*/



/* PARA Bienesinmuebles */

function insertarBienesinmuebles($refdeclaracionjuradacabecera,$reftipooperacion,$reftipobien,$refotrotipobien,$mtrsterreno,$mtrsconstruccion,$refformaadquisicion,$cesionario,$reftitular,$reftipocesionario,$otrotipocesionario,$valor,$tipomoneda,$fechaadquisicion,$registropublico,$ubicacion,$especificacionobra,$especificacionventa) { 
$sql = "insert into dbbienesinmuebles(idbieninmueble,refdeclaracionjuradacabecera,reftipooperacion,reftipobien,refotrotipobien,mtrsterreno,mtrsconstruccion,refformaadquisicion,cesionario,reftitular,reftipocesionario,otrotipocesionario,valor,tipomoneda,fechaadquisicion,registropublico,ubicacion,especificacionobra,especificacionventa) 
values ('',".$refdeclaracionjuradacabecera.",".$reftipooperacion.",".$reftipobien.",".$refotrotipobien.",".($mtrsterreno == '' ? 'NULL' : $mtrsterreno).",".($mtrsconstruccion == '' ? 'NULL' : $mtrsconstruccion).",".$refformaadquisicion.",'".($cesionario)."',".$reftitular.",".$reftipocesionario.",'".($otrotipocesionario)."',".($valor == '' ? 'NULL' : $valor).",'".($tipomoneda)."','".($fechaadquisicion)."','".($registropublico)."','".($ubicacion)."','".($especificacionobra)."','".($especificacionventa)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarBienesinmuebles($id,$refdeclaracionjuradacabecera,$reftipooperacion,$reftipobien,$refotrotipobien,$mtrsterreno,$mtrsconstruccion,$refformaadquisicion,$cesionario,$reftitular,$reftipocesionario,$otrotipocesionario,$valor,$tipomoneda,$fechaadquisicion,$registropublico,$ubicacion,$especificacionobra,$especificacionventa) { 
$sql = "update dbbienesinmuebles 
set 
refdeclaracionjuradacabecera = ".$refdeclaracionjuradacabecera.",reftipooperacion = ".$reftipooperacion.",reftipobien = ".$reftipobien.",refotrotipobien = ".$refotrotipobien.",mtrsterreno = ".($mtrsterreno == '' ? 'NULL' : $mtrsterreno).",mtrsconstruccion = ".($mtrsconstruccion == '' ? 'NULL' : $mtrsconstruccion).",refformaadquisicion = ".$refformaadquisicion.",cesionario = '".($cesionario)."',reftitular = ".$reftitular.",reftipocesionario = ".$reftipocesionario.",otrotipocesionario = '".($otrotipocesionario)."',valor = ".($valor == '' ? 'NULL' : $valor).",tipomoneda = '".($tipomoneda)."',fechaadquisicion = '".($fechaadquisicion)."',registropublico = '".($registropublico)."',ubicacion = '".($ubicacion)."',especificacionobra = '".($especificacionobra)."',especificacionventa = '".($especificacionventa)."' 
where idbieninmueble =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarBienesinmuebles($id) { 
$sql = "delete from dbbienesinmuebles where idbieninmueble =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerBienesinmuebles() { 
$sql = "select 
b.idbieninmueble,
b.refdeclaracionjuradacabecera,
b.reftipooperacion,
b.reftipobien,
b.refotrotipobien,
b.mtrsterreno,
b.mtrsconstruccion,
b.refformaadquisicion,
b.cesionario,
b.reftitular,
b.reftipocesionario,
b.otrotipocesionario,
b.valor,
b.tipomoneda,
b.fechaadquisicion,
b.registropublico,
b.ubicacion,
b.especificacionobra,
b.especificacionventa
from dbbienesinmuebles b 
inner join dbdeclaracionjuradacabecera dj ON dj.iddeclaracionjuradacabecera = b.refdeclaracionjuradacabecera 
inner join tbestadocivil es ON es.idestadocivil = dj.refestadocivil 
inner join tbregimenmatrimonial re ON re.idregimenmatrimonial = dj.refregimenmatrimonial 
inner join dbusuarios us ON us.idusuario = dj.refusuarios 
inner join tbtipooperacion tiop ON tiop.idtipooperacion = b.reftipooperacion 
inner join tbtipobien tb ON tb.idtipobien = b.reftipobien 
inner join tbotrotipobien otr ON otr.idotrotipobien = b.refotrotipobien 
inner join tbformaadquisicion fa ON fa.idformaadquisicion = b.refformaadquisicion 
inner join tbtitular tit ON tit.idtitular = b.reftitular 
inner join tbtipocesionario tc ON tc.idtipocesionario = b.reftipocesionario 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerBienesinmueblesPorId($id) { 
$sql = "select idbieninmueble,refdeclaracionjuradacabecera,reftipooperacion,reftipobien,refotrotipobien,mtrsterreno,mtrsconstruccion,refformaadquisicion,cesionario,reftitular,reftipocesionario,otrotipocesionario,valor,tipomoneda,fechaadquisicion,registropublico,ubicacion,especificacionobra,especificacionventa from dbbienesinmuebles where idbieninmueble =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 



function traerBienesinmueblesGridPorCabecera($cabecera) { 
$sql = "select 
b.idbieninmueble,
tiop.tipooperacion,
tb.tipobien,
otr.otrotipobien,
b.mtrsterreno,
b.mtrsconstruccion,
fa.formaadquisicion,
b.valor,
b.tipomoneda,
b.fechaadquisicion,
b.cesionario,
b.otrotipocesionario,
b.registropublico,
b.ubicacion,
b.especificacionobra,
b.especificacionventa,
b.refdeclaracionjuradacabecera,
b.reftipooperacion,
b.reftipobien,
b.reftitular,
b.reftipocesionario,
b.refformaadquisicion,
b.refotrotipobien
from dbbienesinmuebles b 
inner join dbdeclaracionjuradacabecera dj ON dj.iddeclaracionjuradacabecera = b.refdeclaracionjuradacabecera 
inner join tbestadocivil es ON es.idestadocivil = dj.refestadocivil 
inner join tbregimenmatrimonial re ON re.idregimenmatrimonial = dj.refregimenmatrimonial 
inner join dbusuarios us ON us.idusuario = dj.refusuarios 
inner join tbtipooperacion tiop ON tiop.idtipooperacion = b.reftipooperacion 
inner join tbtipobien tb ON tb.idtipobien = b.reftipobien 
inner join tbotrotipobien otr ON otr.idotrotipobien = b.refotrotipobien 
inner join tbformaadquisicion fa ON fa.idformaadquisicion = b.refformaadquisicion 
inner join tbtitular tit ON tit.idtitular = b.reftitular 
inner join tbtipocesionario tc ON tc.idtipocesionario = b.reftipocesionario 
where dj.iddeclaracionjuradacabecera = ".$cabecera."
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerBienesinmueblesPorCabeceraCURP($cabecera, $curp) { 
$sql = "select 
b.idbieninmueble,
b.refdeclaracionjuradacabecera,
b.reftipooperacion,
b.reftipobien,
b.refotrotipobien,
b.mtrsterreno,
b.mtrsconstruccion,
b.refformaadquisicion,
b.cesionario,
b.reftitular,
b.reftipocesionario,
b.otrotipocesionario,
b.valor,
b.tipomoneda,
b.fechaadquisicion,
b.registropublico,
b.ubicacion,
b.especificacionobra,
b.especificacionventa
from dbbienesinmuebles b 
inner join dbdeclaracionjuradacabecera dj ON dj.iddeclaracionjuradacabecera = b.refdeclaracionjuradacabecera 
inner join tbestadocivil es ON es.idestadocivil = dj.refestadocivil 
inner join tbregimenmatrimonial re ON re.idregimenmatrimonial = dj.refregimenmatrimonial 
inner join dbusuarios us ON us.idusuario = dj.refusuarios 
inner join tbtipooperacion tiop ON tiop.idtipooperacion = b.reftipooperacion 
inner join tbtipobien tb ON tb.idtipobien = b.reftipobien 
inner join tbotrotipobien otr ON otr.idotrotipobien = b.refotrotipobien 
inner join tbformaadquisicion fa ON fa.idformaadquisicion = b.refformaadquisicion 
inner join tbtitular tit ON tit.idtitular = b.reftitular 
inner join tbtipocesionario tc ON tc.idtipocesionario = b.reftipocesionario 
where dj.curp = '".$curp."' and dj.iddeclaracionjuradacabecera = ".$cabecera."
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 



/* Fin */
/* /* Fin de la Tabla: dbbienesinmuebles*/


/* PARA Bienesmuebles */

function insertarBienesmuebles($refdeclaracionjuradacabecera,$reftipooperacion,$reftipobien,$descripcion,$refformaadquisicion,$cesionario,$reftipocesionario,$otrotipocesionario,$valor,$tipomoneda,$fechaadquisicion,$reftitular,$especificacionventa) { 
$sql = "insert into dbbienesmuebles(idbienmueble,refdeclaracionjuradacabecera,reftipooperacion,reftipobien,descripcion,refformaadquisicion,cesionario,reftipocesionario,otrotipocesionario,valor,tipomoneda,fechaadquisicion,reftitular,especificacionventa) 
values ('',".$refdeclaracionjuradacabecera.",".$reftipooperacion.",".$reftipobien.",'".($descripcion)."',".$refformaadquisicion.",'".($cesionario)."',".$reftipocesionario.",'".($otrotipocesionario)."',".$valor.",'".($tipomoneda)."','".($fechaadquisicion)."',".$reftitular.",'".($especificacionventa)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarBienesmuebles($id,$refdeclaracionjuradacabecera,$reftipooperacion,$reftipobien,$descripcion,$refformaadquisicion,$cesionario,$reftipocesionario,$otrotipocesionario,$valor,$tipomoneda,$fechaadquisicion,$reftitular,$especificacionventa) { 
$sql = "update dbbienesmuebles 
set 
refdeclaracionjuradacabecera = ".$refdeclaracionjuradacabecera.",reftipooperacion = ".$reftipooperacion.",reftipobien = ".$reftipobien.",descripcion = '".($descripcion)."',refformaadquisicion = ".$refformaadquisicion.",cesionario = '".($cesionario)."',reftipocesionario = ".$reftipocesionario.",otrotipocesionario = '".($otrotipocesionario)."',valor = ".$valor.",tipomoneda = '".($tipomoneda)."',fechaadquisicion = '".($fechaadquisicion)."',reftitular = ".$reftitular.",especificacionventa = '".($especificacionventa)."' 
where idbienmueble =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarBienesmuebles($id) { 
$sql = "delete from dbbienesmuebles where idbienmueble =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerBienesmuebles() { 
$sql = "select 
b.idbienmueble,
b.refdeclaracionjuradacabecera,
b.reftipooperacion,
b.reftipobien,
b.descripcion,
b.refformaadquisicion,
b.cesionario,
b.reftipocesionario,
b.otrotipocesionario,
b.valor,
b.tipomoneda,
b.fechaadquisicion,
b.reftitular,
b.especificacionventa
from dbbienesmuebles b 
inner join dbdeclaracionjuradacabecera dj ON dj.iddeclaracionjuradacabecera = b.refdeclaracionjuradacabecera 
inner join tbestadocivil es ON es.idestadocivil = dj.refestadocivil 
inner join tbregimenmatrimonial re ON re.idregimenmatrimonial = dj.refregimenmatrimonial 
inner join dbusuarios us ON us.idusuario = dj.refusuarios 
inner join tbtipooperacion tiop ON tiop.idtipooperacion = b.reftipooperacion 
inner join tbtipobien tipb ON tipb.idtipobien = b.reftipobien 
inner join tbformaadquisicion fr ON fr.idformaadquisicion = b.refformaadquisicion 
inner join tbtipocesionario tipc ON tipc.idtipocesionario = b.reftipocesionario 
inner join tbtitular tit ON tit.idtitular = b.reftitular 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerBienesmueblesPorId($id) { 
$sql = "select idbienmueble,refdeclaracionjuradacabecera,reftipooperacion,reftipobien,descripcion,refformaadquisicion,cesionario,reftipocesionario,otrotipocesionario,valor,tipomoneda,fechaadquisicion,reftitular,especificacionventa from dbbienesmuebles where idbienmueble =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerBienesmueblesGridPorCabecera($cabecera) { 
$sql = "select 
b.idbienmueble,
concat(dj.primerapellido, ' ', dj.segundoapellido, ' ', dj.nombres) as declaracioncabecera,
tiop.tipooperacion,
tipb.tipobien,
b.descripcion,
fr.formaadquisicion,
b.valor,
b.tipomoneda,
b.fechaadquisicion,
b.cesionario,
tipc.tipocesionario,
b.otrotipocesionario,
tit.titular,
b.especificacionventa,
b.refdeclaracionjuradacabecera,
b.reftipooperacion,
b.reftipobien,
b.refformaadquisicion,
b.reftipocesionario,
b.reftitular
from dbbienesmuebles b 
inner join dbdeclaracionjuradacabecera dj ON dj.iddeclaracionjuradacabecera = b.refdeclaracionjuradacabecera 
inner join tbestadocivil es ON es.idestadocivil = dj.refestadocivil 
inner join tbregimenmatrimonial re ON re.idregimenmatrimonial = dj.refregimenmatrimonial 
inner join dbusuarios us ON us.idusuario = dj.refusuarios 
inner join tbtipooperacion tiop ON tiop.idtipooperacion = b.reftipooperacion 
inner join tbtipobien tipb ON tipb.idtipobien = b.reftipobien 
inner join tbformaadquisicion fr ON fr.idformaadquisicion = b.refformaadquisicion 
inner join tbtipocesionario tipc ON tipc.idtipocesionario = b.reftipocesionario 
inner join tbtitular tit ON tit.idtitular = b.reftitular 
where dj.iddeclaracionjuradacabecera = ".$cabecera."
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerBienesmueblesPorCabeceraCURP($cabecera, $curp) { 
$sql = "select 
b.idbienmueble,
b.refdeclaracionjuradacabecera,
b.reftipooperacion,
b.reftipobien,
b.descripcion,
b.refformaadquisicion,
b.cesionario,
b.reftipocesionario,
b.otrotipocesionario,
b.valor,
b.tipomoneda,
b.fechaadquisicion,
b.reftitular,
b.especificacionventa
from dbbienesmuebles b 
inner join dbdeclaracionjuradacabecera dj ON dj.iddeclaracionjuradacabecera = b.refdeclaracionjuradacabecera 
inner join tbestadocivil es ON es.idestadocivil = dj.refestadocivil 
inner join tbregimenmatrimonial re ON re.idregimenmatrimonial = dj.refregimenmatrimonial 
inner join dbusuarios us ON us.idusuario = dj.refusuarios 
inner join tbtipooperacion tiop ON tiop.idtipooperacion = b.reftipooperacion 
inner join tbtipobien tipb ON tipb.idtipobien = b.reftipobien 
inner join tbformaadquisicion fr ON fr.idformaadquisicion = b.refformaadquisicion 
inner join tbtipocesionario tipc ON tipc.idtipocesionario = b.reftipocesionario 
inner join tbtitular tit ON tit.idtitular = b.reftitular 
where dj.curp = '".$curp."' and dj.iddeclaracionjuradacabecera = ".$cabecera."
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


/* Fin */
/* /* Fin de la Tabla: dbbienesmuebles*/


/* PARA Inversiones */

function insertarInversiones($refdeclaracionjuradacabecera,$reftipooperacion,$reftitular,$numerocuenta,$donde,$razonsocial,$pais,$saldo,$tipomoneda,$reftipoinversion,$especifica) { 
$sql = "insert into dbinversiones(idinversion,refdeclaracionjuradacabecera,reftipooperacion,reftitular,numerocuenta,donde,razonsocial,pais,saldo,tipomoneda,reftipoinversion,especifica) 
values ('',".$refdeclaracionjuradacabecera.",".$reftipooperacion.",".$reftitular.",'".($numerocuenta)."','".($donde)."','".($razonsocial)."','".($pais)."',".$saldo.",'".($tipomoneda)."',".$reftipoinversion.",'".($especifica)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarInversiones($id,$refdeclaracionjuradacabecera,$reftipooperacion,$reftitular,$numerocuenta,$donde,$razonsocial,$pais,$saldo,$tipomoneda,$reftipoinversion,$especifica) { 
$sql = "update dbinversiones 
set 
refdeclaracionjuradacabecera = ".$refdeclaracionjuradacabecera.",reftipooperacion = ".$reftipooperacion.",reftitular = ".$reftitular.",numerocuenta = '".($numerocuenta)."',donde = '".($donde)."',razonsocial = '".($razonsocial)."',pais = '".($pais)."',saldo = ".$saldo.",tipomoneda = '".($tipomoneda)."',reftipoinversion = ".$reftipoinversion.",especifica = '".($especifica)."' 
where idinversion =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarInversiones($id) { 
$sql = "delete from dbinversiones where idinversion =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerInversiones() { 
$sql = "select 
i.idinversion,
i.refdeclaracionjuradacabecera,
i.reftipooperacion,
i.reftitular,
i.numerocuenta,
i.donde,
i.razonsocial,
i.pais,
i.saldo,
i.tipomoneda,
i.reftipoinversion,
i.especifica
from dbinversiones i 
inner join dbdeclaracionjuradacabecera dj ON dj.iddeclaracionjuradacabecera = i.refdeclaracionjuradacabecera 
inner join tbestadocivil es ON es.idestadocivil = dj.refestadocivil 
inner join tbregimenmatrimonial re ON re.idregimenmatrimonial = dj.refregimenmatrimonial 
inner join dbusuarios us ON us.idusuario = dj.refusuarios 
inner join tbtipooperacion tiop ON tiop.idtipooperacion = i.reftipooperacion 
inner join tbtitular tit ON tit.idtitular = i.reftitular 
inner join tbtipoinversion ti ON ti.idtipoinversion = i.reftipoinversion
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerInversionesPorId($id) { 
$sql = "select idinversion,refdeclaracionjuradacabecera,reftipooperacion,reftitular,numerocuenta,donde,razonsocial,pais,saldo,tipomoneda,reftipoinversion,especifica from dbinversiones where idinversion =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 



function traerInversionesGridPorCabecera($cabecera) { 
$sql = "select 
i.idinversion,
concat(dj.primerapellido, ' ', dj.segundoapellido, ' ', dj.nombres) as declaracioncabecera,
tiop.tipooperacion,
tit.titular,
i.numerocuenta,
i.donde,
i.razonsocial,
i.pais,
i.saldo,
i.tipomoneda,
i.reftipoinversion,
i.refdeclaracionjuradacabecera,
i.reftipooperacion,
i.reftitular,
i.especifica
from dbinversiones i 
inner join dbdeclaracionjuradacabecera dj ON dj.iddeclaracionjuradacabecera = i.refdeclaracionjuradacabecera 
inner join tbestadocivil es ON es.idestadocivil = dj.refestadocivil 
inner join tbregimenmatrimonial re ON re.idregimenmatrimonial = dj.refregimenmatrimonial 
inner join dbusuarios us ON us.idusuario = dj.refusuarios 
inner join tbtipooperacion tiop ON tiop.idtipooperacion = i.reftipooperacion 
inner join tbtitular tit ON tit.idtitular = i.reftitular 
inner join tbtipoinversion ti ON ti.idtipoinversion = i.reftipoinversion
where dj.iddeclaracionjuradacabecera = ".$cabecera." 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 



function traerInversionesPorCabeceraCURP($cabecera, $curp) { 
$sql = "select 
i.idinversion,
i.refdeclaracionjuradacabecera,
i.reftipooperacion,
i.reftitular,
i.numerocuenta,
i.donde,
i.razonsocial,
i.pais,
i.saldo,
i.tipomoneda,
i.reftipoinversion,
i.especifica
from dbinversiones i 
inner join dbdeclaracionjuradacabecera dj ON dj.iddeclaracionjuradacabecera = i.refdeclaracionjuradacabecera 
inner join tbestadocivil es ON es.idestadocivil = dj.refestadocivil 
inner join tbregimenmatrimonial re ON re.idregimenmatrimonial = dj.refregimenmatrimonial 
inner join dbusuarios us ON us.idusuario = dj.refusuarios 
inner join tbtipooperacion tiop ON tiop.idtipooperacion = i.reftipooperacion 
inner join tbtitular tit ON tit.idtitular = i.reftitular 
inner join tbtipoinversion ti ON ti.idtipoinversion = i.reftipoinversion
where dj.curp = '".$curp."' and dj.iddeclaracionjuradacabecera = ".$cabecera."
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


/* Fin */
/* /* Fin de la Tabla: dbinversiones*/


/* PARA Vehiculos */

function insertarVehiculos($refdeclaracionjuradacabecera,$reftipooperacion,$vehiculo,$donde,$entidadfederativa,$refformaadquisicion,$cesionario,$reftipocesionario,$otrotipocesionario,$valor,$tipomoneda,$fechaadquisicion,$reftitular,$especificacionventa,$especificacionsiniestro) { 
$sql = "insert into dbvehiculos(idvehiculos,refdeclaracionjuradacabecera,reftipooperacion,vehiculo,donde,entidadfederativa,refformaadquisicion,cesionario,reftipocesionario,otrotipocesionario,valor,tipomoneda,fechaadquisicion,reftitular,especificacionventa,especificacionsiniestro) 
values ('',".$refdeclaracionjuradacabecera.",".$reftipooperacion.",'".($vehiculo)."','".($donde)."','".($entidadfederativa)."',".$refformaadquisicion.",'".($cesionario)."',".$reftipocesionario.",'".($otrotipocesionario)."',".$valor.",'".($tipomoneda)."','".($fechaadquisicion)."',".$reftitular.",'".($especificacionventa)."','".($especificacionsiniestro)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarVehiculos($id,$refdeclaracionjuradacabecera,$reftipooperacion,$vehiculo,$donde,$entidadfederativa,$refformaadquisicion,$cesionario,$reftipocesionario,$otrotipocesionario,$valor,$tipomoneda,$fechaadquisicion,$reftitular,$especificacionventa,$especificacionsiniestro) { 
$sql = "update dbvehiculos 
set 
refdeclaracionjuradacabecera = ".$refdeclaracionjuradacabecera.",reftipooperacion = ".$reftipooperacion.",vehiculo = '".($vehiculo)."',donde = '".($donde)."',entidadfederativa = '".($entidadfederativa)."',refformaadquisicion = ".$refformaadquisicion.",cesionario = '".($cesionario)."',reftipocesionario = ".$reftipocesionario.",otrotipocesionario = '".($otrotipocesionario)."',valor = ".$valor.",tipomoneda = '".($tipomoneda)."',fechaadquisicion = '".($fechaadquisicion)."',reftitular = ".$reftitular.",especificacionventa = '".($especificacionventa)."',especificacionsiniestro = '".($especificacionsiniestro)."' 
where idvehiculos =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarVehiculos($id) { 
$sql = "delete from dbvehiculos where idvehiculos =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerVehiculos() { 
$sql = "select 
v.idvehiculos,
v.refdeclaracionjuradacabecera,
v.reftipooperacion,
v.vehiculo,
v.donde,
v.entidadfederativa,
v.refformaadquisicion,
v.cesionario,
v.reftipocesionario,
v.otrotipocesionario,
v.valor,
v.tipomoneda,
v.fechaadquisicion,
v.reftitular,
v.especificacionventa,
v.especificacionsiniestro
from dbvehiculos v 
inner join dbdeclaracionjuradacabecera dj ON dj.iddeclaracionjuradacabecera = v.refdeclaracionjuradacabecera 
inner join tbestadocivil es ON es.idestadocivil = dj.refestadocivil 
inner join tbregimenmatrimonial re ON re.idregimenmatrimonial = dj.refregimenmatrimonial 
inner join dbusuarios us ON us.idusuario = dj.refusuarios 
inner join tbtipooperacion tiop ON tiop.idtipooperacion = v.reftipooperacion 
inner join tbformaadquisicion fa ON fa.idformaadquisicion = v.refformaadquisicion 
inner join tbtipocesionario tc ON tc.idtipocesionario = v.reftipocesionario 
inner join tbtitular tit ON tit.idtitular = v.reftitular 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerVehiculosPorId($id) { 
$sql = "select idvehiculos,refdeclaracionjuradacabecera,reftipooperacion,vehiculo,donde,entidadfederativa,refformaadquisicion,cesionario,reftipocesionario,otrotipocesionario,valor,tipomoneda,fechaadquisicion,reftitular,especificacionventa,especificacionsiniestro from dbvehiculos where idvehiculos =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerVehiculosGridPorCabecera($cabecera) { 
$sql = "select 
v.idvehiculos,
concat(dj.primerapellido, ' ', dj.segundoapellido, ' ', dj.nombres) as declaracioncabecera,
tiop.tipooperacion,
v.vehiculo,
fa.formaadquisicion,
v.valor,
v.tipomoneda,
v.fechaadquisicion,
v.donde,
v.entidadfederativa,
v.cesionario,
v.otrotipocesionario,
v.reftipocesionario,
v.refformaadquisicion,
v.reftitular,
v.refdeclaracionjuradacabecera,
v.reftipooperacion,
v.especificacionventa,
v.especificacionsiniestro
from dbvehiculos v 
inner join dbdeclaracionjuradacabecera dj ON dj.iddeclaracionjuradacabecera = v.refdeclaracionjuradacabecera 
inner join tbestadocivil es ON es.idestadocivil = dj.refestadocivil 
inner join tbregimenmatrimonial re ON re.idregimenmatrimonial = dj.refregimenmatrimonial 
inner join dbusuarios us ON us.idusuario = dj.refusuarios 
inner join tbtipooperacion tiop ON tiop.idtipooperacion = v.reftipooperacion 
inner join tbformaadquisicion fa ON fa.idformaadquisicion = v.refformaadquisicion 
inner join tbtipocesionario tc ON tc.idtipocesionario = v.reftipocesionario 
inner join tbtitular tit ON tit.idtitular = v.reftitular 
where dj.iddeclaracionjuradacabecera = ".$cabecera."
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerVehiculosPorCabeceraCURP($cabecera, $curp) { 
$sql = "select 
v.idvehiculos,
v.refdeclaracionjuradacabecera,
v.reftipooperacion,
v.vehiculo,
v.donde,
v.entidadfederativa,
v.refformaadquisicion,
v.cesionario,
v.reftipocesionario,
v.otrotipocesionario,
v.valor,
v.tipomoneda,
v.fechaadquisicion,
v.reftitular,
v.especificacionventa,
v.especificacionsiniestro
from dbvehiculos v 
inner join dbdeclaracionjuradacabecera dj ON dj.iddeclaracionjuradacabecera = v.refdeclaracionjuradacabecera 
inner join tbestadocivil es ON es.idestadocivil = dj.refestadocivil 
inner join tbregimenmatrimonial re ON re.idregimenmatrimonial = dj.refregimenmatrimonial 
inner join dbusuarios us ON us.idusuario = dj.refusuarios 
inner join tbtipooperacion tiop ON tiop.idtipooperacion = v.reftipooperacion 
inner join tbformaadquisicion fa ON fa.idformaadquisicion = v.refformaadquisicion 
inner join tbtipocesionario tc ON tc.idtipocesionario = v.reftipocesionario 
inner join tbtitular tit ON tit.idtitular = v.reftitular 
where dj.curp = '".$curp."' and dj.iddeclaracionjuradacabecera = ".$cabecera."
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


/* Fin */
/* /* Fin de la Tabla: dbvehiculos*/


/* PARA Formaadquisicion */

function insertarFormaadquisicion($formaadquisicion) { 
$sql = "insert into tbformaadquisicion(idformaadquisicion,formaadquisicion) 
values ('','".($formaadquisicion)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarFormaadquisicion($id,$formaadquisicion) { 
$sql = "update tbformaadquisicion 
set 
formaadquisicion = '".($formaadquisicion)."' 
where idformaadquisicion =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarFormaadquisicion($id) { 
$sql = "delete from tbformaadquisicion where idformaadquisicion =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerFormaadquisicion() { 
$sql = "select 
f.idformaadquisicion,
f.formaadquisicion
from tbformaadquisicion f 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerFormaadquisicionPorId($id) { 
$sql = "select idformaadquisicion,formaadquisicion from tbformaadquisicion where idformaadquisicion =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: tbformaadquisicion*/


/* PARA Otrotipobien */

function insertarOtrotipobien($otrotipobien) { 
$sql = "insert into tbotrotipobien(idotrotipobien,otrotipobien) 
values ('','".($otrotipobien)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarOtrotipobien($id,$otrotipobien) { 
$sql = "update tbotrotipobien 
set 
otrotipobien = '".($otrotipobien)."' 
where idotrotipobien =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarOtrotipobien($id) { 
$sql = "delete from tbotrotipobien where idotrotipobien =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerOtrotipobien() { 
$sql = "select 
o.idotrotipobien,
o.otrotipobien
from tbotrotipobien o 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerOtrotipobienPorId($id) { 
$sql = "select idotrotipobien,otrotipobien from tbotrotipobien where idotrotipobien =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: tbotrotipobien*/



/* PARA Tipobien */

function insertarTipobien($tipobien) { 
$sql = "insert into tbtipobien(idtipobien,tipobien) 
values ('','".($tipobien)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarTipobien($id,$tipobien) { 
$sql = "update tbtipobien 
set 
tipobien = '".($tipobien)."' 
where idtipobien =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarTipobien($id) { 
$sql = "delete from tbtipobien where idtipobien =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerTipobien() { 
$sql = "select 
t.idtipobien,
t.tipobien
from tbtipobien t 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerTipobienPorId($id) { 
$sql = "select idtipobien,tipobien from tbtipobien where idtipobien =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: tbtipobien*/


/* PARA Tipocesionario */

function insertarTipocesionario($tipocesionario) { 
$sql = "insert into tbtipocesionario(idtipocesionario,tipocesionario) 
values ('','".($tipocesionario)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarTipocesionario($id,$tipocesionario) { 
$sql = "update tbtipocesionario 
set 
tipocesionario = '".($tipocesionario)."' 
where idtipocesionario =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarTipocesionario($id) { 
$sql = "delete from tbtipocesionario where idtipocesionario =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerTipocesionario() { 
$sql = "select 
t.idtipocesionario,
t.tipocesionario
from tbtipocesionario t 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerTipocesionarioPorId($id) { 
$sql = "select idtipocesionario,tipocesionario from tbtipocesionario where idtipocesionario =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: tbtipocesionario*/


/* PARA Tipoinversion */

function insertarTipoinversion($tipoinversion) { 
$sql = "insert into tbtipoinversion(idtipoinversion,tipoinversion) 
values ('','".($tipoinversion)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarTipoinversion($id,$tipoinversion) { 
$sql = "update tbtipoinversion 
set 
tipoinversion = '".($tipoinversion)."' 
where idtipoinversion =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarTipoinversion($id) { 
$sql = "delete from tbtipoinversion where idtipoinversion =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerTipoinversion() { 
$sql = "select 
t.idtipoinversion,
t.tipoinversion
from tbtipoinversion t 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerTipoinversionPorId($id) { 
$sql = "select idtipoinversion,tipoinversion from tbtipoinversion where idtipoinversion =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: tbtipoinversion*/


/* PARA Tipooperacion */

function insertarTipooperacion($tipooperacion) { 
$sql = "insert into tbtipooperacion(idtipooperacion,tipooperacion) 
values ('','".($tipooperacion)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarTipooperacion($id,$tipooperacion) { 
$sql = "update tbtipooperacion 
set 
tipooperacion = '".($tipooperacion)."' 
where idtipooperacion =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarTipooperacion($id) { 
$sql = "delete from tbtipooperacion where idtipooperacion =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerTipooperacion() { 
$sql = "select 
t.idtipooperacion,
t.tipooperacion
from tbtipooperacion t 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerTipooperacionPorId($id) { 
$sql = "select idtipooperacion,tipooperacion from tbtipooperacion where idtipooperacion =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: tbtipooperacion*/


/* PARA Titular */

function insertarTitular($titular) { 
$sql = "insert into tbtitular(idtitular,titular) 
values ('','".($titular)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarTitular($id,$titular) { 
$sql = "update tbtitular 
set 
titular = '".($titular)."' 
where idtitular =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarTitular($id) { 
$sql = "delete from tbtitular where idtitular =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerTitular() { 
$sql = "select 
t.idtitular,
t.titular
from tbtitular t 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerTitularPorId($id) { 
$sql = "select idtitular,titular from tbtitular where idtitular =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: tbtitular*/



/* PARA Adeudos */

function insertarAdeudos($refdeclaracionjuradacabecera,$reftipooperacion,$reftipoadeudo,$numerocuenta,$donde,$razonsocial,$pais,$fechaotorgamiento,$montooritginal,$tipomoneda,$montopagos,$saldo,$tipomonedasaldo,$reftitular) { 
$sql = "insert into dbadeudos(idadeudo,refdeclaracionjuradacabecera,reftipooperacion,reftipoadeudo,numerocuenta,donde,razonsocial,pais,fechaotorgamiento,montooritginal,tipomoneda,montopagos,saldo,tipomonedasaldo,reftitular) 
values ('',".$refdeclaracionjuradacabecera.",".$reftipooperacion.",".$reftipoadeudo.",'".($numerocuenta)."','".($donde)."','".($razonsocial)."','".($pais)."','".($fechaotorgamiento)."',".$montooritginal.",'".($tipomoneda)."',".$montopagos.",".$saldo.",'".($tipomonedasaldo)."',".$reftitular.")"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarAdeudos($id,$refdeclaracionjuradacabecera,$reftipooperacion,$reftipoadeudo,$numerocuenta,$donde,$razonsocial,$pais,$fechaotorgamiento,$montooritginal,$tipomoneda,$montopagos,$saldo,$tipomonedasaldo,$reftitular) { 
$sql = "update dbadeudos 
set 
refdeclaracionjuradacabecera = ".$refdeclaracionjuradacabecera.",reftipooperacion = ".$reftipooperacion.",reftipoadeudo = ".$reftipoadeudo.",numerocuenta = '".($numerocuenta)."',donde = '".($donde)."',razonsocial = '".($razonsocial)."',pais = '".($pais)."',fechaotorgamiento = '".($fechaotorgamiento)."',montooritginal = ".$montooritginal.",tipomoneda = '".($tipomoneda)."',montopagos = ".$montopagos.",saldo = ".$saldo.",tipomonedasaldo = '".($tipomonedasaldo)."',reftitular = ".$reftitular." 
where idadeudo =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarAdeudos($id) { 
$sql = "delete from dbadeudos where idadeudo =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerAdeudos() { 
$sql = "select 
a.idadeudo,
a.refdeclaracionjuradacabecera,
a.reftipooperacion,
a.reftipoadeudo,
a.numerocuenta,
a.donde,
a.razonsocial,
a.pais,
a.fechaotorgamiento,
a.montooritginal,
a.tipomoneda,
a.montopagos,
a.saldo,
a.tipomonedasaldo,
a.reftitular
from dbadeudos a 
inner join dbdeclaracionjuradacabecera dj ON dj.iddeclaracionjuradacabecera = a.refdeclaracionjuradacabecera 
inner join tbestadocivil es ON es.idestadocivil = dj.refestadocivil 
inner join tbregimenmatrimonial re ON re.idregimenmatrimonial = dj.refregimenmatrimonial 
inner join dbusuarios us ON us.idusuario = dj.refusuarios 
inner join tbtipooperacion tiop ON tiop.idtipooperacion = a.reftipooperacion 
inner join tbtipoadeudo ta ON ta.idtipoadeudo = a.reftipoadeudo 
inner join tbtitular tit ON tit.idtitular = a.reftitular 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerAdeudosPorId($id) { 
$sql = "select idadeudo,refdeclaracionjuradacabecera,reftipooperacion,reftipoadeudo,numerocuenta,donde,razonsocial,pais,fechaotorgamiento,montooritginal,tipomoneda,montopagos,saldo,tipomonedasaldo,reftitular from dbadeudos where idadeudo =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerAdeudosGridPorCabecera($cabecera) { 
$sql = "select 
a.idadeudo,
concat(dj.primerapellido, ' ', dj.segundoapellido, ' ', dj.nombres) as declaracioncabecera,
tiop.tipooperacion,
ta.tipoadeudo,
tit.titular,
a.numerocuenta,
a.donde,
a.razonsocial,
a.pais,
a.fechaotorgamiento,
a.montooritginal,
a.tipomoneda,
a.montopagos,
a.saldo,
a.tipomonedasaldo,
a.refdeclaracionjuradacabecera,
a.reftipooperacion,
a.reftipoadeudo
from dbadeudos a 
inner join dbdeclaracionjuradacabecera dj ON dj.iddeclaracionjuradacabecera = a.refdeclaracionjuradacabecera 
inner join tbestadocivil es ON es.idestadocivil = dj.refestadocivil 
inner join tbregimenmatrimonial re ON re.idregimenmatrimonial = dj.refregimenmatrimonial 
inner join dbusuarios us ON us.idusuario = dj.refusuarios 
inner join tbtipooperacion tiop ON tiop.idtipooperacion = a.reftipooperacion 
inner join tbtipoadeudo ta ON ta.idtipoadeudo = a.reftipoadeudo 
inner join tbtitular tit ON tit.idtitular = a.reftitular
where dj.iddeclaracionjuradacabecera = ".$cabecera." 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 



function traerAdeudosPorCabeceraCURP($cabecera, $curp) { 
$sql = "select 
a.idadeudo,
concat(dj.primerapellido, ' ', dj.segundoapellido, ' ', dj.nombres) as declaracioncabecera,
tiop.tipooperacion,
tit.titular,
a.numerocuenta,
a.donde,
a.razonsocial,
a.pais,
a.fechaotorgamiento,
a.montooritginal,
a.tipomoneda,
a.montopagos,
a.saldo,
a.tipomonedasaldo,
a.refdeclaracionjuradacabecera,
a.reftipooperacion,
a.reftipoadeudo
from dbadeudos a 
inner join dbdeclaracionjuradacabecera dj ON dj.iddeclaracionjuradacabecera = a.refdeclaracionjuradacabecera 
inner join tbestadocivil es ON es.idestadocivil = dj.refestadocivil 
inner join tbregimenmatrimonial re ON re.idregimenmatrimonial = dj.refregimenmatrimonial 
inner join dbusuarios us ON us.idusuario = dj.refusuarios 
inner join tbtipooperacion tiop ON tiop.idtipooperacion = a.reftipooperacion 
inner join tbtipoadeudo ta ON ta.idtipoadeudo = a.reftipoadeudo 
inner join tbtitular tit ON tit.idtitular = a.reftitular
where dj.curp = '".$curp."' and dj.iddeclaracionjuradacabecera = ".$cabecera."
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: dbadeudos*/



/* PARA Tipoadeudo */

function insertarTipoadeudo($tipoadeudo) { 
$sql = "insert into tbtipoadeudo(idtipoadeudo,tipoadeudo) 
values ('','".($tipoadeudo)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarTipoadeudo($id,$tipoadeudo) { 
$sql = "update tbtipoadeudo 
set 
tipoadeudo = '".($tipoadeudo)."' 
where idtipoadeudo =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarTipoadeudo($id) { 
$sql = "delete from tbtipoadeudo where idtipoadeudo =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerTipoadeudo() { 
$sql = "select 
t.idtipoadeudo,
t.tipoadeudo
from tbtipoadeudo t 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerTipoadeudoPorId($id) { 
$sql = "select idtipoadeudo,tipoadeudo from tbtipoadeudo where idtipoadeudo =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: tbtipoadeudo*/


/* PARA Recursos */

function insertarRecursos($refdeclaracionjuradacabecera,$pagos,$otros) { 
$sql = "insert into dbrecursos(idrecurso,refdeclaracionjuradacabecera,pagos,otros) 
values ('',".$refdeclaracionjuradacabecera.",".$pagos.",".$otros.")"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarRecursos($id,$refdeclaracionjuradacabecera,$pagos,$otros) { 
$sql = "update dbrecursos 
set 
refdeclaracionjuradacabecera = ".$refdeclaracionjuradacabecera.",pagos = ".$pagos.",otros = ".$otros." 
where idrecurso =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarRecursos($id) { 
$sql = "delete from dbrecursos where idrecurso =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerRecursos() { 
$sql = "select 
r.idrecurso,
r.refdeclaracionjuradacabecera,
r.pagos,
r.otros
from dbrecursos r 
inner join dbdeclaracionjuradacabecera dj ON dj.iddeclaracionjuradacabecera = r.refdeclaracionjuradacabecera 
inner join tbestadocivil es ON es.idestadocivil = dj.refestadocivil 
inner join tbregimenmatrimonial re ON re.idregimenmatrimonial = dj.refregimenmatrimonial 
inner join dbusuarios us ON us.idusuario = dj.refusuarios 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerRecursosPorId($id) { 
$sql = "select idrecurso,refdeclaracionjuradacabecera,pagos,otros from dbrecursos where idrecurso =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerRecursosGridPorCabecera($cabecera) { 
$sql = "select 
r.idrecurso,
concat(dj.primerapellido, ' ', dj.segundoapellido, ' ', dj.nombres) as declaracioncabecera,
r.pagos,
r.otros,
r.refdeclaracionjuradacabecera 
from dbrecursos r 
inner join dbdeclaracionjuradacabecera dj ON dj.iddeclaracionjuradacabecera = r.refdeclaracionjuradacabecera 
inner join tbestadocivil es ON es.idestadocivil = dj.refestadocivil 
inner join tbregimenmatrimonial re ON re.idregimenmatrimonial = dj.refregimenmatrimonial 
inner join dbusuarios us ON us.idusuario = dj.refusuarios 
where dj.iddeclaracionjuradacabecera = ".$cabecera." 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 



function traerRecursosPorCabeceraCURP($cabecera, $curp) { 
$sql = "select 
r.idrecurso,
concat(dj.primerapellido, ' ', dj.segundoapellido, ' ', dj.nombres) as declaracioncabecera,
r.pagos,
r.otros,
r.refdeclaracionjuradacabecera 
from dbrecursos r 
inner join dbdeclaracionjuradacabecera dj ON dj.iddeclaracionjuradacabecera = r.refdeclaracionjuradacabecera 
inner join tbestadocivil es ON es.idestadocivil = dj.refestadocivil 
inner join tbregimenmatrimonial re ON re.idregimenmatrimonial = dj.refregimenmatrimonial 
inner join dbusuarios us ON us.idusuario = dj.refusuarios 
where dj.curp = '".$curp."' and dj.iddeclaracionjuradacabecera = ".$cabecera."
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: dbrecursos*/


/* PARA Decrementos */

function insertarDecrementos($refdeclaracionjuradacabecera,$donaciones,$robo,$siniestros,$otros) { 
$sql = "insert into dbdecrementos(iddecremento,refdeclaracionjuradacabecera,donaciones,robo,siniestros,otros) 
values ('',".$refdeclaracionjuradacabecera.",".$donaciones.",".$robo.",".$siniestros.",".$otros.")"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarDecrementos($id,$refdeclaracionjuradacabecera,$donaciones,$robo,$siniestros,$otros) { 
$sql = "update dbdecrementos 
set 
refdeclaracionjuradacabecera = ".$refdeclaracionjuradacabecera.",donaciones = ".$donaciones.",robo = ".$robo.",siniestros = ".$siniestros.",otros = ".$otros." 
where iddecremento =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarDecrementos($id) { 
$sql = "delete from dbdecrementos where iddecremento =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerDecrementos() { 
$sql = "select 
d.iddecremento,
d.refdeclaracionjuradacabecera,
d.donaciones,
d.robo,
d.siniestros,
d.otros
from dbdecrementos d 
inner join dbdeclaracionjuradacabecera dj ON dj.iddeclaracionjuradacabecera = d.refdeclaracionjuradacabecera 
inner join tbestadocivil es ON es.idestadocivil = dj.refestadocivil 
inner join tbregimenmatrimonial re ON re.idregimenmatrimonial = dj.refregimenmatrimonial 
inner join dbusuarios us ON us.idusuario = dj.refusuarios 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerDecrementosPorId($id) { 
$sql = "select iddecremento,refdeclaracionjuradacabecera,donaciones,robo,siniestros,otros from dbdecrementos where iddecremento =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerDecrementosGridPorCabecera($cabecera) { 
$sql = "select 
d.iddecremento,
concat(dj.primerapellido, ' ', dj.segundoapellido, ' ', dj.nombres) as declaracioncabecera,
d.donaciones,
d.robo,
d.siniestros,
d.otros,
d.refdeclaracionjuradacabecera 
from dbdecrementos d 
inner join dbdeclaracionjuradacabecera dj ON dj.iddeclaracionjuradacabecera = d.refdeclaracionjuradacabecera 
inner join tbestadocivil es ON es.idestadocivil = dj.refestadocivil 
inner join tbregimenmatrimonial re ON re.idregimenmatrimonial = dj.refregimenmatrimonial 
inner join dbusuarios us ON us.idusuario = dj.refusuarios 
where dj.iddeclaracionjuradacabecera = ".$cabecera." 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 



function traerDecrementosPorCabeceraCURP($cabecera, $curp) { 
$sql = "select 
d.iddecremento,
concat(dj.primerapellido, ' ', dj.segundoapellido, ' ', dj.nombres) as declaracioncabecera,
d.donaciones,
d.robo,
d.siniestros,
d.otros,
d.refdeclaracionjuradacabecera 
from dbdecrementos d 
inner join dbdeclaracionjuradacabecera dj ON dj.iddeclaracionjuradacabecera = d.refdeclaracionjuradacabecera 
inner join tbestadocivil es ON es.idestadocivil = dj.refestadocivil 
inner join tbregimenmatrimonial re ON re.idregimenmatrimonial = dj.refregimenmatrimonial 
inner join dbusuarios us ON us.idusuario = dj.refusuarios 
where dj.curp = '".$curp."' and dj.iddeclaracionjuradacabecera = ".$cabecera."
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: dbdecrementos*/


/* PARA Observaciones */

function insertarObservaciones($refdeclaracionjuradacabecera,$observacion) { 
$sql = "insert into dbobservaciones(idobservacion,refdeclaracionjuradacabecera,observacion) 
values ('',".$refdeclaracionjuradacabecera.",'".($observacion)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarObservaciones($id,$refdeclaracionjuradacabecera,$observacion) { 
$sql = "update dbobservaciones 
set 
refdeclaracionjuradacabecera = ".$refdeclaracionjuradacabecera.",observacion = '".($observacion)."' 
where idobservacion =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarObservaciones($id) { 
$sql = "delete from dbobservaciones where idobservacion =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerObservaciones() { 
$sql = "select 
o.idobservacion,
o.refdeclaracionjuradacabecera,
o.observacion
from dbobservaciones o 
inner join dbdeclaracionjuradacabecera dj ON dj.iddeclaracionjuradacabecera = o.refdeclaracionjuradacabecera 
inner join tbestadocivil es ON es.idestadocivil = dj.refestadocivil 
inner join tbregimenmatrimonial re ON re.idregimenmatrimonial = dj.refregimenmatrimonial 
inner join dbusuarios us ON us.idusuario = dj.refusuarios 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerObservacionesPorId($id) { 
$sql = "select idobservacion,refdeclaracionjuradacabecera,observacion from dbobservaciones where idobservacion =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerObservacionesGridPorCabecera($cabecera) { 
$sql = "select 
o.idobservacion,
concat(dj.primerapellido, ' ', dj.segundoapellido, ' ', dj.nombres) as declaracioncabecera,
o.observacion,
o.refdeclaracionjuradacabecera 
from dbobservaciones o 
inner join dbdeclaracionjuradacabecera dj ON dj.iddeclaracionjuradacabecera = o.refdeclaracionjuradacabecera 
inner join tbestadocivil es ON es.idestadocivil = dj.refestadocivil 
inner join tbregimenmatrimonial re ON re.idregimenmatrimonial = dj.refregimenmatrimonial 
inner join dbusuarios us ON us.idusuario = dj.refusuarios 
where dj.iddeclaracionjuradacabecera = ".$cabecera." 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 



function traerObservacionesPorCabeceraCURP($cabecera, $curp) { 
$sql = "select 
o.idobservacion,
concat(dj.primerapellido, ' ', dj.segundoapellido, ' ', dj.nombres) as declaracioncabecera,
o.observacion,
o.refdeclaracionjuradacabecera 
from dbobservaciones o 
inner join dbdeclaracionjuradacabecera dj ON dj.iddeclaracionjuradacabecera = o.refdeclaracionjuradacabecera 
inner join tbestadocivil es ON es.idestadocivil = dj.refestadocivil 
inner join tbregimenmatrimonial re ON re.idregimenmatrimonial = dj.refregimenmatrimonial 
inner join dbusuarios us ON us.idusuario = dj.refusuarios 
where dj.curp = '".$curp."' and dj.iddeclaracionjuradacabecera = ".$cabecera."
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: dbobservaciones*/




function query($sql,$accion) {
		
		
		
		require_once 'appconfig.php';

		$appconfig	= new appconfig();
		$datos		= $appconfig->conexion();	
		$hostname	= $datos['hostname'];
		$database	= $datos['database'];
		$username	= $datos['username'];
		$password	= $datos['password'];
		
		$conex = mysql_connect($hostname,$username,$password) or die ("no se puede conectar".mysql_error());
		
		mysql_select_db($database);
		
		        $error = 0;
		mysql_query("BEGIN");
		$result=mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		if(!$result){
			$error=1;
		}
		if($error==1){
			mysql_query("ROLLBACK");
			return false;
		}
		 else{
			mysql_query("COMMIT");
			return $result;
		}
		
	}

}

?>