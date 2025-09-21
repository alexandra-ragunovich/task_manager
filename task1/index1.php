<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Журнал тренировок</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .status-выполнено {
            background-color: #198754;
            color: #fff;
        }

        .status-запланировано {
            background-color: #ffc107;
            color: #212529;
        }

        .status-badge {
            padding: 0.4em 0.6em;
            border-radius: 0.5rem;
            font-size: 0.9em;
        }
    </style>
</head>

<body class="container py-5">
    <div class="d-flex justify-content-between mb-4">
        <h1 class="h3">🏋️ Журнал тренировок</h1>
        <a href="add1.php" class="btn btn-success">➕ Добавить</a>
        <a href="index.php" class="btn btn-outline-dark">📋 Список задач</a>
    </div>
    <table class="table table-hover table-bordered bg-white shadow-sm">
        <thead class="table-light">
            <tr>
                <th>Тип</th>
                <th>Длительность</th>
                <th>Заметки</th>
                <th>Статус</th>
                <th>Дата</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $pdo->query("SELECT * FROM workout_log ORDER BY created_at DESC");
            while ($row = $stmt->fetch()) {
                $statusClass = 'status-' . $row['status'];
                echo "<tr>
                    <td>" . htmlspecialchars($row['exercise_type']) . "</td>
                    <td>" . htmlspecialchars($row['duration']) . " мин</td>
                    <td>" . htmlspecialchars($row['notes']) . "</td>
                    <td><span class='status-badge $statusClass'>" . htmlspecialchars($row['status']) . "</span></td>
                    <td>" . date('d.m.Y H:i', strtotime($row['created_at'])) . "</td>
                    <td>
                        <a href='edit1.php?id={$row['id']}' class='btn btn-outline-primary btn-sm'>✏️Редактирова</a>
                        <a href='delete1.php?id={$row['id']}' class='btn btn-outline-danger btn-sm' ;\">🗑️Удалить</a>
                        <a href='update_status1.php?id={$row['id']}' class='btn btn-outline-success btn-sm'>✅Отметить выполненной</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>