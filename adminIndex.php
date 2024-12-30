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
                            <li class="nav-item"><a class="nav-link active" aria-current="page" href="課程管理.html">課程管理</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="會員管理.html">會員管理</a></li>
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
                        <!-- Side widget-->
    <div class="card mb-4">
        <div class="card-header">最新消息</div>
        <div class="card-body">
            <!-- 管理最新消息按鈕 -->
            <div class="text-end mt-3">
                <a href="管理最新消息.html" class="btn btn-primary btn-sm">管理最新消息</a>
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
    </body>
</html>