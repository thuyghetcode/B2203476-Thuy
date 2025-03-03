<?php
session_start();

// Kết nối tới cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlbanhang";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["submit"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Kiểm tra loại tệp tin
    if ($fileType != "csv") {
        echo "Chỉ chấp nhận file loại 'CSV' .";
        $uploadOk = 0;
    }

    // Kiểm tra và upload tệp tin
    if ($uploadOk == 0) {
        echo "Xin lỗi, upload thất bại";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " Đã được upload";
            // Đọc tệp tin CSV và lưu dữ liệu vào cơ sở dữ liệu
            if (($handle = fopen($target_file, "r")) !== FALSE) {
                fgetcsv($handle); // Bỏ qua dòng tiêu đề
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $id = $data[0];
                    $fullname = $data[1];
                    $email = $data[2];
                    $password = md5($data[3]); // Băm mật khẩu trước khi lưu vào cơ sở dữ liệu
                    $img_profile = $data[4];

                    $sql = "INSERT INTO customers (id, fullname, email, password, img_profile) VALUES ('$id', '$fullname', '$email', '$password', '$img_profile')";

                    if ($conn->query($sql) === TRUE) {
                        echo "Đã cập nhật thành công<br>";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
                fclose($handle);
            }
        } else {
            echo "Xin lỗi, không có file nào đươc chọn để update.";
        }
    }
}

$conn->close();
