function setCookieContador(valor) {
  var fecha = new Date();
  fecha.setTime(fecha.getTime() + (1 * 24 * 60 * 60 * 1000));
  var expira = "expires=" + fecha.toUTCString();
  document.cookie = "contadorTabla" + "=" + valor + ";" + expira + ";path=/";
}

function genera_tabla(valor) {
    // setea el contador de la tabla
    setCookieContador(valor)
    // Obtener la referencia del elemento body
    var body = document.getElementsByTagName("section")[0];
  
    // Crea un elemento <table> y un elemento <tbody>
    var tabla   = document.createElement("table");
    var tblBody = document.createElement("tbody");
    //Crea encabezados
    let encabezado = ["Remitente", "Asunto","Contenido","Fecha de envio"]
   
    var hilera = document.createElement("tr");
    for (var j = 0; j < 4; j++) {
        // Crea un elemento <td> y un nodo de texto, haz que el nodo de
        // texto sea el contenido de <td>, ubica el elemento <td> al final
        // de la hilera de la tabla
        var celda = document.createElement("td");
        var textoCelda = document.createTextNode(encabezado[j]);
        celda.appendChild(textoCelda);
        hilera.appendChild(celda);
    }

    // agrega la hilera al final de la tabla (al final del elemento tblbody)
    tblBody.appendChild(hilera);

    // Crea las celdas
    for (var i = 0; i < 10; i++) {
      // Crea las hileras de la tabla
      var hilera = document.createElement("tr");
      for (var j = 0; j < 4; j++) {
        // Crea un elemento <td> y un nodo de texto, haz que el nodo de
        // texto sea el contenido de <td>, ubica el elemento <td> al final
        // de la hilera de la tabla
        var celda = document.createElement("td");
        var textoCelda = document.createTextNode("celda en la hilera "+i+", columna "+j);
        celda.appendChild(textoCelda);
        hilera.appendChild(celda);
      }
  
      // agrega la hilera al final de la tabla (al final del elemento tblbody)
      tblBody.appendChild(hilera);
    }
  
    // posiciona el <tbody> debajo del elemento <table>
    tabla.appendChild(tblBody);
    // appends <table> into <body>
    body.appendChild(tabla);
    // modifica el atributo "border" de la tabla y lo fija a "2";
    tabla.setAttribute("border", "2");
  }
  
  function anterior_tabla(){}

  function siguiente_tabla(){}
  