<?php
include('db.php');
include('save_concepto.php');
if (isset($_POST['save_indicador'])) {
    $nombre = $_POST['indicador'];
    save_concepto($conn, 'es_indicador', $nombre, 'el indicador');
}
