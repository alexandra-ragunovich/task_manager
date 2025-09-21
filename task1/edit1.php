<?php include 'config.php';

$id = $_GET['id'] ?? null;
if (!$id)
    die("ID не указан");

$stmt = $pdo->prepare("SELECT * FROM workout_log WHERE id = ?");
$stmt->execute([$id]);
$entry = $stmt->fetch();

if (!$entry)
    die("Запись не найдена");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = htmlspecialchars(trim($_POST['exercise_type']));
    $duration = (int) $_POST['duration'];
    $notes = htmlspecialchars(trim($_POST['notes']));
    $status = $_POST['status'] ?? 'запланировано';

    $stmt = $pdo->prepare("UPDATE workout_log SET exercise_type = ?, duration = ?, notes = ?, status = ? WHERE id = ?");
    $stmt->execute([$type, $duration, $notes, $status, $id]);
    header("Location: index1.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Редактировать тренировку</title>
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
        <h2 class="mb-4">✏️ Редактировать тренировку</h2>
        <form method="POST">
            <div class="mb-3"><label class="form-label">Тип упражнения</label><input type="text" name="exercise_type"
                    class="form-control" value="<?= htmlspecialchars($entry['exercise_type']) ?>" required></div>
            <div class="mb-3">
                <label class="form-label">Длительность (мин)</label>
                <input type="number" name="duration" class="form-control" min="1"
                    value="<?= htmlspecialchars($entry['duration']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Заметки</label>
                <textarea name="notes" class="form-control" rows="3"><?= htmlspecialchars($entry['notes']) ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Статус</label>
                <select name="status" class="form-select">
                    <option value="запланировано" <?= $entry['status'] === 'запланировано' ? 'selected' : '' ?>>
                        Запланировано</option>
                    <option value="выполнено" <?= $entry['status'] === 'выполнено' ? 'selected' : '' ?>>Выполнено</option>
                </select>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">💾 Обновить</button>
                <a href="index.php" class="btn btn-outline-secondary">↩️ Назад</a>
            </div>
        </form>
    </div>
</body>

</html>