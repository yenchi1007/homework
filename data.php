<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>影片數據分析 - 遠距教學影片管理系統</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="css/styles.css" rel="stylesheet" />
    <style>
        .data-container {
            max-width: 800px;
            margin: 0 auto;
        }
        .video-info {
            text-align: center;
            margin-bottom: 20px;
        }
        .video-preview {
            width: 100%;
            max-width: 600px;
            margin: 0 auto 20px auto;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
        }
        .video-preview img {
            width: 100%;
            height: auto;
            display: block;
        }
        .table-container {
            margin-top: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#!">輔仁大學</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="index.html">首頁</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="我的課程.html">我的課程</a></li>
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

    <!-- Page header -->
    <header class="py-2 bg-light border-bottom mb-3">
        <div class="container">
            <div class="text-center my-3">
                <h1 class="fw-bolder">影片數據分析</h1>
                <p class="lead mb-0">檢視影片的觀看數據</p>
            </div>
        </div>
    </header>

    <!-- Page content -->
    <div class="container data-container">
        <!-- Video Preview -->
        <div class="video-preview">
            <img src="fju.jpg" alt="影片預覽圖">
        </div>

        <!-- Video Information -->
        <div class="video-info">
            <h2>影片標題</h2>
        </div>

        <!-- Section 1: 觀看人數 -->
        <div class="table-container">
            <h3 class="text-center">影片觀看人數</h3>
            <table>
                <thead>
                    <tr>
                        <th>總觀看人數</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>35</td> <!-- 可替換成實際觀看人數 -->
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Section 2: 每位學生觀看時數 -->
        <div class="table-container">
            <h3 class="text-center">每位學生的觀看時數</h3>
            <table>
                <thead>
                    <tr>
                        <th>學生</th>
                        <th>觀看時數</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>學生 A</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>學生 B</td>
                        <td>4</td>
                    </tr>
                    <tr>
                        <td>學生 C</td>
                        <td>3</td>
                    </tr>
                    <!-- 可添加更多學生的觀看數據 -->
                </tbody>
            </table>
        </div>
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
</body>
</html>
