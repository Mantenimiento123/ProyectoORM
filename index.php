<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Correos</title>
    <!-- Enlace a Bootstrap CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-kJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Q04SQkIChwYKtl8ayQjC5Bz76Kc/QO1y" crossorigin="anonymous">
    <!-- Estilos CSS personalizados -->
    <style>
        body {
            background: linear-gradient(to left, blue, cyan);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h3 {
            margin-top: 0;
        }
        form {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        require_once(__DIR__ . '/Database.php');
        require_once(__DIR__ . '/Orm.php');
        require_once(__DIR__ . '/correo.php');
        require_once(__DIR__ . '/inscripciones.php');

        $database = new Database();
        $conneccion = $database->getConnection();
        $correoModel = new correo($conneccion);
        $correos = $correoModel->getAll();
        ?>

        <!-- Formulario para insertar un nuevo correo -->
        <div class="mb-3">
            <h3>Insertar Nuevo Correo</h3>
            <form action="insertar_correo.php" method="POST">
                <div class="form-group">
                    <label for="id">ID:</label>
                    <input type="text" class="form-control" name="id" id="id">
                </div>
                <div class="form-group">
                    <label for="correo">Correo:</label>
                    <input type="text" class="form-control" name="correo" id="correo">
                </div>
                <button type="submit" class="btn btn-primary">Insertar</button>
            </form>
        </div>

        <!-- Tabla de correos -->
        <div class="mb-3">
            <h3>Listado de Correos</h3>
            <table class="table table-striped" border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($correos as $correo): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($correo['ID']); ?></td>
                            <td><?php echo htmlspecialchars($correo['CORREO']); ?></td>
                            <td>
                                <form action="eliminar_correo.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($correo['ID_']); ?>">
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Enlace a la página de inscripciones -->
        <div>
            <a href="index2_inscripciones.php" class="btn btn-primary">Ver Inscripciones</a>
        </div>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-zB5r5sSXLtnmhaxOficlkTJK7tC7ehVfWBmSWXKvqcWz02a8AlzP26SuUBcFm5xW" crossorigin="anonymous"></script>
</body>
</html>
