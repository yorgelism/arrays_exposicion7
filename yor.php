
<?php

// Conexión a la base de datos
$servername = "localhost"; // Nombre del servidor de base de datos
$username = "root"; // Nombre de usuario para conectarse a la base de datos
$password = ""; // Contraseña del usuario para conectarse a la base de datos
$dbname = "base"; // Nombre de la base de datos a la que se conectará

$conn = new mysqli($servername, $username, $password, $dbname); // Crear una nueva conexión a la base de datos utilizando los parámetros proporcionados

if ($conn->connect_error) { // Verificar si hay un error de conexión
  die("Conexión fallida: " . $conn->connect_error); // Si hay un error, mostrar un mensaje de error y detener el script
}

// Consulta a la base de datos
$sql = "SELECT 
  CLIENTE.ci,
  CLIENTE.nombre,
  CLIENTE.apellido,
  PRODUCTO.nombre AS producto,
  PRODUCTO.precio,
  FACTURA.fecha,
  FACTURA.cantidad,
  (PRODUCTO.precio * FACTURA.cantidad) AS subtotal
FROM FACTURA
INNER JOIN PRODUCTO ON FACTURA.id_producto = PRODUCTO.id
INNER JOIN CLIENTE ON FACTURA.ci_cliente = CLIENTE.ci"; // Consulta SQL para obtener los datos de la factura

$result = $conn->query($sql); // Ejecutar la consulta SQL y almacenar el resultado en la variable $result

// Variables para el cálculo del total
$total = 0; // Variable para el total de todas las compras
$impuesto = 0.12; // Variable para la tasa de impuesto

