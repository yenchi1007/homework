<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>我的課程 - 遠距教學影片管理系統</title>
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
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="myclass.html">我的課程</a></li>
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
    <header class="py-1 bg-light border-bottom mb-2">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">我的課程</h1>
            </div>
        </div>
    </header>
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
     <!-- Side widgets -->
     <div class="container content-wrapper">
        <div class="row">
            <div class="col-lg-8">
                <!-- Left content area -->
                <div class="container mt-4">
                    <!-- Filter options -->
                    <div class="row mb-4">
                        <div class="col-md-2">
                            <select class="form-select">
                                <option>學年</option>
                                <option>全部</option>
                                <option>2024</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select">
                                <option>學期</option>
                                <option>全部</option>
                                <option>第一學期</option>
                                <option>第二學期</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select">
                                <option>年級</option>
                                <option>全部</option>
                                <option>二年級</option>
                                <option>三年級</option>
                            </select>
                        </div>
                    </div>
                    <!-- Video entries -->
                    <div class="col-lg-12 mb-4">
                        <div class="card">
                            <img class="card-img-top" src="myclass.png" alt="課程縮圖">
                            <div class="card-body">
                                <h5 class="card-title">微積分</h5>
                                <a href="video.php" class="btn btn-primary">查看課程</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-4">
                        <div class="card">
                            <img class="card-img-top" src="myclass.png" alt="課程縮圖">
                            <div class="card-body">
                                <h5 class="card-title">課程名稱</h5>
                                <p class="card-text">課程資訊</p>
                                <a href="#" class="btn btn-primary">查看課程</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
    
    
                    <!-- Additional video entries can be added similarly -->
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
</body>
</html>
