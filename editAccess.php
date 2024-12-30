<?php
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['id'], $_POST['username'], $_POST['role'])) {
        echo json_encode(['success' => false, 'message' => '缺少必要的參數']);
        exit;
    }

    $id = intval($_POST['id']);
    $username = trim($_POST['username']);
    $role = trim($_POST['role']);

    try {
        $stmt = $conn->prepare("UPDATE users SET username = ?, role = ? WHERE id = ?");
        $stmt->bind_param("ssi", $username, $role, $id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => '更新成功']);
        } else {
            echo json_encode(['success' => false, 'message' => '更新失敗']);
        }

        $stmt->close();
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    } finally {
        $conn->close();
    }
} else {
    echo json_encode(['success' => false, 'message' => '無效的請求']);
}
?>

