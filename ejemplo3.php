<?php

// Ejemplo de array multidimensional
$productos = array(
  array("nombre" => "Manzana", "precio" => 1.5, "stock" => 10),
  array("nombre" => "Pera", "precio" => 2, "stock" => 5),
  array("nombre" => "Naranja", "precio" => 1, "stock" => 20),
  array("nombre" => "Plátano", "precio" => 1.2, "stock" => 15)
);

echo "<table>";
echo "<tr><th>Nombre</th><th>Precio</th><th>Stock</th></tr>";
echo "<h2>Recorrido con un For</h2>";
// Recorremos el array con un for
for ($i = 0; $i < count($productos); $i++) {
  echo "<tr>";
  echo "<td>" . $productos[$i]["nombre"] . "</td>";
  echo "<td>" . $productos[$i]["precio"] . " €</td>";
  echo "<td>" . $productos[$i]["stock"] . "</td>";
  echo "</tr>";
}
echo "</table>";
echo "<h2>Recorrido con un while</h2>";
// Recorremos el array con un while
echo "<table>";
$i = 0;
while ($i < count($productos)) {
  echo "<tr>";
  echo "<td>" . $productos[$i]["nombre"] . "</td>";
  echo "<td>" . $productos[$i]["precio"] . " €</td>";
  echo "<td>" . $productos[$i]["stock"] . "</td>";
  echo "</tr>";
  $i++;
}
echo "</table>";
echo "<h2>Recorrido con un do-while</h2>";
// Recorremos el array con un do-while
echo "<table>";
$i = 0;
do {
  echo "<tr>";
  echo "<td>" . $productos[$i]["nombre"] . "</td>";
  echo "<td>" . $productos[$i]["precio"] . " €</td>";
  echo "<td>" . $productos[$i]["stock"] . "</td>";
  echo "</tr>";
  $i++;
} while ($i < count($productos));
echo "</table>";
echo "<h2>Recorrido con un foreach</h2>";
// Recorremos el array con un foreach
echo "<table>";
foreach ($productos as $producto) {
  echo "<tr>";
  echo "<td>" . $producto["nombre"] . "</td>";
  echo "<td>" . $producto["precio"] . " €</td>";
  echo "<td>" . $producto["stock"] . "</td>";
  echo "</tr>";
}
echo "</table>";

?>