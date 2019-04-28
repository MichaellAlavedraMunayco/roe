<?php
  $query = "SELECT * FROM concepto WHERE es_indicador = 1";
  $result = mysqli_query($conn, $query);
  echo '<option>Indicador</option>';
  while ($row = mysqli_fetch_array($result)) {
      echo '<option value="'. $row['id_concepto'] .'">'. $row['nombre_concepto'] .'</option>';
  }
