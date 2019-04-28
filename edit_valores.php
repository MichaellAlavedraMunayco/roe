<?php
function edit_valores($conn, $id_concepto, $nombre_concepto, $query_end_1, $query_end_2, $column_name, $message)
{
    $query = "SELECT * FROM concepto c INNER JOIN valores v ON c.id_concepto = v.id_concepto WHERE c.id_concepto = $id_concepto AND $query_end_1";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        $id_periodo = $row['id_periodo'];
        if (isset($_POST[$id_periodo])) {
            $queryup = "UPDATE valores SET valor = $_POST[$id_periodo] WHERE id_concepto = $id_concepto AND id_periodo = $id_periodo AND $query_end_2";
            $resultup = mysqli_query($conn, $queryup);
            if(!$resultup){
              die("Error");
            }
        }
    }
    if (mysqli_num_rows($result) == 0) {
        $queryper = "SELECT COUNT(*) FROM periodo";
        $resultper = mysqli_query($conn, $queryper);
        if (mysqli_num_rows($resultper) > 0) {
            $rowper = mysqli_fetch_array($resultper);
            $count = $rowper[0];
            for ($i = 1; $i <= $count; $i++) {
                $queryin = "INSERT INTO valores(id_concepto, id_periodo, valor, $column_name) VALUES($id_concepto, $i, $_POST[$i], 1)";
                $resultin = mysqli_query($conn, $queryin);
                if(!$resultin){
                  die("Error");
                }
            }
        }
    }
    $_SESSION['message'] = 'Se actualizaron '.$message.' <strong> ' . $nombre_concepto . '</strong>';
    $_SESSION['message_type'] = 'success';
    header("Location: index.php");
}
