<?php require_once 'datos.php';
if(!empty($_POST['modificar'])){
$id=$_GET['id']; $id2=$_GET['id2'];
if($id2!=0){ require 'respuestas.php'; $entrada=$res[$id][$id2]; } else { require 'comentarios.php'; $entrada=$dato[$id]; }
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
<h1>Modificador de comentarios basico by ArminVT</h1>
<h2>El comentario a modificar: <?php echo $id.' ~ '.$id2; ?></h2><hr>
<?php

echo '<form method="post" action="'.$archivos[4].'?tipo=modificar&id='.$id.'&id2='.$id2.'">' . '
Nombre: <input type="text" name="usuario" value="' . $entrada['usuario'] . '">' . '<br>
Correo: <input type="email" name="email" value="' . $entrada['email'] . '">' . '<br>
Comentario:<br> <textarea name="comentario">' . $entrada['comentario'] . '</textarea>' . '<br>

<input type="submit" name="envio" value="modificar"><form>'; ?>

<br><br>
&copy; 2023 <a href="https://dbproject.rf.gd" target="_blank">ArminVT/DBHS</a><br><br><br>
</body>
</html>

<?php } else { header("Location: index.php?msm=nocumplieron"); }
?>