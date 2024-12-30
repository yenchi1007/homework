<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>課程管理 - 遠距教學影片管理系統</title>
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
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="courseM.php">課程管理</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="access.php">會員管理</a></li>
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
            <div class="text-center my-5">
                <h1 class="fw-bolder">課程管理</h1>
            </div>
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
</body>
</html>
<!-- Page content -->
<div class="container permission-container">
    <!-- Course Management Search and Filters -->
    <div class="table-container">
        <!-- Search Bar -->
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="搜尋課程" aria-label="搜尋課程" id="courseSearchInput">
            <button class="btn btn-outline-secondary" type="button" onclick="searchCourses()">搜尋</button>
        </div>
        
        <!-- Filters -->
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="semesterSelect" class="form-label">學期</label>
                <select class="form-select" id="semesterSelect">
                    <option selected>選擇學期</option>
                    <option value="spring">春季</option>
                    <option value="fall">秋季</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="schoolSelect" class="form-label">學院</label>
                <select class="form-select" id="schoolSelect">
                    <option selected>選擇學院</option>
                    <option value="arts">文學院</option>
                    <option value="science">理學院</option>
                    <!-- 更多選項 -->
                </select>
            </div>
            <div class="col-md-3">
                <label for="departmentSelect" class="form-label">學系</label>
                <select class="form-select" id="departmentSelect">
                    <option selected>選擇學系</option>
                    <option value="finance">金融系</option>
                    <option value="management">管理系</option>
                    <!-- 更多選項 -->
                </select>
            </div>
            <div class="col-md-3">
                <label for="gradeSelect" class="form-label">年級</label>
                <select class="form-select" id="gradeSelect">
                    <option selected>選擇年級</option>
                    <option value="1">一年級</option>
                    <option value="2">二年級</option>
                    <option value="3">三年級</option>
                    <option value="4">四年級</option>
                </select>
            </div>
        </div>
        
  <!-- 搜尋結果預覽 -->
<div class="container">
    <h3 class="my-4">搜尋結果</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>課程名稱</th>
                    <th>學期</th>
                    <th>學院</th>
                    <th>學系</th>
                    <th>年級</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody id="courseResults">
                <!-- 範例資料直接輸入 -->
                <tr>
                    <td>微積分</td>
                    <td>113-1</td>
                    <td>管理學院</td>
                    <td>金融與國際企業學系</td>
                    <td>一年級</td>
                    <td><a href="courseuser.php?id='.$row['id'] .'" class="btn btn-primary">查看課程</a></td>
                  
                </tr>
            </tbody>
        </table>
    </div>
</div>


<script>
    function searchCourses() {
        const searchInput = document.getElementById("courseSearchInput").value;
        const semester = document.getElementById("semesterSelect").value;
        const school = document.getElementById("schoolSelect").value;
        const department = document.getElementById("departmentSelect").value;
        const grade = document.getElementById("gradeSelect").value;
        
        // 範例的搜尋結果數據
        const courses = [
            { name: "財務管理", semester: "春季", school: "管理學院", department: "金融系", grade: "三年級" },
            { name: "企業管理", semester: "秋季", school: "管理學院", department: "管理系", grade: "二年級" },
            { name: "經濟學原理", semester: "春季", school: "社會科學學院", department: "經濟系", grade: "一年級" }
        ];
        
        // 將結果添加到表格
        const resultsContainer = document.getElementById("courseResults");
        resultsContainer.innerHTML = ""; // 清空之前的搜尋結果
        
        courses.forEach(course => {
            const row = `<tr>
                            <td>${course.name}</td>
                            <td>${course.semester}</td>
                            <td>${course.school}</td>
                            <td>${course.department}</td>
                            <td>${course.grade}</td>
                            <td><button class="btn btn-primary btn-sm">查看</button></td>
                         </tr>`;
            resultsContainer.insertAdjacentHTML('beforeend', row);
        });
        
        alert(`搜尋: ${searchInput}, 學期: ${semester}, 學院: ${school}, 學系: ${department}, 年級: ${grade}`);
    }
</script>

        

<script>
    function searchCourses() {
        const searchInput = document.getElementById("courseSearchInput").value;
        const semester = document.getElementById("semesterSelect").value;
        const school = document.getElementById("schoolSelect").value;
        const department = document.getElementById("departmentSelect").value;
        const grade = document.getElementById("gradeSelect").value;
        
        // 進行搜尋並更新課程列表
        alert(`搜尋: ${searchInput}, 學期: ${semester}, 學院: ${school}, 學系: ${department}, 年級: ${grade}`);
       }
</script>


