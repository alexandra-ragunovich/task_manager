<?php include 'config.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM workout_log WHERE id = ?");
    $stmt->execute([$id]);
}
header("Location: index1.php");
exit;
?>