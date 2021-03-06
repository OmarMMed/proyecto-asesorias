<?php 
include("cabecera_asesor.php");


$num = $_SESSION['asesor'];
$con = conectar();

    $query = "SELECT * FROM asesores WHERE idAsesor = '$num'";
    $result = $con->query($query);
    $row = $result->fetch_object();
    $_idAsesor = $row->idAsesor;
    $_correo = $row->correo;
    $_nombre = $row->nombre;
    $password = $row->password;
    $_celular = $row->celular;
    $_carrera = $row->carrera;
    $_grado = $row->grado;
    $_grupo = $row->grupo;
    $dias = $row->diasDisponibles;
    $horario = $row->horario;
?>




            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title" >Perfil de Asesor</h2>
                        <?php
                        //Si en la página siguiente no encuentra un campo, se activa el error y se muestra un mensaje
                            if (isset($_GET['error']))
                            {
                                $error = $_GET['error'];
                                echo '<strong style="color: red">'. $error .'</strong><br>';
                            }


                        ?>
                            <form method="post" action="editar_perfil_asesor.php" onsubmit="return validarCheckboxes()">
                                    <label>Numero de Asesor:</label><br>
                                    <input type="text" name="id" pattern="[0-9]*" minlength="8" maxlength="8" value="<?=$_idAsesor?>" readonly=»readonly></p>
                                    <label for="nombre">Nombre Completo:</label>
                                    <p><input type="text" style="WIDTH: 400px;" name="nombre" maxlength="50" pattern="[a-zA-Z ñáéíóú]*" placeholder required value="<?=$_nombre?>"></p>
                                    <label for="telefono">Número de Teléfono:</label>
                                    <p><input type="text" name="telefono" minlength="10" maxlength="10" pattern="[0-9]+" required value="<?=$_celular?>"></p>
                                    <label for="correo">Correo Electrónico:</label>
                                    </p>
                                    <p><input type="email" style="WIDTH: 400px;" name="correo" required value="<?=$_correo?>"></p>
                                    <label>Carrera: </label> </p>
                                    <select   id = "carrera" name = "carrera" required>
                                        <option selected disabled hidden value="">Elija la carrera donde participa</option>
                                        <option value="Informática" <?php if($_carrera == "Informática"){echo "selected";}?>>Facultad de Informática Culiacán</option>
                                        <option value="ITSE" <?php if($_carrera == "ITSE"){echo "selected";}?>>Ingeniería en Telecomunicaciones y Sistemas y Electronica</option>
                                    </select> </p>
                                    
                                    <label>Grado y Grupo</label>

                                    <select   name="grado" required>
                                        <option selected disabled hidden value="">Elija el grado al que pertenece</option>
                                        <option value="1" <?php if($_grado == "1"){echo "selected";}?>>1</option>
                                        <option value="2" <?php if($_grado == "2"){echo "selected";}?>>2</option>
                                        <option value="3" <?php if($_grado == "3"){echo "selected";}?>>3</option>
                                        <option value="4" <?php if($_grado == "4"){echo "selected";}?>>4</option>
                                        <option value="5" <?php if($_grado == "5"){echo "selected";}?>>5</option>
                                    </select>
                                    <label>-</label>
                                    <select   name="grupo" required>
                                        <option selected disabled hidden value="">Elija el grupo al que pertenece</option>
                                        <option value="1" <?php if($_grupo == "1"){echo "selected";}?>>1</option>
                                        <option value="2" <?php if($_grupo == "2"){echo "selected";}?>>2</option>
                                        <option value="3" <?php if($_grupo == "3"){echo "selected";}?>>3</option>
                                        <option value="4" <?php if($_grupo == "4"){echo "selected";}?>>4</option>
                                        <option value="5" <?php if($_grupo == "5"){echo "selected";}?>>5</option>
                                    </select><br>
                                    <h2>Editar horarios</h2>
                                    <label>Dias Disponibles</label><br>
                                    <input type="checkbox" name="lunes" id="lunes" value="lunes" <?php if(preg_match("/lunes/", $dias)){echo "checked";}?>><label> Lunes</label><br>
                                    <input type="checkbox" name="martes" id="martes" value="martes" <?php if(preg_match("/martes/", $dias)){echo "checked";}?>><label> Martes</label><br>
                                    <input type="checkbox" name="miercoles" id="miercoles" value="miercoles" <?php if(preg_match("/miercoles/", $dias)){echo "checked";}?>><label> Miércoles</label><br>
                                    <input type="checkbox" name="jueves" id="jueves" value="jueves" <?php if(preg_match("/jueves/", $dias)){echo "checked";}?>><label> Jueves</label><br>
                                    <input  type="checkbox" name="viernes" id="viernes"value="viernes" <?php if(preg_match("/viernes/", $dias)){echo "checked";}?>><label> Viernes</label><br>
                                    <label for="horario" required>Horario:</label>
                                    <input type="time" name="horario" min="08:00" max="19:00" value="<?php echo $horario;?>"> <label>Toma en cuenta que una buena asesoria dura minimo 1 hora</label></br>
                                    </p>   
                                    <a href="../asesor/perfil_materias_asesor.php">Editar Horarios y Materias</a><br><br>
                                    <input type="submit" class="btn btn-success" value="Confirmar Cambios" name="registro"><br>
                            </form><br>
                            <form action="borrar_asesor.php" method="POST">
                                <input type="submit" class="btn btn-danger" value="Eliminar Asesor" name="registro"><br>
                            </form><br>
                            <form action="asesores.php">
                                <input type="submit" class="btn btn-primary" value="Regresar" name="registro">
                            </form>
                     </div>
                </div>
            </div>




<?php include('footer_asesor.php') ?>