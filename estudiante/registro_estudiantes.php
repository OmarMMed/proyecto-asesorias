<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Document</title>

    <script type="text/javascript">
      // Validar solo digitos
			function valideKey(evt){
				var code = (evt.which) ? evt.which : evt.keyCode;
				
				if(code==8) { 
				  return true;
				} else if(code>=48 && code<=57) { 
				  return true;
				} else{ 
				  return false;
				}
			}

      // Validar solo letras
			function soloLetras(e){
			   key = e.keyCode || e.which;
			   tecla = String.fromCharCode(key).toLowerCase();
			   letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
			   especiales = "8-37-39-46";

			   tecla_especial = false
			   for(var i in especiales){
					if(key == especiales[i]){
						tecla_especial = true;
						break;
					}
				}

				if(letras.indexOf(tecla)==-1 && !tecla_especial){
					return false;
				}
			}
    </script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    
    <a class="navbar-brand" href="#">Asesorías</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
</nav>

<div class="container">
<div class="card">
  <h5 class="card-header"> Registro Estudiante </h5>
  <div class="card-body">

  <form action="registro_estudiantes_BD.php" method="POST">
  
  <div class="mb-3">
    <label for="" class="form-label">Numero de Cuenta</label>
    <input name="numCuenta" type="text" class="form-control" placeholder="Ingrese su número de cuenta" id="txtId" value="" onkeypress="return valideKey(event);">
  </div>
  

  <div class="mb-3">
    <label for="nombreCompleto" class="form-label">Nombre</label>
    <input name="nombreCompleto" type="text" class="form-control" 
    id="nombreCompleto" placeholder="Ingrese el nombre" value=""  onkeypress="return soloLetras(event);">
  </div>
 
  <div class="mb-3">
    <label for="pwd" class="form-label">Contraseña</label>
    <input name="pwd" type="text" class="form-control" 
    id="pwd" placeholder="Ingrese una contraseña" value="">
  </div>

  <div class="mb-3">
    <label for="carrera" class="form-label">Carrera</label>
    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="carrera">
        <option selected>Seleccione su carrera</option>
        <option value="Licenciatura en Informatica">Licenciatura en Informatica</option>
        <option value="ITSE">ITSE</option>
    </select>
  </div>

  <div class="mb-3">
    <label for="grado" class="form-label">Grado</label>
    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="grado">
  <option selected>Seleccione el semestre que está cursando</option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
</select>
  </div>

  <div class="mb-3">
    <label for="turno" class="form-label">Turno</label>
    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="turno">
        <option selected>Seleccione su turno</option>
        <option value="Matutino">Matutino</option>
        <option value="Vespertino">Vespertino</option>
    </select>
  </div>

  <div class="mb-3">
    <label for="grupo" class="form-label">Grupo</label>
    <input name="grupo" type="text" class="form-control" 
    id="grupo" placeholder="Ingrese su grupo" value="">
  </div>

  <div class="mb-3">
    <label for="promedio" class="form-label">Promedio</label>
    <input name="promedio" type="text" class="form-control" 
    id="promedio" placeholder="Ingrese su promedio" value="">
  </div>

  <div class="mb-3">
    <label for="celular" class="form-label">Celular</label>
    <input name="celular" maxlength="10"  type="text" class="form-control" 
    id="celular" placeholder="Ingrese su numero de celular" value="" onkeypress="return valideKey(event);">
  </div>

  <div class="mb-3">
    <label for="correo" class="form-label">Correo</label>
    <input name="correo" type="email" class="form-control" 
    id="correo" placeholder="Ingrese su correo" value="">
  </div>
  
  <button type="submit" class="btn btn-primary" style="float: right;">Confirmar</button>
</form>
  </div>
</div>

</div>
</body>
</html>