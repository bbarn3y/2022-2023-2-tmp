<?php

if (!empty($_FILES)) {
    print_r($_POST);
    print_r($_FILES);
    $fileContent = file_get_contents($_FILES['thefile']['tmp_name']);
    echo nl2br($fileContent);
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <!-- File upload -->
    <form method="POST" action="upload.php" enctype="multipart/form-data">
        Upload file: <input type="file" name="thefile"/>
        <button type="submit">Upload</button>
    </form>

</body>
</html>
