
<div class="col-lg-12">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title" id="tableShared"><?php foreach ($resultadoTrans as $traduccion) {
        if ($traduccion['component_name'] === 'tableShared') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
        } ?></h5>
      <p></p>

      <!-- Table with stripped rows -->
      <table class="table table-hover">
        <thead>
          <tr>
            <th id="tableTitle"><?php foreach ($resultadoTrans as $traduccion) {
            if ($traduccion['component_name'] === 'tableTitle') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
            } ?></th>
            <th id="tableAutor"><?php foreach ($resultadoTrans as $traduccion) {
            if ($traduccion['component_name'] === 'tableAutor') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
            } ?></th>
            <th id="tableState"><?php foreach ($resultadoTrans as $traduccion) {
            if ($traduccion['component_name'] === 'tableState') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
            } ?></th>
            <th id="tableDateCreated" data-type="date" data-format="DD/MM/YYYY"><?php foreach ($resultadoTrans as $traduccion) {
            if ($traduccion['component_name'] === 'tableDateCreated') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
            } ?></th>
            <th id="tableDateUpdated" data-type="date" data-format="DD/MM/YYYY"><?php foreach ($resultadoTrans as $traduccion) {
            if ($traduccion['component_name'] === 'tableDateUpdated') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
            } ?></th>
            <th id="tableDateShared" data-type="date" data-format="DD/MM/YYYY"><?php foreach ($resultadoTrans as $traduccion) {
            if ($traduccion['component_name'] === 'tableDateShared') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
            } ?></th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
            <?php 
                $consulta = "
                SELECT se.*, e.*, u.user_name AS autor
                FROM shared_exams se
                LEFT JOIN exams e ON se.gid_exam = e.gid_exam
                LEFT JOIN users u ON e.gid_user = u.gid_user
                WHERE se.gid_user = '".$_SESSION['giduser']."' ";
            
                $resultado = $conection->query($consulta);
            
                while($fila=$resultado->fetch_assoc()){
                    $title = $fila['title'];
                    $author = $fila['autor'];
                    $status = $fila['status'];
                    $created = $fila['date_created'];
                    $updated = $fila['date_updated'];
                    $shared = $fila['date_shared'];
                    
                    // Reemplazar "0000-00-00" con "-" si la fecha de modificación es "0000-00-00"
                    $updated = ($updated == "0000-00-00") ? "-" : $updated;
                    echo 
                    '<tr>
                        <td><a class="nav-link" href="?exams=do&gid_exam='.$fila['gid_exam'].'">'.$title.'</a></td> 
                        <td>'.$author.'</td>
                        <td>'.$status.'</td>
                        <td>'.$created.'</td>
                        <td>'.$updated.'</td>
                        <td>'.$shared.'</td>
                        <td>';
                    
                        $consulta2 = "SELECT * FROM favorites WHERE gid_user = '".$_SESSION['giduser']."' AND gid_exam = '".$fila['gid_exam']."' ";
                        $resultado2 = $conection->query($consulta2);

                        if($resultado2->num_rows > 0){
                            echo '
                            <button class="favorito" type="button" data-id="'.$fila['gid_exam'].'" data-value="1" style="background:none; border-radius:20px; border:none; display: block; color:#4e61f2;">
                                <i class="bi bi-star-fill"></i>
                            </button>'; 
                        } else {
                            echo '
                            <button class="favorito" type="button" data-id="'.$fila['gid_exam'].'" data-value="0" style="background:none; border-radius:20px; border:none; display: block; color:#4e61f2;">
                               <i class="bi bi-star"></i>
                            </button>';
                        }

                        echo '
                        </td>
                        <td>
                            <a class="nav-link collapsed" href="exams/delete/delete_sharedexam.php?gid_exam='.$fila['gid_exam'].'">
                                <i class="bi bi-trash3-fill" style="color:#4e61f2;"></i>
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
