<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>課程詳情 - 遠距教學影片管理系統</title>
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    <!-- Navbar (可根據需要複製前面代碼中的導覽列) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#!">輔仁大學</a>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="loginIndex.php">首頁</a></li>
                    <li class="nav-item"><a class="nav-link active" href="courseM.php">課程管理</a></li>
                    <li class="nav-item"><a class="nav-link active" href="access.php">會員管理</a></li>
                    <!-- 會員欄 -->
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
    <!-- Course Details Header -->
    <header class="py-4 bg-light border-bottom mb-4">
        <div class="container">
            <h1 class="fw-bolder">微積分</h1>
            <p>金企一甲 113-1學期</p>
        </div>
    </header>

    <!-- Teacher and Student Management -->
    <div class="container">
        <!-- Teacher List -->
        <h2 class="mb-3">老師名單</h2>
        <table class="table table-bordered mb-4">
            <thead>
                <tr>
                    <th>帳號</th>
                    <th>姓名</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody id="teacherList">
                <tr>
                    <td>teacher01</td>
                    <td>陳老師</td>
                    <td><button class="btn btn-danger btn-sm" onclick="removeTeacher(this)">刪除</button></td>
                </tr>
                <!-- 更多老師項目 -->
            </tbody>
        </table>
        <button class="btn btn-primary mb-4" onclick="addTeacher()">新增老師</button>

        <!-- Student List -->
        <h2 class="mb-3">學生名單</h2>
        <table class="table table-bordered mb-4" id="studentTable">
            <thead>
                <tr>
                    <th>帳號</th>
                    <th>姓名</th>
                    <th>系級</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody id="studentList">
                <tr>
                    <td>student01</td>
                    <td>李同學</td>
                    <td>二年級</td>
                    <td><button class="btn btn-danger btn-sm" onclick="removeStudent(this)">刪除</button></td>
                </tr>
                <!-- 更多學生項目 -->
            </tbody>
        </table>
        <button class="btn btn-primary" onclick="addStudent()">新增學生</button>
    </div>
    <script>
    document.getElementById('memberForm').addEventListener('submit', function (event) {
        event.preventDefault(); // 防止表單的預設提交行為

        const name = document.getElementById('memberName').value;
        const role = document.getElementById('memberRole').value;
        const password = document.getElementById('memberPassword').value;

        // 檢查表單欄位是否填寫完整
        if (!name || !role || !password) {
            alert('請填寫完整的會員資訊！');
            return;
        }

        // 發送新增會員請求
        fetch('addUser.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `name=${encodeURIComponent(name)}&role=${role}&password=${encodeURIComponent(password)}`
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

</body>
</html>
