<!DOCTYPE html>
<html lang="en">
<head>
</head>
    <body>
        <main>
            <section class="section profile">
              <div class="row">
                <div class="col-xl-4">
                  <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                      <img src="assets/img/profile2.png" alt="Profile" class="rounded-circle">
                      <h2><?php /* Obtener el nombre */ echo ($_SESSION['username']) ?></h2>
                      <h3>
                          <?php
                            //Obtener el rol de usuario
                            $consulta = 'SELECT rol_name FROM rols WHERE rol_key="'.$_SESSION['rolkey'].'" ';
                            $resultado = $conection->query($consulta);
                            $fila=$resultado->fetch_assoc();
                            $roluser = $fila['rol_name'];
                            echo $roluser 
                          ?>
                    </h3>
                    </div>
                  </div>
                </div>

                <div class="col-xl-8">

                  <div class="card">
                    <div class="card-body pt-3">
                      <!-- Bordered Tabs -->
                      <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item">
                          <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Detalles</button>
                        </li>

                        <li class="nav-item">
                          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Editar Perfil</button>
                        </li>

                      </ul>
                      <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            
                          <h5 class="card-title">Detalles del perfil</h5>

                          <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Nombre de usuario</div>
                            <div class="col-lg-9 col-md-8"><?php /* Obtener el nombre */ echo ($_SESSION['username']) ?></div>
                          </div>

                           <div class="row">
                                <div class="col-lg-3 col-md-4 label">Contraseña</div>
                                <div class="col-lg-6 col-md-6">
                                    <input id="password-input" class="form-control" type="password" style="background:white; border:none; font-size:0.95rem;" value=
                                    <?php //Obtener la contraseña del usuario
                                    $consulta = 'SELECT password FROM users WHERE user_name="'.$_SESSION['username'].'" ';
                                    $resultado = $conection->query($consulta);
                                    $fila=$resultado->fetch_assoc();
                                    $password = $fila['password'];
                                    echo $password  
                                    ?> 
                                    disabled>
                                </div>
                                <div class="col-lg-3 col-md-2">
                                    <button id="toggle-password" class="btn btn-secondary" style="color:blue; border:none; background:white; font-size: 0.95rem; padding: 0.25rem 0.5rem; line-height: 1;">Mostrar contraseña</button>
                                </div>
                            </div>
                            

                          <div class="row">
                            <div class="col-lg-3 col-md-4 label">Email</div>
                            <div class="col-lg-9 col-md-8">
                                <?php
                                    //Obtener el email del usuario
                                    $consulta = 'SELECT email FROM users WHERE user_name="'.$_SESSION['username'].'" ';
                                    $resultado = $conection->query($consulta);
                                    $fila=$resultado->fetch_assoc();
                                    $email = $fila['email'];
                                    echo $email 
                                  ?>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-3 col-md-4 label">Idioma</div>
                            <div class="col-lg-9 col-md-8">
                              <?php
                                    //Obtener el idioma del usuario
                                    $consulta = 'SELECT description FROM languages WHERE lang_key="'.$_SESSION['langkey'].'" ';
                                    $resultado = $conection->query($consulta);
                                    $fila=$resultado->fetch_assoc();
                                    $idioma = $fila['description'];
                                    echo $idioma 
                                  ?>
                            </div>
                          </div>
                            
                        </div>

                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                          <!-- Profile Edit Form -->
                          <form method="POST" action="update_profile.php">
                              
                            <div class="row mb-3">
                              <label for="username" class="col-md-4 col-lg-3 col-form-label">Nombre de usuario</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="username" type="text" class="form-control" id="fullName" value=<?php echo ($_SESSION['username']) ?>>
                              </div>
                            </div>

                            <div class="row mb-3">
                              <label for="password" class="col-md-4 col-lg-3 col-form-label">Contraseña</label>
                              <div class="col-md-8 col-lg-9">
                                <input name ="password" id="password-input" class="form-control" type="password" style="background:white; font-size:0.95rem;" value= <?php echo $password ?>>
                              </div>
                            </div>

                            <div class="row mb-3">
                              <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="email" type="text" class="form-control" id="email" value=<?php echo $email ?>>
                              </div>
                            </div>

                            <div class="row mb-3">
                                <label for="language" class="col-md-4 col-lg-3 col-form-label">Idioma</label>
                                <div class="col-md-8 col-lg-9">
                                    <select name="lang_key" class="form-select" id="lang_key">
                                        <?php
                                        $consulta = "SELECT * FROM languages";
                                        $resultado = $conection->query($consulta);
                                        // Verifica si la consulta fue exitosa
                                        if ($resultado) {
                                            // Itera sobre los resultados obtenidos de la consulta
                                            while ($fila = $resultado->fetch_assoc()) {
                                                // Define una variable para determinar si esta opción debe estar seleccionada
                                                $selected = '';
                                                // Si el lang_key de la fila coincide con el lang_key del usuario, marca esta opción como seleccionada
                                                if ($fila["lang_key"] == $_SESSION['langkey']) {
                                                    $selected = 'selected';
                                                }
                                                // Imprime cada opción del dropdown con los datos de la consulta
                                                echo '<option value="' . $fila["lang_key"] . '" codename="' . $fila["code_name"] . '" ' . $selected . '>' . $fila["description"] . '</option>';
                                            }
                                        } else {
                                            echo "Error al ejecutar la consulta: " . $conexion->error;
                                        }
                                        ?> 
                                    </select>
                                </div>
                            </div>
                              
                            <div class="text-center">
                              <button type="submit" class="btn btn-primary">Guardar cambios</button>
                            </div>
                              
                          </form><!-- End Profile Edit Form -->

                        </div>

                      </div><!-- End Bordered Tabs -->

                    </div>
                  </div>
                </div>
              </div>
            </section>
        </main>
        <script>
            // Script para ocultar o mostrar la contraseña //
            // Escucha el evento 'click' en el botón con el id
            document.getElementById('toggle-password').addEventListener('click', function () {
                // Obtiene el elemento del campo de contraseña por su id
                var passwordInput = document.getElementById('password-input');

                // Verifica si el tipo de entrada del campo de contraseña es 'password'
                if (passwordInput.type === 'password') {
                    // Si el tipo de entrada es 'password', cambia el tipo a 'text' para mostrar la contraseña
                    passwordInput.type = 'text';
                    // Cambia el texto del botón a 'Ocultar contraseña'
                    this.textContent = 'Ocultar contraseña';
                } else {
                    // Si el tipo de entrada no es 'password', lo cambia a 'password' para ocultar la contraseña
                    passwordInput.type = 'password';
                    // Cambia el texto del botón a 'Mostrar contraseña'
                    this.textContent = 'Mostrar contraseña';
                }
            });
        </script>
    </body>
</html>