-- 录取查询系统数据库
CREATE DATABASE IF NOT EXISTS admission;
USE admission;

-- 录取结果表
CREATE TABLE IF NOT EXISTS admission_results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(20) NOT NULL COMMENT '考生号',
    id_card VARCHAR(18) NOT NULL COMMENT '身份证号',
    name VARCHAR(50) NOT NULL COMMENT '考生姓名',
    major VARCHAR(100) NOT NULL COMMENT '录取专业',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- 管理员账户表
CREATE TABLE IF NOT EXISTS admin_accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE COMMENT '管理员账号',
    password VARCHAR(50) NOT NULL COMMENT '密码(明文)',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- 新闻表
CREATE TABLE IF NOT EXISTS news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL COMMENT '新闻标题',
    content TEXT NOT NULL COMMENT '新闻内容',
    publish_date DATE NOT NULL COMMENT '发布日期',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- 添加示例数据
INSERT INTO admission_results (student_id, id_card, name, major) VALUES
('20230001', '440106199901011234', '张三', '计算机科学与技术'),
('20230002', '440106199902022345', '李四', '软件工程'),
('20230003', '440106199903033456', '王五', '人工智能');

-- 添加默认管理员账户
INSERT INTO admin_accounts (username, password) VALUES ('admin', 'admin123');