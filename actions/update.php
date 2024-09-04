<?php

require_once '../database/conn.php';

$new_description = $_POST['description'];
$id = $_POST['id'];
if ($new_description) {
    $sql = $conn->prepare("UPDATE to_do SET description = ? WHERE id = ?");
    $sql->bind_param("si", $new_description, $id);
    $sql->execute();
    header('Location: ../index.php');
    exit();
}
else {
    header('Location: ../index.php');
    exit();
}
