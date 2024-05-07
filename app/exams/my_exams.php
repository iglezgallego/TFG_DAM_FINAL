<?php
    //config para la conexion
    include "../conection/config.php";
?>
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Exámenes creados por mi</h5>
              <p></p>

              <!-- Table with stripped rows -->
                    
              <table class="table table table-hover">
                <thead>
                  <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Estado</th>
                    <th data-type="date" data-format="DD/MM/YYYY">Creación</th>
                    <th data-type="date" data-format="DD/MM/YYYY">Ultima modificación</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                        $consulta = "SELECT * FROM exams WHERE gid_user = '".$_SESSION['giduser']."' ";
                        $resultado = $conection->query($consulta);
                        while($fila=$resultado->fetch_assoc()){
                            $title = $fila['title'];
                            $author = $_SESSION['username'];
                            $status = $fila['status'];
                            $created = $fila['date_created'];
                            $updated = $fila['date_updated'];
                            
                            // Reemplazar "0000-00-00" con "-" si la fecha de modificación es "0000-00-00"
                            $updated = ($updated == "0000-00-00") ? "-" : $updated;
                            echo 
                                '<tr>
                                <td><a class="nav-link" href="?exams=do&gid_exam='.$fila['gid_exam'].'">'.$title.'</a></td>
                                <td>'.$author.'</td>
                                <td>'.$status.'</td>
                                <td>'.$created.'</td>
                                <td>'.$updated.'</td>
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
                                    <a class="nav-link" href="exams/delete/delete_exam.php?gid_exam='.$fila['gid_exam'].'">
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