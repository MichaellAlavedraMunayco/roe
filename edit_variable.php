<?php
include('db.php');
include('edit_valores.php');
if (isset($_POST['edit_variable'])) {
    $id_concepto = $_GET['id_concepto'];
    $nombre_concepto = $_GET['nombre_concepto'];
    edit_valores($conn, $id_concepto, $nombre_concepto, 'c.es_variable = 1', 'es_interno = 1', 'es_interno', 'los valores de la variable');
}
//
// if (isset($_POST['edit_variable'])) {
//     $id_concepto = $_GET['id_concepto'];
//     $nombre_concepto = $_GET['nombre_concepto'];
//     $query = "SELECT * FROM concepto c INNER JOIN valores v ON c.id_concepto = v.id_concepto WHERE c.id_concepto = $id_concepto AND c.es_variable = 1";
//     $result = mysqli_query($conn, $query);
//     while ($row = mysqli_fetch_array($result)) {
//         $id_periodo = $row['id_periodo'];
//         if (isset($_POST[$id_periodo])) {
//             $queryup = "UPDATE valores SET valor = $_POST[$id_periodo] WHERE id_concepto = $id_concepto AND id_periodo = $id_periodo AND es_interno = 1";
//             $resultup = mysqli_query($conn, $queryup);
//             if (!$resultup) {
//                 die('Error');
//             }
//         }
//     }
//     if(mysqli_num_rows($result) == 0){
//       $queryper = "SELECT COUNT(*) FROM periodo";
//       $resultper = mysqli_query($conn, $queryper);
//       if (mysqli_num_rows($resultper) > 0) {
//           $rowper = mysqli_fetch_array($resultper);
//           $count = $rowper[0];
//           for ($i = 1; $i <= $count; $i++) {
//               $queryin = "INSERT INTO valores(id_concepto, id_periodo, valor, es_interno) VALUES($id_concepto, $i, $_POST[$i], 1)";
//               $resultin = mysqli_query($conn, $queryin);
//               if (!$resultin) {
//                 die('Error');
//               }
//           }
//       }
//     }
//     $_SESSION['message'] = 'Se actualizaron los valores de la variable <strong> ' . $nombre_concepto . '</strong>';
//     $_SESSION['message_type'] = 'success';
//     header("Location: index.php");
// }
