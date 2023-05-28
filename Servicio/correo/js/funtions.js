function getCookieEmpleado(nombre) {
  var nombreEQ = nombre + "=";
  var cookies = document.cookie.split(';');
  for (var i = 0; i < cookies.length; i++) {
    var cookie = cookies[i];
    while (cookie.charAt(0) === ' ') {
      cookie = cookie.substring(1, cookie.length);
    }
    if (cookie.indexOf(nombreEQ) === 0) {
      return cookie.substring(nombreEQ.length, cookie.length);
    }
  }
  return "";
}

function borrarCookieEmpleado() {
  var empleadoCookie = getCookieEmpleado("id_empleado");;
  if (empleadoCookie !== "") {
    document.cookie = "id_empleado=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  } else {
    alert("La cookie 'id_empleado' no existe");
  }
}

function cerrarSecion(){
  borrarCookieEmpleado();
  window.location.href = "../login.html";
}

function verificarSesion() {
  var empleadoCookie = getCookieEmpleado("id_empleado");
  if (empleadoCookie !== "") {
    // La cookie 'id_empleado' existe
    window.location.href = "correo/correo.html";
  } 
}


function username() {
  // Realizar la solicitud AJAX al archivo PHP al cargar la página
  $.ajax({
    url: 'php/username.php',
    method: 'GET',
    success: function(response) {
      // Actualizar el contenido del elemento con la respuesta del PHP
      $('#resultadoPHP').html(response);
    },
    error: function() {
      console.log('Error en la solicitud AJAX');
    }
  });
}

function setCookieContador(valor) {
  var fecha = new Date();
  fecha.setTime(fecha.getTime() + (1 * 24 * 60 * 60 * 1000));
  var expira = "expires=" + fecha.toUTCString();
  document.cookie = "contadorTabla" + "=" + valor + ";" + expira + ";path=/";
}

function creaEncabezados(tabla) {
  let encabezados = ["Remitente", "Asunto", "Contenido", "Fecha de envío"];
  var hilera = document.createElement("tr");
  
  for (var j = 0; j < encabezados.length; j++) {
    var celda = document.createElement("td");
    var textoCelda = document.createTextNode(encabezados[j]);
    celda.appendChild(textoCelda);
    hilera.appendChild(celda);
  }
  
  tabla.appendChild(hilera);
}

function creaCelda(texto) {
  var celda = document.createElement("td");
  var textoCelda = document.createTextNode(texto);
  celda.appendChild(textoCelda);
  return celda;
}

function creaHilera(datos) {
  var hilera = document.createElement("tr");
  
  for (var j = 0; j < datos.length; j++) {
    var celda = creaCelda(datos[j]);
    hilera.appendChild(celda);
  }
  
  return hilera;
}

function generaTabla() {
  var body = document.getElementsByTagName("section")[0];
  var tabla = document.createElement("table");
  var tblBody = document.createElement("tbody");
  
  creaEncabezados(tblBody);
  
  for (var i = 0; i < 10; i++) {
    var datos = ["celda en la hilera " + i + ", columna 0", "celda en la hilera " + i + ", columna 1", "celda en la hilera " + i + ", columna 2", "celda en la hilera " + i + ", columna 3"];
    var hilera = creaHilera(datos);
    tblBody.appendChild(hilera);
  }
  
  tabla.appendChild(tblBody);
  body.appendChild(tabla);
  tabla.setAttribute("border", "2");
}
  
  function anterior_tabla(){}

  function siguiente_tabla(){}
  