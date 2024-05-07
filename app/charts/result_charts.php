<?php
    
    $consulta = "SELECT title FROM exams WHERE gid_exam = '".$_GET['gid_exam']."' ";
    $resultado = $conection->query($consulta);
    if($fila=$resultado->fetch_assoc()){
        $title = $fila['title'];
        echo '<h2 style="margin-bottom:40px;">'.$title.'</h2>';
    }
?>


<!-- Tabla por nota -->
<div class="col-lg-4">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">TOP por nota</h5>
        <table class="table table-striped">
            <thead>
              <tr>
                <th>Fecha</th>
                <th>Resultado</th>
              </tr>
            </thead>
            <tbody>
                <?php 
                    //Consulta para obtener cada examen diferente de cada usuario donde la fecha de creación sea la mayor y ordenador por fecha de creación descendiente
                    $consulta2 = "SELECT result, DATE_FORMAT(date_result, '%d-%m-%Y') AS date_result
                    FROM results
                    WHERE gid_exam = '".$_GET['gid_exam']."'
                    AND gid_user = '".$_SESSION['giduser']."'
                    ORDER BY result DESC
                    LIMIT 8;";
                    $resultado2 = $conection->query($consulta2);
                    while($fila=$resultado2->fetch_assoc()){
                        $date_result = $fila['date_result'];
                        $result = $fila['result'];

                        echo 
                            '<tr>
                                <td>'.$date_result.'</td>
                                <td>'.$result.'%</td>
                            </tr>';
                    }
                ?>
            </tbody>
          </table>
      </div>
    </div>
</div>

<!-- Evolutivo por nota -->
<div class="col-lg-8" >
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Evolutivo por nota</h5>
        <?php
        // Realizas la consulta SQL
        $consulta3 = "SELECT result, DATE_FORMAT(date_result, '%d-%m-%Y') AS date_result
                      FROM results
                      WHERE gid_exam = '".$_GET['gid_exam']."'
                      AND gid_user = '".$_SESSION['giduser']."'
                      LIMIT 10;";

        $resultado3 = $conection->query($consulta3);

        // Arrays para almacenar las fechas y las notas
        $fechas = [];
        $notas = [];

        // Iteras sobre los resultados de la consulta
        while($fila = $resultado3->fetch_assoc()) {
            // Añades las fechas y las notas a los arrays
            $fechas[] = $fila['date_result'];
            $notas[] = $fila['result'];
        }

        // Generas los datos de la gráfica
        $data = [
            'labels' => $fechas, // Fechas en el eje X
            'datasets' => [
                [
                    'label' => 'Nota', // Etiqueta de la serie de datos
                    'data' => $notas, // Notas en el eje Y
                    'fill' => false,
                    'borderColor' => 'rgb(75, 192, 192)',
                    'tension' => 0.1
                ]
            ]
        ];

        // Conviertes los datos a formato JSON
        $data_json = json_encode($data);
        ?>

        <canvas id="lineChart"></canvas>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                var ctx = document.querySelector('#lineChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: <?php echo $data_json; ?>,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        </script>

      </div>
    </div>
</div>

<!-- Tabla por tiempo y nota -->
<div class="col-lg-4">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">TOP por nota y tiempo</h5>
        <table class="table table-striped">
            <thead>
              <tr>
                <th>Fecha</th>
                <th>Resultado</th>
                <th>Tiempo</th>
                <th>Score</th>
              </tr>
            </thead>
            <tbody>
                <?php 
                    // La consulta primero asigna un número de fila a cada resultado ordenado por nota y tiempo (de menor a mayor), luego calcula el puntaje ponderado (score) para cada resultado. Finalmente, selecciona los 5 mejores resultados basados en el puntaje ponderado y los ordena de mejor a peor.
                    $consulta4 = "
                    SELECT result, time, date_result, ROUND((result_weight * result + time_weight * time),1) AS score
                    FROM (
                        SELECT result, time, DATE_FORMAT(date_result, '%d-%m-%Y') AS date_result,
                               (@row_number:=@row_number + 1) AS row_number,
                               @result_weight := 0.5 AS result_weight, -- Peso asignado a la nota
                               @time_weight := 0.5 AS time_weight -- Peso asignado al tiempo
                        FROM results
                        CROSS JOIN (SELECT @row_number := 0) AS vars -- Inicializa la variable de fila
                        WHERE gid_exam = '".$_GET['gid_exam']."'
                        AND gid_user = '".$_SESSION['giduser']."'
                        ORDER BY result DESC, time ASC
                    ) AS ranked_results
                    WHERE row_number <= 8
                    ORDER BY score DESC;";

                    $resultado4 = $conection->query($consulta4);
                    while($fila = $resultado4->fetch_assoc()){
                        $date_result = $fila['date_result'];
                        $result = $fila['result'];
                        $time = $fila['time'];
                        $score = $fila['score'];

                        echo 
                            '<tr>
                                <td>'.$date_result.'</td>
                                <td>'.$result.'%</td>
                                <td>'.$time.'</td>
                                <td>'.$score.'</td>
                            </tr>';
                    }
                ?> 
            </tbody>
          </table>
      </div>
    </div>
</div>

<!-- Evolutivo por tiempo y nota -->
<div class="col-lg-8" >
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Evolutivo por nota y tiempo</h5>
        <?php
        // Realizas la consulta SQL
        $consulta4 = "
        SELECT result, time, DATE_FORMAT(date_result, '%d-%m-%Y') AS date_result, 
               ROUND((result_weight * result + time_weight * time),1) AS score
        FROM (
            SELECT result, time, date_result,
                   (@row_number:=@row_number + 1) AS row_number,
                   @result_weight := 0.5 AS result_weight, -- Peso asignado a la nota
                   @time_weight := 0.5 AS time_weight -- Peso asignado al tiempo
            FROM results
            CROSS JOIN (SELECT @row_number := 0) AS vars -- Inicializa la variable de fila
            WHERE gid_exam = '".$_GET['gid_exam']."'
            AND gid_user = '".$_SESSION['giduser']."'
        ) AS ranked_results
        WHERE row_number <= 10;
        ";

        $resultado = $conection->query($consulta4);

        // Arrays para almacenar las fechas y los scores
        $fechas = [];
        $scores = [];

        // Iteras sobre los resultados de la consulta
        while($fila = $resultado->fetch_assoc()) {
            // Añades las fechas y los scores a los arrays
            $fechas[] = $fila['date_result'];
            $scores[] = $fila['score'];
        }

        // Generas los datos de la gráfica
        $data = [
            'labels' => $fechas, // Fechas en el eje X
            'datasets' => [
                [
                    'label' => 'Score', // Etiqueta de la serie de datos
                    'data' => $scores, // Scores en el eje Y
                    'fill' => false,
                    'borderColor' => 'rgb(75, 192, 192)',
                    'tension' => 0.1
                ]
            ]
        ];

        // Conviertes los datos a formato JSON
        $data_json = json_encode($data);
        ?>

        <canvas id="lineChart2"></canvas>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                var ctx = document.querySelector('#lineChart2').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: <?php echo $data_json; ?>,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        </script>

      </div>
    </div>
</div>


