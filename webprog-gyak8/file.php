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
