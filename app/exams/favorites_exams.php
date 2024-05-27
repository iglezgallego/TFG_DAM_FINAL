<div class="col-lg-12">
  <div class="card">
    <div class="card-body">
      <h5 id="tableFavorites" class="card-title"><?php foreach ($resultadoTrans as $traduccion) {
        if ($traduccion['component_name'] === 'tableFavorites') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
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
            <th></th>
          </tr>
        </thead>
        <tbody>
            <?php 
                
                $consulta = "
                SELECT 
                f.*, 
                u.user_name AS autor, 
                e.title, 
                DATE_FORMAT(e.date_created, '%d-%m-%Y') AS date_created, 
                DATE_FORMAT(e.date_updated, '%d-%m-%Y') AS date_updated, 
                e.status
                FROM favorites f
                LEFT JOIN exams e ON f.gid_exam = e.gid_exam
                LEFT JOIN users u ON e.gid_user = u.gid_user
                WHERE f.gid_user = '".$_SESSION['giduser']."' 
                ORDER BY e.date_created DESC;";


                $resultado = $conection->query($consulta);
            
                while($fila=$resultado->fetch_assoc()){
                    $title = $fila['title'];
                    $author = $fila['autor'];
                    $status = $fila['status'];
                    $created = $fila['date_created'];
                    $updated = $fila['date_updated'];
                    // Reemplazar "0000-00-00" con "-" si la fecha de modificación es "0000-00-00"
                    $updated = ($updated == "00-00-0000") ? "-" : $updated;
                    
                    echo '<tr>
                    <td><a class="nav-link" href="?exams=do&gid_exam='.$fila['gid_exam'].'">' . (strlen($title) > 60 ? substr($title, 0, 80) . "..." : $title) . '</a></td>
                    <td>'.$author.'</td>
                    <td style="font-size:20px;"><i class="'.$status.'"></i></td>
                    <td>'.$created.'</td>
                    <td>'.$updated.'</td>
                    <td>';
                            
                        $consulta2 = "SELECT * FROM favorites WHERE gid_user = '".$_SESSION['giduser']."' AND gid_exam = '".$fila['gid_exam']."' ";
                        $resultado2 = $conection->query($consulta2);

                        if($resultado2->num_rows > 0){
                            echo '
                            <button class="favorito onPageFav" type="button" data-id="'.$fila['gid_exam'].'" data-value="1" style="background:none; border-radius:20px; border:none; display: block; color:#4e61f2;">
                                <i class="bi bi-star-fill"></i>
                            </button>';
                        }

                        echo '
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