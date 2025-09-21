<?php include 'config.php';

$id = $_GET['id'] ?? null;
if (!$id)
    die("ID не указан");

$stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ?");
$stmt->execute([$id]);
$task = $stmt->fetch();

if (!$task)
    die("Задача не найдена");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars(trim($_POST['title']));
    $description = htmlspecialchars(trim($_POST['description']));
    $status = isset($_POST['status']) ? 'выполнена' : 'не выполнена';

    $stmt = $pdo->prepare("UPDATE tasks SET title = ?, description = ?, status = ? WHERE id = ?");
    $stmt->execute([$title, $description, $status, $id]);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Редактировать задачу</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-card {
            background-color: #fff;
            border-radius: 0.75rem;
            padding: 2rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: 500;
        }
    </style>
</head>

<body class="container py-5">
    <div class="form-card mx-auto" style="max-width: 600px;">
        <h2 class="mb-4">✏️ Редактировать задачу</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Название</label>
                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($task['title']) ?>"
                    required>
            </div>
            <div class="mb-3">
                <label class="form-label">Описание</label>
                <textarea name="description" class="form-control"
                    rows="4"><?= htmlspecialchars($task['description']) ?></textarea>
            </div>
            <div class="form-check mb-4">
                <input type="checkbox" name="status" class="form-check-input" id="statusCheck"
                    <?= $task['status'] === 'выполнена' ? 'checked' : '' ?>>
                <label class="form-check-label" for="statusCheck">Выполнена</label>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">💾 Обновить</button>
                <a href="index.php" class="btn btn-outline-secondary">↩️ Назад</a>
            </div>
        </form>
    </div>
</body>

</html>