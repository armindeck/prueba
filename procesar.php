<?php require_once 'datos.php';

function darFormato($string) {
	$string = str_replace(array('<'), '«', $string );
	$string = str_replace(array('>'), '»', $string );
	$string = str_replace(array("'"), ' &#039; ', $string );
	$string = str_replace(array('"'), ' &quot; ', $string );
	$string = str_replace(array('{'), ' &#123; ', $string );
	$string = str_replace(array('}'), ' &#125; ', $string );
	return $string;
}

function darFormatoNoSimbolos($string) {
	$string = str_replace(array('☺', '☻', '♥', '♦', '♣', '♠', '•', '◘', '○', '◙', '♂', '♀', '♪', '♫', '☼', '►', '◄', '↕', '‼', '¶', '§', '▬', '↨', '↑', '↓', '→', '←', '∟', '↔', '▲', '▼', '!', '"', '#', '$', '%', '&', '(', ')', '*', '+', ',', '-', '.', '/', ':', ';', '<', '=', '>', '?', '@', '[', ']', '^', '_', '`', '{', '|', '}', '~', '⌂', 'ª', 'º', '¿', '®', '¬', '½', '¼', '¡', '«', '»', '░', '▒', '▓', '│', '┤', '©', '╣', '║', '╗', '╝', '¢', '¥', '┐', '└', '‼', '┴', '┬', '├', '─', '┼', '╚', '╔', '╩', '╦', '╠', '═', '╬', '¤', 'ð', '┘', '┌', '█', '▄', '¦', '▀', '¯', '´', '±', '³', '²', '¶', '§', '÷', '¸', '°', '¨', '·', '¹', '³', '²', '■', "'", '“', '”'), '', $string );
	return $string;
}

if(!empty(darFormatoNoSimbolos(trim($_POST['envio'])))){
	$usuario=darFormatoNoSimbolos(trim($_POST['usuario']));
	$email=darFormato(trim($_POST['email']));
	$comentario=darFormato(trim($_POST['comentario']));

	if( #VERIFICACION DE DATOS
		strlen($usuario)>=4 && strlen($usuario)<=30 &&
		strlen($email)>=17 && strlen($email)<=100 &&
		strlen($email)>=10 && strlen($email)<=5000){

		$contador=$archisolo[2];
		if(!file_exists($contador)){ file_put_contents($contador,0); }
		$leerCon=file_get_contents($contador);
		$aumenCon=$leerCon+1;
		file_put_contents($contador,$aumenCon);


		$archivo=$archisolo[0];
		if(!file_exists($archivo)){ file_put_contents($archivo,"<?php\n"); }
		$leer=file_get_contents($archivo);
		$datos="$".'dato['.$aumenCon.']=['."\n'usuario'=>'$usuario',\n'email'=>'$email',\n'comentario'=>'$comentario',\n'fecha'=>'$fecha'\n];\n";
		file_put_contents($archivo, "$leer$datos");

		header("Location: $archivos[1]?msm=publicado");
	} else { header("Location: $archivos[1]?msm=nocumplieron"); }
} else { header("Location: $archivos[1]?msm=noenvio"); }


?>