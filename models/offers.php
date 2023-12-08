<div class="offers">

    <?php
    include './db.php';

    $result = $conn->query("SELECT * FROM oferty");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="offer-card">';
            echo '<img onerror="this.onerror=null;this.src=`https://upload.wikimedia.org/wikipedia/commons/b/b1/No-image.png`;" hidth="200px" height="300px"src="' . $row['zdjecie'] . '" alt="' . $row['nazwa'] . '">';
            echo '<h2>' . $row['nazwa'] . '</h2>';
            echo '<p>Cena: ' . $row['cena'] . ' zł</p>';
            echo '<a href="./order.php?id=' . $row['id']  . '"><button >Kup</button></a>';
            echo '</div>';
        }
    } else {
        echo "Brak ofert.";
    }
    $conn->close();
    ?>

</div>