<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>會員管理 - 遠距教學影片管理系統</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="css/styles.css" rel="stylesheet" />
    <style>
        .member-container {
            max-width: 800px;
            margin: 0 auto;
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
        .form-container {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f8f9fa;
        }
        .form-container h3 {
            margin-bottom: 15px;
        }
        .form-container input,
        .form-container select {
            margin-bottom: 10px;
            width: 100%;
            padding: 8px;
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
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="courseM.php">課程管理</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="manage.php">會員管理</a></li>
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
                <h1 class="fw-bolder">會員管理</h1>
                <p class="lead mb-0">新增、修改或刪除會員</p>
            </div>
        </div>
    </header>

    <!-- Page content -->
    <div class="container member-container">
        <!-- Search and Add Member Button -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <input type="text" id="searchInput" class="form-control" placeholder="輸入名稱或帳號以搜尋會員" onkeyup="searchMember()" />
            <button class="btn btn-outline-secondary" type="button" onclick="searchCourses()">搜尋</button>
        </div>

        <!-- Member Table -->
        <div class="table-container">
            <h3 class="text-center">會員列表</h3>
            <table>
                <thead>
                    <tr>
                        <th>會員帳號</th>
                        <th>名稱</th>
                        <th>身分</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody id="memberTableBody">
                    <tr>
                        <td>user01</td>
                        <td>張小明</td>
                        <td>學生</td>
                        <td>
                            <button class="btn btn-primary btn-sm" onclick="editMember('user01')">修改</button>
                            <button class="btn btn-danger btn-sm" onclick="deleteMember('user01')">刪除</button>
                        </td>
                    </tr>
                    <!-- 更多會員資料可在這裡添加 -->
                </tbody>
            </table>
        </div>

        <!-- Add/Edit Member Form -->
        <div class="form-container" id="memberFormContainer">
            <h3 id="formTitle">新增會員</h3>
            <form id="memberForm">
                <input type="hidden" id="memberAccount" />
                <label for="memberAccount">會員帳號</label>
                <input type="text" id="memberAccount" placeholder="請輸入會員帳號" required />
                <label for="memberName">名稱</label>
                <input type="text" id="memberName" placeholder="請輸入會員名稱" required />
                <label for="memberRole">身分</label>
                <select id="memberRole" required>
                    <option value="">請選擇身分</option>
                    <option value="學生">學生</option>
                    <option value="教師">教師</option>
                    <option value="管理者">管理者</option>
                </select>
                <button type="submit" class="btn btn-success w-100" id="submitButton">新增會員</button>
            </form>
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
    <script>
        // 切換表單到新增模式
        function resetForm() {
            document.getElementById('formTitle').innerText = "新增會員";
            document.getElementById('submitButton').innerText = "新增會員";
            document.getElementById('memberAccount').value = "";
            document.getElementById('memberName').value = "";
            document.getElementById('memberRole').value = "";
        }

        // 搜尋會員
        function searchMember() {
            const searchValue = document.getElementById('searchInput').value.toLowerCase();
            const tableRows = document.getElementById('memberTableBody').getElementsByTagName('tr');
            for (const row of tableRows) {
                const accountCell = row.cells[0].textContent.toLowerCase();
                const nameCell = row.cells[1].textContent.toLowerCase();
                row.style.display = accountCell.includes(searchValue) || nameCell.includes(searchValue) ? '' : 'none';
            }
        }

        // 編輯會員
        function editMember(account) {
            document.getElementById('formTitle').innerText = "修改會員";
            document.getElementById('submitButton').innerText = "更新會員";
            document.getElementById('memberAccount').value = account;
            document.getElementById('memberName').value = "張小明"; // 預設示例數據
            document.getElementById('memberRole').value = "學生"; // 預設示例數據
        }

        // 刪除會員
        function deleteMember(account) {
            if (confirm("確定要刪除此會員嗎？")) {
                alert("會員已刪除");
            }
        }

        // 表單提交事件
        document.getElementById('memberForm').addEventListener('submit', function(event) {
            event.preventDefault();
            if (document.getElementById('memberAccount').value) {
                alert("會員資料已更新");
            } else {
                alert("新會員已添加");
            }
            resetForm();
        });
    </script>
</body>
</html>
           