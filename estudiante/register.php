<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Estudiante</title><!-- Font Icon -->
    <link rel="stylesheet" href="../fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="../css/style.css">

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


<!-- Sign up form -->
<section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Registro Estudiantes</h2>

  
  <?php 
    if(isset($_GET['error']))
    { 
      $error = $_GET['error'];
      echo '<strong style="color: red">'. $error .'</strong><br>';
    } 
    ?>
<form action="registro_estudiantes_BD.php" method="POST">
  <div class="mb-3">
  
    <input required name="numCuenta" pattern="[0-9]*" minlength="8" maxlength="8" type="text" class="form-control" placeholder="Ingrese su número de cuenta" id="txtId" value="" onkeypress="return valideKey(event);">
  </div>
  

  <div class="mb-3">
    <input required name="nombreCompleto" type="text" class="form-control" 
    id="nombreCompleto" placeholder="Ingrese el nombre" value=""  onkeypress="return soloLetras(event);">
  </div>
 
  <div class="mb-3">
    <input required name="pwd" type="password" class="form-control" 
    id="pwd" placeholder="Ingrese una contraseña" value="">
  </div>

  <div class="mb-3">
    <input required name="confirmar" type="password" class="form-control" 
    id="confirmar" placeholder="Confirme su contraseña" value="">
  </div>

  <div class="mb-3">
    <select required class="form-select form-select-sm" aria-label=".form-select-sm example" name="carrera">
    <option selected disabled hidden value="">Seleccione su carrera</option>
        <option value="Licenciatura en Informatica">Licenciatura en Informatica</option>
        <option value="ITSE">ITSE</option>
    </select>
  </div>

  <div class="mb-3">
    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="grado" required>
    <option selected disabled hidden value="">Seleccione el año que está cursando</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
  </select>
  </div>

  <div class="mb-3">
    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="grupo" required>
      <option selected disabled hidden value="">Elija el grupo al que pertenece</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select>
  </div>

  <div class="mb-3">
    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="turno" required>
    <option selected disabled hidden value="">Seleccione su turno</option>
        <option value="Matutino">Matutino</option>
        <option value="Vespertino">Vespertino</option>
    </select>
  </div>

  <div class="mb-3">
    <input name="promedio" type="text" class="form-control" 
    id="promedio" placeholder="Ingrese su promedio" value="" required>
  </div>

  <div class="mb-3">
    <input name="celular" minlength = "10" maxlength="10"  type="text" class="form-control" 
    id="celular" placeholder="Ingrese su numero de celular" value="" pattern="[0-9]*" onkeypress="return valideKey(event);" required>
  </div>

  <div class="mb-3">
    <input name="correo" type="email" class="form-control" 
    id="correo" placeholder="Ingrese su correo" value="" required>
  </div>
  
  <button type="submit" class="btn btn-primary" style="float: right;">Confirmar</button>
</form>
  </div>
  <a href="../index.php" class="signup-image-link">Ya soy un usuario</a>
</div>

</div>
            </div>
        </section>
       
</body>
</html>