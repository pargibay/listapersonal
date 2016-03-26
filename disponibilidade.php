

<?php
// Conectando, seleccionando a base de datos
$link = mysql_connect('localhost', 'root', '')
    or die('Non se puido conectar: ' . mysql_error());
mysql_select_db('frivipesca') or die('Non se puido seleccionar a base de datos');
$cons_personal = 'SELECT * FROM Operario WHERE disponibilidade="1"';
$result_personal = mysql_query($cons_personal) or die('Consulta fallida: ' . mysql_error());
echo "<option value=''></option>";
while($registro=mysql_fetch_array($result_personal)){ echo "<option value='".$registro['idoperario']."'>".$registro['Nome']." ".$registro['Apelido']." ".$registro['Apelido2']."</option>";}



?>

