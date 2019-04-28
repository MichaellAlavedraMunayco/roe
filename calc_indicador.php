<?php
include('db.php');
if (isset($_POST['calc_indicador'])) {
    $id_concepto = $_GET['id_concepto'];
    $nombre_concepto = $_GET['nombre_concepto'];
    $queryper = "SELECT COUNT(*) FROM periodo";
    $resultper = mysqli_query($conn, $queryper);
    if (mysqli_num_rows($resultper) > 0) {
        $rowper = mysqli_fetch_array($resultper);
        $count = $rowper[0];
        for ($i = 1; $i <= $count; $i++) {
            $querycon = "SELECT * FROM concepto c INNER JOIN valores v ON c.id_concepto = v.id_concepto WHERE c.es_variable = 1 AND v.id_periodo = $i";
            $resultcon = mysqli_query($conn, $querycon);
            $vars = array();
            while ($rowcon = mysqli_fetch_array($resultcon)) {
                $vars[strtolower($rowcon['nombre_concepto'])] = intval($rowcon['valor']);
            }
            // Filtrado de nombres de variables para formulas dinamicas
            // Codigo ...
            // Para Formula estática ROE = (utilidad/patrimonio)*100
            $roeval = ($vars['utilidad']/$vars['patrimonio'])*100;
            $queryvi = "SELECT * FROM valores WHERE id_concepto = $id_concepto AND id_periodo = $i AND es_calculado = 1";
            $resultvi = mysqli_query($conn, $queryvi);
            while ($rowvi = mysqli_fetch_array($resultvi)) {
                $queryup = "UPDATE valores SET valor = $roeval WHERE id_concepto = $id_concepto AND id_periodo = $i AND es_calculado = 1";
                $resultup = mysqli_query($conn, $queryup);
                if (!$resultup) {
                    die("Error");
                }
            }
            if(mysqli_num_rows($resultvi) == 0){
              $queryin = "INSERT INTO valores(id_concepto, id_periodo, valor, es_calculado) VALUES($id_concepto, $i, $roeval, 1)";
              $resultin = mysqli_query($conn, $queryin);
              if (!$resultin) {
                die("Error");
              }
            }
        }
        $_SESSION['message'] = 'Se ha calculado el indicador <strong> ' . $nombre_concepto . '</strong>';
        $_SESSION['message_type'] = 'success';
        header("Location: index.php");
    }
}
