/* 2.	Programa que cada vez que el usuario escriba una letra en un input se muestre al lado del input un mensaje indicando si el valor es vàlido o no. 
En caso que no sea vàlido muestra un mensaje personalizado indicando qué restriccion no cumple. */

let nombre = document.querySelector("#nombre");
let correo = document.querySelector("#correo");
let telefono = document.querySelector("#telefono");
let contraseña = document.querySelector("#contraseña");
let inputFecha = document.querySelector("#fecha");
let repContraseña = document.querySelector("#repcontraseña");
let formulario = document.querySelector("#formulario");

let spanNombre = document.querySelector("#spanNombre");
let spanEmail = document.querySelector("#spanEmail");
let spanTelefono = document.querySelector("#spanTelefono");
let spanContraseña = document.querySelector("#spanContraseña");
let spanFecha = document.querySelector("#spanFecha");
let spanRepContraseña = document.querySelector("#spanRepContraseña");

let validaNombre = false;
let validaEmail = false;
let validaTelefono = false;
let validaContraseña = false;
let validaFecha = false;
let validaRepContraseña = false;
let validaSOperativos = false;
let validaGenero = false;

//Función que valida el el valor del input del nombre cada vez que se deja de presionar una tecla.

nombre.addEventListener('keyup', function () {

    if (nombre.value.length >= 3 && nombre.value.length <= 10) {
        spanNombre.innerHTML = "OK!";
        validaNombre = true;
    } else if (nombre.value.length == 0) {
        spanNombre.innerHTML = "Obligatorio";
        validaNombre = false;
    } else {
        spanNombre.innerHTML = "Debe tener entre 3 y 10 letras.";
        validaNombre = false;
    }
});

//Función que valida el valor del input del correo cada vez que se deja de presionar una tecla.

var validRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

correo.addEventListener('keyup', function () {

    if (correo.value.match(validRegex)) {
        spanEmail.innerHTML = "OK!";
        validaEmail = true;
    } else if (correo.value.length == 0) {
        spanEmail.innerHTML = "Obligatorio";
        validaEmail = false;
    } else {
        spanEmail.innerHTML = "Formato incorrecto";
        validaEmail = false;
    }
})

//Función que valida el valor del input del teléfono cada vez que se deja de presionar una tecla.

telefono.addEventListener('keyup', function () {


    if (telefono.value.length == 9) {
        spanTelefono.innerHTML = "OK!";
        validaTelefono = true;
    } else if (telefono.value.length == 0) {
        spanTelefono.innerHTML = "Obligatorio";
        validaTelefono = false;
    } else {
        spanTelefono.innerHTML = "Debe tener 9 dígitos.";
        validaTelefono = false;
    }
})

//Función que valida el valor del input de la contraseña cada vez que se deja de presionar una tecla.

contraseña.addEventListener('keyup', function () {


    if (contraseña.value.length >= 4 && contraseña.value.length <= 10) {
        spanContraseña.innerHTML = "OK!";
        validaContraseña = true;
    } else if (contraseña.value.length == 0) {
        spanContraseña.innerHTML = "Obligatorio";
        validaContraseña = false;
    } else {
        spanContraseña.innerHTML = "Debe tener entre 4 y 10 caracteres";
        validaContraseña = false;
    }


})

// 3.	Programa que quando el usuario modifique la fecha, su valor sea inferior a la fecha actual. En caso contrario muestra un mensaje personalizado.

// Función que valida el valor del input de la fecha cada vez que se produce un cambio en él.

inputFecha.addEventListener("change", function () {

    var date = new Date();
    var month = date.getUTCMonth() + 1;
    var day = date.getUTCDate();
    var year = date.getUTCFullYear();

    fechaInput = inputFecha.value;

    let fechaDividida = fechaInput.split('-');
    let añoInput = parseInt(fechaDividida[0]);
    let mesInput = parseInt(fechaDividida[1]);
    let diaInput = parseInt(fechaDividida[2]);

    if (añoInput <= year && mesInput <= month && diaInput < day) {
        spanFecha.innerHTML = "OK!";
        validaFecha = true;
    } else {
        spanFecha.innerHTML = "La fecha tiene que ser inferior a la actual";
        validaFecha = false;
    }

});

//4.	Programa que al perder el foco de “repetir contraseña”, se muestre un mensaje indicando si las dos contraseñas son iguales o no.

//Función que valida el valor del input de repetir contraseña cuando pierde el foco.

repContraseña.addEventListener("blur", function () {
    if (repContraseña.value === contraseña.value) {
        repContraseña.style.backgroundColor = "green";
        spanRepContraseña.innerHTML = "Correcto";
        spanRepContraseña.style.color = "green";
        validaRepContraseña = true;
    } else {
        repContraseña.style.backgroundColor = "red";
        spanRepContraseña.innerHTML = "Las contraseñas no coinciden.";
        spanRepContraseña.style.color = "red";
        validaRepContraseña = false;
    }
})


