<?php

// Ejemplo de array asociativo
$personas = array(
  array("nombre" => "Juan", "edad" => 25, "ciudad" => "Madrid"),
  array("nombre" => "María", "edad" => 30, "ciudad" => "Barcelona"),
  array("nombre" => "Pedro", "edad" => 20, "ciudad" => "Valencia"),
  array("nombre" => "Lucía", "edad" => 35, "ciudad" => "Sevilla")
);

echo "<table>";
echo "<tr><th>Nombre</th><th>Edad</th><th>Ciudad</th></tr>";

echo "<h2>Recorrido con un For</h2>";
// Recorremos el array con un for
for ($i = 0; $i < count($personas); $i++) {
  echo "<tr>";
  echo "<td>" . $personas[$i]["nombre"] . "</td>";
  echo "<td>" . $personas[$i]["edad"] . "</td>";
  echo "<td>" . $personas[$i]["ciudad"] . "</td>";
  echo "</tr>";
}
echo "</table>";


echo "<h2>Recorrido con un while</h2>";
// Recorremos el array con un while
echo "<table>";
$i = 0;
while ($i < count($personas)) {
  echo "<tr>";
  echo "<td>" . $personas[$i]["nombre"] . "</td>";
  echo "<td>" . $personas[$i]["edad"] . "</td>";
  echo "<td>" . $personas[$i]["ciudad"] . "</td>";
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
  echo "<td>" . $personas[$i]["nombre"] . "</td>";
  echo "<td>" . $personas[$i]["edad"] . "</td>";
  echo "<td>" . $personas[$i]["ciudad"] . "</td>";
  echo "</tr>";
  $i++;
} while ($i < count($personas));


echo "</table>";
echo "<h2>Recorrido con un foreach</h2>";
// Recorremos el array con un foreach
echo "<table>";
foreach ($personas as $persona) {
  echo "<tr>";
  echo "<td>" . $persona["nombre"] . "</td>";
  echo "<td>" . $persona["edad"] . "</td>";
  echo "<td>" . $persona["ciudad"] . "</td>";
  echo "</tr>";
}
echo "</table>";

?>