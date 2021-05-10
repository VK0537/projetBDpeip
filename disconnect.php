<?php
session_start();
unset($_SESSION['logged']);
unset($_SESSION['email']);
header('Location:/');
exit("Vous avez été déconnecté");
?>