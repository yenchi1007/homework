<?php
require_once('db.php');

if (isset($_GET['video_id'])) {
    $video_id = $_GET['video_id'];

    // 準備 SQL 查詢，計算總觀看人數
    $query_total_viewers = "SELECT COUNT(DISTINCT user_id) AS total_viewers FROM video_views WHERE video_id = ?";
    $stmt_total = $conn->prepare($query_total_viewers);

    if (!$stmt_total) {
        die("SQL 準備失敗: " . $conn->error);
    }

    $stmt_total->bind_param("i", $video_id);
    $stmt_total->execute();
    $result_total = $stmt_total->get_result();
    $total_viewers = $result_total->fetch_assoc()['total_viewers'];
    $stmt_total->close();

    // 準備 SQL 查詢，取得每位學生的觀看時數
    $query_watch_hours = "
        SELECT u.name AS student_name, v.watched_hours 
        FROM video_views v
        JOIN users u ON v.user_id = u.id
        WHERE v.video_id = ?";
    $stmt_hours = $conn->prepare($query_watch_hours);

    if (!$stmt_hours) {
        die("SQL 準備失敗: " . $conn->error);
    }

    $stmt_hours->bind_param("i", $video_id);
    $stmt_hours->execute();
    $result_hours = $stmt_hours->get_result();

    // 準備資料供前端顯示
    $watch_data = [];
    while ($row = $result_hours->fetch_assoc()) {
        $watch_data[] = $row;
    }
    $stmt_hours->close();
    $conn->close();
} else {
    die("請提供影片 ID");
}
?>

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
    <div class="container data-container">
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
                        <td><?php echo htmlspecialchars($total_viewers); ?></td>
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
                    <?php if (!empty($watch_data)): ?>
                        <?php foreach ($watch_data as $data): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($data['student_name']); ?></td>
                                <td><?php echo htmlspecialchars($data['watched_hours']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2">尚無觀看數據</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
