<?php
session_start();

// Sprawdzanie, czy użytkownik jest zalogowany. Jeśli nie, przekierowujemy go na stronę logowania.
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit();
}
require_once('../db.php');

$id = "";
$name = "";
$text = "";

if (isset($_POST['type']) && isset($_POST['id'])) {

  $sql = "SELECT * FROM podstrony WHERE id=" . $_POST['id'];
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $id = $_POST['id'];
      $name = $row["nazwa"];
      $text = $row["tekst"];

    }
  }
}

?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <title>Strony</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
<div class="form-element">
    <div class="overlay" onclick="showForm();"></div>
    <div class="form">
      <h2>Edycja podstrony</h2>
      <form method="POST" id="form">
        <input type="hidden" name="action" value="add">
        <input type="hidden" name="type" value="page">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <div class="label">Nazwa</div>
          <input type="text" name="name" value="<?php echo $name ?>" required>
          <div class="label">Tekst</div>
        <div id="editor">
        <?php echo $text ?>
        </div>
        <textarea name="text" style="display:none" id="hiddenDescription"></textarea>
        <button type="submit" onclick="showForm();">Zapisz</button>
        <div onclick="showForm();">Anuluj</div>
      </form>
    </div>
  </div>

    <?php
    include '../models/sidebar.php';
    ?>
    <div class="main-content">
        <div class="header">
            <div class="title">
                <h1>Edycja Podstron</h1>
                <p>Tutaj dodasz lub usuniesz podstrony.</p>


            </div>
            <button type="submit" onclick="showForm();">Dodaj Podstrone</button>

        </div>
        <div class="card">

        <table>
          <tr>
            <th>Id</th>
            <th>Nazwa Strony</th>
            <th>Akcje</th>
          </tr>
          <?php
          include '../db.php';

          $result = $conn->query("SELECT * FROM podstrony");

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo '<tr>';
              echo '<td>' . $row['id'] . '</td>';
              echo '<td>' . $row['nazwa'] . '</td>';
              echo '<td> 
              <form method="POST">
              <input type="hidden" name="action" value="edit">

              <input type="hidden" name="id" value="' . $row['id'] . '">
              <input type="hidden" name="type" value="page">

              <button type="submit">Edytuj</button>
              </form>

              <form method="POST">
              <input type="hidden" name="action" value="remove">
              <input type="hidden" name="type" value="page">
              <input type="hidden" name="id" value="' . $row['id'] . '">


              <button type="submit">Usun</button></td>
              ';
              echo '<tr>';
            }
          } 
          ?>
        </table>
        </div>
    </div>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js?ver=3.3.1"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
  <script src="pages.js"></script>
  <?php 
  
  if (isset($_POST['type']) && isset($_POST['id'])) {
    echo "<script>showForm();</script>";
  }
  ?>
</body>

</html>