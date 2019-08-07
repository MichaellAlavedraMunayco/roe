<?php
include('db.php');
include('edit_valores.php');
if (isset($_POST['edit_variable'])) {
    $id_concepto = $_GET['id_concepto'];
    $nombre_concepto = $_GET['nombre_concepto'];
    edit_valores($conn, $id_concepto, $nombre_concepto, 'c.es_variable = 1', 'es_interno = 1', 'es_interno', 'los valores de la variable');
}
