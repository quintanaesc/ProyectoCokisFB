function encuentraUsuario(){
  //encuentra el valor del letrero donde se muestra el usuario entregando un string
  var usuario = document.getElementById("resultadoPHP").getElementsByTagName("li")[0].textContent;
  return usuario;
}

function aumentarCookieYRecargar() {
  // Obtener el valor actual de la cookie 'id_empleado'
  var valorCookie = parseInt(document.cookie.replace(/(?:(?:^|.*;\s*)id_empleado\s*\=\s*([^;]*).*$)|^.*$/, "$1")) || 0;

  // Aumentar el valor de la cookie en 1
  valorCookie++;

  // Establecer la nueva cookie con el valor aumentado
  document.cookie = 'id_empleado=' + valorCookie;

  // Recargar la página actual
  location.reload();
}

// Iniciar el bucle que se ejecutará cada 10 segundos
setInterval(aumentarCookieYRecargar, 10000);
  //cheerio

  