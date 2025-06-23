<?php
// 后台管理系统
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

// 登录验证
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// 新闻管理功能
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'add_news':
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $title = $_POST['title'];
                $content = $_POST['content'];
                $publish_date = date('Y-m-d');
                
                $sql = "INSERT INTO news (title, content, publish_date) VALUES ('$title', '$content', '$publish_date')";
                $conn->query($sql);
                header("Location: admin.php");
            }
            break;
            
        case 'edit_news':
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $id = $_POST['id'];
                $title = $_POST['title'];
                $content = $_POST['content'];
                
                $sql = "UPDATE news SET title='$title', content='$content' WHERE id=$id";
                $conn->query($sql);
                header("Location: admin.php");
            }
            break;
            
        case 'delete_news':
            $id = $_GET['id'];
            $sql = "DELETE FROM news WHERE id=$id";
            $conn->query($sql);
            header("Location: admin.php");
            break;
            
        // 录取结果管理功能
        case 'add_result':
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $student_id = $_POST['student_id'];
                $id_card = $_POST['id_card'];
                $name = $_POST['name'];
                $major = $_POST['major'];
                
                $sql = "INSERT INTO admission_results (student_id, id_card, name, major) VALUES ('$student_id', '$id_card', '$name', '$major')";
                $conn->query($sql);
                header("Location: admin.php");
            }
            break;
            
        case 'edit_result':
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $id = $_POST['id'];
                $student_id = $_POST['student_id'];
                $id_card = $_POST['id_card'];
                $name = $_POST['name'];
                $major = $_POST['major'];
                
                $sql = "UPDATE admission_results SET student_id='$student_id', id_card='$id_card', name='$name', major='$major' WHERE id=$id";
                $conn->query($sql);
                header("Location: admin.php");
            }
            break;
            
        case 'delete_result':
            $id = $_GET['id'];
            $sql = "DELETE FROM admission_results WHERE id=$id";
            $conn->query($sql);
            header("Location: admin.php");
            break;
            
        // 咨询管理功能
        case 'reply_consult':
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $id = $_POST['id'];
                $reply = $_POST['reply'];
                
                $sql = "UPDATE consultations SET reply='$reply', replied_at=NOW() WHERE id=$id";
                $conn->query($sql);
                header("Location: admin.php");
            }
            break;
            
        case 'delete_consult':
            $id = $_GET['id'];
            $sql = "DELETE FROM consultations WHERE id=$id";
            $conn->query($sql);
            header("Location: admin.php");
            break;
    }
}

// 获取新闻列表
$news_sql = "SELECT * FROM news ORDER BY publish_date DESC";
$news_result = $conn->query($news_sql);

// 获取录取结果列表
$results_sql = "SELECT * FROM admission_results";
$results_result = $conn->query($results_sql);

