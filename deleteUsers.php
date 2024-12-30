<?php
require_once('db.php'); // 包含資料庫連線檔案

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']); // 獲取要刪除的用戶 ID

    try {
        // 使用預處理語句刪除資料
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id); // 綁定參數 (ID)

        if ($stmt->execute()) {
            // 刪除成功
            echo json_encode(['success' => true, 'message' => '用戶已成功刪除']);
        } else {
            // 刪除失敗
            echo json_encode(['success' => false, 'message' => '刪除失敗']);
        }

        $stmt->close();
    } catch (Exception $e) {
        // 捕獲異常並返回錯誤訊息
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    } finally {
        // 關閉資料庫連線
        $conn->close();
    }
} else {
    // 無效的請求
    echo json_encode(['success' => false, 'message' => '無效的請求']);
}
?>
