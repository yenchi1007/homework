<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>登入 - 遠距教學影片管理系統</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <?php
        try{
            require_once('db.php');
            if($_SERVER['REQUEST_METHOD'] === "POST"){
                $username=$_POST['username'];
                $userpassword=$_POST['password'];
                $stmt=$conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
                if (!$stmt) {
                    throw new Exception("Failed to prepare statement: " . $conn->error);
                }
                $stmt->bind_param('ss',$username,$userpassword);
                if (!$stmt->execute()) {
                    throw new Exception("Query execution failed: " . $stmt->error);
                }
                $result = $stmt->get_result();
                
                if($result->num_rows > 0){
                    $user = $result-> fetch_array();
                    $_SESSION['userid']=$user['id'];
                    $_SESSION['username']=$user['username'];
                    $_SESSION['userrole']=$user['role'];
                    header("Location: loginIndex.php");
                    exit();
                }
                else{
                    echo "<script>alert('用戶不存在');</script>";
                    exit();
                }
                $stmt->close();
                $conn->close();
            }

        }
        catch(Exception $e){
            echo 'message:'.$e->getMessage();
        }
    ?>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#!">輔仁大學</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="index.php">首頁</a></li>
                    </ul>
                </div>
            </div>
        </nav>
         <!-- Page header with logo and tagline-->
         <header class="py-5 bg-light border-bottom mb-0">
            <div class="container">
                <div class="text-center my-0">
                    <h1 class="fw-bolder">歡迎來到遠距教學影片管理系統!</h1>
                    <!-- <p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p> -->
                </div>
            </div>
        </header>
        <body>

                 </div>
             </div>
         </nav>
     </body>
        <!DOCTYPE html>
        <html lang="zh-TW">
        <head>
            <meta charset="utf-5" />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
            <meta name="description" content="登入頁面" />
            <meta name="author" content="" />
            <title>登入 - 遠距教學影片管理系統</title>
            <!-- Favicon-->
            <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
            <!-- Core theme CSS (includes Bootstrap)-->
            <link href="css/styles.css" rel="stylesheet" />
            <style>
                .login-container {
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 60vh; /* 減少高度 */
                padding-top: 20px; /* 增加上下留白 */
                padding-bottom: 20px;
                }
                .login-card {
                    max-width: 500px;
                    padding: 40px;
                    border: 1px solid #ddd;
                    border-radius: 20px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                    margin-right: 80px;
                }
                .form-control {
                    margin-bottom: 1rem;
                }
                .login-button {
                    width: 100%;
                    padding: 10px;
                    font-size: 1.1em;
                }
                .login-image {
                    max-width: 400px;
                }
                .enlarged-image {
                    width: 150%; /* 設定為容器的 100% 寬度 */
                    max-width: 800px; /* 設定圖片的最大寬度 */
                    height: auto; /* 保持圖片的長寬比例 */
                }
            </style>
        </head>
        <body>
            
            <!-- Unified Login Form with Image -->
            <div class="container login-container">
                <!-- Login Form -->
                <div class="login-card">
                    <h3 class="text-center mb-4">登入</h3>
                    <form action="index.php" method="POST">
                         <!-- 身分選擇 -->
                        <div class="mb-3">
                            <label for="userRole" class="form-label">登入身分</label>
                            <select class="form-select" id="userRole" name="userRole" required>
                                <option value="" disabled selected>選擇您的身分</option>
                                <option value="student">學生</option>
                                <option value="teacher">教師</option>
                                <option value="admin">管理者</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">帳號</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">密碼</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary login-button">登入</button>
                    </form>
                </div>
                
                <!-- Login Image -->
                <div class="login-image">
                    <img src="fju.jpg" alt="登入橫幅圖片" class="img-fluid enlarged-image " />
                </div>
            </div>
        
              <!-- Footer-->
        <footer class="py-4 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; 遠距教學影片管理系統 2024</p></div>
        </footer>
        </body>
        </html>
        