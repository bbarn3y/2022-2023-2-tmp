<?php
declare(strict_types=1)
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

<!-- FOSZK only! -->
<!-- Környezeti változók -->
<?php
print_r(getenv("PATH"));
?>

<!-- Form -->
<form method="get" action="squareRoot.php">
    <label for="number" title="number">
    <input type="text" id="title" name="number">
    <button type="submit">Calculate square root</button>
</form>




</body>
</html>