/* 5.	Programa que al clicar en Enviar solo se envíe el formulario si el formulario es correcto. 
Para que el formulario sea correcto se tienen que validar las restricciones del punto 2, 3 ,4 y a demás comprueba que :
5.1.	Se hayan marcado como mínimo dos SO (en caso contrario, indícalo en el textarea).
5.2.	Se hayan marcado como mínimo dos músicas  (en caso contrario, indícalo en el textarea). */

/* Función que valida que se hayan marcado al menos dos sistemas operativos cada vez que el select pierde el foco.
    Si se han marcado al menos dos sistemas operativos devuelve true y si no devuelve false. */

let selectSO = document.querySelector("#sOperativos");
let sOSelected = [];

selectSO.addEventListener('blur', function () {
    selectSO = document.querySelector("#sOperativos");
    let opcionesSO = selectSO.options;

    for (let x = 0; x < opcionesSO.length; x++) {
        sOSelected.push(opcionesSO[x].selected);


    }

    if (sOSelected.length >= 2) {
        validaSOperativos = true;
    }else{
        validaSOperativos = false;
    }

})


/* Función que valida que se hayan marcado al menos dos géneros musicales cuando se pulsa el botón Enviar. 
    Si se han marcado al menos dos géneros musicales devuelve true y si no devuelve false. */

let submit = document.querySelector("#enviar");

submit.addEventListener('click', function () {
    let genero = document.querySelectorAll('.genero');
    let generoChecked = [];

    genero.forEach((e) => {
        if (e.checked == true) {
            generoChecked.push(e);
        }
        (e).checked == true;
    })

    if (generoChecked.length >= 2) {
        validaGenero = true;
    } else {
        validaGenero = false;
    }

})

/* Función que valida todas las restricciones del formulario al pulsar el botón de enviar. Si todas son correctas el programa permitirá enviar el formulario 
    y si no, nos mostrará un mensaje de error y nos indicará que revisemos los campos. */

document.addEventListener("DOMContentLoaded", function () {
    submit.addEventListener('click', validarFormulario);
});

function validarFormulario(evento) {
    if (validaNombre === true && validaEmail === true && validaTelefono === true && validaContraseña === true && validaRepContraseña === true && validaFecha === true
        && validaSOperativos === true && validaGenero === true) {
    } else if (validaSOperativos == false && validaGenero == true) {
        document.querySelector("#texto").innerHTML = "";
        document.querySelector("#texto").innerHTML = "Selecciona al menos 2 sistemas operativos.";
        evento.preventDefault();
        alert("Formulario no enviado. Revisa los campos.");
    } else if (validaGenero == false && validaSOperativos == true) {
        document.querySelector("#texto").innerHTML = "";
        document.querySelector("#texto").innerHTML = "Selecciona al menos 2 géneros musicales.";
        evento.preventDefault();
        alert("Formulario no enviado. Revisa los campos.");

    } else if (validaGenero == true && validaSOperativos == true) {
        document.querySelector("#texto").innerHTML = "";
        evento.preventDefault();
        alert("Formulario no enviado. Revisa los campos.");
    } else if (validaGenero == false && validaSOperativos == false) {
        document.querySelector("#texto").innerHTML = "Selecciona al menos 2 sistemas operativos. Selecciona al menos 2 géneros musicales. ";
        evento.preventDefault();
        alert("Formulario no enviado. Revisa los campos.");
    } else {
        evento.preventDefault();
        alert("Formulario no enviado. Revisa los campos.");
        document.querySelector("#texto").innerHTML = "";
    }
}


//6.	Permite añadir un nuevo sistema operativo y un nuevo género musical completamente funcionales.


/* Función que añade un option en el select de los sistemas operativos con el nombre que indiquemos mediante un prompt cuando se pulse el botón
    de añadir sistema operativo */

let botonAñadirSO = document.querySelector("#añadirSO");

botonAñadirSO.addEventListener("click", function () {
    let sOperativo = prompt("Introduce el nombre del sistema operativo");
    const option = document.createElement("option");
    option.value = sOperativo;
    option.text = sOperativo;
    document.querySelector("#sOperativos").appendChild(option);
})


/* Función que añade un checkbox con un nuevo género musical con el nombre que indiquemos mediante un prompt cuando se pulse el botón
    de añadir género */

let botonAñadirGenero = document.querySelector("#añadirGenero");
let divGeneros = document.querySelector("#inputsGeneros");

botonAñadirGenero.addEventListener("click", function () {
    let genero = prompt("Introduce el nombre del género");
    const option = document.createElement("input");
    const span = document.createElement("span");
    option.type = "checkbox";
    option.name = "genero";
    option.className = "genero";
    option.value = genero;
    span.innerHTML = genero;
    divGeneros.appendChild(option);
    divGeneros.appendChild(span);
})
