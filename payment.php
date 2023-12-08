<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">

    <title>Płatność</title>
</head>

<body>
    <div class="home-page">

        <?php
        include './models/custom_css.php';

        include './models/navbar.php';
        ?>
        <?php
        if (isset($_POST['id']) && isset($_POST['nazwa_kupujacego']) && isset($_POST['email'])) {
            include './db.php';
            $time = time();
            $sql = "INSERT INTO zamowienia (id_produktu, nazwa_kupujacego, email) VALUES ('{$_POST['id']}', '{$_POST['nazwa_kupujacego']}', '{$_POST['email']}')";

            if ($conn->query($sql) === TRUE) : ?>
                <div class="payment-success">
                    <h1>
                        Dziękujemy za zakup. Twoja płatność została Zakończona pomyślnie, za 5 sekund zostaniesz przekierowany do strony głownej.</h1>
                </div>
            <?php else : ?>
                <div class="payment-error">
                    <h1>
                        Błąd płatności baza spróbuj jeszcze raz.</h1>
                </div>
            <?php endif;

            $conn->close();
        } else { ?>
            <div class="payment-error">
                <h1>
                    Błąd płatności spróbuj jeszcze raz.</h1>
            </div>
        <?php
        }
        ?>



        <?php

        include './models/footer.php';

        ?>
    </div>
	<script>
		window.onload = function() {
			// Wait for 5 seconds
			setTimeout(function() {
				// Change website URL
				window.location.href = "./";
			}, 5000); // 5000 milliseconds = 5 seconds
		};
	</script>
</body>

</html>