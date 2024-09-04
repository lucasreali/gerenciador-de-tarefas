<?php
include "database/conn.php";

if ($conn) {
    $sql = $conn->query("SELECT * FROM to_do");
    $tasks = [];

    if ($sql->num_rows > 0) {
        $tasks = $sql->fetch_all(MYSQLI_ASSOC);
    }
} else {
    die("Falha na conexão com o banco de dados.");
}
?><!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <link
            crossorigin="anonymous"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
            integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
            referrerpolicy="no-referrer"
            rel="stylesheet"
    />
    <script
            crossorigin="anonymous"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            referrerpolicy="no-referrer"
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    ></script>
    <link href="src/styles/style.css" rel="stylesheet"/>
    <title>To-do list</title>
</head>
<body>
<div id="to_do">
    <h1>Things to do</h1>
    <form action="actions/create.php" method="post" class="to-do-form">
        <input
                name="description"
                placeholder="Write your task here"
                required
                type="text"
        />
        <button class="form-button" type="submit">
            <i class="fa-solid fa-plus"></i>
        </button>
    </form>

    <div id="tasks">

        <?php foreach ($tasks as $task): ?>
            <div class="task">
                <input
                        class="progress  <?= $task['completed'] ? "done" : ""?>"
                        name="progress"
                        type="checkbox"
                    <?= $task["completed"] ? "checked" : "" ?>
                        data-task-id="<?= $task['id']?>"
                />

                <p class="task-description">
                    <?= htmlspecialchars($task["description"]) ?>
                </p>

                <div class="task-actions">
                    <a class="action-button edit-button">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>

                    <a href="actions/delete.php?id=<?= $task['id']?>" class="action-button delete-button">
                        <i class="fa-regular fa-trash-can"></i>
                    </a>
                </div>

                <form action="actions/update.php" method="post" class="to-do-form edit-task hidden">
                    <input
                            name="description"
                            placeholder="Edit your task here"
                            type="text"
                    />
                    <input type="hidden" name="id" value="<?= $task['id'] ?>">
                    <button
                            class="form-button confirm-button"
                            type="submit"
                    >
                        <i class="fa-solid fa-check"></i>
                    </button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="src/javascript/script.js"></script>
</body>
</html>
