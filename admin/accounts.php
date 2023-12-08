<?php
session_start();

// Sprawdzanie, czy użytkownik jest zalogowany. Jeśli nie, przekierowujemy go na stronę logowania.
if (!isset($_SESSION['username'])) {
  header('Location: ../login.php');
  exit();
}

require_once('../db.php');

$id = "";
$login = "";
$email = "";

if (isset($_POST['type']) && isset($_POST['id'])) {

  $sql = "SELECT * FROM konta WHERE id=" . $_POST['id'];
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $id = $_POST['id'];
      $login = $row["login"];
      $email = $row["email"];
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
  <title>Użytkownicy</title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>

  <div class="form-element">
    <div class="overlay" onclick="showForm();"></div>
    <div class="form">
      <h2>Edycja konta</h2>
      <form method="POST" id="form">
        <input type="hidden" name="action" value="add">
        <input type="hidden" name="type" value="account">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <div class="label">Login</div>

        <input type="text" name="login" value="<?php echo $login ?>" required>
        <div class="label">Email</div>
        <input type="email" name="email" value="<?php echo $email ?>" required>

        <div class="label">Hasło</div>
        <input type="password" name="haslo" required>
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
        <h1>Edycja kont</h1>
        <p>Tutaj edytujesz lub dodasz konta do sklepu.</p>


      </div>
      <button type="submit" onclick="showForm();">Dodaj Konto</button>

    </div>
    <div class="card">
      <table>
        <tr>
          <th>Login</th>
          <th>Email</th>
          <th>Akcje</th>
        </tr>
        <?php
        include '../db.php';

        $result = $conn->query("SELECT * FROM konta");

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['login'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td> 
              <form method="POST"> 
              <input type="hidden" name="action" value="edit">
              <input type="hidden" name="type" value="account">
              <input type="hidden" name="id" value="' . $row['id'] . '">

              <button type="submit">Edytuj</button>
              </form>
              <form method="POST"> 
              <input type="hidden" name="action" value="remove">
              <input type="hidden" name="type" value="account">
              <input type="hidden" name="id" value="' . $row['id'] . '">

              <button type="submit">Usun</button>
              </form></td>
              ';
            echo '<tr>';
          }
        } else {
          echo "Brak kont.";
        }
        ?>
      </table>
    </div>
  </div>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js?ver=3.3.1"></script>

  <script src="accounts.js"></script>
  <?php

  if (isset($_POST['type']) && isset($_POST['id'])) {
    echo "<script>showForm();</script>";
  }


  ?>
</body>

</html>