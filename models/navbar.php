<?php
session_start();

include './db.php';
$logo = "";
$name = "";
$result = $conn->query("SELECT * FROM ustawienia");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $logo = $row['logo'];
        $name = $row['nazwa'];
    }
}
$conn->close();





?>



<nav>
    

    <div class="nav-logo">
    <?php if ($logo) : ?><a href="#"><img src="<?php echo $logo; ?>" alt="Logo"></a><?php endif; ?>
        <?php if ($name) : ?><h1><?php echo $name; ?></h1><?php endif; ?>
    </div>
    

    <ul class="nav-links">
        <li><a href="index.php">Strona główna</a></li>
        <?php 
        include './db.php';

        $result = $conn->query("SELECT * FROM podstrony") ;

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()){
            echo '<li><a href="page.php?id=' . $row['id'] . '">' . $row['nazwa'] . '</a></li>';
            }
        }
        
        $conn->close();
        
        ?>
    </ul>
    <?php if (!isset($_SESSION['username'])) : ?>
        <div class="nav-login">
            <a href="login.php">Zaloguj się</a>
        </div>
    <?php else : ?>
        <div class="nav-login">
            <a href="./admin/">Panel</a>
            <a href="logout.php">Wyloguj się</a>
        </div>

    <?php endif; ?>
</nav>