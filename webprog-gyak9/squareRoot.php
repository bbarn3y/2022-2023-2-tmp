<!-- FOSZK only! -->
<?php

    print_r($_GET);
    print_r($_POST);
    print_r($_POST['number']);

    $errors = [];
    $number = $_GET['number'] ?? $_POST['number'];

    // Read input
    $number = $_GET['number'] ?? $_POST['number'];

    if ($number == null || $number == '') {
        $errors[] = "Please provide a number";
        $number = 0;
    } else if (!is_numeric($number)) {
        $errors[] = $number . " is not number!";
        $number = 0;
    }

    // Calculate
    $squareRoot = NULL;
    if (count($errors) == 0) {
        $squareRoot = sqrt($number);
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
    <div>Number: <?= $number ?></div>
    <?php if ($squareRoot != NULL): ?>
        <div>SQRT: <?php print_r($squareRoot) ?></div>
    <?php endif; ?>

    <?php foreach($errors as $error): ?>
        <div style="color: red"><?= $error ?></div>
    <?php endforeach; ?>
</body>
</html>
