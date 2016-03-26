<html>
	<head>
	<title>Lista de personal</title>
	</head>
	<body>
<?php
if(!$_POST){?>
<form action="lista.php" method="post">
 <p>Turno: <select name="turno">
			<option value="1">Turno A</option>
			<option value="2">Turno B</option>
			<option value="3">Turno noite</option>
		</select></p>
 <p>Liña: <select name="linha">
			<option value="1">Anguriñas 1</option>
			<option value="2">Anguriñas 2</option>
			<option value="3">Anguriñas 3</option>
			<option value="Surimi 1">Surimi 1</option>
			<option value="Surimi 2">Surimi 2</option>
			<option value="Surimi 3">Surimi 3</option>
			<option value="Muslitos">Muslitos</option>
		</select> </p>
 <p>Data: <input type="date" name="data"></p>
 <p><input value="Enviar" type="submit" /></p>
</form>
<?php
}else{
	echo $_POST['turno'];
// Conectando, seleccionando a base de datos
$link = mysql_connect('localhost', 'admin_code', 'qn7A74Elw2')
    or die('Non se puido conectar: ' . mysql_error());
mysql_select_db('admin_code') or die('Non se puido seleccionar a base de datos');

// Realizar unha consulta MySQL
if($_POST['turno']=="1"){
	echo "Personal do turno A";
	$query = 'SELECT DNI, Nome FROM Operario WHERE Turno=1';
	}elseif($_POST['turno']=="2"){
	echo "Personal do turno B";
	$query = 'SELECT DNI, Nome FROM Operario WHERE Turno=2';
	}else{
	echo "Personal do turno Noite";
	$query = 'SELECT DNI, Nome FROM Operario WHERE Turno=3';	
	}
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

// Imprimir los resultados en HTML
echo "<table>\n";
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";

// Liberar resultados
mysql_free_result($result);

// Pechar a conexión
mysql_close($link);
}
?>
	</body>
</html>
