<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Upload Ảnh</title>
</head>

<body>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        <p>Chọn ảnh để làm profile:</p>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>

</body>

</html>