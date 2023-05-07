<?php

$personsFile = fopen("persons.json", "r");

$personsAsString = fread($personsFile, filesize("persons.json"));
echo $personsAsString;
$parsedPersons = json_decode($personsAsString, true);
print_r($parsedPersons);

?>

<ul>
<?php
    foreach ($parsedPersons as $person) : ?>
    <li>
        <?= $person['name'] ?>
    </li>
<?php endforeach; ?>
</ul>

<?php
$adultPersons = array_filter($parsedPersons, fn($person) => $person['age'] >= 18 && $person['sex'] == 'F');
echo "<br>Adult female people: <br>";
foreach ($adultPersons as $adultPerson) : ?>
    <li>
        <?= $adultPerson['name'] ?>
    </li>
<?php endforeach; ?>

<?php
$adultPersonsCSVFile = fopen('adult_persons.csv', 'w');
fwrite($adultPersonsCSVFile, 'name,age,sex' . PHP_EOL);
foreach ($adultPersons as $adultPerson) {
    fwrite($adultPersonsCSVFile, $adultPerson['name'] . ',' . $adultPerson['age'] . ',' . $adultPerson['sex'] . PHP_EOL);
}
fclose($adultPersonsCSVFile);
?>
