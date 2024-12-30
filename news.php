<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>管理最新消息 - 遠距教學影片管理系統</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#!">輔仁大學</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="loginIndex.php">首頁</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="courseM.php">課程管理</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="access.php">會員管理</a></li>
                    <li class="nav-item user-profile" id="userProfile">
                            <div class="user-icon">👤</div>
                            <div><?php echo $_SESSION['username'].'&nbsp;&nbsp;'.$_SESSION['userrole']; ?></div>
                            &nbsp;&nbsp;
                            <a class="user-name" href='logout.php'>登出</a>
                </ul>
                </ul>
            </div>
        </div>
    </nav>
    <style>
        /* 用戶欄的樣式 */
        .user-profile {
            display: flex;
            align-items: center;
            color: white;
            cursor: pointer;
            margin-left: 15px;
        }
        .user-icon {
            background-color: #00c1de;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2em;
            margin-right: 8px;
        }
        .user-name {
            font-size: 1em;
            margin-right: 4px;
        }
    </style>

    <!-- Page header -->
    <header class="py-2 bg-light border-bottom mb-2">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">最新消息</h1>
                <p class="lead mb-0">管理及編輯最新消息</p>
            </div>
        </div>
    </header>
    <?php
require_once 'db.php';



// 如果是 admin，處理公告更新
if ($_SESSION['userrole'] === 'admin' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    try {
        $stmt = $conn->prepare("INSERT INTO news (title, content) VALUES (?, ?) ON DUPLICATE KEY UPDATE title = VALUES(title), content = VALUES(content)");
        $stmt->bind_param("ss", $title, $content);
        if ($stmt->execute()) {
            $successMessage = "公告已成功更新！";
        } else {
            $errorMessage = "更新失敗，請稍後再試！";
        }
    } catch (Exception $e) {
        $errorMessage = "發生錯誤：" . $e->getMessage();
    }
}

// 獲取最新公告
$news = null;
try {
    $result = $conn->query("SELECT * FROM news ORDER BY Date DESC LIMIT 1");
    if ($result && $result->num_rows > 0) {
        $news = $result->fetch_assoc();
    }
} catch (Exception $e) {
    $errorMessage = "無法加載公告：" . $e->getMessage();
}
?>
        <!-- Page content -->
            <div class="container ">
            <div class="row">
                <form class="upload-form" action="uploadNews.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="newsTitle" class="form-label">最新消息標題</label>
                        <input type="text" class="form-control" id="newsTitle" name="newsTitle" placeholder="請輸入標題" required>
                    </div>
                    <div class="mb-3">
                        <label for="newsContent" class="form-label">最新消息內容</label>
                        <textarea class="form-control" id="newsContent" name="newsContent" rows="8" placeholder="請輸入最新消息內容" required></textarea>
                    </div>
                    <div>
                        <label for="date">公告日期</label>
                        <input type="date" id="date" name="date" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">儲存變更</button>
                </form>   
    <script>
    document.getElementById('upload-form').addEventListener('submit', function (event) {
        event.preventDefault(); // 防止表單的預設提交行為

        const title = document.getElementById('newsTitle').value;
        const content = document.getElementById('newsContent').value;

        // 檢查表單欄位是否填寫完整
        if (!title || !content) {
            alert('請填寫完整的公告資訊！');
            return;
        }

        // 發送新增會員請求
        fetch('addnews.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `title=${encodeURIComponent(title)}&content=${content}}`
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('新增成功！');
                    location.reload(); // 新增成功後重新加載頁面
                } else {
                    alert('新增失敗：' + data.message);
                }
            })
            .catch(error => {
                console.error('發生錯誤:', error);
                alert('發生錯誤，請稍後再試！');
            });
    });
</script>
    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container"><p class="m-0 text-center text-white">Copyright &copy; 遠距教學影片管理系統 2024</p></div>
    </footer>

    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Function to save and display the latest news
        function saveNews() {
            const newsTitle = document.getElementById("newsTitle").value;
            const newsContent = document.getElementById("newsContent").value;
            document.getElementById("displayNewsTitle").textContent = newsTitle;
            document.getElementById("displayNewsContent").textContent = newsContent;
            alert("最新消息已更新！");
            // 在這裡加入儲存到資料庫的程式碼
        }
    </script>
    

</body>
</html>

