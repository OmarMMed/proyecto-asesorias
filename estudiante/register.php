<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Registro de Estudiante</title>

    <!-- Font Icon -->
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

    <div class="main">
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Registro Estudiante</h2>
                        <form method="POST" class="register-form" id="register-form" action="registro_estudiantes_BD.php">
                        <div class="mb-3">
                            <input name="numCuenta" type="text" class="form-control" placeholder="Ingrese su número de cuenta" id="txtId" value="" onkeypress="return valideKey(event);">
                            </div>
                            <div class="mb-3">
                                <input name="nombreCompleto" type="text" class="form-control" 
                                id="nombreCompleto" placeholder="Ingrese el nombre completo" value=""  onkeypress="return soloLetras(event);">
                            </div>
                            
                            <div class="mb-3">
                                <input name="pwd" type="text" class="form-control" 
                                id="pwd" placeholder="Ingrese una contraseña" value="">
                            </div>

                            <div class="mb-3">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="carrera">
                                    <option selected>Seleccione su carrera</option>
                                    <option value="Licenciatura en Informatica">Licenciatura en Informatica</option>
                                    <option value="ITSE">ITSE</option>
                                </select>
                            </div>

                            <div class="mb-3">
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
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="turno">
                                    <option selected>Seleccione su turno</option>
                                    <option value="Matutino">Matutino</option>
                                    <option value="Vespertino">Vespertino</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <input name="grupo" type="text" class="form-control" 
                                id="grupo" placeholder="Ingrese su grupo" value="">
                            </div>

                            <div class="mb-3">
                                <input name="promedio" type="text" class="form-control" 
                                id="promedio" placeholder="Ingrese su promedio" value="">
                            </div>

                            <div class="mb-3">
                                <input name="celular" maxlength="10"  type="text" class="form-control" 
                                id="celular" placeholder="Ingrese su numero de celular" value="" onkeypress="return valideKey(event);">
                            </div>

                            <div class="mb-3">
                                <input name="correo" type="email" class="form-control" 
                                id="correo" placeholder="Ingrese su correo" value="">
                            </div>
                         <div class="form-group form-button">
                            <input type="submit" name="reg_user" id="reg_user" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="../images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="../login.php" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>
       
    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>