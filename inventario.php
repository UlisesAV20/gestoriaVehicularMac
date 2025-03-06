<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "gestiondecarrosmac";

    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Inventario Mac</title>


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="css/css_adminP1.css" rel="stylesheet">

</head>

<body class="bg-dark" id="page-top">

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
      <div class="container-fluid">
        <a class="navbar-brand" href="invenario.php">
          <img src="images/mac-computadoras-logo.jpg" width="50px" height="50px" alt="" title="" />
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarResponsive">
            <ul class="navbar-nav mb-2 mb-lg-0">
              <li class="nav-item">
                <form class="d-flex justify-content-center" action="inventario.php" method="GET" name="busca">
                  <div class="input-group custom-width me-2">
                    <select class="form-select custom-width" name="ub">         
                      <option value="">Ver todo</option>
                      <option value="Almacen">Cuernavaca</option>
                      <option value="Direccion">CDMX</option>
                      <option value="Secretaria Academica (Direccion)">Puebla</option>
                      <option value="Secretaria de Investigacion (Direccion)">Tijuana</option>

                      
                    </select>
                    <button class="btn btn-orange" type="submit">
                      <i class="fa fa-check"></i>
                    </button>
                  </div>
                  <div class="input-group custom-width">
                    <input class="form-control" id="search" type="text" placeholder="Busqueda General..." name="buscar" maxlength="100">
                    <button class="btn btn-orange" type="submit">
                      <i class="fa fa-search"></i>
                    </button>
                  </div>
                </form>
              </li>
              <li class="nav-item">
                <a href="admin-inventario_nuevo.php" class="nav-link"><i class="fas fa-plus-circle"></i><span class="nav-link-text"> Agregar nuevo</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="adminP1.php"><i class="fas fa-home"></i><span class="nav-link-text"> Inicio</span></a>
              </li>
                            <li class="nav-item">
                  <a class="nav-link" href="admin-administrador.php"><i class="fas fa-users"></i>&nbsp;Usuarios</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="llaves/index.php"><i class="fas fa-box-open"></i>&nbsp;Prestamos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="admin-bajas.php"><i class="fas fa-fw fa-swatchbook"></i><span class="nav-link-text">Bajas</span></a>
                </li>
                          <li class="nav-item">
                <a class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-fw fa-sign-out"></i>Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
  
  
          <!-- Main Content -->
      <div class="mt-3 pt-4">
          ﻿
  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <title>Facultad de Artes - Sistema de Inventario</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Favicon -->
      <link rel="icon" type="image/jpg" href="img/images.jpg">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.2/xlsx.full.min.js"></script>
  </head>
  <body>
  
  <!-- Section -->
  <section>
      <div class="card">
          <div class="card-body">
              <div class="table-responsive">
                  <table id="tablaInventario" class="table table-striped table-bordered">
                      <thead class="thead-dark font-weight-bold">
                      <tr>
            <th>#</th>
            <th>Número de Resguardo</th>
            <th>Número de Inventario</th>
            <th>Tipo de Activo</th>
            <th>Descripción</th>
            <th>Ubicación</th>
            <th>Observaciones</th>
            <th>Foto</th>
            <th>Fecha de Alta</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Consulta para obtener los registros
        $sql = "SELECT * FROM materiales";
        $resultado = $conn->query($sql);
        $contador = 1;

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$contador}</td>";
                echo "<td>{$fila['n_resguardo']}</td>";
                echo "<td>{$fila['codigo_material']}</td>";
                echo "<td>{$fila['tipo_activo']}</td>";
                echo "<td>{$fila['descripcion']}</td>";
                echo "<td>{$fila['ubicacion']}</td>";
                echo "<td>{$fila['observaciones']}</td>";
                echo "<td><img src='fotos/{$fila['foto']}' width='200'></td>";
                echo "<td>{$fila['fecha_alta']}</td>";
                echo "<td>
                        <a href='editar.php?id={$fila['id']}'>Editar</a> | 
                        <a href='eliminar.php?id={$fila['id']}'>Eliminar</a>
                        <a href='eliminar.php?id={$fila['id']}'>baja</a>
                      </td>";
                echo "</tr>";
                $contador++;
            }
        } else {
            echo "<tr><td colspan='10'>No hay datos registrados.</td></tr>";
        }
        ?>
                      </thead>
                      <tbody class="text-center">
                      
                        </table>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Enlace al archivo JS -->
        <script src="js/scripts.js"></script>
        
        </body>
        </html>
            </div>
        
        
            <!-- /.content-wrapper-->
            <footer>
              <div class="container">
                <div class="text-center">
                  
                </div>
              </div>
            </footer>
        
            <!-- Botón para ir al tope de la página -->
            <a class="scroll-to-top rounded" href="#page-top" id="scrollToTopButton">
                <i class="fa fa-angle-up"></i>
            </a>
        
            <!-- Botón para exportar a Excel -->
            <a class="export-to-excel rounded" href="javascript:void(0)" onclick="htmlExcel('tablaInventario', 'Reporte_Inventario')" id="exportToExcelButton">
                <i class="fa fa-file-excel"></i>
            </a>
        
          <!-- Logout Modal-->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro de que quieres cerrar sesión?</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Selecciona "Cerrar sesión" si estás listo para finalizar tu sesión actual.
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  <a class="btn btn-primary" href="logout.php">Cerrar sesión</a>
                </div>
              </div>
            </div>
          </div>
        
          </div>
        
          <!-- Bootstrap core JS -->
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
          <!-- jQuery -->
          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
          <!-- Custom JS -->
          <script src="js/scripts.js"></script>
        
        </body>
        </html>