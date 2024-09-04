<?php

require_once '../database/conn.php';

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$completed = filter_input(INPUT_POST, 'completed', FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

if ($id !== false && $completed !== null) {
    $sql = $conn->prepare("UPDATE to_do SET completed = ? WHERE id = ?");
    $completed = $completed ? 1 : 0; 
    $sql->bind_param("ii", $completed, $id);

    if ($sql->execute()) {
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("success" => false, "error" => $conn->error));
    }
} else {
    echo json_encode(array("success" => false, "error" => "Dados inválidos"));
}
