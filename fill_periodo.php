<?php
  $query = "SELECT * FROM periodo";
  $result = mysqli_query($conn, $query);
  echo '<div class="col">Indicador</div>';
  while ($row = mysqli_fetch_array($result)) {
      echo '<div class="col">' . $row['mes'] . '</div>';
  }
  echo '<div class="col">Acciones</div>';
