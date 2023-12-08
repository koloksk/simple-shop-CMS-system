<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link href="http://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="http://cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
<link href="http://cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <title>Strona</title>
</head>
<body>
<div class="home-page">

<?php
        include './models/custom_css.php';

include './models/navbar.php';

include './db.php';

$result = $conn->query("SELECT * FROM podstrony WHERE id = " . $_GET['id']) ;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo '<div class="content">';
    echo '<p>' . $row['tekst'] . '</p>';
    echo '</div>';
} else {
    echo "Błąd 404.";
}

$conn->close();

include './models/footer.php';

?>
</div>

</body>
</html>