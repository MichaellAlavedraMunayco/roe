<?php include('db.php') ?>

<?php include('includes/header.php') ?>

<div class="p-4">
  <div class="row">
    <div class="col-md-3">
      <div class="card card-body">
        <form action="save_indicador.php?" method="POST">
          <h6>Indicador</h6>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Indicador" name="indicador" required>
            <div class="input-group-append">
              <button class="btn btn-success" name="save_indicador" type="submit">Add</button>
            </div>
          </div>
        </form>
        <form action="save_variable.php" method="POST">
          <h6>Variable</h6>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Variable" name="variable" required>
            <div class="input-group-append">
              <button class="btn btn-success" name="save_variable" type="submit">Add</button>
            </div>
          </div>
        </form>
        <form action=".php" method="POST">
          <h6>Fórmula</h6>
          <div class="form-group">
            <input class="form-control" placeholder="ROE=(Utilidad/Patrimonio)*100" autofocus type="text"
              name="variable">
            <small class="form-text text-muted">Única fórmula implementada ROE</small>
            <input type="submit" class="btn btn-success btn-block mt-2" name="save_varible" value="Agregar">
          </div>
        </form>
      </div>
    </div>
    <div class="col-md-9">
      <div class="card card-body mb-2">
        <h6>Cálculos y Variables</h6>
        <div class="card mt-2">
          <div class="card-header text-white bg-dark">
            <div class="row">
              <?php include('fill_periodo.php')?>
            </div>
          </div>
        </div>
        <div class="card-body">
          <?php include('fill_conceptos.php') ?>
        </div>
      </div>
      <div class="card card-body">
        <h6>Metas</h6>
        <div class="card mt-2">
          <div class="card-header text-white bg-dark">
            <div class="row">
              <?php include('fill_periodo.php')?>
            </div>
          </div>
          <div id="card_body_metas" class="card-body">
            <?php include('fill_metas.php');?>
          </div>
        </div>
      </div>
      <div class="card card-body mt-3">
        <h6>Gráfica de columnas básica</h6>
        <div id="chart" style="min-width: 100%; height: 400px; margin: 0 auto"></div>
        <?php
          $query_categories = "SELECT * FROM periodo";
          $result_categories = mysqli_query($conn, $query_categories);
          while ($row_categories = mysqli_fetch_array($result_categories)) {
              $categories[] = "'".$row_categories['mes']."'";
          }
          $query_reales = "SELECT valor FROM valores v INNER JOIN periodo p ON v.id_periodo = p.id_periodo WHERE id_concepto = 1 AND es_calculado = 1 ORDER BY p.id_periodo";
          $result_reales = mysqli_query($conn, $query_reales);
          while ($row_reales = mysqli_fetch_array($result_reales)) {
              $reales[] = $row_reales['valor'];
          }
          $query_metas = "SELECT valor FROM valores v INNER JOIN periodo p ON v.id_periodo = p.id_periodo WHERE id_concepto = 1 AND es_meta = 1 ORDER BY p.id_periodo";
          $result_metas = mysqli_query($conn, $query_metas);
          while ($row_metas = mysqli_fetch_array($result_metas)) {
              $metas[] = $row_metas['valor'];
          }
        ?>
        <script type="text/javascript">
          Highcharts.chart('chart', {
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
              categories: [ <?php echo join($categories, ',') ?> ],
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
              data: [ <?php echo join($reales, ',') ?> ],
              tooltip: {
                valueSuffix: ' %'
              }

            }, {
              name: 'Meta',
              type: 'spline',
              data: [ <?php echo join($metas, ',') ?> ],
              tooltip: {
                valueSuffix: ' %'
              }
            }]
          });
        </script>
      </div>
    </div>
  </div>
</div>
<?php if (isset($_SESSION['message'])) {
            ?>
<div
  class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show m-3 fixed-bottom col-3"
  role="alert">
  <?= $_SESSION['message'] ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php
  session_unset();
        }
include('includes/footer.php');
