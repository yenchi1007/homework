<?php
    try {
        require_once('db.php');
        $id = $_GET['id'];
        if ($id) {
            $stmt = $conn->prepare("DELETE FROM videos WHERE id = ?");
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                $stmt->close();
                header("Location: video.php");
                exit();
            } else {
                echo "資料刪除失敗: " . $stmt->error . "<br><a href='video.php'>返回</a>";
                $stmt->close();
                exit();
            } 
        } else {
            echo "<h1 class='title'>未提供有效的 ID！</h1>";
            exit();
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        header("Location: video.php");
        exit();
    } finally {
        if (isset($conn) && $conn->ping()) {
            $conn->close();
        }
    }       
?>