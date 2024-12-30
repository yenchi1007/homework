<?php
require_once('db.php'); // 包含資料庫連線檔案

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $role = $_POST['role'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($name) || empty($role) || empty($password)) {
        echo json_encode(['success' => false, 'message' => '名稱、身分和密碼為必填項目！']);
        exit;
    }

    try {
        // 使用預處理語句插入新會員資料
        $stmt = $conn->prepare("INSERT INTO users (username, role, password, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("sss", $name, $role, $password);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => '會員新增成功']);
        } else {
            echo json_encode(['success' => false, 'message' => '會員新增失敗']);
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

