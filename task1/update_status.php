<?php include 'config.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("UPDATE tasks SET status = 'выполнена' WHERE id = ?");
    $stmt->execute([$id]);

}
header("Location: index.php");
exit;
?>