// 获取咨询列表
$consults_sql = "SELECT * FROM consultations ORDER BY created_at DESC";
$consults_result = $conn->query($consults_sql);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>后台管理系统</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
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
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }
        .tabs {
            display: flex;
            margin-bottom: 20px;
        }
        .tab {
            padding: 10px 20px;
            background-color: #f1f1f1;
            cursor: pointer;
            margin-right: 5px;
        }
        .tab.active {
            background-color: #4CAF50;
            color: white;
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>后台管理系统</h1>
        
        <div class="tabs">
            <div class="tab active" onclick="showTab('news')">新闻管理</div>
            <div class="tab" onclick="showTab('results')">录取结果管理</div>
            <div class="tab" onclick="showTab('consults')">咨询管理</div>
        </div>
        
        <!-- 新闻管理 -->
        <div id="news" class="tab-content active">
            <h2>新闻列表</h2>
            <button onclick="showAddNewsForm()">添加新闻</button>
            
            <table>
                <tr>
                    <th>ID</th>
                    <th>标题</th>
                    <th>发布日期</th>
                    <th>操作</th>
                </tr>
                <?php while($row = $news_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['publish_date']; ?></td>
                    <td>
                        <button onclick="showEditNewsForm(<?php echo $row['id']; ?>, '<?php echo $row['title']; ?>', '<?php echo addslashes($row['content']); ?>')">编辑</button>
                        <button onclick="if(confirm('确定删除?')) window.location='admin.php?action=delete_news&id=<?php echo $row['id']; ?>'">删除</button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
            
            <!-- 添加/编辑新闻表单 -->
            <div id="news-form" style="display: none;">
                <h2 id="form-title">添加新闻</h2>
                <form id="news-form-content" method="post" action="admin.php?action=add_news">
                    <input type="hidden" name="id" id="news-id">
                    <div class="form-group">
                        <label for="news-title">标题</label>
                        <input type="text" id="news-title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="news-content">内容</label>
                        <textarea id="news-content" name="content" rows="5" required></textarea>
                    </div>
                    <button type="submit">保存</button>
                    <button type="button" onclick="hideNewsForm()">取消</button>
                </form>
            </div>
        </div>
        
        <!-- 录取结果管理 -->
        <div id="results" class="tab-content">
            <h2>录取结果列表</h2>
            <button onclick="showAddResultForm()">添加录取结果</button>
            
            <table>
                <tr>
                    <th>ID</th>
                    <th>考生号</th>
                    <th>身份证号</th>
                    <th>姓名</th>
                    <th>专业</th>
                    <th>操作</th>
                </tr>
                <?php while($row = $results_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['student_id']; ?></td>
                    <td><?php echo $row['id_card']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['major']; ?></td>
                    <td>
                        <button onclick="showEditResultForm(<?php echo $row['id']; ?>, '<?php echo $row['student_id']; ?>', '<?php echo $row['id_card']; ?>', '<?php echo $row['name']; ?>', '<?php echo $row['major']; ?>')">编辑</button>
                        <button onclick="if(confirm('确定删除?')) window.location='admin.php?action=delete_result&id=<?php echo $row['id']; ?>'">删除</button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
            
            <!-- 添加/编辑录取结果表单 -->
            <div id="result-form" style="display: none;">
                <h2 id="result-form-title">添加录取结果</h2>
                <form id="result-form-content" method="post" action="admin.php?action=add_result">
                    <input type="hidden" name="id" id="result-id">
                    <div class="form-group">
                        <label for="student-id">考生号</label>
                        <input type="text" id="student-id" name="student_id" required>
                    </div>
                    <div class="form-group">
                        <label for="id-card">身份证号</th>
                        <input type="text" id="id-card" name="id_card" required>
                    </div>
                    <div class="form-group">
                        <label for="name">姓名</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="major">专业</label>
                        <input type="text" id="major" name="major" required>
                    </div>
                    <button type="submit">保存</button>
                    <button type="button" onclick="hideResultForm()">取消</button>
                </form>
            </div>
        </div>
        
        <!-- 咨询管理 -->
        <div id="consults" class="tab-content">
            <h2>咨询列表</h2>
            
            <table>
                <tr>
                    <th>ID</th>
                    <th>姓名</th>
                    <th>电话</th>
                    <th>咨询时间</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                <?php while($row = $consults_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td><?php echo empty($row['reply']) ? '未回复' : '已回复'; ?></td>
                    <td>
                        <button onclick="showReplyForm(<?php echo $row['id']; ?>, '<?php echo addslashes($row['content']); ?>', '<?php echo isset($row['reply']) ? addslashes($row['reply']) : ''; ?>')">回复</button>
                        <button onclick="if(confirm('确定删除?')) window.location='admin.php?action=delete_consult&id=<?php echo $row['id']; ?>'">删除</button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
            
            <!-- 回复表单 -->
            <div id="consult-form" style="display: none;">
                <h3>回复咨询</h3>
                <form method="post" action="admin.php?action=reply_consult">
                    <input type="hidden" id="consult_id" name="id">
                    <div class="form-group">
                        <label>咨询内容</label>
                        <div id="consult-content" style="padding: 10px; background: #f5f5f5; margin-bottom: 15px;"></div>
                    </div>
                    <div class="form-group">
                        <label for="reply_content">回复内容</label>
                        <textarea id="reply_content" name="reply" rows="5" required></textarea>
                    </div>
                    <button type="submit">提交回复</button>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        // 切换标签页
        function showTab(tabName) {
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            
            document.querySelector(`.tab[onclick="showTab('${tabName}')"]`).classList.add('active');
            document.getElementById(tabName).classList.add('active');
        }
        
        // 新闻表单相关函数
        function showAddNewsForm() {
            document.getElementById('form-title').textContent = '添加新闻';
            document.getElementById('news-form-content').action = 'admin.php?action=add_news';
            document.getElementById('news-id').value = '';
            document.getElementById('news-title').value = '';
            document.getElementById('news-content').value = '';
            document.getElementById('news-form').style.display = 'block';
        }
        
        function showEditNewsForm(id, title, content) {
            document.getElementById('form-title').textContent = '编辑新闻';
            document.getElementById('news-form-content').action = 'admin.php?action=edit_news';
            document.getElementById('news-id').value = id;
            document.getElementById('news-title').value = title;
            document.getElementById('news-content').value = content;
            document.getElementById('news-form').style.display = 'block';
        }
        
        function hideNewsForm() {
            document.getElementById('news-form').style.display = 'none';
        }
        
        // 录取结果表单相关函数
        function showAddResultForm() {
            document.getElementById('result-form-title').textContent = '添加录取结果';
            document.getElementById('result-form-content').action = 'admin.php?action=add_result';
            document.getElementById('result-id').value = '';
            document.getElementById('student-id').value = '';
            document.getElementById('id-card').value = '';
            document.getElementById('name').value = '';
            document.getElementById('major').value = '';
            document.getElementById('result-form').style.display = 'block';
        }
        
        function showEditResultForm(id, studentId, idCard, name, major) {
            document.getElementById('result-form-title').textContent = '编辑录取结果';
            document.getElementById('result-form-content').action = 'admin.php?action=edit_result';
            document.getElementById('result-id').value = id;
            document.getElementById('student-id').value = studentId;
            document.getElementById('id-card').value = idCard;
            document.getElementById('name').value = name;
            document.getElementById('major').value = major;
            document.getElementById('result-form').style.display = 'block';
        }
        
        function hideResultForm() {
            document.getElementById('result-form').style.display = 'none';
        }
        
        // 咨询回复表单函数
        function showReplyForm(id, content, reply) {
            document.getElementById('consult_id').value = id;
            document.getElementById('consult-content').innerHTML = content;
            document.getElementById('reply_content').value = reply;
            document.getElementById('consult-form').style.display = 'block';
            window.scrollTo(0, document.body.scrollHeight);
        }
    </script>
</body>
</html>