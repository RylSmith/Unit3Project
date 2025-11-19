<?php
$dsn = 'mysql:host=localhost;dbname=unit_3_project';
$username = 'root';
$password = 'thing';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
try {
    $db = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    $error = $e->getMessage();
    include('view/error.php');
    exit();
}
?>