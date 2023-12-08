<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: ./admin/');
    exit();
}
// Łączenie z bazą danych
require_once('db.php');

//Sprawdza czy sa konta w bazie
$check = $conn->query("SELECT * FROM konta");
$user_count = mysqli_num_rows($check);

if ($user_count == 0){
   //tabela jest pusta
   if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
    $sql = "INSERT INTO konta (login, email, haslo) VALUES ('{$_POST['username']}', '{$_POST['email']}', '" . sha1($_POST['password']) . "')";
    
    if ($conn->query($sql) === TRUE) {
      echo "Konto zostało utworzone pomyslnie";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

   }
}


// Obsługa formularza logowania
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Pobieramy hasło dla podanego użytkownika z bazy danych
    $username = $_POST['username'];
    $sql = "SELECT * FROM konta WHERE login = '$username' OR email = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $db_password = $row['haslo'];
        if(sha1($_POST['password']) == $db_password) {
            $_SESSION['username'] = $row['login'];
            header('Location: ./admin/');
            exit();
        } else {
            echo "Nieprawidłowy login lub hasło";

        }
    } else {
        echo "Nieprawidłowy login lub hasło";
    }
	$conn->close();
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Strona logowania</title>
	<link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="login-container">
    <?php if($user_count != 0):?>
	<div class="login">
		<h1>Logowanie</h1>
		<form method="POST">
            <div class="label">Login lub email</div>
			<input type="text" id="username" name="username" required>

		    <div class="label">Hasło</div>
			<input type="password" id="password" name="password" required>
            <div id="captcha"></div>
            <button type="submit">Zaloguj</button>
		</form>
	</div>
    <?php else:?>
	<div class="login">
		<h1>Rejestracja</h1>
		<form method="POST">
            <div class="label">Login</div>
			<input type="text" id="username" name="username" required>
            <div class="label">Email</div>
			<input type="email" id="email" name="email" required>
		    <div class="label">Hasło</div>
			<input type="password" id="password" name="password" required>
            <button type="submit">Zarejestruj</button>
		</form>
	</div>
    <?php endif;?>
    </div>
    <script type="text/javascript">
      var onloadCallback = function() {
        grecaptcha.render('captcha', {
          'sitekey' : '6Lc1U9UkAAAAANTZA0OfJBiQZUzSUrVgeS3ieBzd'
        });
      };
    </script>
    
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
    </script>
</body>
</html>
