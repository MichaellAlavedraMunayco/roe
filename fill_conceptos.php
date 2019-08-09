<?php
function fill($conn, $action_form, $id_concepto, $nombre_concepto, $end_query, $input_status, $btn_color, $icon_btn)
{
    echo '<form class="border-bottom py-1" action="'.$action_form.'.php?id_concepto=' . $id_concepto . '&nombre_concepto='.$nombre_concepto.'" method="post">';
    echo '<div id="one_row" class="row">';
    echo '<div class="col">' . $nombre_concepto . '</div>';
    $queryvar = "SELECT * FROM valores WHERE id_concepto = $id_concepto AND " . $end_query;
    $resultvar = mysqli_query($conn, $queryvar);
    while ($rowvar = mysqli_fetch_array($resultvar)) {
        echo '<div class="col"><input class="form-control form-control-sm" type="number" name="' . $rowvar['id_periodo'] . '" value="' . round($rowvar['valor'], 3) . '" '.$input_status.'></div>';
    }
    if (mysqli_num_rows($resultvar) == 0) {
        $queryper = "SELECT COUNT(*) FROM periodo";
        $resultper = mysqli_query($conn, $queryper);
        if (mysqli_num_rows($resultper) > 0) {
            $rowper = mysqli_fetch_array($resultper);
            $count = $rowper[0];
            for ($i = 1; $i <= $count; $i++) {
                echo '<div class="col"><input class="form-control form-control-sm" type="number" name="' . $i . '" value="0" '.$input_status.'></div>';
            }
        }
    }
    echo "<div class='col-1'><button type='submit' class='btn btn-sm btn-$btn_color btn-block' name='$action_form'>$icon_btn</button></div>";
}
$querycon = "SELECT * FROM concepto ORDER BY es_indicador";
$resultcon = mysqli_query($conn, $querycon);
while ($rowcon = mysqli_fetch_array($resultcon)) {
    $id_concepto = $rowcon['id_concepto'];
    $nombre_concepto = $rowcon['nombre_concepto'];
    $es_indicador = $rowcon['es_indicador'];
    $es_variable = $rowcon['es_variable'];
    if ($es_indicador == 1) { // Valor estático
        fill($conn, 'calc_indicador', $id_concepto, $nombre_concepto, 'es_calculado = 1', 'disabled', 'info', '<i class="fas fa-calculator"></i>');
    } elseif ($es_variable == 1) { // Valor dinámico
        fill($conn, 'edit_variable', $id_concepto, $nombre_concepto, 'es_interno = 1', 'required', 'success', '<i class="fas fa-edit"></i>');
    }
    echo '</div>';
    echo '</form>';
}
