<?php

require_once '../database/conn.php';

$id = $_GET['id'];
if ($id) {
    $sql = $conn->prepare("DELETE FROM to_do WHERE id = ?");
    $sql->bind_param('i', $id);
    $sql->execute();
    header('Location: ../index.php');
    exit();
}
else {
    header('Location: ../index.php');
    exit();
}
