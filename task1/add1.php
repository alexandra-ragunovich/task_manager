<?php include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = htmlspecialchars(trim($_POST['exercise_type']));
    $duration = (int) $_POST['duration'];
    $notes = htmlspecialchars(trim($_POST['notes']));
    if ($type && $duration > 0) {
        $stmt = $pdo->prepare("INSERT INTO workout_log (exercise_type, duration, notes, status) VALUES (?, ?, ?, 'запланировано')");
        $stmt->execute([$type, $duration, $notes]);
        header("Location: index1.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Добавить тренировку</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-card {
            background: #fff;
            padding: 2rem;
            border-radius: 0.75rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="container py-5">
    <div class="form-card mx-auto" style="max-width: 600px;">
        <h2 class="mb-4">📝 Добавить тренировку</h2>
        <form method="POST">
            <div class="mb-3"><label class="form-label">Тип упражнения</label><input type="text" name="exercise_type"
                    class="form-control" required></div>
            <div class="mb-3"><label class="form-label">Длительность (мин)</label><input type="number" name="duration"
                    class="form-control" min="1" required></div>
            <div class="mb-3"><label class="form-label">Заметки</label><textarea name="notes" class="form-control"
                    rows="3"></textarea></div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">💾 Сохранить</button>
                <a href="index1.php" class="btn btn-outline-secondary">↩️ Назад</a>
            </div>
        </form>
    </div>
</body>

</html>