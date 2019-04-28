<?php
include('db.php');
include('edit_valores.php');
if (isset($_POST['edit_meta'])) {
    $id_concepto = $_GET['id_concepto'];
    $nombre_concepto = $_GET['nombre_concepto'];
    edit_valores($conn, $id_concepto, $nombre_concepto, 'v.es_meta = 1', 'es_meta = 1', 'es_meta', 'las metas del indicador');
}
