<?php require_once 'datos.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sistema de cometarios</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
<center>
<h1>Sistema de comentarios basico by ArminVT</h1>
<h2>Deja un comentario</h2><hr>
<?php if(!file_exists($archisolo[2])){ file_put_contents($archisolo[2], 0); }
	$leerCon=file_get_contents($archisolo[2]);
	if($leerCon>=$maxDComentarios){
		echo '<h2>Lo lamento, pero el numero maximo de comentarios es de '.$maxPComentarios.'</h2>';
	}
?>
<form method="post" action="procesa.php?tipo=comentar">
	<input type="text" name="usuario" placeholder="Usuario">
	<input type="email" name="email" placeholder="Email"><br>
	<textarea name="comentario" placeholder="Deja tu comentario..."></textarea><br>
	<input type="submit" name="envio" value="Comentar">
</form>

<?php
	$msm="";
	if(isset($_GET['msm'])){ $msm=darFormatoNoSimbolos(trim($_GET['msm'])); }
	if(!empty($msm)){
		$id=''; $id2='';
		if(isset($_GET['id']) || isset($_GET['id2'])){
			$id=darFormatoNoSimbolos(trim($_GET['id']));
			$id2=darFormatoNoSimbolos(trim($_GET['id2']));
			if($id2!=0){ $id2=' ~ '.$id2; } else { $id2=''; }
		}

		switch ($msm) {
			case 'publicado':
				$msm="El comentario fue publicado exitosamente.";
				break;
			case 'modificado':
				$msm="El comentario #$id $id2 fue modificado exitosamente.";
				break;
			case 'respondido':
				$msm="El comentario #$id $id2 fue respondido exitosamente.";
				break;
			case 'nocumplieron':
				$msm="Los datos enviados no nocumplieron con los solicitados.";
				break;
			case 'noenvio':
				$msm="No se enviaron los datos.";
				break;
			default:
				$msm="";
				break;
		}
	}

	if($msm!=""){ echo "<h3>$msm</h3>"; }
	$arComentarios=$archisolo[0]; $arRespuestas=$archisolo[1]; $arContador=$archisolo[2]; $arCaja=$archivos[2];
	
	if(file_exists($arComentarios) && file_exists($arContador) && file_exists($arCaja)){
		require_once $arComentarios;
		if(file_exists($arRespuestas)){ require_once $arRespuestas; }
		$leerCon=file_get_contents($arContador);
		echo "<h3>$leerCon comentarios...</h3><br>";
		
		$mosOpcionesCaja=true;
		for($i=file_get_contents($arContador); $i>=$empPComentarios; $i--):
			if(isset($dato[$i])){ $resp='';
				$com=$dato[$i]; $modi='t=m&id='.$i.'&id2=0'; $idu=''; $eti='';
				if(!isset($res[$i][$maxPRespuestas])){
					$resp='<form method="post" action="responder.php?t=r&id='.$i.'"><input type="submit" name="responder" value="Responder">';
				} require $arCaja;
			}
			for($e=$maxPRespuestas; $e>=1; $e--){ $resp='';
				if(isset($res[$i][$e])){
					$com=$res[$i][$e]; $modi='t=m&id='.$i.'&id2='.$e; $idu=' ~ '.$e.' > '.$dato[$i]['usuario']; $eti=" class='res'";
					require $arCaja;
				}
			}
		endfor;
	}
?><br><br>
&copy; 2023 <a href="https://dbproject.rf.gd" target="_blank">ArminVT/DBHS</a><br><br><br>
</body>
</html>