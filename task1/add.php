<?php include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars(trim($_POST['title']));
    $description = htmlspecialchars(trim($_POST['description']));

    if ($title) {
        $stmt = $pdo->prepare("INSERT INTO tasks (title, description, status) VALUES (?, ?, 'не выполнена')");
        $stmt->execute([$title, $description]);
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Добавить задачу</title>
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
        <h2 class="mb-4">📝 Добавить задачу</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Название</label>
                <input type="text" name="title" class="form-control" placeholder="Введите краткое название" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Описание</label>
                <textarea name="description" class="form-control" rows="4"
                    placeholder="Дополнительные детали (необязательно)"></textarea>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">💾 Сохранить</button>
                <a href="index.php" class="btn btn-outline-secondary">↩️ Назад</a>
            </div>
        </form>
    </div>
</body>

</html>