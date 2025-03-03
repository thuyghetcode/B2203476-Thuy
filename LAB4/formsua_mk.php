<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sửa mật khẩu</title>
</head>
<body>
    <h2>Sửa mật khẩu</h2>
    <form action="formsua_mk.php" method="post">
        <label for="old_pass">Mật khẩu cũ:</label><br>
        <input type="password" id="old_pass" name="old_pass" required><br><br>
        <label for="new_pass">Mật khẩu mới:</label><br>
        <input type="password" id="new_pass" name="new_pass" required><br><br>
        <label for="confirm_new_pass">Nhập lại mật khẩu mới:</label><br>
        <input type="password" id="confirm_new_pass" name="confirm_new_pass" required><br><br>
        <input type="submit" name="submit" value="Cập nhật mật khẩu">
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $old_pass = $_POST['old_pass'];
        $new_pass = $_POST['new_pass'];
        $confirm_new_pass = $_POST['confirm_new_pass'];
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "qlbanhang";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $email = $_SESSION['user'];
        
        // Kiểm tra mật khẩu cũ
        $sql = "SELECT password FROM customers WHERE email = '$email'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['password'] != md5($old_pass)) {
                echo "Mật khẩu cũ không đúng!";
            } else {
                // Kiểm tra mật khẩu mới
                if ($new_pass != $confirm_new_pass) {
                    echo "Mật khẩu mới không khớp!";
                } elseif ($new_pass == $old_pass) {
                    echo "Mật khẩu mới không được giống mật khẩu cũ!";
                } else {
                    // Cập nhật mật khẩu mới
                    $new_pass_hashed = md5($new_pass);
                    $sql = "UPDATE customers SET password = '$new_pass_hashed' WHERE email = '$email'";
                    if ($conn->query($sql) === TRUE) {
                        echo "Mật khẩu đã được cập nhật thành công!";
                    } else {
                        echo "Lỗi cập nhật mật khẩu: " . $conn->error;
                    }
                }
            }
        } else {
            echo "Không tìm thấy tài khoản!";
        }
        
        $conn->close();
    }
    ?>
</body>
</html>
