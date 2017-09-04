<?php
$conn = mysqli_connect('localhost', 'root', 'root', 'productos1', '3306');
if (!$conn) {
    die('Could not connect to MySQL: ' . mysqli_connect_error());
}
mysqli_query($conn, 'SET NAMES \'utf8\'');
// TODO: insert your code here.
echo '<table>';
echo '<tr>';
echo '<th>codigo</th>';
echo '<th>nombre</th>';
echo '<th>precio</th>';
echo '<th>fechaalta</th>';
echo '<th>categoria</th>';
echo '</tr>';
$result = mysqli_query($conn, 'SELECT codigo, nombre, precio, fechaalta, categoria FROM productos');
while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
    echo '<tr>';
    echo '<td>' . $row['codigo'] . '</td>';
    echo '<td>' . $row['nombre'] . '</td>';
    echo '<td>' . $row['precio'] . '</td>';
    echo '<td>' . $row['fechaalta'] . '</td>';
    echo '<td>' . $row['categoria'] . '</td>';
    echo '</tr>';
}
mysqli_free_result($result);
echo '</table>';
mysqli_close($conn);
?>