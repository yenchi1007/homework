<?php
        try {
            require_once("db.php");
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $uploader_id=$_SESSION['userid'];
                $videoTitle=$_POST['videoTitle'];
                $videoDescription=$_POST['videoDescription'];
                $videoURL=$_POST['videoURL'];
                // 將數據插入到資料庫中
                $stmt = $conn->prepare("INSERT INTO videos (title, description, youtube_id, uploader_id) VALUES (?,?,?,?)");
                $stmt->bind_param("sssi", $videoTitle, $videoDescription, $videoURL, $uploader_id);
                if ($stmt->execute()) {
                    echo "<script>alert('上傳成功'); window.location.href='video.php';</script>";
                    exit();
                }
                else {
                    echo "<script>alert('上傳失敗'); window.location.href='addvideo.php';</script>";
                }
                // 關閉語句
                $stmt->close();
            }
        }
        catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
        finally {
            // 確保連接在最後關閉
            if (isset($conn) && $conn->ping()) {
                $conn->close();
            }
        }
?>