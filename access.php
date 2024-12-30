<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>會員管理 - 遠距教學影片管理系統</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="css/styles.css" rel="stylesheet" />
    <style>
        .permission-container {
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
        .form-select, .input-field {
            width: 100%;
            padding: 8px;
        }
        .btn-save {
            margin-top: 10px;
            width: 100%;
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
                    <li class="nav-item"><a class="nav-link" href="loginIndex.php">首頁</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="courseM.php">課程管理</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="access.php">會員管理</a></li>
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
                <p class="lead mb-0">管理帳號使用權限</p>
            </div>
        </div>
    </header>

    <!-- Page content -->
    <div class="container permission-container">
        
    <div class="form-container" id="memberFormContainer">
    <h3 id="formTitle">新增會員</h3>
    <form id="memberForm">
        <label for="memberName">名稱</label>
        <input type="text" id="memberName" placeholder="請輸入會員名稱" required />
        
        <label for="memberPassword">密碼</label>
        <input type="password" id="memberPassword" placeholder="請輸入會員密碼" required />
        
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


   
            <h3 class="text-center">帳號權限列表</h3>
            <style>
    .table-container {
        margin-bottom: 30px; /* 與底部增加間隔 */
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
        .btn-save, .btn-delete {
            margin-top: 5px;
            width: 100%;
        }
        .btn-save {
            background-color: #007bff;
            color: white;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
        }
</style>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>帳號</th>
                        <th>密碼</th>
                        <th>權限</th>
                        <th>操作</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    // 連接資料庫
                    require_once('db.php');

                    try {
                        $query = "SELECT id, username, role, password FROM users";
                        $result = $conn->query($query);
                    
                        if ($result && $result->num_rows > 0) { // 確保查詢成功且有數據
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                echo "<td><input type='text' id='username-" . htmlspecialchars($row['id']) . "' class='input-field' value='" . htmlspecialchars($row['username']) . "' /></td>";
                                echo "<td>" . htmlspecialchars($row['password']) . "</td>";
                                echo "<td>
                                    <select id='role-" . htmlspecialchars($row['id']) . "' class='form-select'>
                                        <option value='student' " . ($row['role'] === 'student' ? 'selected' : '') . ">學生</option>
                                        <option value='teacher' " . ($row['role'] === 'teacher' ? 'selected' : '') . ">教師</option>
                                        <option value='admin' " . ($row['role'] === 'admin' ? 'selected' : '') . ">管理員</option>
                                    </select>
                                </td>";
                                echo "<td>
                                <button class='btn btn-save btn-sm' onclick='saveChanges(" . htmlspecialchars($row['id']) . ")'>儲存</button>
                                <button class='btn btn-delete btn-sm' onclick='deleteUser(" . htmlspecialchars($row['id']) . ")'>刪除</button>
                            </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>尚無資料</td></tr>";
                        }
                    } catch (Exception $e) {
                        echo "<tr><td colspan='5'>資料加載失敗：" . htmlspecialchars($e->getMessage()) . "</td></tr>";
                    } finally {
                        $conn->close();
                    }
                    
                    ?>
                </tbody>
            </table>
        </div>
    </div>
   
    <script>
    function saveChanges(id) {
        // 獲取該行的數據
        const username = document.getElementById(`username-${id}`).value;
        const role = document.getElementById(`role-${id}`).value;

        // 發送更新請求
        fetch('editAccess.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id=${id}&username=${encodeURIComponent(username)}&role=${role}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('更新成功');
            } else {
                alert('更新失敗: ' + data.message);
            }
        })
        .catch(error => {
            console.error('請求發生錯誤:', error);
            alert('發生錯誤，請檢查開發者工具中的主控台 (Console)。');
        });
    }
    
    function deleteUser(id) {
            if (confirm('確定要刪除此用戶嗎？')) {
                fetch('deleteUsers.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `id=${id}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('刪除成功');
                        location.reload(); // 重新載入頁面
                    } else {
                        alert('刪除失敗: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('錯誤:', error);
                    alert('刪除失敗，請檢查開發者工具。');
                });
            }
        }
</script>

<style>
      .table-container {
        margin-bottom: 30px; /* 與底部增加間隔 */
    }
</style>
    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; 遠距教學影片管理系統 2024</p>
        </div>
    </footer>

    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
