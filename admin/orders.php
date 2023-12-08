<?php
session_start();

// Sprawdzanie, czy użytkownik jest zalogowany. Jeśli nie, przekierowujemy go na stronę logowania.
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit();
}


?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strony</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>


    <?php
    include '../models/sidebar.php';
    ?>
    <div class="main-content">
        <div class="header">
            <div class="title">
                <h1>Historia zamówień</h1>
                <p>Tutaj wyświetlisz historie zamówień.</p>


            </div>

        </div>
        <div class="card">
        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Wyszukaj po nazwie kupującego...">

        <table class="table" id="table">
        <thead>
          <tr>
            <th scope="col">Id transakcji</th>
            <th scope="col">Id Przedmiotu</th>
            <th scope="col">Nazwa</th>
            <th scope="col">Cena</th>

            <th scope="col">Kupujący</th>
            <th scope="col">Email</th>

            <th scope="col">Data</th>
          </tr>
        </thead>
        
        <tbody>
          <?php
          include '../db.php';

          $result = $conn->query("SELECT * FROM zamowienia ORDER BY id DESC");

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $cena = "";
              $produkt = "";
              $result2 = $conn->query("SELECT nazwa, cena FROM oferty WHERE id = '{$row['id_produktu']}'");
              if ($result2->num_rows > 0) {
                  while ($row2 = $result2->fetch_assoc()) {
                      $cena = $row2['cena'];
                      $produkt = $row2['nazwa'];
      
                  }
              }
              echo '<tr>';
              echo '<td>' . $row['id'] . '</td>';
              echo '<td>' . $row['id_produktu'] . '</td>';
              echo '<td>' . $produkt . '</td>';
              echo '<td>' . $cena . '</td>';

              echo '<td>' . $row['nazwa_kupujacego'] . '</td>';
              echo '<td>' . $row['email'] . '</td>';

              echo '<td>' . $row['data'] . '</td>';
              echo '</tr>';
            }
          } 
          ?>

        </tbody>
      </table>
        </div>
    </div>
<script> 
function searchTable() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("table");
  tr = table.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[4];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

</script>
</body>

</html>