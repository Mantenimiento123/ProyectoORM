<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Inscripciones</title>
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
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h3 {
            margin-top: 0;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
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
        require_once(__DIR__ . '/inscripciones.php');
        require_once(__DIR__ . '/estudiantes.php');

        // Obtener la conexión y los datos de las inscripciones
        $database = new Database();
        $conneccion = $database->getConnection();
        $inscripcionesModel = new inscripciones($conneccion);
        $inscripciones = $inscripcionesModel->getAll();

        // Obtener los datos de los estudiantes
        $estudiantesModel = new estudiantes($conneccion);
        $estudiantes = $estudiantesModel->getAll();
        ?>

        <!-- Formulario para insertar una nueva inscripción -->
        <h3>Insertar Nueva Inscripción</h3>
        <form action="insertar_inscripcion.php" method="POST">
            <div class="mb-3">
                <label for="id" class="form-label">ID:</label>
                <select name="id" id="id" class="form-control" required>
                    <?php foreach ($estudiantes as $estudiante): ?>
                        <option value="<?php echo htmlspecialchars($estudiante['ID']); ?>"><?php echo htmlspecialchars($estudiante['ID']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="carnet" class="form-label">CARNET:</label>
                <input type="text" class="form-control" name="carnet" id="carnet" required>
            </div>
            <div class="mb-3">
                <label for="semestre" class="form-label">SEMESTRE:</label>
                <input type="text" class="form-control" name="semestre" id="semestre" required>
            </div>
            <div class="mb-3">
                <label for="anio" class="form-label">AÑO:</label>
                <input type="text" class="form-control" name="anio" id="anio" required>
            </div>
            <div class="mb-3">
                <label for="mes" class="form-label">MES:</label>
                <input type="text" class="form-control" name="mes" id="mes" required>
            </div>
            <div class="mb-3">
                <label for="tipo_inscripcion" class="form-label">TIPO_INSCRIPCION:</label>
                <input type="text" class="form-control" name="tipo_inscripcion" id="tipo_inscripcion" required>
            </div>
            <div class="mb-3">
                <label for="mora" class="form-label">MORA:</label>
                <input type="text" class="form-control" name="mora" id="mora" required>
            </div>
            <button type="submit" class="btn btn-primary">Insertar</button>
        </form>

        <!-- Tabla de inscripciones -->
        <h3>Listado de Inscripciones</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID_INSCRIPCION</th>
                    <th>ID</th>
                    <th>CARNET</th>
                    <th>SEMESTRE</th>
                    <th>AÑO</th>
                    <th>MES</th>
                    <th>TIPO INSCRIPCIÓN</th>
                    <th>MORA</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inscripciones as $inscripcion): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($inscripcion['ID_']); ?></td>
                        <td><?php echo htmlspecialchars($inscripcion['ID']); ?></td>
                        <td><?php echo htmlspecialchars($inscripcion['CARNET']); ?></td>
                        <td><?php echo htmlspecialchars($inscripcion['SEMESTRE']); ?></td>
                        <td><?php echo htmlspecialchars($inscripcion['ANIO']); ?></td>
                        <td><?php echo htmlspecialchars($inscripcion['MES']); ?></td>
                        <td><?php echo htmlspecialchars($inscripcion['TIPO_INSCRIPCION']); ?></td>
                        <td><?php echo htmlspecialchars($inscripcion['MORA']); ?></td>
                        <td>
                            <form action="eliminar_inscripcion.php" method="POST">
                                <input type="hidden" name="id_inscripcion" value="<?php echo htmlspecialchars($inscripcion['ID_']); ?>">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                  
                <?php endforeach; ?>

            </tbody>
        </table>
        <div>
            <a href="index.php" class="btn btn-primary">Ver Correos</a>
        </div>
    </div>
</body>
</html>

