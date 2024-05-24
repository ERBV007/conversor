<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Conversor</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <?php
    $servername = "localhost";
    $username = "root";
    $password = "Admin1234";
    $database = "conversor";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    echo "Connected successfully";
  ?>

  <h1 class="text-center">Conversor de Kilos a Libras</h1>
  <p class="text-center">Este es mi parrafo</p>
  <div class="container">
    <div class="row">
      <div class="col-sm-4"></div>
      <div class="col-sm-4">
        <form action="guardarCalculo.php" method="post">
          <div class="form-group">
            <label for="kilos">Ingrese el Peso en Kg</label>
            <input id="kilos" name="kilos" type="number" class="form-control" required>
            
          </div>
          <div class="form-group">
            <label for="conversion">Seleccione la Conversión</label>
            <select id="conversion" name="conversion" class="form-control" required>
              <option value="1">Kilogramos a Libras</option>
              <option value="2">Libras a Kilogramos</option>
              <option value="3">Otra Conversión</option>
            </select>
          </div>
          <br>
          <div class="text-end">
            <button type="submit" class="btn btn-primary">Enviar</button>
          </div>
        </form>
        <p id="result"></p>
      </div>
      <div class="col-sm-4"></div>
    </div>
  </div>
  <hr>
  <div class="container">
    <div class="text-center">
      <h2>Resultados Guardados</h2>
    </div>
    <hr>
    <table class="table table-bordered table-striped" id="results">
      <thead>
        <tr>
          <th>kg</th>
          <th>lb</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>
        <?php
          // Fetch data from the database
          $sql = "SELECT * FROM results";
          $result = $conn->query($sql);

          // Check if there are any results
          if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $row['kg'] . "</td>";
              echo "<td>" . $row['lb'] . "</td>";
              echo '<td>
                      <form action="eliminar.php" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="' . $row['id'] . '">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                      </form>
                    </td>';
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='3'>No results found</td></tr>";
          }

          $conn->close();
        ?>
      </tbody>
    </table>
  </div>
  <hr>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
