<?php
  $queryind = "SELECT * FROM concepto WHERE es_indicador = 1";
  $resultind = mysqli_query($conn, $queryind);
  while ($rowind = mysqli_fetch_array($resultind)) {
      $id_concepto = $rowind['id_concepto'];
      $nombre_concepto = $rowind['nombre_concepto'];
      echo '<form class="border-bottom py-1" action="edit_meta.php?id_concepto=' . $id_concepto . '&nombre_concepto='.$nombre_concepto.'" method="post">';
      echo '<div id="one_row" class="row">';
      echo '<div class="col">' . $rowind['nombre_concepto'] . '</div>';
      $queryper = "SELECT * FROM valores v WHERE v.es_meta = 1 AND v.id_concepto = $id_concepto";
      $resultper = mysqli_query($conn, $queryper);
      while ($rowper = mysqli_fetch_array($resultper)) {
          echo '<div class="col"><input class="form-control form-control-sm" type="number" name="' . $rowper['id_periodo'] . '" value="' . $rowper['valor'] . '" required></div>';
      }
      if (mysqli_num_rows($resultper) == 0) {
          $queryper2 = "SELECT COUNT(*) FROM periodo";
          $resultper2 = mysqli_query($conn, $queryper2);
          if (mysqli_num_rows($resultper2) > 0) {
              $rowper2 = mysqli_fetch_array($resultper2);
              $count = $rowper2[0];
              for ($i = 1; $i <= $count; $i++) {
                  echo '<div class="col"><input class="form-control form-control-sm" type="number" name="' . $i . '" required></div>';
              }
          }
      }
      echo '<div class="col"><button type="submit" class="btn btn-sm btn-success btn-block" name="edit_meta"><i class="fas fa-sync-alt"></i></button></div>';
      echo '</div>';
      echo '</form>';
  }
