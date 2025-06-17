<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>招生信息网</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .header {
            background-color: #005EBE;
            height: 50px;
            display: flex;
            align-items: center;
            padding-left: 20px;
        }
        .banner {
             width: 100%;
             height: 300px;
         }
         .nav-tabs {
             display: flex;
             justify-content: center;
             background-color:rgb(26, 71, 116);
             padding: 10px 0;
         }
         .nav-tabs a {
             color: white;
             text-decoration: none;
             padding: 10px 20px;
             margin: 0 5px;
         }
         .nav-tabs a:hover {
             background-color: #005EBE;
         }
         .content {
            width: 80%;
            margin: 0 auto;
            background-color: #f5f5f5;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 0;
        }
        .carousel {
            width: 870px;
            height: 350px;
            margin-bottom: 30px;
            overflow: hidden;
            position: relative;
        }
        .carousel-container {
            display: flex;
            transition: transform 0.5s ease;
            width: 300%;
        }
        .carousel img {
            width: 33.333%;
            height: 100%;
            object-fit: cover;
            flex-shrink: 0;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 1px solid #005EBE;
        }
        .section-container {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 30px;
            border-radius: 5px;
            width: 870px;
        }
        /* 轮播图背景 */
        .carousel-container {
            background-color: #e0e0e0;
        }
        /* 招生动态背景 */
        .admission-news {
            background-color: #d0e3ff;
        }
        /* 招生类型背景 */
        .admission-types {
            background-color: #ffe8cc;
        }
        /* 招生服务背景 */
        .admission-services {
            background-color: #d0f0d0;
            display: flex;
        }
        .admission-service-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 10px;
        }
        .admission-service-text {
            margin-top: 5px;
            text-align: center;
            font-size: 14px;
        }
        .admission-news {
            display: flex;
            width: 100%;
            margin-bottom: 30px;
        }
        .news-left {
            width: 425px;
            height: 100%;
            background-color: #d4d1d9;
            margin-right: 20px;
        }
        .news-right {
            width: 425px;
            flex: 1;
        }
        .news-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 5px;
        }
        .news-item:hover {
            background-color: #f5f5f5;
        }
        .news-title {
            flex: 1;
            text-align: left;
        }
        .news-date {
            color: #666;
        }
        .admission-types {
            display: flex;
            justify-content: space-around;
            width: 100%;
            margin-bottom: 30px;
        }
        .admission-type {
            width: 75px;
            height: 75px;
            margin: 10px;
        }
        .admission-type-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 10px;
        }
        .admission-type-text {
            margin-top: 5px;
            text-align: center;
            font-size: 14px;
        }
        .admission-services {
            display: flex;
            justify-content: space-around;
            width: 100%;
        }
        .admission-service {
            width: 75px;
            height: 75px;
        }
        .footer {
            background-color:rgb(57, 131, 204);
            display: flex;
            justify-content: space-between;
            padding: 20px;
            height: 133px;
        }
        .logo {
            width: 130px;
            height: 130px;
        }
        .links {
            display: flex;
            flex-direction: column;
        }
        .qrcode {
            width: 150px;
            height: 150px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>招生信息网</h1>
    </div>
    <img class="banner" src="banner.jpg" alt="Banner">
        <div class="nav-tabs">
            <a href="index.php">首页</a>
            <a href="admission-types.php">招生类型</a>
            <a href="index.php">报考指南</a>
            <a href="index.php">专业介绍</a>
            <a href="query.php">录取查询</a>
            <a href="contact.php">招生咨询</a>
            <a href="index.php">资料下载</a>
        </div>
        <div class="content">
            <!-- 轮播图部分 -->
            <div class="section-container">
                <div class="section-title">校园风采</div>
                <div class="carousel">
                    <div class="carousel-container">
                        <img src="lb1.jpg" alt="轮播图1">
                        <img src="lb2.jpg" alt="轮播图2">
                        <img src="lb3.jpg" alt="轮播图3">
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const container = document.querySelector('.carousel-container');
                    const images = document.querySelectorAll('.carousel img');
                    let currentIndex = 0;
                    
                    function nextSlide() {
                        currentIndex = (currentIndex + 1) % images.length;
                        container.style.transform = `translateX(-${currentIndex * 33.333}%)`;
                    }
                    
                    setInterval(nextSlide, 5000);
                });
            </script>
            
            <!-- 招生动态 -->
            <div class="section-container">
                <div style="display: flex; justify-content: space-between; align-items: center;">
    <div class="section-title">招生动态</div>
    <a href="news.php" style="color: #005EBE; text-decoration: none;">更多 &gt;</a>
