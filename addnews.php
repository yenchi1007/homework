<?php
require_once('db.php'); // 包含資料庫連線檔案

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $Date = $_POST['Date'] ?? '';

    if (empty($title) || empty($content)|| empty($Date)) {
        echo json_encode(['success' => false, 'message' => '請輸入公告內容']);
        exit;
    }

    try {
        // 使用預處理語句插入新會員資料
        $stmt = $conn->prepare("INSERT INTO news (title, content, Date) VALUES (?, ?, NOW())");
        $stmt->bind_param("sss", $title, $content, $Date );

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => '公告新增成功']);
        } else {
            echo json_encode(['success' => false, 'message' => '公告新增失敗']);
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
