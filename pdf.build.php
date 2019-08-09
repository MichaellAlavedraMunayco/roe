<?php
require_once('db.php');

$query_categories = "SELECT * FROM periodo";
$result_categories = mysqli_query($conn, $query_categories);
while ($row_categories = mysqli_fetch_array($result_categories)) {
    $categories[] = "'".$row_categories['mes']."'";
}
$categories = join($categories, ',');
$query_reales = "SELECT valor FROM valores v INNER JOIN periodo p ON v.id_periodo = p.id_periodo WHERE id_concepto = 1 AND es_calculado = 1 ORDER BY p.id_periodo";
$result_reales = mysqli_query($conn, $query_reales);
while ($row_reales = mysqli_fetch_array($result_reales)) {
    $reales[] = $row_reales['valor'];
}
$reales = join($reales, ',');
$query_metas = "SELECT valor FROM valores v INNER JOIN periodo p ON v.id_periodo = p.id_periodo WHERE id_concepto = 1 AND es_meta = 1 ORDER BY p.id_periodo";
$result_metas = mysqli_query($conn, $query_metas);
while ($row_metas = mysqli_fetch_array($result_metas)) {
    $metas[] = $row_metas['valor'];
}
$metas = join($metas, ',');

echo <<< HTML
<div id="chart2" style="min-width: 100%; height: 400px; margin: 0 auto"></div>
<script>
    Highcharts.chart('chart2', {
        chart: {
            zoomType: 'xy'
        },
        title: {
            text: 'Ratio de Rentabilidad Financiera'
        },
        subtitle: {
            text: 'ROE (Return on Equity)'
        },
        xAxis: [{
            categories: [{$categories}],
            crosshair: true
        }],
        yAxis: [{ // Primary yAxis
            labels: {
                format: '{value}%',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            },
            title: {
                text: 'ROE',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            }
        }, { // Secondary yAxis
            title: {
                text: 'ROE',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            labels: {
                format: '{value}%',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            opposite: true
        }],
        tooltip: {
            shared: true
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            x: 120,
            verticalAlign: 'top',
            y: 100,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) ||
                'rgba(255,255,255,0.25)'
        },
        series: [{
            name: 'Real',
            type: 'column',
            yAxis: 1,
            data: [{$reales}],
            tooltip: {
                valueSuffix: ' %'
            }

        }, {
            name: 'Meta',
            type: 'spline',
            data: [{$metas}],
            tooltip: {
                valueSuffix: ' %'
            }
        }]
    });
</script>
HTML;
