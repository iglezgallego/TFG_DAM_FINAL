<div class="col-lg-12">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Resultados de exámenes</h5>
      <p></p>

      <!-- Table with stripped rows -->
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Título</th>
            <th>Autor</th>
            <th>Estado</th>
            <th data-type="date" data-format="DD/MM/YYYY">Hecho por última vez</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
            <?php 
                $consulta = "SELECT e.*, u.user_name AS autor
                FROM exams e
                LEFT JOIN users u ON e.gid_user = u.gid_user
                WHERE e.status = 'public' ";
                $resultado = $conection->query($consulta);
                while($fila=$resultado->fetch_assoc()){
                    $title = $fila['title'];
                    $author = $fila['autor'];
                    $status = $fila['status'];
                    $created = $fila['date_created'];

                    echo 
                        '<tr>
                        <td><a class="nav-link" href="">'.$title.'</a></td>
                        <td>'.$author.'</td>
                        <td>'.$status.'</td>
                        <td>'.$created.'</td>
                        <td>
                            <a class="nav-link" href="" data-gid-exam="'.$fila['gid_exam'].'">
                                <i class="bi bi-pie-chart-fill" style="color:#4e61f2;"></i>
                            </a>
                        </td>
                        </tr>';
                }
            ?>
        </tbody>
      </table>
      <!-- End Table with stripped rows -->

    </div>
  </div>
</div>