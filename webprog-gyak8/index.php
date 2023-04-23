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
Hi there!

<?php echo "Dynamic 'Hi there'"  ?>

<?php
// Types
$bool = false;
$int = 4;
$float = 4.2;
$string = "4.2";
$array = ["asd", "asdasd"];
$callable = function() {};

echo "asd" . "kek";
echo 5 + 3;
echo '<br>';
echo 5 <=> 3;
echo 3 <=> 5;
echo 3 <=> 3;
echo '<br>';
echo 9 ?? NULL ?? 8;
echo NULL ?? NULL ?? 8;
echo 1 ? 1 : 0;
echo 1 ?: 0; // 1 ? 1 : 0

echo "<br> gettype(bool):" . gettype($bool);
echo "<br> gettype(int):" . gettype($int);
echo "<br> gettype(float):" . gettype($float);
echo "<br> gettype(string):" . gettype($string);
echo "<br> gettype(array):" . gettype($array);
echo "<br> gettype(callable):" . gettype($callable);
echo "<br> is_callable(array):" . is_callable($array);
echo "<br> is_callable(callable):" . is_callable($callable);


// Find even numbers
function even(array $array): array {
    $result = [];
    foreach($array as $number) {
        if ($number % 2 == 0) {
            $result[] = $number;
        }
    }
    return $result;
}

function filter(array $array, callable $fn): array {
    $result = [];
    foreach($array as $number) {
        if ($fn($number)) {
            $result[] = $number;
        }
    }
    return $result;
}

$numbers = [-2, 0, 1, 8, 11, 13, 15, 16];
$evenNumbers = even($numbers);

echo "<br>Even numbers: <br>";
print_r($evenNumbers);

$oddNumbers = filter($numbers, function($number) {
    return $number % 2 == 1;
});
echo "<br>Odd numbers: <br>";
print_r($oddNumbers);

$oddNumbersAlternative = filter($numbers, fn($number) => $number % 2 == 1);
echo "<br>Odd numbers alternative: <br>";
print_r($oddNumbersAlternative);

$oddNumbersSecondAlternative = array_filter($numbers, fn($number) => $number % 2 == 1);
echo "<br>Odd numbers second alternative: <br>";
print_r($oddNumbersSecondAlternative);
?>

<br> Odd numbers:
<ul>
    <?php foreach($oddNumbers as $oddNumber) : ?>
        <li>
            <?= $oddNumber ?>
        </li>
    <?php endforeach ?>
</ul>

<!--
Adatmegjelenítés
-->
<?php
$settings = [
    1 => [
        'name' => 'Theme',
        'type' => 'radio',
        'options' => [
            'light' => false,
            'dark' => true
        ]
    ],
    2 => [
        'name' => 'Mode',
        'type' => 'checkbox',
        'options' => [
            'mode1' => true,
            'mode2' => false,
            'mode3' => true
        ]
    ]
];
?>

<h3>
    Category
</h3>
<input type="radio" name="theme"> Light
<input type="radio" name="theme"> Dark

<?php foreach($settings as $id => $setting) : ?>
    <h3><?= $setting['name'] ?></h3>
    <?php foreach($setting['options'] as $option => $checked) : ?>
        <input type="<?= $setting['type'] ?>"
               name="setting_<?= $id ?>"
            <?= $checked ? 'checked' : '' ?>
        />
        <?= $option ?>
    <?php endforeach ?>

<?php endforeach ?>

<!-- Környezeti változók -->
<?php
print_r(getenv("PATH"));
?>

<!-- URL query parameter -->
<a href="http://localhost:8000/index.php?color=blue">Blue</a>
<?php
// print_r($_GET["color"]);
// print_r($_GET["color2"]);

$backgroundColor = $_GET["color"] ?? "white";
?>
<style>
    html {
        background-color: <?= $backgroundColor ?>;
    }
</style>

<!-- Form -->
<form method="post" action="squareRoot.php">
    <label for="number" title="number">
    <input type="text" id="title" name="number">
    <button type="submit">Calculate square root</button>
</form>
</body>
</html>
