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
            color: white;
            padding: 20px;
            text-align: center;
        }
        .nav-tabs {
            display: flex;
            justify-content: center;
            background-color: #f8f9fa;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }
        .nav-tabs a {
            margin: 0 15px;
            color: #333;
            text-decoration: none;
            padding: 5px 10px;
        }
        .nav-tabs a:hover {
            color: #005EBE;
            text-decoration: underline;
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
            <a href="https://zs.ldpoly.edu.cn/home/index/ListPage.html?catalogueId=90a12e6756cb4f4ebc4d251a58d60245">报考指南</a>
            <a href="https://zs.ldpoly.edu.cn/home/index/ListPage.html?catalogueId=faa806f9b8af4d80bbb8db81b227ce8c">专业介绍</a>
            <a href="query.php">录取查询</a>
            <a href="https://zs.ldpoly.edu.cn/home/index/ListPage.html?catalogueId=9353c230ece24af98ebcfb17c6239f6b">招生咨询</a>
            <a href="https://zs.ldpoly.edu.cn/home/index/ListPage.html?catalogueId=9353c230ece24af98ebcfb17c6239f6b">资料下载</a>
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
            <a href="https://www.ldpoly.edu.cn/">罗定职业技术学院官网</a>
            <a href="#">学号23303520119</a>
            <a href="#">姓名刘宇虓</a>
        </div>
        <img class="qrcode" src="二维码.jpg" alt="二维码">
    </div>
</body>
</html>