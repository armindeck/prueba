<?php require_once 'datos.php';
if(!empty($_POST['responder'])){
if(isset($_GET['id'])){ $id=$_GET['id']; require 'comentarios.php'; $com=$dato[$id]; }

?>

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
<h1>Responder comentarios basico by ArminVT</h1>
<h2>El comentario a responder: <?php echo $id; ?></h2><hr>
<?php

echo "<table><tr><td class='usuario'>".$com['usuario'].' <span class="t12">~ '.$id.'</span></td><td class="der">'.$com['email'].'</td></tr><tr><td colspan="2">'.$com['comentario'].'</td></tr><tr><td class="fecha">'.$com['fecha'].'</td></tr></table>';

echo '<form method="post" action="'.$archivos[4].'?tipo=responder&id='.$id.'">' . '
Nombre: <input type="text" name="usuario">' . '<br>
Correo: <input type="email" name="email">' . '<br>
Comentario:<br> <textarea name="comentario"></textarea>' . '<br>

<input type="submit" name="envio" value="Responder"><form>'; ?>

<br><br>
&copy; 2023 <a href="https://dbproject.rf.gd" target="_blank">ArminVT/DBHS</a><br><br><br>
</body>
</html>

<?php } else { header("Location: index.php?msm=nocumplieron"); }
?>