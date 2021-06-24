function validarCheckboxes()
{
    var validacion = false;
    
    if(document.getElementById("lunes").checked || document.getElementById("martes").checked ||
    document.getElementById("miercoles").checked || document.getElementById("jueves").checked 
    || document.getElementById("viernes").checked)
    {
        valid = true;
    }
    else
    {
        valid = false;
    }

    if(!valid)
    {
        alert("Por favor seleccione un día para tomar la clase");
        return false;
    }
}
