<?php #CONTENIDO PARA EL FUNCIONAMIENTO Y EL ORDEN

session_start();

$_SESSION['rol']='admin';

#Archivos necesarios
$archivos=['datos.php','index.php','caja.php','estilo.css','procesa.php','modificar.php','responder.php'];
#Archivos que se crean solos
$archisolo=['comentarios.php','respuestas.php','contador.php','contadorres.php'];

#VERIFICAR ARCHIVOS
for($a=0; $a<=6; $a++){
	if(!file_exists($archivos[$a])){ echo "El archivo: $archivos[$a] no existe.<br>"; }
}

#Maximo en pantalla
$maxPRespuestas=5;

#Maximo en datos
$maxDComentarios=10;
$maxDRespuestas=5;

#EMPIESA
$empPComentarios=1;


#FECHA Y HORA DEL PAIS
date_default_timezone_set("America/Bogota");
$fecha=date('Y-m-d - g:ia');

#CONVERTIDORES
function darFormato($string) { return $string; }

function darFormatoNoSimbolos($string) { return $string; }

?>