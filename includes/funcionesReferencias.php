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
	values ('',".$refdeclaracionjuradacabecera.",".$essecretario.",".$esauditor.",".$ejercicio.",".$espublico.",".$refpoder.",'".($registrofederalcontribuyente)."','".($fechadeclaracionanterior)."','".($fechatomaposesion)."','".($cargoactual)."','".($cargoanterior)."','".($areaadquisicion)."','".($areaadquisicionanterior)."','".($dependencia)."','".($dependenciaanterior)."')"; 
	$res = $this->query($sql,1); 
	return $res; 
	} 
	
	
	function modificarDeclaracionanualinteres($id,$refdeclaracionjuradacabecera,$essecretario,$esauditor,$ejercicio,$espublico,$refpoder,$registrofederalcontribuyente,$fechadeclaracionanterior,$fechatomaposesion,$cargoactual,$cargoanterior,$areaadquisicion,$areaadquisicionanterior,$dependencia,$dependenciaanterior) { 
	$sql = "update dbdeclaracionanualinteres 
	set 
	refdeclaracionjuradacabecera = ".$refdeclaracionjuradacabecera.",essecretario = ".$essecretario.",esauditor = ".$esauditor.",ejercicio = ".$ejercicio.",espublico = ".$espublico.",refpoder = ".$refpoder.",registrofederalcontribuyente = '".($registrofederalcontribuyente)."',fechadeclaracionanterior = '".($fechadeclaracionanterior)."',fechatomaposesion = '".($fechatomaposesion)."',cargoactual = '".($cargoactual)."',cargoanterior = '".($cargoanterior)."',areaadquisicion = '".($areaadquisicion)."',areaadquisicionanterior = '".($areaadquisicionanterior)."',dependencia = '".($dependencia)."',dependenciaanterior = '".($dependenciaanterior)."' 
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
	inner join dbdeclaracionjuradacabecera dec ON dec.iddeclaracionjuradacabecera = d.refdeclaracionjuradacabecera 
	inner join tbestadocivil es ON es.idestadocivil = dec.refestadocivil 
	inner join tbregimenmatrimonial re ON re.idregimenmatrimonial = dec.refregimenmatrimonial 
	inner join dbusuarios us ON us.idusuario = dec.refusuarios 
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
	
	/* Fin */
	/* /* Fin de la Tabla: dbdependienteseconomicos*/
	
	
	/* PARA Ingresosanuales */
	
	function insertarIngresosanuales($refdeclaracionjuradacabecera,$remuneracionanualneta,$actividadindustrial,$razonsocialactividadindustrial,$actividadfinanciera,$razonsocialactividadfinanciera,$actividadprofesional,$descripcionactividadprofesional,$otros,$especifiqueotros,$ingresoanualconyuge,$especifiqueingresosconyuge,$fueservidorpublico,$vigenciadesde,$vigenciahasta) { 
	$sql = "insert into dbingresosanuales(idingresoanual,refdeclaracionjuradacabecera,remuneracionanualneta,actividadindustrial,razonsocialactividadindustrial,actividadfinanciera,razonsocialactividadfinanciera,actividadprofesional,descripcionactividadprofesional,otros,especifiqueotros,ingresoanualconyuge,especifiqueingresosconyuge,fueservidorpublico,vigenciadesde,vigenciahasta) 
	values ('',".$refdeclaracionjuradacabecera.",".$remuneracionanualneta.",".$actividadindustrial.",'".($razonsocialactividadindustrial)."',".$actividadfinanciera.",'".($razonsocialactividadfinanciera)."',".$actividadprofesional.",'".($descripcionactividadprofesional)."',".$otros.",'".($especifiqueotros)."',".$ingresoanualconyuge.",'".($especifiqueingresosconyuge)."',".$fueservidorpublico.",'".($vigenciadesde)."','".($vigenciahasta)."')"; 
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
	i.fueservidorpublico,
	i.vigenciadesde,
	i.vigenciahasta
	from dbingresosanuales i 
	order by 1"; 
	$res = $this->query($sql,0); 
	return $res; 
	} 
	
	
	function traerIngresosanualesPorId($id) { 
	$sql = "select idingresoanual,refdeclaracionjuradacabecera,remuneracionanualneta,actividadindustrial,razonsocialactividadindustrial,actividadfinanciera,razonsocialactividadfinanciera,actividadprofesional,descripcionactividadprofesional,otros,especifiqueotros,ingresoanualconyuge,especifiqueingresosconyuge,fueservidorpublico,vigenciadesde,vigenciahasta from dbingresosanuales where idingresoanual =".$id; 
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
	i.fueservidorpublico,
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
				inner join dbdeclaracionjuradacabecera dj on dj.iddeclaracionjuradacabecera = d.refdeclaracionjuradacabecera
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

function insertarDeclaracionjuradacabecera($fecharecepcion,$primerapellido,$segundoapellido,$nombres,$curp,$homoclave,$emailinstitucional,$emailalterno,$refestadocivil,$refregimenmatrimonial,$paisnacimiento,$nacionalidad,$entidadnacimiento,$numerocelular,$lugarubica,$domicilioparticular,$localidad,$municipio,$telefono,$entidadfederativa,$codigopostal,$lada,$sexo,$estudios,$cedulaprofesional,$refusuarios) { 
$sql = "insert into dbdeclaracionjuradacabecera(iddeclaracionjuradacabecera,fecharecepcion,primerapellido,segundoapellido,nombres,curp,homoclave,emailinstitucional,emailalterno,refestadocivil,refregimenmatrimonial,paisnacimiento,nacionalidad,entidadnacimiento,numerocelular,lugarubica,domicilioparticular,localidad,municipio,telefono,entidadfederativa,codigopostal,lada,sexo,estudios,cedulaprofesional,refusuarios) 
values ('','".($fecharecepcion)."','".($primerapellido)."','".($segundoapellido)."','".($nombres)."','".($curp)."','".($homoclave)."','".($emailinstitucional)."','".($emailalterno)."',".$refestadocivil.",".$refregimenmatrimonial.",'".($paisnacimiento)."','".($nacionalidad)."','".($entidadnacimiento)."','".($numerocelular)."',".$lugarubica.",'".($domicilioparticular)."','".($localidad)."','".($municipio)."','".($telefono)."','".($entidadfederativa)."','".($codigopostal)."','".($lada)."',".$sexo.",'".($estudios)."','".($cedulaprofesional)."',".$refusuarios.")"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarDeclaracionjuradacabecera($id,$fecharecepcion,$primerapellido,$segundoapellido,$nombres,$curp,$homoclave,$emailinstitucional,$emailalterno,$refestadocivil,$refregimenmatrimonial,$paisnacimiento,$nacionalidad,$entidadnacimiento,$numerocelular,$lugarubica,$domicilioparticular,$localidad,$municipio,$telefono,$entidadfederativa,$codigopostal,$lada,$sexo,$estudios,$cedulaprofesional,$refusuarios) { 
$sql = "update dbdeclaracionjuradacabecera 
set 
fecharecepcion = '".($fecharecepcion)."',primerapellido = '".($primerapellido)."',segundoapellido = '".($segundoapellido)."',nombres = '".($nombres)."',curp = '".($curp)."',homoclave = '".($homoclave)."',emailinstitucional = '".($emailinstitucional)."',emailalterno = '".($emailalterno)."',refestadocivil = ".$refestadocivil.",refregimenmatrimonial = ".$refregimenmatrimonial.",paisnacimiento = '".($paisnacimiento)."',nacionalidad = '".($nacionalidad)."',entidadnacimiento = '".($entidadnacimiento)."',numerocelular = '".($numerocelular)."',lugarubica = ".$lugarubica.",domicilioparticular = '".($domicilioparticular)."',localidad = '".($localidad)."',municipio = '".($municipio)."',telefono = '".($telefono)."',entidadfederativa = '".($entidadfederativa)."',codigopostal = '".($codigopostal)."',lada = '".($lada)."',sexo = ".$sexo.",estudios = '".($estudios)."',cedulaprofesional = '".($cedulaprofesional)."',refusuarios = ".$refusuarios." 
where iddeclaracionjuradacabecera =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarDeclaracionjuradacabecera($id) { 
$sql = "delete from dbdeclaracionjuradacabecera where iddeclaracionjuradacabecera =".$id; 
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
				d.emailinstitucional
			from dbdeclaracionjuradacabecera d 
			inner join tbestadocivil est ON est.idestadocivil = d.refestadocivil 
			inner join tbregimenmatrimonial reg ON reg.idregimenmatrimonial = d.refregimenmatrimonial 
			inner join dbusuarios usu ON usu.idusuario = d.refusuarios 
			inner join tbroles ro ON ro.idrol = usu.refroles 
			order by 1"; 
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
$sql = "select iddeclaracionjuradacabecera,fecharecepcion,primerapellido,segundoapellido,nombres,curp,homoclave,emailinstitucional,emailalterno,refestadocivil,refregimenmatrimonial,paisnacimiento,nacionalidad,entidadnacimiento,numerocelular,lugarubica,domicilioparticular,localidad,municipio,telefono,entidadfederativa,codigopostal,lada,sexo,estudios,cedulaprofesional,refusuarios from dbdeclaracionjuradacabecera where iddeclaracionjuradacabecera =".$id; 
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