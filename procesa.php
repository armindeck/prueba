<?php require_once 'datos.php';

$proceso=[false,false,false];
if(!empty(darFormatoNoSimbolos(trim($_POST['envio']))) && isset($_GET['tipo'])){
	$proceso['tipo']=darFormatoNoSimbolos(trim($_GET['tipo'])); $proceso[0]=true;
} else { header("Location: $archivos[1]?msm=noenvio"); }

if($proceso[0]){
	$usuario=darFormatoNoSimbolos(trim($_POST['usuario']));
	$email=darFormato(trim($_POST['email']));
	$comentario=darFormato(trim($_POST['comentario']));

	if( #VERIFICACION DE DATOS
		strlen($usuario)>=4 && strlen($usuario)<=30 &&
		strlen($email)>=12 && strlen($email)<=100 &&
		strlen($comentario)>=10 && strlen($comentario)<=5000){
		$proceso[1]=true;
	} else { header("Location: $archivos[1]?msm=nocumplieron"); }
}

if($proceso[1]){

	switch($proceso['tipo']){
		case 'comentar':
			$archivo=$archisolo[0];
			$contador=$archisolo[2];
			if(!file_exists($contador)){ file_put_contents($contador,0); }
			$leerCon=file_get_contents($contador);
			if($leerCon<$maxDComentarios){
				$aumenCon=$leerCon+1;
				file_put_contents($contador,$aumenCon);

				
				$tip=['dato',$aumenCon,'','publicado'];
				$proceso[2]=true;
			} else{
				print( 'Lo lamento, pero numero maximo de comentarios es: '.$maxDComentarios);
				header("Refresh:3; url='{$archivos[1]}'");
				break;
			}
		break;
		case 'responder':
			$archivo=$archisolo[1];
			$contador=$archisolo[3];
			if(!file_exists($contador)){ file_put_contents($contador,"<?php\n"); }
			require_once $contador;
				
			$id=darFormatoNoSimbolos(trim($_GET['id']));
			for($i=1; $i<=$maxDRespuestas; $i++){
				if(isset($res[$id][$maxDRespuestas])){
					print( 'Lo lamento, pero numero maximo de respuestas es: '.$maxDRespuestas);
					header("Refresh:3; url='{$archivos[1]}'");
					break;
				}
				if(!isset($res[$id][$i])){
					$resda="$"."res[$id][$i]=$i".";\n";

					$grabar = fopen($contador,"a");
					fwrite ($grabar, $resda);
					fclose($grabar);

					$tip=['res',$id,"[$i]","repondido&id=$id&id2=$i"];
					$proceso[2]=true; break;
				}
			}
			
		break;
		case 'modificar':
			$id=darFormatoNoSimbolos(trim($_GET['id']));
			$id2=darFormatoNoSimbolos(trim($_GET['id2']));

			if($id2!=0){
				$archivo=$archisolo[1];
				$tip=['res',$id,"[$id2]","modificado&id=$id&id2=$id2"];
			} else {
				$archivo=$archisolo[0];
				$tip=['dato',$id,"","modificado&id=$id&id2=$id2"];
			}
			$proceso[2]=true;
		break;
		default: header("Location: $archivos[1]?msm=nocumplieron&switch"); break;
	}
}

if($proceso[2]){
	if(!file_exists($archivo)){ file_put_contents($archivo,"<?php\n"); }
	$leer=file_get_contents($archivo);
	$datos="$".$tip[0].'['.$tip[1].']'.$tip[2].'=['."\n'usuario'=>'$usuario',\n'email'=>'$email',\n'comentario'=>'$comentario',\n'fecha'=>'$fecha'\n];\n";
	if($proceso['tipo']=='modificar'){ $datosMod="$".$tip[0].'['.$tip[1].']'.$tip[2].'["modificado"]=true;'."\n"; } else { $datosMod=''; }
	file_put_contents($archivo, "$leer$datos$datosMod");
	header("Location: $archivos[1]?msm=$tip[3]");
}

?>