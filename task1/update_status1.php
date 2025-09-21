<?php include 'config.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("UPDATE workout_log SET status = 'выполнено' WHERE id = ?");
    $stmt->execute([$id]);

}
header("Location: index1.php");
exit;
?>