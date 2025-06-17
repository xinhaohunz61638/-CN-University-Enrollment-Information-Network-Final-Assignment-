<?php
// 数据库连接
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admission";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 获取所有新闻
$sql = "SELECT id, title, publish_date FROM news ORDER BY publish_date DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>招生动态 - 新闻列表</title>
    <style>
        body {
            font-family: 'Microsoft YaHei', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        .news-list {
            background-color: white;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .news-item {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        .news-item:last-child {
            border-bottom: none;
        }
        .news-title {
            color: #333;
            font-size: 16px;
        }
        .news-date {
            color: #999;
            font-size: 14px;
        }
        a {
            text-decoration: none;
            color: inherit;
        }
        a:hover .news-title {
            color: #005EBE;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>招生动态</h1>
        <div class="news-list">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<a href="news-detail.php?id='.$row['id'].'" class="news-item">';
                    echo '<span class="news-title">'.$row['title'].'</span>';
                    echo '<span class="news-date">'.$row['publish_date'].'</span>';
                    echo '</a>';
                }
            } else {
                echo '<div class="news-item">暂无新闻</div>';
            }
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>