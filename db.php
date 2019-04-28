<?php

session_start();

$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'editor_formulas_bd'
);
// if (isset($conn)) {
//   echo 'DB ROE is connected';
// }
