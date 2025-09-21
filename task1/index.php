<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Менеджер задач</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .status-badge {
            font-size: 0.9em;
            padding: 0.4em 0.6em;
            border-radius: 0.5rem;
        }

        .status-невыполнена {
            background-color: #ffc107;
            color: #212529;
        }

        .status-выполнена {
            background-color: #198754;
            color: #fff;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }
    </style>
</head>

<body class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">📋 Список задач</h1>
        <a href="add.php" class="btn btn-success">➕ Добавить задачу</a>
        <a href="index1.php" class="btn btn-outline-dark">🏋️ Журнал тренировок</a>
    </div>

    <table class="table table-hover table-bordered bg-white shadow-sm">
        <thead class="table-light">
            <tr>
                <th>Название</th>
                <th>Описание</th>
                <th>Статус</th>
                <th>Создана</th>
                <th class="text-center">Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $pdo->query("SELECT * FROM tasks ORDER BY created_at DESC");
            while ($row = $stmt->fetch()) {
                $statusClass = $row['status'] === 'выполнена' ? 'status-выполнена' : 'status-невыполнена';
                echo "<tr>
                    <td>" . htmlspecialchars($row['title']) . "</td>
                    <td>" . htmlspecialchars($row['description']) . "</td>
                    <td><span class='status-badge $statusClass'>" . htmlspecialchars($row['status']) . "</span></td>
                    <td>" . date('d.m.Y H:i', strtotime($row['created_at'])) . "</td>
                    <td class='text-center'>
                        <a href='edit.php?id={$row['id']}' class='btn btn-outline-primary btn-sm me-1'>✏️Редактировать</a>
                        <a href='delete.php?id={$row['id']}' class='btn btn-outline-danger btn-sm me-1';\">🗑️Удалить</a>
                        <a href='update_status.php?id={$row['id']}' class='btn btn-outline-success btn-sm'>✅Отметить выполненной</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>