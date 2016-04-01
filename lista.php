<html>
	<head>
	<title>Lista de <?php echo $_POST['linha'];?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

	</head>
	<body onload="">
<script src="./js/jquery-1.12.2.js"> </script>		
	
		

<?php
// Conectando, seleccionando a base de datos
$link = mysql_connect('localhost', 'root', '')
    or die('Non se puido conectar: ' . mysql_error());
mysql_select_db('frivipesca') or die('Non se puido seleccionar a base de datos');
$cons_personal = 'SELECT * FROM Operario WHERE disponibilidade="1"';
$result_personal = mysql_query($cons_personal) or die('Consulta fallida: ' . mysql_error());


while($registro=mysql_fetch_array($result_personal)){ echo "<input class='personal' 
	type='hidden' idPuesto='' 
	id='idoperario".$registro['idoperario']."'
	idOperario='".$registro['idoperario']."' nome='".$registro['Nome']."'  apelido1='".$registro['Apelido']."' apelido2='".$registro['Apelido2']."'/> ";}



?>
		
	<!-- Memoria de personal en javascript-->
		<script type="text/javascript"> 
		
		
		function cargarInicio () {
			$("select").change(function () {
				$("#idoperario"+$(this).val()).attr('idpuesto', "x")
				alert ( $(this).val());
				});
			
			}
		
		
		</script>		
		
<?php
if($_POST){
echo "A liña seleccionada é ".$_POST['linha']." para o turno ".$_POST['turno']." e a data ".$_POST['data'];

// Conectando, seleccionando a base de datos
$link = mysql_connect('localhost', 'root', '')
    or die('Non se puido conectar: ' . mysql_error());
mysql_select_db('frivipesca') or die('Non se puido seleccionar a base de datos');
$linha=$_POST['linha'];
// Realizar unha consulta MySQL
	$query = 'SELECT posto FROM Posto WHERE idlinha='.$linha.' ';
	$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

// Imprimir los resultados en HTML
echo "<table>\n";
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td class='fila'>".$col_value.": <select  name='".$col_value."'>"; 
        include "disponibilidade.php";
        echo "</select></td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";

// Liberar resultados
mysql_free_result($result);

// Pechar a conexión
mysql_close($link);
}else{
echo "<h1>Acceso denegado</h1>";
	}
?>


</body>
</html>
