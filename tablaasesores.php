<?php 
	include("header.php");
	require 'conexion.php';
  	$conn=new mysqli($servidor, $usuario, $pwd, $bd);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<table>
		<tr>
			<td>idAsesor</td>
			<td>correo</td>
			<td>nombre</td>
			<td>password</td>
			<td>celular</td>
			<td>carrera</td>
			<td>grupo</td>
			<td>diasDisponibles</td>
			<td>horario</td>
		</tr>
	<?php
	$sql="SELECT * FROM asesores";
	$result=mysqli_query($conn,$sql);

	while ($mostrar=mysqli_fetch_array($result)) {
	?>
	<tr>
		<td><?php echo $mostrar['idAsesor']?></td>
		<td><?php echo $mostrar['correo']?></td>
		<td><?php echo $mostrar['nombre']?></td>
		<td><?php echo $mostrar['password']?></td>
		<td><?php echo $mostrar['celular']?></td>
		<td><?php echo $mostrar['carrera']?></td>
		<td><?php echo $mostrar['grupo']?></td>
		<td><?php echo $mostrar['diasDisponibles']?></td>
		<td><?php echo $mostrar['horario']?></td>
	</tr>
	<?php
	} 
	?>
	</table>
</body>
</html>