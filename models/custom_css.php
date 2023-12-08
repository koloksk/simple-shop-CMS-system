<?php 

include './db.php';
$result = $conn->query("SELECT css FROM ustawienia");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<style>{$row['css']}</style>";
    }
}
$conn->close();

?>