<?php
include("../header.php");
require ("../conexion.php"); 
if(isset($_SESSION['asesor'])){
  header("Location: ../asesores.php");
}
elseif(isset($_SESSION['estudiante'])){
  header("Location: ../estudiantes.php");
}
if(isset($_SESSION['rt'])){
echo '<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<title></title>
</head>
<body>

<div class="alert alert-warning" role="alert">
	<h4 class="alert-heading">Historial de Asesorias</h4>
</div>

<div class="row col-12">
	<div  class="col-10"></div>
	<div class="col-2">
	<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar estudiante.." title="Escribe un nombre">
   </div>
</div>

<div class="row col-12">
	<div  class="col-10"></div>
	<div class="col-2">
	<input type="text" id="myInput2" onkeyup="myFunction2()" placeholder="Buscar asesor.." title="Escribe un nombre">
   </div>
</div>

<div class="row col-12">
	<div  class="col-10"></div>
	<div class="col-2">
	<input type="text" id="myInput3" onkeyup="myFunction3()" placeholder="Buscar materia.." title="Escribe un nombre">
   </div>
</div>




<table class="table table-striped table-bordered" id="myTable">
<tr>
      <th>Clave</th>
      <th  onclick="sortTable(1)" style="cursor: pointer">Materia</th>
      <th onclick="sortTable(2)" style="cursor: pointer">Fecha y hora</th>
      <th onclick="sortTable(3)" style="cursor: pointer";>Nombre Estudiante</th>
      <th onclick="sortTable(4)" style="cursor: pointer">Nombre Asesor</th>
      <th onclick="sortTable(5)" style="cursor: pointer">Grupo</th>
      <th onclick="sortTable(6)" style="cursor: pointer">Carrera</th>
    </tr>';
    ?><?php
    
    //Crear la conexion al servidorde base de datos
    $conn = new  mysqli($servidor,$usuario,$pwd,$bd);


    //verificar la conexion al servidor de base de datos
    if ($conn->connect_error) {
    	die("Error al momento de conectar al servidor : " . $conn->connect_error);
    }

   //obtener los registros de la base de datos 
    $sql = "SELECT *  from agenda";
    $result = $conn->query($sql);

    if ($result->num_rows > 0){
    	while ($row = $result->fetch_object()) {
    		
         echo "<tr>";
            echo "<td>" . $row->idAsesoria . "</td>";
            echo "<td>" . $row->nombreMateria . "</td>";
            echo "<td>" . $row->Fecha . "</td>";
            echo "<td>" . $row->nombreEstudiante . "</td>";
            echo "<td>" . $row->nombreAsesor . "</td>";
            echo "<td>" . $row->grupoEstudiante . "</td>";
            echo "<td>" . $row->carrera . "</td>";
         echo "</tr>";

    	}
    	$result->free();
    	
    }
    $conn-> close();

echo '
</table>

<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

function myFunction2() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput2");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[4];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

function myFunction3() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput3");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  dir = "asc"; 
  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount ++;      
    } else {
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>

</body>
</html>'
;}else{
  header("Location: rt.php");
}
?>