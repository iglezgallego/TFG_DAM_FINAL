<?php
    //config para la conexion
    include "../conection/config.php";
?>
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title" id="tableMyexams"><?php foreach ($resultadoTrans as $traduccion) {
                if ($traduccion['component_name'] === 'tableMyexams') {$contenido = $traduccion[$_SESSION['language']]; echo $contenido; break;}
                } ?></h5>
              <p></p>

              <!-- Table with stripped rows -->
                    
              <table class="table table table-hover">
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
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                        $consulta = "SELECT 
                        id_exam,
                        gid_exam,
                        gid_user,
                        title,
                        DATE_FORMAT(date_created, '%d-%m-%Y') AS datecreated,
                        DATE_FORMAT(date_updated, '%d-%m-%Y') AS dateupdated,
                        status
                        FROM exams WHERE gid_user = '".$_SESSION['giduser']."'
                        ORDER BY date_created DESC;
                        ";
                        $resultado = $conection->query($consulta);
                        while($fila=$resultado->fetch_assoc()){
                            $title = $fila['title'];
                            $author = $_SESSION['username'];
                            $status = $fila['status'];
                            $created = $fila['datecreated'];
                            $updated = $fila['dateupdated'];
                            
                            // Reemplazar "00-00-0000" con "-" si la fecha de modificación es "0000-00-00"
                            $updated = ($updated == "00-00-0000") ? "-" : $updated;
                            echo '<tr>
                            <td><a class="nav-link" href="?exams=do&gid_exam=' . $fila['gid_exam'] . '">' . (strlen($title) > 60 ? substr($title, 0, 80) . "..." : $title) . '</a></td>
                            <td>' . $author . '</td>
                            <td style="font-size:20px;"><i class="' . $status . '"></i></td>
                            <td>' . $created . '</td>
                            <td>' . $updated . '</td>
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
                                    <a class="nav-link" href="#" data-toggle="modal" data-gid-exam="'.$fila['gid_exam'].'" onclick="openModal(\'myModal1\', this.getAttribute(\'data-gid-exam\'))">
                                        <i class="bi bi-share-fill" style="color:#4e61f2;"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="nav-link" href="?exams=edit&gid_exam='.$fila['gid_exam'].'" data-gid-exam="'.$fila['gid_exam'].'">
                                        <i class="bi bi-pencil-fill" style="color:#4e61f2;"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="nav-link" href="javascript:void(0);" onclick="confirmarBorrado(\''.$fila['gid_exam'].'\')">
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
    <script>
        function confirmarBorrado(gid_exam) {
            // Mostrar mensaje de confirmación
            if (confirm("¿Estás seguro de que deseas eliminar este examen?")) {
                // Redirigir a delete_exam.php con el gid_exam como parámetro
                window.location.href = "exams/delete/delete_exam.php?gid_exam=" + gid_exam;
            }
        }
    </script>