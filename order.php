<!DOCTYPE html>
<html>

<head>
    <title>Sklep</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

</head>

<body>
    <div class="home-page">

        <?php
        include './models/custom_css.php';

        include './models/navbar.php';

        include './db.php';
        $id = $_GET['id'];
        $name = "";
        $desc = "";
        $price = "";
        $img = "";
        $result = $conn->query("SELECT * FROM oferty WHERE id = '{$id}'");


        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $name = $row['nazwa'];
            $desc = $row['opis'];
            $price = $row['cena'];
            $img = $row['zdjecie'];
        } else {
            echo "Błąd 404.";
        }

        $conn->close();


        ?>
        <div id="row">
            <div class="card">
                <div style="width:100%; display: flex; justify-content: center;">
                    <img onerror="this.onerror=null;this.src=`https://upload.wikimedia.org/wikipedia/commons/b/b1/No-image.png`;" hidth="200px" height="300px" src=" <?php echo $img ?>" alt="<?php $name ?>">
                </div>
                <h2><?php echo $name ?></h2>
                <p><?php echo $price ?></p>
                <p><?php echo $desc ?></p>


            </div>
            <div class="card">
                <form action="./payment.php" method="POST">
                    <h1>Formularz Zamowienia</h1>
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <div class="label">Imię</div>
                    <input type="text" name="nazwa_kupujacego" id="">
                    <div class="label">Telefon</div>
                    <input type="text" name="telefon" id="">
                    <div class="label">Email</div>
                    <input type="email" name="email" id="">
                    <button type="submit">Zamów</button>
                </form>
            </div>
        </div>


        <?php include './models/footer.php';
        ?>
    </div>

</body>

</html>