<?php require_once("../conexion.php")?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Registrar Asesor</title>
        <link rel="stylesheet" href="../estilos.css">
        <script src="scripts.js"></script>
    </head>
    <body>
        <div class="contenedor">
            <h2>Ingrese sus datos</h2>
            <?php
            //Si en la página siguiente no encuentra un campo, se activa el error y se muestra un mensaje
                if (isset($_GET['error']))
                {
                    $error = $_GET['error'];
                    echo '<strong style="color: red">'. $error .'</strong><br>';
                }
            ?>
                <form method="post" action="seleccionarMaterias.php" onsubmit="return validarCheckboxes()">
                        <label for="nombre">Nombre Completo:</label>
                        <p><input type="text" name="nombre" maxlength="50" pattern="[a-zA-Z ñáéíóú]*" placeholder required></p>
                        <label for="telefono">Número de Teléfono:</label>
                        <p><input type="text" name="telefono" minlength="10" maxlength="10" pattern="[0-9]+" required></p>
                        <label for="correo">Correo Electrónico:</label>
                        </p>
                        <p><input type="email" name="correo" required></p>
                        <label>Carrera: </label> </p>
                        <select id = "carrera" name = "carrera" required>
                            <option selected disabled hidden value="">Elija la carrera donde participa</option>
                            <option value="Informática">Facultad de Informática Culiacán</option>
                            <option value="ITSE">Ingeniería en Telecomunicaciones y Sistemas y Electronica</option>
                        </select> </p>
                        <label>Grado y Grupo</label>
                        <select name="grado" required>
                            <option selected disabled hidden value="">Elija el grado al que pertenece</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <label>-</label>
                        <select name="grupo" required>
                            <option selected disabled hidden value="">Elija el grupo al que pertenece</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        </p>
                        <label>Dias Disponibles de la Semana: </label>
                        </p>
                        <input type="checkbox" name="lunes" id="lunes" value="lunes"><label>Lunes</label><br>
                        <input type="checkbox" name="martes" id="martes" value="martes"><label>Martes</label><br>
                        <input type="checkbox" name="miercoles" id="miercoles" value="miercoles"><label>Miércoles</label><br>
                        <input type="checkbox" name="jueves" id="jueves" value="jueves"><label>Jueves</label><br>
                        <input type="checkbox" name="viernes" id="viernes"value="viernes"><label>Viernes</label><br>
                        </p>
                        <label for="horario" required>Horario:</label>
                        <input type="time" name="horario" min="08:00" max="19:00"> <label>Toma en cuenta que una buena asesoria dura minimo 1 hora</label>
                        </p>    
                        <input type="submit" value="Registrarse" name="registro">
                </form>
        </div>
    </body>
</html>