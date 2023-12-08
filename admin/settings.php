<?php
session_start();

// Sprawdzanie, czy użytkownik jest zalogowany. Jeśli nie, przekierowujemy go na stronę logowania.
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit();
}


include '../db.php';
if (isset($_POST['logo']) && isset($_POST['name']) && isset($_POST['css'])) {
    $sql = "UPDATE ustawienia SET logo = '{$_POST['logo']}', nazwa = '{$_POST['name']}', css = '{$_POST['css']}' WHERE id = 1";

    if ($conn->query($sql) === TRUE) {
        echo "zapisano pomyslnie";
    } else {
        echo "Błąd zapisu: " . mysqli_error($conn);
    }
}

$logo = "";
$name = "";
$css = "";
$result = $conn->query("SELECT * FROM ustawienia");

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $logo = $row['logo'];
    $name = $row['nazwa'];
    $css = $row['css'];
}

$conn->close();


?>




<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ustawienia</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/codemirror.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/mode/css/css.min.js"></script>
</head>

<body>


    <?php
    include '../models/sidebar.php';
    ?>
    <div class="main-content">
        <div class="header">
            <div class="title">
                <h1>Edycja Ustawień</h1>
                <p>Tutaj zmienisz ustawienia sklepu.</p>


            </div>

        </div>
        <div class="card">
            <form action="" method="post">
                <div class="label">Logo Sklepu</div>
                <input type="text" name="logo" id="" value="<?php echo $logo ?>">
                <div class="label">Nazwa Sklepu</div>
                <input type="text" name="name" id="" value="<?php echo $name ?>">

                <div class="label">Własne style css</div>
                <textarea name="css" id="css" cols="30" rows="10"><?php echo $css ?></textarea>

                <button type="submit">Zapisz</button>
            </form>
        </div>
    </div>
    <script>
        var ta = document.getElementById("css");
        var editor = CodeMirror.fromTextArea(ta, {
            mode: "css",
            lineNumbers: true,
            theme: "default",
            indentUnit: 4,
            indentWithTabs: true,
        });
    </script>
</body>

</html>