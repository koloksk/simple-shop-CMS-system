<?php
session_start();

// Sprawdzanie, czy użytkownik jest zalogowany. Jeśli nie, przekierowujemy go na stronę logowania.
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit();
}


include '../db.php';

$result = $conn->query("SELECT * FROM zamowienia");
$sprzedane_produkty = mysqli_num_rows($result);
$zarobek_calkowity = 0;
$zarobek_30d = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $result2 = $conn->query("SELECT cena FROM oferty WHERE id = '{$row['id_produktu']}'");
        if ($result2->num_rows > 0) {
            while ($row2 = $result2->fetch_assoc()) {
                $zarobek_calkowity += $row2['cena'];
            }
        }
    }
}

$result = $conn->query("SELECT * FROM zamowienia WHERE data >= FROM_UNIXTIME(UNIX_TIMESTAMP(NOW()) - (30 * 24 * 60 * 60))"
);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $result2 = $conn->query("SELECT cena FROM oferty WHERE id = '{$row['id_produktu']}'");
        if ($result2->num_rows > 0) {
            while ($row2 = $result2->fetch_assoc()) {
                $zarobek_30d += $row2['cena'];
            }
        }
    }
}

$conn->close();



?>

<!DOCTYPE html>
<html>

<head>
    <title>Panel administracyjny</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.1.96/css/materialdesignicons.min.css">


</head>

<body>

    <?php
    include '../models/sidebar.php';
    ?>
    <!-- Główny kontener -->
    <div class="main-content">
        <h1>Dashboard</h1>
        <div class="info-container">
            <div class="info">
                <i class="mdi mdi-cart-outline"></i>

                <div class="info-text">
                    <h2><?php echo $sprzedane_produkty?></h2>
                    <p>Sprzedane produkty</p>
                </div>
            </div>
            <div class="info">
                <i class="mdi mdi-cash"></i>

                <div class="info-text">
                    <h2><?php echo $zarobek_30d?> zł</h2>
                    <p>Przychód 30dni</p>
                </div>
            </div>
            <div class="info">
                <i class="mdi mdi-currency-usd"></i>

                <div class="info-text">
                    <h2><?php echo $zarobek_calkowity?> zł</h2>
                    <p>Przychód całkowity</p>
                </div>
            </div>
        </div>
        <div class="chart-container">
            <canvas id="chart"></canvas>
        </div>
        <div class="info last-orders">
            <h2>Ostatnie 5 transakcji</h2>
            <table class="table">
                <tbody>
                    <?php
                    include '../db.php';

                    $result = $conn->query("SELECT * FROM zamowienia ORDER BY id DESC LIMIT 5;");

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $cena = "";
                            $produkt = "";
                            $result2 = $conn->query("SELECT nazwa, cena FROM oferty WHERE id = '{$row['id_produktu']}'");
                            if ($result2->num_rows > 0) {
                                while ($row2 = $result2->fetch_assoc()) {
                                    $cena = $row2['cena'];
                                    $produkt = $row2['nazwa'];

                                }
                            }
                            echo '<tr>';
                            echo '<td>' . $row['data'] . '</td>';
                            echo '<td>' . $produkt . '</td>';
                            echo '<td>' . $cena . ' zł</td>';

                            echo '<td>' . $row['nazwa_kupujacego'] . '</td>';
                            echo '<td>' . $row['email'] . '</td>';

                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        var ctx = document.getElementById('chart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Pon", "Wto", "Śro", "Czw", "Ptk", "Sob", "Nie"],
                datasets: [{
                        data: [86, 114, 106, 106, 107, 111, 133],
                        label: "Sprzedaż",
                        borderColor: "rgb(62,149,205)",
                        backgroundColor: "rgb(62,149,205,0.1)",
                    },
                    {
                        data: [82, 14, 101, 26, 37, 11, 140],
                        label: "Dochód",
                        borderColor: "rgb(10,255,10)",
                        backgroundColor: "rgb(62,149,205,0.1)",
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

</body>

</html>