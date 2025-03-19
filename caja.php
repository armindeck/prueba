<?php
if($mosOpcionesCaja && $_SESSION['rol']=='admin'){ $opcionesCaja='<div class="opciones"><form method="post" action="modificar.php?'.$modi.'"><input type="submit" name="modificar" value="Modificar"></form>  '.$resp.'</form></div>'; } else { $opcionesCaja=''; }
if(isset($com['modificado'])){ $modc=' <span style="color:#484848;font-weight:normal;">(modificado)</span>'; } else { $modc=''; }
echo "<table".$eti."><tr><td class='usuario'>".$com['usuario'].' <span class="t12">#'.$i.$idu.$modc.'</span></td><td class="der">'.$com['email'].'</td></tr><tr><td colspan="2">'.$com['comentario'].'</td></tr><tr><td class="fecha">'.$com['fecha'].$opcionesCaja.' </td></tr></table>';
?>