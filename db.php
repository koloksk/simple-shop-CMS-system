<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}



// Tworzy tabele jeśli nie istnieją potrzebna jest stworzona baza danych
$conn->query("CREATE TABLE IF NOT EXISTS `cms`.`oferty` ( `id` INT NOT NULL AUTO_INCREMENT , `nazwa` VARCHAR(255) NOT NULL , `opis` VARCHAR(65000) NOT NULL ,`cena` VARCHAR(255) NOT NULL , `zdjecie` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;");


$conn->query("CREATE TABLE IF NOT EXISTS `cms`.`konta` ( `id` INT NOT NULL AUTO_INCREMENT , `login` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL , `haslo` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;");

$conn->query("CREATE TABLE IF NOT EXISTS `cms`.`podstrony` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(100) NOT NULL,
  `tekst` longtext NOT NULL,
  PRIMARY KEY (`id`)

) ENGINE=InnoDB;");

$conn->query("CREATE TABLE IF NOT EXISTS `cms`.`ustawienia` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `logo` varchar(1000) NOT NULL,
  `nazwa` varchar(50) NOT NULL,
  `css` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;");
$conn->query("INSERT IGNORE INTO ustawienia (id) VALUES ('1')");
$conn->query("CREATE TABLE IF NOT EXISTS `cms`.`zamowienia` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_produktu` int(11) NOT NULL,
  `nazwa_kupujacego` varchar(1000) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;");
?>