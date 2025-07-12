<?php
// 录取查询页面
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admission";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $id_card = $_POST['id_card'];
    
    $sql = "SELECT name, major FROM admission_results WHERE student_id='$student_id' AND RIGHT(id_card,6)='$id_card'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $message = $row['name'] . "已录取" . $row['major'];
    } else {
        $message = "无录取数据";
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>录取查询</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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
        .query-form {
            max-width: 500px;
            margin: 30px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #005EBE;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        .result {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-align: center;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #ddd;
            margin-top: 30px;
        }
        .footer .logo {
            height: 50px;
            margin-bottom: 10px;
        }
        .footer .links a {
            margin: 0 10px;
            color: #333;
            text-decoration: none;
        }
        .footer .qrcode {
            height: 80px;
            margin-top: 15px;
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
    <div class="query-form">
        <h2>录取查询</h2>
        <form method="post">
            <div class="form-group">
                <label for="student_id">考生号:</label>
                <input type="text" id="student_id" name="student_id" required>
            </div>
            <div class="form-group">
                <label for="id_card">身份证号后6位:</label>
                <input type="text" id="id_card" name="id_card" required maxlength="6">
            </div>
            <button type="submit">查询</button>
        </form>
        
        <?php if (isset($message)): ?>
        <div class="result">
            <?php echo $message; ?>
        </div>
        <?php endif; ?>
    </div>
    <div class="footer">
        <img class="logo" src="logo.png" alt="Logo">
        <div class="links">
            <a href="https://www.ldpoly.edu.cn/">职业技术学院官网</a>
            <a href="#">学号/a>
            <a href="#">1班</a>
            <a href="admin.php">姓名</a>
        </div>
        <img class="qrcode" src="二维码.jpg" alt="二维码">
    </div>
</body>
</html>