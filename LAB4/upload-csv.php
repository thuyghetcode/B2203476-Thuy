<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Upload CSV</title>
</head>

<body>
    <h2>Upload CSV</h2>
    <form action="save-upload-csv.php" method="post" enctype="multipart/form-data">
        <label for="fileToUpload">Select CSV file to upload:</label><br>
        <input type="file" name="fileToUpload" id="fileToUpload" accept=".csv"><br><br>
        <input type="submit" value="Upload CSV" name="submit">
    </form>
</body>

</html>