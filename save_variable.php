<?php
include('db.php');
include('save_concepto.php');
if (isset($_POST['save_variable'])) {
    $nombre = $_POST['variable'];
    save_concepto($conn, 'es_variable', $nombre, 'la variable');
}
