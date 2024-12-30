
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>新增影片 - 遠距教學影片管理系統</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <style>
        .video-upload-container {
            max-width: 800px;
            margin: 5 auto;
        }
        .video-preview {
            width: 100%;
            height: auto;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #888;
            font-size: 1.5em;
        }
        .upload-form input, .upload-form textarea {
            margin-bottom: 1rem;
        }
    
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
</head>
<body>
    <?php if(isset($_SESSION['username'])):?>
        <?php if($_SESSION['userrole'] === 'teacher'):  ?>
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                    <a class="navbar-brand" href="#!">輔仁大學</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item"><a class="nav-link" href="index.html">首頁</a></li>
                            <li class="nav-item"><a class="nav-link active" aria-current="page" href="myclass.php">我的課程</a></li>
                            <!-- 新增會員欄 -->
                            <li class="nav-item user-profile" id="userProfile">
                            <div class="user-icon">👤</div>
                            <div><?php echo $_SESSION['username'].'&nbsp;&nbsp;'.$_SESSION['userrole']; ?></div>
                            &nbsp;&nbsp;
                            <a class="user-name" href='logout.php'>登出</a>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Page header -->
            <header class="py-2 bg-light border-bottom mb-3">
                <div class="container">
                    <div class="text-center my-3">
                        <h1 class="fw-bolder">編輯影片</h1>
                        <p class="lead mb-0">編輯並管理您的教學影片</p>
                    </div>
                </div>
            </header>
            <!-- Page content -->
            <div class="container video-upload-container">
                <!-- Video Preview -->
                <?php
                require_once('db.php');
                if(isset($_GET["id"])){
                    $id = $_GET["id"];
                    $stmt = $conn->prepare("SELECT * FROM videos WHERE id = ?");
                    $stmt->bind_param("i",$id);
                    $stmt->execute();
                    $result=$stmt->get_result();
                    if($row = $result->fetch_assoc()){
                        $videoTitle=$row["title"];
                        $videoDescription=$row["description"];
                        $videoURL=$row["youtube_id"];
                    }
                    $stmt->close();

                }
                $conn->close();
                ?>
                <form class="upload-form" action="updateVideo.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                    <div class="mb-3">
                        <label for="videoTitle" class="form-label">修改的影片標題</label>
                        <input type="text" class="form-control" id="videoTitle" name="videoTitle" placeholder="請輸入影片標題" value="<?php echo $videoTitle; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="videoDescription" class="form-label">修改的影片文字說明</label>
                        <textarea class="form-control" id="videoDescription" name="videoDescription" rows="8" placeholder="請輸入影片描述" value="<?php echo $videoDescription; ?>" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="videoURL" class="form-label">修改的youtube網址</label>
                        <input type="text" class="form-control" id="videoURL" name="videoURL" placeholder="影片youtube網址" value="<?php echo $videoURL; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">提交</button>
                </form>   
            </div>
            <div class="container video-upload-container mb-5">
                <!-- Video Preview and Upload Form here -->
            </div>
            <!-- Footer -->
            <footer class="py-5 bg-dark">
                <div class="container">
                    <p class="m-0 text-center text-white">Copyright &copy; 遠距教學影片管理系統 2024</p>
                </div>
            </footer>
            <!-- Bootstrap core JS -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
            <!-- Core theme JS -->
            <script src="js/scripts.js"></script>
        <?php else: ?>
            <?php echo "<script>alert('沒有權限');</script>"; ?>
        <?php endif; ?>    
    <?php else: ?>
        <?php echo "<script>alert('未登入');</script>"; ?>
    <?php endif; ?>
</body>
</html>
