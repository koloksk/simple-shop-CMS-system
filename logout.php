<?php
session_start();

// Usuwanie sesji i przekierowanie użytkownika na stronę logowania.
session_unset();
session_destroy();

header('Location: index.php');
exit();
?>
