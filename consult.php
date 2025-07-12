<?php
// 招生咨询页面
session_start();

// 数据库连接
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admission";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 处理留言提交
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_consult'])) {
    if (!isset($_SESSION['form_token'])) {
        $_SESSION['form_token'] = bin2hex(random_bytes(32));
    }
    
    if (!isset($_POST['form_token']) || $_POST['form_token'] !== $_SESSION['form_token']) {
        die('表单已提交，请勿重复提交');
    }
    
    unset($_SESSION['form_token']);
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $content = $_POST['content'];
    
    $sql = "INSERT INTO consultations (name, phone, content, created_at) VALUES ('$name', '$phone', '$content', NOW())";
    $conn->query($sql);
}

// 获取所有咨询留言
$sql = "SELECT * FROM consultations ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>招生咨询</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .consult-form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 5px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        button {
            background: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }
        .consult-list {
            margin-top: 30px;
        }
        .consult-item {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
        .consult-meta {
            color: #666;
            font-size: 0.9em;
            margin-bottom: 10px;
        }
        .header {
            background-color: #005EBE;
            height: 50px;
            display: flex;
            align-items: center;
            padding-left: 20px;
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
        <div class="nav-tabs">
            <a href="index.php">首页</a>
            <a href="query.php">招生类型</a>
            <a href="网址放这里">报考指南</a>
            <a href="网址放这里">专业介绍</a>
            <a href="query.php">录取查询</a>
            <a href="consult.php">招生咨询</a>
            <a href="网址放这里">资料下载</a>
        </div>
    <div class="container" style="margin: 20px;">
        <h1>招生咨询</h1>
        
        <div class="consult-form">
            <h2>提交咨询</h2>
            <form method="post">
    <input type="hidden" name="form_token" value="<?php echo isset($_SESSION['form_token']) ? $_SESSION['form_token'] : ''; ?>">
                <div class="form-group">
                    <label for="name">姓名</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="phone">联系电话</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="content">咨询内容</label>
                    <textarea id="content" name="content" rows="5" required></textarea>
                </div>
                <button type="submit" name="submit_consult">提交咨询</button>
            </form>
        </div>
        
        <div class="consult-list">
            <h2>咨询留言</h2>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="consult-item">
                        <div class="consult-meta">
                            <?php echo $row['name']; ?> | 
                            <?php echo $row['phone']; ?> | 
                            <?php echo $row['created_at']; ?>
                            <?php if (isset($row['reply']) && !empty($row['reply'])): ?>
                                <span style="color:green">(已回复)</span>
                            <?php endif; ?>
                        </div>
                        <p><?php echo nl2br($row['content']); ?></p>
                        <?php if (isset($row['reply']) && !empty($row['reply'])): ?>
                            <div style="background:#f0f0f0; padding:10px; margin-top:10px;">
                                <strong>回复：</strong>
                                <p><?php echo nl2br($row['reply']); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>暂无咨询留言</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="footer">
        <div class="logo">
            <img src="logo.png" alt="Logo" style="width: 100%; height: 100%;">
        </div>
        <div class="links">
            <a href="https://www.ldpoly.edu.cn/">职业技术学院官网</a>
            <a href="#">学号</a>
            <a href="#">1班</a>
            <a href="admin.php">姓名</a>
        </div>
        <div class="qrcode">
            <img src="二维码.jpg" alt="二维码" style="width: 100%; height: 100%;">
        </div>
    </div>
</body>
</html>