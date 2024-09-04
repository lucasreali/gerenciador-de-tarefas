<?php

require_once '../database/conn.php';

$description = $_POST['description'];
if ($description) {
    $sql = $conn->prepare("INSERT INTO to_do (description) VALUES (?)");
    $sql->bind_param("s", $description);
    $sql->execute();
    header('Location: ../index.php');
    exit();
} else {
    header('Location: ../index.php');
    exit();
}