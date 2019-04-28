<?php
function save_concepto($conn, $column_name, $nombre, $message)
{
    $query = "INSERT INTO concepto(nombre_concepto, $column_name) VALUES ('$nombre', 1)";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Error");
    }
    $_SESSION['message'] = 'Se guardó '.$message.' <strong>' . $nombre . '</strong>';
    $_SESSION['message_type'] = 'success';
    header('Location: index.php');
}
