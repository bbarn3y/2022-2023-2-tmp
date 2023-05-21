<?php
    // TASK A
    session_start();
    include_once('storage.php');
    $storage = new Storage(new JsonIO('recipes.json'));
    $recipes = $storage -> findAll();
    // TASK B
    if (!isset($_SESSION['fridge']))
        $_SESSION['fridge'] = [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Task 4</title>
</head>
<body>
    <h1>Task 4: Recipe tracker</h1>

    <h2>List of recipes</h2>
    <ul>
        <?php foreach($recipes as $name => $ingredients): ?>
            <li>
                <a href="details.php?recipe=<?= $name ?>"><?= $name ?></a>
                <!-- TASK E -->
                <?= !count(array_filter($ingredients, fn($i) => !in_array($i, $_SESSION['fridge']))) ? ' - <a href="make.php?recipe='.$name.'"><span style="color: green"><b>Can make!</b></span></a>' : '' ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- TASK B -->
    <h2>Fridge contents</h2>
    <?= !$_SESSION['fridge'] ? 'Fridge is empty.' : '' ?>
    <ul>
        <?php foreach($_SESSION['fridge'] as $f): ?>
            <li><?= $f ?></li>
        <?php endforeach; ?>
    </ul>

    </body>
</html>
