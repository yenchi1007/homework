<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>影片專區 - 遠距教學影片管理系統</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
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
    <?php if(isset($_SESSION['username'])):?>
        <?php if($_SESSION['userrole'] === 'student'): ?>
            <!-- Page header with search bar -->
            <header class="py-2 bg-light border-bottom mb-3">
                <div class="container">
                    <div class="text-center my-3">
                        <h1 class="fw-bolder">微積分</h1>
                        <p class="lead mb-0">金企一甲 113-1學期</p>
                    </div>
                    <!-- Search bar -->
                    <div class="row justify-content-center mt-3">
                        <div class="col-md-6">
                            <form class="d-flex" role="search">
                                <input class="form-control me-2" type="search" placeholder="搜尋影片名稱或關鍵字" aria-label="Search">
                                <button class="btn btn-primary" type="submit">搜尋</button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Page content -->
            <div class="container">
                <div class="row">
                    <!-- Video entries -->
                    <div class="col-lg-12">
                        <div class="row">
                        <?php 
                            try {
                                require_once('db.php'); // 加上分號
                                $stmt = $conn->prepare("SELECT * FROM videos");
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while ($row = $result->fetch_array()) {
                                    // 解析 YouTube 影片網址，提取 YouTube ID
                                    $youtube_url = $row["youtube_id"];
                                    parse_str(parse_url($youtube_url, PHP_URL_QUERY), $query_params);
                                    $youtube_id = $query_params['v'] ?? ''; // 提取 'v' 參數的值

                                    if (!empty($youtube_id)) {
                                        echo '<div class="col-lg-6 mb-4">';
                                        echo '<div class="card">';
                                        echo '<img class="card-img-top" src="https://img.youtube.com/vi/' . $youtube_id . '/hqdefault.jpg" alt="影片縮圖" />';
                                        echo '<div class="card-body">';
                                        echo '<h5 class="card-title">' . htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8') . '</h5>';
                                        echo '<p class="card-text">' . htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8') . '</p>';
                                        echo '<a href='.$row["youtube_id"].' class="btn btn-primary">查看影片</a>&nbsp';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                    } else {
                                        echo '<p>無法解析 YouTube 縮圖</p>';
                                    }
                                }
                            } catch (Exception $e) {
                                echo 'message: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
                            } finally {
                                if (isset($conn) && $conn->ping()) {
                                    $conn->close();
                                }
                            }
                        ?> 
                        </div>
                    </div>
                </div>
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
        <?php elseif($_SESSION['userrole'] === 'teacher'): ?>
            <!-- Page header -->
            <header class="py-2 bg-light border-bottom mb-3">
                <div class="container">
                    <div class="text-center my-5">
                        <h1 class="fw-bolder">微積分</h1>
                        <p class="lead mb-2">金企一甲113-1學期</p>
                        <a href="addVideo.php?id='.$row['id'] .'" class="btn btn-primary">新增影片</a>
                    </div>
                </div>
            </header>
            <!-- Page content -->
            <div class="container">
                <div class="row">
                    <!-- Video entries -->
                    <div class="col-lg-12">
                        <div class="row">
                        <?php 
                            try {
                                require_once('db.php'); // 加上分號
                                $stmt = $conn->prepare("SELECT * FROM videos");
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while ($row = $result->fetch_array()) {
                                    // 解析 YouTube 影片網址，提取 YouTube ID
                                    $youtube_url = $row["youtube_id"];
                                    parse_str(parse_url($youtube_url, PHP_URL_QUERY), $query_params);
                                    $youtube_id = $query_params['v'] ?? ''; // 提取 'v' 參數的值

                                    if (!empty($youtube_id)) {
                                        echo '<div class="col-lg-6 mb-4">';
                                        echo '<div class="card">';
                                        echo '<img class="card-img-top" src="https://img.youtube.com/vi/' . $youtube_id . '/hqdefault.jpg" alt="影片縮圖" />';
                                        echo '<div class="card-body">';
                                        echo '<h5 class="card-title">' . htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8') . '</h5>';
                                        echo '<p class="card-text">' . htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8') . '</p>';
                                        echo '<a href='.$row["youtube_id"].' class="btn btn-primary">查看影片</a>&nbsp';
                                        echo '<a href="editVideo.php?id='.$row['id'] .'" class="btn btn-primary">編輯影片</a>&nbsp';
                                        echo '<a href="deleteVideo.php?id='.$row['id'].'" class="btn btn-primary">刪除影片</a>&nbsp';
                                        echo '<a href="data.php?id='.$row['id'] .'" class="btn btn-primary">觀看數據分析</a>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                    } else {
                                        echo '<p>無法解析 YouTube 縮圖</p>';
                                    }
                                }
                            } catch (Exception $e) {
                                echo 'message: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
                            } finally {
                                if (isset($conn) && $conn->ping()) {
                                    $conn->close();
                                }
                            }
                        ?>           
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <footer class="py-5 bg-dark"> <!-- 保持全寬背景 -->
                <div class="container"> <!-- 讓內容居中 -->
                    <p class="m-0 text-center text-white">Copyright &copy; 遠距教學影片管理系統 2024</p>
                </div>
            </footer>
            <!-- Bootstrap core JS -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
            <!-- Core theme JS -->
            <script src="js/scripts.js"></script>
        <?php elseif($_SESSION['userrole'] === 'admin'): ?>
            <h1>admin</h1>
        <?php endif; ?>
    <?php else: ?>
        <?php echo "<script>alert('未登入');</script>"; ?>
    <?php endif; ?>
</body>
</html>