</div>
                <div class="admission-news">
                    <div class="news-left"></div>
                    <div class="news-right">
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

// 从数据库获取最新5条新闻
$sql = "SELECT id, title, publish_date FROM news ORDER BY publish_date DESC LIMIT 5";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<a href="news-detail.php?id='.$row['id'].'" class="news-item" style="color: inherit; text-decoration: none;">';
        echo '<span class="news-title">'.$row['title'].'</span>';
        echo '<span class="news-date">'.$row['publish_date'].'</span>';
        echo '</a>';
    }
} else {
    echo '<div class="news-item" style="color: inherit; font-weight: inherit; text-decoration: none;">暂无招生动态</div>';
}

$conn->close();
?>
                    </div>
                </div>
            </div>
            
            <!-- 招生类型 -->
            <div class="section-container">
                <div class="section-title">招生类型</div>
                <div class="admission-types">
                    <div class="admission-type-container">
                    <a href="admission-query.php"><img class="admission-type" src="gk.jpg" alt="高考招生"></a>
                    <div class="admission-type-text">高考招生</div>
                </div>
                <div class="admission-type-container">
                    <a href="admission-query.php"><img class="admission-type" src="xk.jpg" alt="校考招生"></a>
                    <div class="admission-type-text">校考招生</div>
                </div>
                <div class="admission-type-container">
                    <a href="admission-query.php"><img class="admission-type" src="3+zs.jpg" alt="3+证书"></a>
                    <div class="admission-type-text">3+证书</div>
                </div>
                <div class="admission-type-container">
                    <a href="admission-query.php"><img class="admission-type" src="zzzs.jpg" alt="自主招生"></a>
                    <div class="admission-type-text">自主招生</div>
                </div>
                </div>
            </div>
            
            <!-- 招生服务 -->
            <div class="section-container">
                <div class="section-title">招生服务</div>
                <div class="admission-services">
                    <div class="admission-service-container">
                        <a href="http://external-site.com" target="_blank"><img class="admission-service" src="招生简章.jpg" alt="招生简章"></a>
                        <div class="admission-service-text">招生简章</div>
                    </div>
                    <div class="admission-service-container">
                        <a href="http://external-site.com" target="_blank"><img class="admission-service" src="招生章程.jpg" alt="招生章程"></a>
                        <div class="admission-service-text">招生章程</div>
                    </div>
                    <div class="admission-service-container">
                        <a href="http://external-site.com" target="_blank"><img class="admission-service" src="招生计划.jpg" alt="招生计划"></a>
                        <div class="admission-service-text">招生计划</div>
                    </div>
                    <div class="admission-service-container">
                        <a href="http://external-site.com" target="_blank"><img class="admission-service" src="网上公示.jpg" alt="网上公示"></a>
                        <div class="admission-service-text">网上公示</div>
                    </div>
                </div>
            </div>
        </div>
    <div class="footer">
        <div class="logo">
            <img src="logo.png" alt="Logo" style="width: 100%; height: 100%;">
        </div>
        <div class="links">
            <a href="#">链接1</a>
            <a href="#">链接2</a>
            <a href="#">链接3</a>
        </div>
        <div class="qrcode">
            <img src="二维码.jpg" alt="二维码" style="width: 100%; height: 100%;">
        </div>
    </div>
    <script>
        // JavaScript代码
    </script>
</body>
</html>