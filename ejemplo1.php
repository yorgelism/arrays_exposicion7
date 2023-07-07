<?php

// Ejemplo de array indexado
  $frutas = array("manzana", "pera", "naranja", "plátano");

echo "<h2>Recorrido con un For</h2>";
echo "<ul>";
// Recorremos el array con un for
for ($i = 0; $i < count($frutas); $i++) {

  echo "<li>" . $frutas[$i] . "</li>";
}
echo "</ul>";











echo "<h2>Recorrido con un while</h2>";


// Recorremos el array con un while
echo "<ul>";
$i = 0;
while ($i < count($frutas)) {
  echo "<li>" . $frutas[$i] . "</li>";
  $i++;
}
echo "</ul>";




echo "<h2>Recorrido con un do-while</h2>";
// Recorremos el array con un do-while
echo "<ul>";
$i = 0;
do {
  echo "<li>" . $frutas[$i] . "</li>";
  $i++;
} while ($i < count($frutas));



echo "</ul>";
echo "<h2>Recorrido con un foreach</h2>";
// Recorremos el array con un foreach
echo "<ul>";
foreach ($frutas as $fruta) {
  echo "<li>" . $fruta . "</li>";
}
echo "</ul>";

?>