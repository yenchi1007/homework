 <?php

// 引入資料庫連線
require_once 'db.php';

// 檢查是否已登入
if (!isset($_SESSION['userrole'])) {
    echo "<script>alert('未登入或權限不足');</script>";
    echo "<meta http-equiv='refresh' content='0;url=login.php'>";
    exit;
}

// 獲取最新公告
$news = null;
try {
    // 確保 $conn 已正確初始化
    if ($conn) {
        $result = $conn->query("SELECT * FROM news ORDER BY Date DESC LIMIT 1");
        if ($result && $result->num_rows > 0) {
            $news = $result->fetch_assoc();
        }
    } else {
        throw new Exception("資料庫連線失敗");
    }
} catch (Exception $e) {
    $errorMessage = "無法加載公告：" . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>首頁 - 遠距教學影片管理系統</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
    <?php if ($_SESSION['userrole'] === 'student' || $_SESSION['userrole'] === 'teacher'): ?>
            <!-- Responsive navbar-->
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
                            </li>
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
            <!-- Page header with logo and tagline-->
            <header class="py-2 bg-light border-bottom mb-2">
                <div class="container">
                    <div class="text-center my-5">
                        <h1 class="fw-bolder">歡迎來到遠距教學影片管理系統！</h1>
                    </div>
                </div>
            </header>
            <!-- Page content-->
            <div class="container">
                <div class="row">
                    <!-- Blog entries-->
                    <div class="col-lg-8">
                        <!-- Featured blog post-->
                        <div class="card mb-4">
                            <a href="#!"><img class="card-img-top" src="fju.jpg" alt="..." /></a>
                            <div class="card-body">
                                <div class="small text-muted">January 1, 2023</div>
                                <h2 class="card-title">影片標題</h2>
                                <p class="card-text">影片內容文字描述</p>
                                <a class="btn btn-primary" href="#!">查看影片</a>
                            </div>
                        </div>
                        <!-- Nested row for non-featured blog posts-->
                        <div class="row">
                            <div class="col-lg-6">
                                <!-- Blog post-->
                                <div class="card mb-4">
                                    <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a>
                                    <div class="card-body">
                                        <div class="small text-muted">January 1, 2023</div>
                                        <h2 class="card-title h4">影片標題</h2>
                                        <p class="card-text">影片內容文字描述</p>
                                        <a class="btn btn-primary" href="#!">查看影片</a>
                                    </div>
                                </div>
                                <!-- Blog post-->
                                <div class="card mb-4">
                                    <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a>
                                    <div class="card-body">
                                        <div class="small text-muted">January 1, 2023</div>
                                        <h2 class="card-title h4">影片標題</h2>
                                        <p class="card-text">影片內容文字描述</p>
                                        <a class="btn btn-primary" href="#!">查看影片</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!-- Blog post-->
                                <div class="card mb-4">
                                    <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a>
                                    <div class="card-body">
                                        <div class="small text-muted">January 1, 2023</div>
                                        <h2 class="card-title h4">影片標題</h2>
                                        <p class="card-text">影片內容文字描述</p>
                                        <a class="btn btn-primary" href="#!">查看影片</a>
                                    </div>
                                </div>
                                <!-- Blog post-->
                                <div class="card mb-4">
                                    <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a>
                                    <div class="card-body">
                                        <div class="small text-muted">January 1, 2023</div>
                                        <h2 class="card-title h4">影片標題</h2>
                                        <p class="card-text">影片內容文字描述</p>
                                        <a class="btn btn-primary" href="#!">查看影片</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Pagination-->
                        <nav aria-label="Pagination">
                            <hr class="my-0" />
                            <ul class="pagination justify-content-center my-4">
                                <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Newer</a></li>
                                <li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>
                                <li class="page-item"><a class="page-link" href="#!">2</a></li>
                                <li class="page-item"><a class="page-link" href="#!">3</a></li>
                                <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
                                <li class="page-item"><a class="page-link" href="#!">15</a></li>
                                <li class="page-item"><a class="page-link" href="#!">Older</a></li>
                            </ul>
                        </nav>
                    </div>
                    <!-- Side widgets-->
             
            <div class="col-lg-4">
            <!-- Side widgets -->
            <div class="col-lg-10">
                <!-- 最新消息 -->
                <div class="card mb-4">
                    <div class="card-header">最新消息</div>
                    <div class="card-body">
                        <?php if ($news): ?>
                            <h5><?php echo htmlspecialchars($news['title']); ?></h5>
                            <p><?php echo nl2br(htmlspecialchars($news['content'])); ?></p>
                        <?php else: ?>
                            <p>目前沒有最新消息。</p>
                        <?php endif; ?>
                    </div>
                </div>
                </div>
            </div>
            <!-- Footer-->
            <footer class="py-5 bg-dark">
                <div class="container"><p class="m-0 text-center text-white">Copyright &copy; 遠距教學影片管理系統 2024</p></div>
            </footer>
            <!-- Bootstrap core JS-->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
            <!-- Core theme JS-->
            <script src="js/scripts.js"></script>
            <?php elseif ($_SESSION['userrole'] === 'admin'): ?>
    <!-- 顯示管理員的內容 -->
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                    <a class="navbar-brand" href="#!">輔仁大學</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item"><a class="nav-link" href="loginIndex.php">首頁</a></li>
                            <<li class="nav-item"><a class="nav-link active" aria-current="page" href="courseM.php">課程管理</a></li>
                            <li class="nav-item"><a class="nav-link active" aria-current="page" href="access.php">會員管理</a></li>
                            <!-- 新增會員欄 -->
                            <li class="nav-item user-profile" id="userProfile">
                                <div class="user-icon">👤</div>
                                <div><?php echo $_SESSION['username'].'&nbsp;&nbsp;'.$_SESSION['userrole']; ?></div>
                                &nbsp;&nbsp;
                                <a class="user-name" href='logout.php'>登出</a>
                            </li>
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
            <!-- Page header with logo and tagline-->
            <header class="py-2 bg-light border-bottom mb-2">
                <div class="container">
                    <div class="text-center my-5">
                        <h1 class="fw-bolder">歡迎來到遠距教學影片管理系統！</h1>
                    </div>
                </div>
            </header>
            <!-- Page content-->
            <div class="container">
                <div class="row">
                    <!-- Blog entries-->
                    <div class="col-lg-8">
                        <!-- Featured blog post-->
                        <div class="card mb-4">
                            <a href="#!"><img class="card-img-top" src="fju.jpg" alt="..." /></a>
                            <div class="card-body">
                                <div class="small text-muted">January 1, 2023</div>
                                <h2 class="card-title">影片標題</h2>
                                <p class="card-text">影片內容文字描述</p>
                                <a class="btn btn-primary" href="#!">查看影片</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                                <!-- Blog post-->
                                <div class="card mb-4">
                                    <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a>
                                    <div class="card-body">
                                        <div class="small text-muted">January 1, 2023</div>
                                        <h2 class="card-title h4">影片標題</h2>
                                        <p class="card-text">影片內容文字描述</p>
                                        <a class="btn btn-primary" href="#!">查看影片</a>
                                    </div>
                                </div>
                                <!-- Blog post-->
                                <div class="card mb-4">
                                    <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a>
                                    <div class="card-body">
                                        <div class="small text-muted">January 1, 2023</div>
                                        <h2 class="card-title h4">影片標題</h2>
                                        <p class="card-text">影片內容文字描述</p>
                                        <a class="btn btn-primary" href="#!">查看影片</a>
                                    </div>
                                </div>
                            </div>
                        </div>
            <!-- Side widgets-->
             
            <div class="col-lg-4">
            <!-- Side widgets -->
            <div class="col-lg-10">
                <!-- 最新消息 -->
                <div class="card mb-4">
                    <div class="card-header">最新消息</div>
                    <div class="card-body">
                        <?php if ($news): ?>
                            <h5><?php echo htmlspecialchars($news['title']); ?></h5>
                            <p><?php echo nl2br(htmlspecialchars($news['content'])); ?></p>
                        <?php else: ?>
                            <p>目前沒有最新消息。</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- 管理按鈕 (僅 admin 可見) -->
                <?php if ($_SESSION['userrole'] === 'admin'): ?>
                    <div class="card mb-4">
                            <a href="news.php" class="btn btn-primary btn-sm">管理最新消息</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php else: ?>
    <!-- 未登入處理 -->
    <script>alert('未登入');</script>
    <meta http-equiv="refresh" content="0;url=login.php">
<?php endif; ?>
    </body>
</html>