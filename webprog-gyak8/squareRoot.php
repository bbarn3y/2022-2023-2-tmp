<?php

    print_r($_GET);
    print_r($_POST);
    print_r($_POST['number']);

    $error = '';
    $number = NULL;

    // Read input
    $number = $_GET['number'] ?? $_POST['number'];

    if ($number == null || $number == '') {
        $error = 'Empty value!';
        $number = 0;
    } else if (!is_numeric($number)) {
        $error = 'Value must be numeric!';
        $number = 0;
    }


    // Calculate
    $squareRoot = sqrt($number);

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
    <div>SQRT: <?php print_r($squareRoot) ?></div>

    <?php if ($error != '') : ?>
        <div style="color: red"><?= $error ?></div>
    <?php endif; ?>
</body>
</html>
