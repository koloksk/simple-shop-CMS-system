<?php

session_start();

// Sprawdzanie, czy użytkownik jest zalogowany. Jeśli nie, przekierowujemy go na stronę logowania.
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
  exit();
}

require_once('db.php');

if (isset($_POST['type'])) {
  $sql = "";

  //Akcje do ofert
  if ($_POST['type'] == "offer") {
    if ($_POST['action'] == "add") {
      if (isset($_POST['nazwa']) && isset($_POST['cena']) && isset($_POST['zdjecie']) && isset($_POST['opis']) && $_POST['id'] == null) {
        $sql = "INSERT INTO oferty (nazwa, opis, cena, zdjecie) VALUES ('{$_POST['nazwa']}', '{$_POST['opis']}', '{$_POST['cena']}' , '{$_POST['zdjecie']}' )";
      } else {
        $sql = "UPDATE oferty SET  nazwa = '{$_POST['nazwa']}', opis = '{$_POST['opis']}', cena = '{$_POST['cena']}', zdjecie = '{$_POST['zdjecie']}' WHERE id = '{$_POST['id']}' ;";
      }
    }
    if ($_POST['action'] == "remove") {
      if (isset($_POST['id'])) {
        $sql = "DELETE FROM oferty WHERE id=" . $_POST['id'];
      }
    }
  }

  //Akcje do kont

  if ($_POST['type'] == "account") {
    if ($_POST['action'] == "add") {
      if (isset($_POST['login']) && isset($_POST['email']) && isset($_POST['haslo']) && $_POST['id'] == null) {
        $sql = "INSERT INTO konta (login, email, haslo) VALUES ('{$_POST['login']}', '{$_POST['email']}', '" . sha1($_POST['haslo']) . "')";
      } else {
        $sql = "UPDATE konta SET login = '{$_POST['login']}', email = '{$_POST['email']}', haslo = '" . sha1($_POST['haslo']) . "' WHERE id = '{$_POST['id']}' ;";
      }
    }
    if ($_POST['action'] == "remove") {
      if (isset($_POST['id'])) {
        $sql = "DELETE FROM konta WHERE id= '{$_POST['id']}'";
      }
    }
  }

  //Akcje dla podstron
  if ($_POST['type'] == "page") {
    if ($_POST['action'] == "add") {
      if (isset($_POST['name']) && isset($_POST['text']) && $_POST['id'] == null) {
        $sql = "INSERT INTO podstrony (nazwa, tekst) VALUES ('{$_POST['name']}', '{$_POST['text']}')";
      } else {
        $sql = "UPDATE podstrony SET nazwa = '{$_POST['name']}', tekst = '{$_POST['text']}' WHERE id = '{$_POST['id']}' ;";
      }
    }
    if ($_POST['action'] == "remove") {
      if (isset($_POST['id'])) {
        $sql = "DELETE FROM podstrony WHERE id= '{$_POST['id']}'";
      }
    }
  }

  //Wysyła zapytanie do bazy danych
  if ($sql != null && $sql != "") {
    if ($conn->query($sql) === TRUE) {
      echo "Pomyslnie wykonano akcje";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}
