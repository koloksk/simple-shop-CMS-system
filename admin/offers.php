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
  <title>Oferty</title>
  <link rel="stylesheet" href="../css/style.css">
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">


</head>

<?php


require_once('../db.php');
$id = "";
$nazwa = "";
$opis = "";
$cena = "";
$zdjecie = "";


if (isset($_POST['type']) && isset($_POST['id'])) {

  $sql = "SELECT * FROM oferty WHERE id=" . $_POST['id'];
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $id = $_POST['id'];
      $nazwa = $row["nazwa"];
      $zdjecie = $row["zdjecie"];
      $opis = $row["opis"];
      $cena = $row["cena"];
    }
  } 
}


?>


<body>
  <?php include '../models/offer_form.php'; ?>

  <?php
  include '../models/sidebar.php';
  ?>
  <div class="main-content">
    <div class="header">
      <div class="title">
        <h1>Edycja ofert sklepu</h1>
        <p>Tutaj edytujesz lub dodasz ofertę do sklepu.</p>


      </div>
      <button type="submit" onclick="showForm();">Dodaj Produkt</button>
    </div>

    <div class="card">
      <table class="table">
        <thead>
          <tr>
          <th scope="col">Lp.</th>

            <th scope="col">Id przedmiotu</th>
            <th scope="col">Zdjecie</th>

            <th scope="col">Nazwa</th>
            <th scope="col">Cena</th>
            <th scope="col">Akcje</th>
          </tr>
        </thead>
        
        <tbody>
          <?php
          include '../db.php';

          $result = $conn->query("SELECT * FROM oferty");
          $counter = 1;
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo '<tr>';
              echo '<td>' . $counter . '</td>';
              echo '<td>' . $row['id'] . '</td>';
              echo '<td><img onerror="this.onerror=null;this.src=`https://upload.wikimedia.org/wikipedia/commons/b/b1/No-image.png`;" width="80px" height="80px"src="' . $row['zdjecie'] . '"></td>';
              echo '<td>' . $row['nazwa'] . '</td>';
              echo '<td>' . $row['cena'] . ' zł</td>';
              echo '<td> 
                <form method="POST">
                <input type="hidden" name="action" value="edit">

                <input type="hidden" name="id" value="' . $row['id'] . '">
                <input type="hidden" name="type" value="offer">

                <button type="submit">Edytuj</button>
                </form>

                <form method="POST">
                <input type="hidden" name="action" value="remove">
                <input type="hidden" name="type" value="offer">
                <input type="hidden" name="id" value="' . $row['id'] . '">


                <button type="submit">Usun</button>
                </form>
                </td>';
              echo '</tr>';
              $counter++;
            }
          } 
          ?>
        </tbody>
      </table>
    </div>
  </div>


  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js?ver=3.3.1"></script>
  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
  <script src="offers.js"></script>
  <?php

  if (isset($_POST['type']) && isset($_POST['id'])) {
    echo "<script>showForm();</script>";
  }


  ?>

</body>

</html>