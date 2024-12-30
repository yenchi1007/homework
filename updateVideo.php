<!-- 管理員的更新 -->
<?php 
    try{
        require_once("db.php");
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"];
            $videoTitle = $_POST["videoTitle"];
            $videoDescription = $_POST["videoDescription"];
            $videoURL = $_POST["videoURL"];
            // 更新資料
            $stmt = $conn->prepare("UPDATE videos SET title = ?, description = ?, youtube_id = ? WHERE id = ?");
            $stmt->bind_param("sssi", $videoTitle, $videoDescription, $videoURL, $id);
            if ($stmt->execute()) {
                header("Location: video.php");
                exit();
            } else {
                echo "資料更新失敗: " . $stmt->error . "<br><a href='video.php'>返回</a>";
            }
            $stmt->close();
            
        }
    } catch (Exception $e) {
        // 捕捉例外並顯示錯誤訊息
        echo "錯誤: " . $e->getMessage();
    } finally {
        // 關閉資料庫連線
        $conn->close();
    }
?>