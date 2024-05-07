<div class="col-lg-12">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Tus resultados</h5>
      <!-- Table with stripped rows -->
      <table class="table table table-hover">
        <thead>
          <tr>
            <th>Título</th>
            <th>Autor&nbsp;&nbsp;&nbsp;</th>
            <th>Última fecha</th>
          </tr>
        </thead>
        <tbody>
            <?php 
                //Consulta para obtener cada examen diferente de cada usuario donde la fecha de creación sea la mayor y ordenador por fecha de creación descendiente
                $consulta = "SELECT r.gid_exam, e.title, u.user_name AS autor, DATE_FORMAT(MAX(r.date_result), '%Y-%m-%d') AS last_date
                FROM results r
                JOIN exams e ON r.gid_exam = e.gid_exam
                JOIN users u ON e.gid_user = u.gid_user
                WHERE r.gid_user = '".$_SESSION['giduser']."'
                GROUP BY r.gid_exam, e.title, autor
                ORDER BY last_date DESC;";
                $resultado = $conection->query($consulta);
                while($fila=$resultado->fetch_assoc()){
                    $title = $fila['title'];
                    $author = $fila['autor'];
                    $lastDate = $fila['last_date'];

                    echo 
                        '<tr>
                            <td><a class="nav-link" href="?charts=result&gid_exam='.$fila['gid_exam'].'" data-gid-exam="'.$fila['gid_exam'].'">'.$title.'</a></td>
                            <td>'.$author.'</td>
                            <td>'.$lastDate.'</td>
                        </tr>';
                }
            ?>
        </tbody>
      </table>
    <!-- End Table with stripped rows -->

    </div>
  </div>
</div>