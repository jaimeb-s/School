function validar() {
    var nombre, apellido, usuario, contra1, contra2;

    nombre = document.getElementById('nombre').value;
    apellido = document.getElementById('apellidos').value;
    usuario = document.getElementById('usuario').value;
    contra1 = document.getElementById('contra1').value;
    contra2 = document.getElementById('contra2').value;

    if (nombre === "" || apellido === "" || usuario === "" || contra1 === "" || contra2 === "") {
        alert("Todos los campos son obligatorios");
        return false;
    } else if (nombre.length > 15) {
        alert("El nombre es muy largo");
        return false;
    } else if (apellido.length > 20) {
        alert("El apellido es muy largo");
        return false;
    } else if (usuario.length > 10) {
        alert("El usuario es demaciado largo");
        return false;
    } else if (contra1.length < 4 || contra2.length < 4) {
        alert("Las contraseñas son demasiado cortas");
        return false;
    } else if (contra1.length > 15 || contra2.length > 15) {
        alert("las contraseñas son muy largas");
        return false;
    } else if (contra1 != contra2) {
        alert("Las contraseñas no coinciden");
        return false;
    }
}

function validar_inicio() {
    var usuario, contra;
    usuario = document.getElementById('usuario').value;
    contra = document.getElementById('contra').value;

    if (usuario === "" || contra === "") {
        alert("Todos los campos son obligatorios");
        return false;
    } else if (usuario.length > 15) {
        alert("El usuario es muy largo");
        return false;
    } else if (contra.length < 4) {
        alert("Las contraseñas son demasiado cortas");
        return false;
    } else if (contra.length > 15) {
        alert("La contraseña es demasiado larga");
        return false;
    }
}

function validar_cambiar_contra() {
    var nombre, apellido, usuario, contranueva;
    nombre = document.getElementById('nombre').value;
    apellido = document.getElementById('apellido').value;
    usuario = document.getElementById('usuario').value;
    contranueva = document.getElementById('contranueva').value;

    if (nombre === "" || apellido === "" || usuario === "" || contranueva === "") {
        alert("Todos los campos son obligatorios");
        return false;
    } else if (nombre.length > 15) {
        alert("El nombre es muy largo");
        return false;
    } else if (apellido.length > 20) {
        alert("EL apellido es muy largo");
        return false;
    } else if (usuario.length > 15) {
        alert("EL usuario es muy largo");
        return false;
    } else if (contranueva.length < 4) {
        alert("La contraseña nueva es demaciado corta");
        return false;
    } else if (contranueva.length > 15) {
        alert("La contraseña es demaciado larga");
        return false;
    }
}