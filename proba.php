<?php
include ("disponibilidade.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">

<html>
<head>
    <title>Select Excluyentes</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js" type="text/javascript">
</script>
    <style type="text/css">
.hidden { display: none; }
    </style>
    <script type="application/x-javascript">
    $(function () {
            function restrict_multiple(selector) {
                // Aqui establece el valor actual en su alt
                $(selector).each(function () {
                    $(this).attr("alt", $(this).val());
                })
                // Disparador cuando cambia el select
                $(selector).change(function () {
                    // Eliminando el hidden del option
                    $(selector + " option").removeClass("hidden");
                    
                    // Se usa el alt attr, como aun auxiliar para mantener el valor que esta activo
                    $(this).attr("alt", $(this).val())
                    
                    // Creando un arreglo con las opciones seleccionadas
                    var selected = new Array();
                    
                    // Cada opcion seleccionada se ingresa en el arreglo
                    $(selector + " option:selected").each(function () {
                        selected.push(this.value);
                    })
                    
                    // Ocultando los seleccionados ya, para no verlos en los demas selects
                    for (k in selected) {
                        $(selector + "[alt!=" + selected[k] + "] option[value=" + selected[k] + "]").addClass("hidden")
                    }
                })
                
                // Disparador para que se mantenga actualizado todos los selects
                $(selector).each(function () { $(this).trigger("change"); })
            }
            
            restrict_multiple(".excluyent-select");
        })
    </script>
</head>

<body>
	<?php
// Conectando, seleccionando a base de datos
$link = mysql_connect('localhost', 'root', '')
    or die('Non se puido conectar: ' . mysql_error());
mysql_select_db('frivipesca') or die('Non se puido seleccionar a base de datos');
$cons_personal = 'SELECT * FROM Operario WHERE disponibilidade="1"';
$result_personal = mysql_query($cons_personal) or die('Consulta fallida: ' . mysql_error());


/* while($registro=mysql_fetch_array($result_personal)){ echo "<input class='personal' 
	type='hidden' idPuesto='' 
	id='idoperario".$registro['idoperario']."'
	idOperario='".$registro['idoperario']."' nome='".$registro['Nome']."'  apelido1='".$registro['Apelido']."' apelido2='".$registro['Apelido2']."'/> ";}
*/


?>		
		
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
echo "<div class='select'>";
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    foreach ($line as $col_value) {
        echo $col_value.": <select class='excluyent-select' name='".$col_value."' id='".$col_value."'>"; 
        echo $disponibilidade;
        echo "</select>";
    }
}
echo "</div>";

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