// Mostrar los resultados de la consulta como una factura en formato de tabla HTML
if ($result->num_rows > 0) { // Verificar si la consulta devolvió algún resultado
  echo "<table border=1>"; // Comenzar la tabla HTML y establecer un borde de 1 píxel
  echo "<thead>"; // Comenzar el encabezado de la tabla
  echo "<tr>"; // Comenzar una fila
  echo "<th>      factura      </th>"; // Agregar una celda de encabezado con el texto "factura"
  echo "</tr>"; // Finalizar la fila
  echo "</thead>"; // Finalizar el encabezado de la tabla
  echo "<tbody>"; // Comenzar el cuerpo de la tabla
  $cliente = ""; // Variable para almacenar el nombre del cliente actual
  foreach ($result as $row) { // Recorrer el resultado de la consulta y almacenar cada fila en la variable $row
    if ($cliente !== $row["nombre"] . " " . $row["apellido"]) { // Verificar si el nombre del cliente actual es diferente al nombre del cliente anterior
      if ($cliente !== "") { // Si no es la primera iteración, imprimir la fila de totales para el cliente anterior
        echo "<tr>"; // Comenzar una fila
        echo "<td colspan='4'>Subtotal:</td>"; // Agregar una celda vacía que ocupa 4 columnas y con el texto "Subtotal:"
        printf("<td>%.2f</td>", $subtotal); // Agregar una celda con el subtotal formateado como un número de punto flotante con 2 decimales
        echo "</tr>"; // Finalizar la fila
        echo "<tr>"; // Comenzar una fila
        printf("<td colspan='4'>Impuesto (%.0f%%):</td>", $impuesto * 100); // Agregar una celda vacía que ocupa 4 columnas y con el texto "Impuesto (12%):"
        printf("<td>%.2f</td>", $subtotal * $impuesto); // Agregar una celda con el monto de impuesto formateado como un número de punto flotante con 2 decimales
        echo "</tr>"; // Finalizar la fila
        echo "<tr>"; // Comenzar una fila
        echo "<td colspan='4'>Total:</td>"; // Agregar una celda vacía que ocupa 4 columnas y con el texto "Total:"
        printf("<td>%.2f</td>", $subtotal * (1 + $impuesto)); // Agregar una celda con el total formateado como un número de punto flotante con 2 decimales
        echo "</tr>"; // Finalizar la fila
        echo "</tbody>"; // Finalizar el cuerpo de la tabla
        echo "</table>"; // Finalizar la tabla
        echo "<br>"; // Agregar un salto de línea
      }
// Si el nombre del cliente actual es diferente al nombre del cliente anterior, crear una nueva tabla para el nuevo cliente
      echo "<table border=1>"; // Comenzar una nueva tabla HTML y establecer un borde de 1 píxel
      echo "<thead>"; // Comenzar el encabezado de la tabla
      echo "<tr>"; // Comenzar una fila
      echo "<th colspan='5'>Cliente: " . $row["nombre"] . " " . $row["apellido"] . "</th>"; // Agregar una celda de encabezado que ocupa 5 columnas con el texto "Cliente: [nombre] [apellido]"
      echo "</tr>"; // Finalizar la fila
      echo "<tr>"; // Comenzar una fila
      echo "<th>Cliente</th>"; // Agregar una celda de encabezado con el texto "Cliente"
      echo "<th>Producto</th>"; // Agregar una celda de encabezado con el texto "Producto"
      echo "<th>Precio unitario</th>"; // Agregar una celda de encabezado con el texto "Precio unitario"
      echo "<th>Cantidad</th>"; // Agregar una celda de encabezado con el texto "Cantidad"
      echo "<th>Subtotal</th>"; // Agregar una celda de encabezado con el texto "Subtotal"
      echo "</tr>"; // Finalizar la fila
      echo "</thead>"; // Finalizar el encabezado de la tabla
      echo "<tbody>"; // Comenzar el cuerpo de la tabla
      $cliente = $row["nombre"] . " " . $row["apellido"]; // Establecer el nombre del cliente actual como el nombre del cliente anterior
      $subtotal = 0; // Reiniciar la variable $subtotal
    }
    $subtotal += $row["subtotal"]; // Sumar el subtotal de la fila actual a la variable $subtotal
    echo "<tr>"; // Comenzar una fila
    echo "<td>" . $row["nombre"] . " " . $row["apellido"] . "</td>"; // Agregar una celda con el nombre completo del cliente
    echo "<td>" . $row["producto"] . "</td>"; // Agregar una celda con el nombre del producto
    printf("<td>%.2f</td>", $row["precio"]); // Agregar una celda con el precio unitario formateado como un número de punto flotante con 2 decimales
    echo "<td>" . $row["cantidad"] . "</td>"; // Agregar una celda con la cantidad de productos comprados
    printf("<td>%.2f</td>", $row["subtotal"]); // Agregar una celda con el subtotal de la fila actual formateado como un número de punto flotante con 2 decimales
    echo "</tr>"; // Finalizar la fila
  }
  // Imprimir la fila de totales para el último cliente
  echo "<tr>"; // Comenzar una fila
  echo "<td colspan='4'>Subtotal:</td>"; // Agregar una celda vacía que ocupa 4 columnas y con el texto "Subtotal:"
  printf("<td>%.2f</td>", $subtotal); // Agregar una celda con el subtotal formateado como un número de punto flotante con 2 decimales
  echo "</tr>"; // Finalizar la fila
  echo "<tr>"; // Comenzar una fila
  printf("<td colspan='4'>Impuesto (%.0f%%):</td>", $impuesto * 100); // Agregar una celda vacía que ocupa 4 columnas y con el texto "Impuesto (12%):"
  printf("<td>%.2f</td>", $subtotal * $impuesto); // Agregar una celda con el monto de impuesto formateado como un número de punto flotante con 2 decimales
  echo "</tr>"; // Finalizar la fila
  echo "<tr>"; // Comenzar una fila
  echo "<td colspan='4'>Total:</td>"; // Agregar una celda vacía que ocupa 4 columnas y con el texto "Total:"
  printf("<td>%.2f</td>", $subtotal * (1 + $impuesto)); // Agregar una celda con el total formateado como un número de punto flotante con 2 decimales
  echo "</tr>"; // Finalizar la fila
  echo "</tbody>"; // Finalizar el cuerpo de la tabla
  echo "</table>"; // Finalizar la tabla
} else {
  echo "No se encontraron resultados"; // Si la consulta no devolvió ningún resultado, mostrar un mensaje indicando que no se encontraron resultados
 }
 $conn->close(); //cierra conexion con la base de datos
 ?>

