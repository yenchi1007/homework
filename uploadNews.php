<?php
        try {
            require_once("db.php");
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $newsTitle=$_POST['newsTitle'];
                $newsContent=$_POST['newsContent'];
                // 將數據插入到資料庫中
                $stmt = $conn->prepare("INSERT INTO news (title, content) VALUES (?,?)");
                $stmt->bind_param("ss", $newsTitle, $newsContent);
                if ($stmt->execute()) {
                    echo "<script>alert('新增成功'); window.location.href='loginIndex.php';</script>";
                    exit();
                }
                else {
                    echo "<script>alert('新增失敗'); window.location.href='loginIndex.php';</script>";
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